<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartShow extends Component
{
    public function removeCart($cart_id)
    {
        Cart::where('id', $cart_id)->where('user_id', Auth::user()->id)->delete();
        $this->emit('cartCountUpdate');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Cart Removed Successfully.',
            'type' => 'success',
            'status' => 200
        ]);
    }

    public function decrementQuantity($cart_id)
    {
        $cart = Cart::where('id', $cart_id)->where('user_id', Auth::user()->id)->first();
        if($cart)
        {
            if($cart->productColor()->where('id', $cart->product_color_id)->exists())
            {
                $productColor = $cart->productColor()->where('id', $cart->product_color_id)->first();
                if($productColor->quantity >= $cart->quantity)
                {
                    if($cart->quantity <= 1)
                    {
                        return $this->removeCart($cart_id);
                    }
                    else
                    {
                        $cart->decrement('quantity');
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Quantity Updated.',
                            'type' => 'success',
                            'status' => 200
                        ]);
                    }
                }
                else
                {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only '.$cart->productColor->quantity.' Product Quantity Available',
                        'type' => 'warning',
                        'status' => 401
                    ]);
                }
            }
            else
            {
                if($cart->product->quantity >= $cart->quantity)
                {
                    if($cart->quantity <= 1)
                    {
                        return $this->removeCart($cart_id);
                    }
                    else
                    {
                        $cart->decrement('quantity');
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Quantity Updated.',
                            'type' => 'success',
                            'status' => 200
                        ]);
                    }
                }
                else
                {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only '.$cart->product->quantity.' Product Quantity Available',
                        'type' => 'warning',
                        'status' => 401
                    ]);
                }
            }
        }
        else
        {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Product Doesnt Exists.',
                'type' => 'warning',
                'status' => 401
            ]);
        }
    }

    public function incrementQuantity($cart_id)
    {
        $cart = Cart::where('id', $cart_id)->where('user_id', Auth::user()->id)->first();
        if($cart)
        {
            if($cart->productColor()->where('id', $cart->product_color_id)->exists())
            {
                $productColor = $cart->productColor()->where('id', $cart->product_color_id)->first();
                if($productColor->quantity > $cart->quantity)
                {
                    $cart->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity Updated.',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
                else
                {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only '.$cart->productColor->quantity.' Product Quantity Available',
                        'type' => 'warning',
                        'status' => 401
                    ]);
                }
            }
            else
            {
                if($cart->product->quantity > $cart->quantity)
                {
                    $cart->increment('quantity');
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Quantity Updated.',
                        'type' => 'success',
                        'status' => 200
                    ]);
                }
                else
                {
                    $this->dispatchBrowserEvent('message', [
                        'text' => 'Only '.$cart->product->quantity.' Product Quantity Available',
                        'type' => 'warning',
                        'status' => 401
                    ]);
                }
            }
        }
        else
        {
            $this->dispatchBrowserEvent('message', [
                'text' => 'Product Doesnt Exists.',
                'type' => 'warning',
                'status' => 401
            ]);
        }
    }

    public function render()
    {
        $carts = Cart::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.cart-show', [
            'carts' => $carts
        ]);
    }
}
