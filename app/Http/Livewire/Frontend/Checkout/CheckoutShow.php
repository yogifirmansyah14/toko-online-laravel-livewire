<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderItems;
use Illuminate\Support\Str;
use App\Mail\PlacingOrderMailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CheckoutShow extends Component
{
    public $carts, $totalProductAmount = 0;

    public $fullname, $phone, $email, $pincode, $address, $payment_mode = NULL, $payment_id = NULL;

    protected $listeners = [
        'validationForAll',
        'transactionEmit' => 'paidOnlineOrder'
    ];

    public function paidOnlineOrder($transaction_id)
    {
        $this->payment_id = $transaction_id;
        $this->payment_mode = 'Paid By Paypal';
        $paypalOrder = $this->placeOrder();
        if ($paypalOrder)
        {
            Cart::where('user_id', Auth::user()->id)->delete();
            session()->flash('message', 'Place Order Successfully.');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Placed Order Successfully.',
                'type' => 'success',
                'status' => 200
            ]);

            return redirect()->to('thank-you');
        }
        else
        {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong.',
                'type' => 'warning',
                'status' => 401
            ]);
        }

    }

    public function validationForAll()
    {
        $this->validate();
    }

    public function rules()
    {
        return [
            'fullname' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string|min:10|max:13',
            'pincode' => 'required|string|min:5|max:6',
            'address' => 'required|string',
        ];
    }

    public function placeOrder()
    {
        $this->validate();
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'tracking_no' => 'Seashrimps'.Str::random(10),
            'fullname' => $this->fullname,
            'email' => $this->email,
            'phone' => $this->phone,
            'pincode' => $this->pincode,
            'address' => $this->address,
            'status_message' => 'In Progress',
            'payment_mode' => $this->payment_mode,
            'payment_id' => $this->payment_id,
        ]);

        foreach ($this->carts as $cart)
        {
            $orderItems = OrderItems::create([
                'order_id' => $order->id,
                'product_id' => $cart->product_id,
                'product_color_id' => $cart->product_color_id,
                'quantity' => $cart->quantity,
                'price' => $cart->product->selling_price,
            ]);

            if ($cart->product_color_id != NULL)
            {
                $cart->productColor()->where('id', $cart->product_color_id)->decrement('quantity', $cart->quantity);
            }
            else
            {
                $cart->product()->where('id', $cart->product_id)->decrement('quantity', $cart->quantity);
            }
        }

        return $order;
    }

    public function codOrder()
    {
        $this->payment_mode = 'Cash On Delivery';
        $codOrder = $this->placeOrder();
        if ($codOrder)
        {
            Cart::where('user_id', Auth::user()->id)->delete();
            try {
                // Send Mail To Customer
                $order = Order::findOrFail($codOrder->id);
                Mail::to("$order->email")->send(new PlacingOrderMailable($order));
            } catch (\Exception $e) {
                // Something went wrong
            }
            session()->flash('message', 'Order Successfully.');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Placed Order Successfully.',
                'type' => 'success',
                'status' => 200
            ]);

            return redirect()->to('thank-you');
        }
        else
        {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Something Went Wrong.',
                'type' => 'warning',
                'status' => 401
            ]);
        }
    }

    public function totalProductAmount()
    {
        $this->carts = Cart::where('user_id', Auth::user()->id)->get();
        $this->totalProductAmount = 0;
        foreach ($this->carts as $cart)
        {
            $this->totalProductAmount += $cart->product->selling_price * $cart->quantity;
        }
        return $this->totalProductAmount;
    }

    public function render()
    {
        $this->fullname = Auth::user()->name;
        $this->email = Auth::user()->email;
        $this->phone = Auth::user()->userDetail->phone;
        $this->pincode = Auth::user()->userDetail->pincode;
        $this->address = Auth::user()->userDetail->address;
        $this->totalProductAmount = $this->totalProductAmount();
        return view('livewire.frontend.checkout.checkout-show', [
            'totalProductAmount' => $this->totalProductAmount
        ]);
    }
}
