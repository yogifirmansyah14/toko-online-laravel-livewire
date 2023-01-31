<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
    
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @forelse ($wishlists as $wishlist)
                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-6 my-auto">
                                    <a href="{{ url('/collections/'.$wishlist->product->category->slug.'/'.$wishlist->product->slug) }}">
                                        <label class="product-name">
                                            <img src="{{ $wishlist->product->productImages[0]->image }}" style="width: 50px; height: 50px">
                                            {{ $wishlist->product->name }}
                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">{{ currency_IDR($wishlist->product->selling_price) }} </label>
                                </div>
                                <div class="col-md-2 col-5 my-auto">
                                    <div class="remove">
                                        <button type="button" wire:click="removeWishlist({{ $wishlist->id }})" class="btn btn-danger btn-sm">
                                            <span wire:loading wire:target="removeWishlist({{ $wishlist->id }})">
                                                <i class="fa fa-trash"></i> Removing
                                            </span>
                                            <span wire:loading.remove wire:target="removeWishlist({{ $wishlist->id }})">
                                                <i class="fa fa-trash"></i> Remove
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="alert alert-danger text-center">No Items in Wishlist</h3>
                            </div>
                        </div>
                        @endforelse
                                
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
