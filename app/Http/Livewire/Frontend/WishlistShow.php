<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistShow extends Component
{
    public function removeWishlist($wishlist_id)
    {
        Wishlist::where('user_id', Auth::user()->id)->where('id', $wishlist_id)->delete();
        $this->emit('WishlistCount');
        $this->dispatchBrowserEvent('message', [
            'text' => 'Wishlist Removed Successfully.',
            'type' => 'success',
            'status' => 200
        ]);
    }

    public function render()
    {
        $wishlists = Wishlist::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.wishlist-show', [
            'wishlists' => $wishlists
        ]);
    }
}
