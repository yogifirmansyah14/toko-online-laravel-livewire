<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
    
            <div class="row">
                <div class="col-md-12">
                    <div class="shopping-cart">

                        <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                            <div class="row">
                                <div class="col-md-4">
                                    <h4>Products</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Price</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Quantity</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Total</h4>
                                </div>
                                <div class="col-md-2">
                                    <h4>Remove</h4>
                                </div>
                            </div>
                        </div>

                        @php $total = 0; @endphp
                        @forelse ($carts as $cart)
                        <div class="cart-item">
                            <div class="row">
                                <div class="col-md-4 my-auto">
                                    <a href="{{ url('/collections/'.$cart->product->category->slug.'/'.$cart->product->slug) }}">
                                        <label class="product-name">
                                            @if ($cart->product->productImages)
                                            <img src="{{ $cart->product->productImages[0]->image }}" style="width: 50px; height: 50px" alt="">                                        
                                            @else
                                            <img src="" style="width: 50px; height: 50px" alt="">    
                                            @endif
                                            {{ $cart->product->name }}
                                            @if ($cart->productColor)
                                                <small>
                                                    - {{ $cart->productColor->color->name }}
                                                </small>
                                            @endif
                                        </label>
                                    </a>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">{{ currency_IDR($cart->product->selling_price) }} </label>
                                </div>
                                <div class="col-md-2 col-7 my-auto">
                                    <div class="quantity">
                                        <div class="input-group">
                                            <button class="btn btn1" wire:click="decrementQuantity({{ $cart->id }})"><i class="fa fa-minus"></i></button>
                                            <input type="text" value="{{ $cart->quantity }}" class="input-quantity" />
                                            <button class="btn btn1" wire:click="incrementQuantity({{ $cart->id }})"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label class="price">{{ currency_IDR($cart->product->selling_price * $cart->quantity) }} </label>
                                </div>
                                <div class="col-md-2 col-5 my-auto">
                                    <div class="remove">
                                        <button type="button" wire:click="removeCart({{ $cart->id }})" class="btn btn-danger btn-sm">
                                            <span wire:loading wire:target="removeCart({{ $cart->id }})">
                                                <i class="fa fa-trash"></i> Removing
                                            </span>
                                            <span wire:loading.remove wire:target="removeCart({{ $cart->id }})">
                                                <i class="fa fa-trash"></i> Remove
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $total += $cart->product->selling_price * $cart->quantity ; @endphp
                        @empty
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="alert alert-danger text-center">No Items in Carts</h3>
                            </div>
                        </div>
                        @endforelse                               
                    </div>
                    <div class="card-footer">
                        <h6 class="fw-bold float-end">Total Price : {{ currency_IDR($total) }}</h6> <br><br>
                        <a href="{{ url('checkout') }}" class="btn btn-success float-end">Checkout</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
