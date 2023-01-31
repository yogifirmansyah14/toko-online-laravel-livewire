@extends('layouts.app')

@section('title', 'New Arrivals')

@section('content')
<div class="py-5 bg-white">
  <div class="container">
    <div class="row">
        
      <div class="col-md-12">
        <h4>New Arrivals</h4>
        <div class="underline mb-4"></div>
      </div>   

        @forelse ($newArrivals as $product)
        <div class="col-md-3">
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
        @empty
        <div class="col-md-12">
            <div class="p-2">
                <h4>No Products Available</h4>
            </div>
        </div>
        @endforelse

        <div class="col-md-12 text-center mt-5">
            <a href="{{ url('/collections') }}" class="btn btn-warning px-3">View More</a>
        </div>
    </div>
  </div>
</div>
@endsection