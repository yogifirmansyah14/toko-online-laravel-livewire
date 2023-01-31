<?php

namespace App\Http\Livewire\Frontend;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CartCount extends Component
{
    public $cartCount;

    protected $listeners = ['cartCountUpdate' => 'cartCountCheck'];

    public function cartCountCheck()
    {
        if(Auth::check())
        {
            return $this->cartCount = Cart::where('user_id', Auth::user()->id)->count();
        }
        else
        {
            return $this->cartCount = 0;
        }
    }

    public function render()
    {
        $this->cartCount = $this->cartCountCheck();
        return view('livewire.frontend.cart-count', [
            'cartCount' => $this->cartCount
        ]);
    }
}
