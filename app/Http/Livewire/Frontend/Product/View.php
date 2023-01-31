<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category, $product, $productColorQuantitySelected, $quantityCount = 1, $productColorId;

    public function decrementQuantity()
    {
        if ($this->quantityCount > 1)
        $this->quantityCount--;
    }

    public function incrementQuantity()
    {
        if ($this->quantityCount < 10)
        $this->quantityCount++;
    }

    public function colorSelected($productColorId)
    {
        $this->productColorId = $productColorId;
        $productColor = $this->product->productColors()->where('id', $productColorId)->first();
        $this->productColorQuantitySelected = $productColor->quantity;
        if ($this->productColorQuantitySelected == 0)
        {
            $this->productColorQuantitySelected = 'outOfStock';
        }
    }

    public function addToCart(int $product_id)
    {
        if (Auth::check())
        {
            if ($this->product->where('id', $product_id)->where('status', 0)->exists())
            {
                // Check for product color quantity and add to cart
                if ($this->product->productColors()->count() > 0)
                {
                    if ($this->productColorQuantitySelected != NULL)
                    {
                        $productColor = $this->product->productColors()->where('id', $this->productColorId)->first();
                        if ($productColor->quantity > 0)
                        {
                            if (Cart::where('user_id', Auth::user()->id)->where('product_id', $product_id)->where('product_color_id', $productColor->id)->exists())
                            {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product Already Added',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                            else
                            {
                                if($productColor->quantity > $this->quantityCount)
                                {
                                    Cart::create([
                                        'user_id' => Auth::user()->id,
                                        'product_id' => $product_id,
                                        'product_color_id' => $productColor->id,
                                        'quantity' => $this->quantityCount
                                    ]);
                                    $this->emit('cartCountUpdate');
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Product Added To Cart',
                                        'type' => 'success',
                                        'status' => 200
                                    ]);
                                }
                                else
                                {
                                    $this->dispatchBrowserEvent('message', [
                                        'text' => 'Only '.$productColor->quantity.' Quantity Available',
                                        'type' => 'warning',
                                        'status' => 404
                                    ]);
                                }
                            }
                        }
                        else
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product out of stock',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                    }
                    else
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Select Product Color!',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    }
                }
                else
                {
                    if ($this->product->quantity > 0)
                    {
                        if (Cart::where('user_id', Auth::user()->id)->where('product_id', $product_id)->exists())
                        {
                            $this->dispatchBrowserEvent('message', [
                                'text' => 'Product Already Added',
                                'type' => 'warning',
                                'status' => 404
                            ]);
                        }
                        else
                        {
                            if ($this->product->quantity > $this->quantityCount)
                            {
                                Cart::create([
                                    'user_id' => Auth::user()->id,
                                    'product_id' => $product_id,
                                    'quantity' => $this->quantityCount
                                ]);
                                $this->emit('cartCountUpdate');
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Product Added To Cart',
                                    'type' => 'success',
                                    'status' => 200
                                ]);
                            }
                            else
                            {
                                $this->dispatchBrowserEvent('message', [
                                    'text' => 'Only '.$this->product->quantity.' Quantity Available',
                                    'type' => 'warning',
                                    'status' => 404
                                ]);
                            }
                        }
                    }
                    else
                    {
                        $this->dispatchBrowserEvent('message', [
                            'text' => 'Product out of stock',
                            'type' => 'warning',
                            'status' => 404
                        ]);
                    }
                }
            }
            else
            {
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Product does not exists',
                    'type' => 'warning',
                    'status' => 404
                ]);
            }
        }
        else
        {
            session()->flash('danger', 'You Must Login First Before Add To Cart!');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login First Before Add To Cart!',
                'type' => 'info',
                'status' => 401
            ]);
        }
    }

    public function addToWishlist($product_id)
    {
        if (Auth::check())
        {
            if (Wishlist::where('user_id', Auth::user()->id)->where('product_id', $product_id)->exists())
            {
                session()->flash('danger', 'You have Already This Product In Wishlist!');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'You have Already This Product In Wishlist!',
                    'type' => 'warning',
                    'status' => 409
                ]);
                return false;
            }
            else
            {
                Wishlist::create([
                    'user_id' => Auth::user()->id,
                    'product_id' => $product_id,
                ]);
                $this->emit('WishlistCount');
                session()->flash('message', 'Wishlist Added Successfully.');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist Added Successfully.',
                    'type' => 'success',
                    'status' => 200
                ]);
                return false;
            }
        }
        else
        {
            session()->flash('danger', 'You Must Login First Before Add Wishlist!');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login First Before Add Wishlist!',
                'type' => 'info',
                'status' => 401
            ]);
            return false;
        }
    }

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.frontend.product.view', [
            'category' => $this->category,
            'product' => $this->product
        ]);
    }
}
