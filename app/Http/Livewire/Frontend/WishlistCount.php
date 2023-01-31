<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistCount extends Component
{
    public $wishlist;

    protected $listeners = ['WishlistCount' => 'wishlistCheckCount'];

    public function wishlistCheckCount()
    {
        if (Auth::check())
        {
            return $this->wishlist = Wishlist::where('user_id', Auth::user()->id)->count();
        }
        else
        {
            return $this->wishlist = 0;
        }
    }

    public function render()
    {
        $this->wishlist = $this->wishlistCheckCount();
        return view('livewire.frontend.wishlist-count', [
            'wishlist' => $this->wishlist
        ]);
    }
}
