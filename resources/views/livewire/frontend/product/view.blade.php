<div>
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-5 mt-3">
                    <div class="bg-white border" wire:ignore>
                        @if ($product->productImages)
                        <!-- <img src="{{ asset($product->productImages[0]->image) }}" class="w-100" alt="Img"> -->
                        <div class="exzoom" id="exzoom">
                            <!-- Images -->
                            <div class="exzoom_img_box">
                                <ul class='exzoom_img_ul'>
                                    @foreach ($product->productImages as $productImage)
                                    <li><img src="{{ asset($productImage->image) }}"/></li>                                        
                                    @endforeach
                                </ul>
                            </div>
                            <!-- <a href="https://www.jqueryscript.net/tags.php?/Thumbnail/">Thumbnail</a> Nav-->
                            <div class="exzoom_nav"></div>
                            <!-- Nav Buttons -->
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                        </div>
                        @else
                        No Image Added
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{ $product->name }} {{ $product->brand }}
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{ $category->name }} / {{ $product->name }}
                        </p>
                        <div>
                            <span class="selling-price">{{ currency_IDR($product->selling_price) }}</span>
                            <span class="original-price">{{ currency_IDR($product->original_price) }}</span>
                        </div>
                        <div>
                            @if ($product->productColors->count() > 0)
                                @if ($product->productColors)
                                    @foreach ($product->productColors as $colorsItem)
                                        <!-- <input type="radio" name="colorSelection" value="{{ $colorsItem->id }}"> {{ $colorsItem->color->name }} -->
                                        <label class="colorSelectionLabel mt-1" style="background-color: {{ $colorsItem->color->code }}"
                                        wire:click="colorSelected({{ $colorsItem->id }})"
                                        >
                                            {{ $colorsItem->color->name }}
                                        </label>
                                    @endforeach
                                @endif
                                <div>
                                    @if ($this->productColorQuantitySelected == 'outOfStock')
                                        <label class="btn-sm py-1 mb-2 mt-1 text-white bg-danger">Out Of Stock</label>                                                                                                           
                                    @elseif ($this->productColorQuantitySelected > 0)
                                        <label class="btn-sm py-1 mb-2 mt-1 text-white bg-success">In Stock</label>                                                                           
                                    @endif
                                </div> 
                            @else
                                @if ($product->quantity > 0)
                                    <label class="btn-sm py-1 mb-2 mt-1 text-white bg-success">In Stock</label>                                   
                                    @else
                                    <label class="btn-sm py-1 mb-2 mt-1 text-white bg-danger">Out Of Stock</label>                                                                   
                                @endif
                            @endif                      
                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" readonly value="{{ $this->quantityCount }}" class="input-quantity" />
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="button" wire:click="addToCart({{ $product->id }})" class="btn btn1">
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </button>
                            <button type="button" wire:click="addToWishlist({{ $product->id }})" class="btn btn1">
                                <span wire:loading.remove wire:target="addToWishlist">
                                    <i class="fa fa-heart"></i> Add To Wishlist 
                                </span>
                                <span wire:loading wire:target="addToWishlist">Added...</span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {{ $product->small_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                            {{ $product->description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="py-3 py-md-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Related @if ($category) {{ $category->name }} @endif Products</h4>
                    <div class="underline"></div>
                </div>
                <div class="col-md-12">
                @if ($category)
                    <div class="owl-carousel owl-theme products-carousel">
                        @foreach ($category->products as $relatedProductCategory)
                        <div class="item">
                            <div class="product-card">
                                <div class="product-card-img">                          
                                    @if ($relatedProductCategory->productImages->count() > 0)
                                    <a href="{{ url('collections/'.$relatedProductCategory->category->slug.'/'.$relatedProductCategory->slug) }}">
                                        <img src="{{ asset($relatedProductCategory->productImages[0]->image) }}" alt="{{ $relatedProductCategory->name }}">
                                    </a>
                                    @endif
                                </div>
                                <div class="product-card-body">
                                    <p class="product-brand">{{ $relatedProductCategory->brand }}</p>
                                    <h5 class="product-name">
                                        <a href="{{ url('collections/'.$relatedProductCategory->category->slug.'/'.$relatedProductCategory->slug) }}">
                                            {{ $relatedProductCategory->name }}
                                        </a>
                                    </h5>
                                    <div>
                                        <span class="selling-price">Rp. {{ $relatedProductCategory->selling_price }}</span>
                                        <span class="original-price">Rp. {{ $relatedProductCategory->original_price }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-2">
                        <h4>No Related Products Available</h4>
                    </div>
                @endif
                </div> 
            </div>
        </div>
    </div>
    
    <div class="py-3 py-md-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h4>Related @if ($product->brand) {{ $product->brand }} @endif Products</h4>
                    <div class="underline"></div>
                </div>
                <div class="col-md-12">
                @if ($category)
                    <div class="owl-carousel owl-theme products-carousel">
                        @foreach ($category->products as $productBrand)
                            @if ($productBrand->brand == "$product->brand")
                            <div class="item">
                                <div class="product-card">
                                    <div class="product-card-img">                          
                                        @if ($productBrand->productImages->count() > 0)
                                        <a href="{{ url('collections/'.$productBrand->category->slug.'/'.$productBrand->slug) }}">
                                            <img src="{{ asset($productBrand->productImages[0]->image) }}" alt="{{ $productBrand->name }}">
                                        </a>
                                        @endif
                                    </div>
                                    <div class="product-card-body">
                                        <p class="product-brand">{{ $productBrand->brand }}</p>
                                        <h5 class="product-name">
                                            <a href="{{ url('collections/'.$productBrand->category->slug.'/'.$productBrand->slug) }}">
                                                {{ $productBrand->name }}
                                            </a>
                                        </h5>
                                        <div>
                                            <span class="selling-price">Rp. {{ $productBrand->selling_price }}</span>
                                            <span class="original-price">Rp. {{ $productBrand->original_price }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>                            
                            @endif
                        @endforeach
                    </div>
                @else
                    <div class="p-2">
                        <h4>No Related Products Available</h4>
                    </div>
                @endif
                </div> 
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script>
        $(function(){

            $("#exzoom").exzoom({

                // thumbnail nav options
                "navWidth": 60,
                "navHeight": 60,
                "navItemNum": 5,
                "navItemMargin": 7,
                "navBorder": 1,

                // autoplay
                "autoPlay": false,

                // autoplay interval in milliseconds
                "autoPlayTimeout": 2000
            
            });

        });

        $('.products-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:4
                }
            }
        });
    </script>
@endpush
