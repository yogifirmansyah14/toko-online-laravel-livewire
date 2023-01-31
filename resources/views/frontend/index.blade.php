@extends('layouts.app')

@section('title', 'Home Page')

@section('content')

@if (session('message'))
  <div class="alert alert-success text-center mt-3">{{ session('message') }}</div>
@endif

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    @foreach ($sliders as $key => $slider)           
        <div class="carousel-item {{ $key == 0 ? 'active':'' }}">
            <img src="{{ asset("$slider->image") }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <div class="custom-carousel-content text-center">
                    <h1>
                        {!! $slider->title !!}
                    </h1>
                    <p>
                        {{ $slider->description }}
                    </p>
                    <div>
                        <a href="#" class="btn btn-slider">
                            Get Now
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

<div class="py-5 bg-white">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 text-center">
        <h4>Welcome to TOKO E-Commerce</h4>
        <div class="underline mx-auto"></div>
        <p>
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit ab voluptates incidunt alias cum laudantium a ipsam cumque neque illo! Nulla laboriosam a quas repellendus, obcaecati impedit saepe incidunt. Ratione?
        </p>
      </div>
    </div>
  </div>
</div>

<div class="py-5 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4>Trending Products</h4>
        <div class="underline mb-4"></div>
      </div>
      @if ($trendingProducts)
        <div class="col-md-12">
          <div class="owl-carousel owl-theme products-carousel">
            @foreach ($trendingProducts as $product)
              <div class="item">
                <div class="product-card">
                    <div class="product-card-img">
                        <label class="stock bg-danger">New</label>                           
                        @if ($product->productImages->count() > 0)
                        <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">
                            <img src="{{ asset($product->productImages[0]->image) }}" alt="{{ $product->name }}">
                        </a>
                        @endif
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{ $product->brand }}</p>
                        <h5 class="product-name">
                            <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h5>
                        <div>
                            <span class="selling-price">Rp. {{ $product->selling_price }}</span>
                            <span class="original-price">Rp. {{ $product->original_price }}</span>
                        </div>
                    </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @else
        <div class="col-md-12">
            <div class="p-2">
                <h4>No Products Available</h4>
            </div>
        </div>
      @endif
    </div>
  </div>
</div>

<div class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4>new Arrivals
          <a href="{{ url('/new-arrivals') }}" class="btn btn-warning float-end">More Info</a>
        </h4>
        <div class="underline mb-4"></div>
      </div>
      @if ($newArrivals)
        <div class="col-md-12">
          <div class="owl-carousel owl-theme products-carousel">
            @foreach ($newArrivals as $product)
              <div class="item">
                <div class="product-card">
                    <div class="product-card-img">
                        <label class="stock bg-danger">New</label>                           
                        @if ($product->productImages->count() > 0)
                        <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">
                            <img src="{{ asset($product->productImages[0]->image) }}" alt="{{ $product->name }}">
                        </a>
                        @endif
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{ $product->brand }}</p>
                        <h5 class="product-name">
                            <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h5>
                        <div>
                            <span class="selling-price">Rp. {{ $product->selling_price }}</span>
                            <span class="original-price">Rp. {{ $product->original_price }}</span>
                        </div>
                    </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @else
        <div class="col-md-12">
            <div class="p-2">
                <h4>No Products Available</h4>
            </div>
        </div>
      @endif
    </div>
  </div>
</div>

<div class="py-5 bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4>Featured Products
          <a href="{{ url('/featured-products') }}" class="btn btn-warning float-end">More Info</a>
        </h4>
        <div class="underline mb-4"></div>
      </div>
      @if ($featuredProducts)
        <div class="col-md-12">
          <div class="owl-carousel owl-theme products-carousel">
            @foreach ($featuredProducts as $product)
              <div class="item">
                <div class="product-card">
                    <div class="product-card-img">
                        <label class="stock bg-danger">New</label>                           
                        @if ($product->productImages->count() > 0)
                        <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">
                            <img src="{{ asset($product->productImages[0]->image) }}" alt="{{ $product->name }}">
                        </a>
                        @endif
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{ $product->brand }}</p>
                        <h5 class="product-name">
                            <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">
                                {{ $product->name }}
                            </a>
                        </h5>
                        <div>
                            <span class="selling-price">Rp. {{ $product->selling_price }}</span>
                            <span class="original-price">Rp. {{ $product->original_price }}</span>
                        </div>
                    </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      @else
        <div class="col-md-12">
            <div class="p-2">
                <h4>No Products Available</h4>
            </div>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection

@section('script')
  <script>
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
    })
  </script>
@endsection