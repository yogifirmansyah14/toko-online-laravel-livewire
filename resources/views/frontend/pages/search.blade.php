@extends('layouts.app')

@section('title', 'Search Products')

@section('content')
<div class="py-5 bg-white">
  <div class="container">
    <div class="row justify-content-center">
        
      <div class="col-md-10">
        <h4>Search Result</h4>
        <div class="underline mb-4"></div>
        <p class="mt-3">
            Search result view for <b>{{ Request::get('search') }}</b>
        </p>
      </div>   

        @forelse ($searchProducts as $product)
        <div class="col-md-10">
            <div class="product-card">
                <div class="row">
                    <div class="col-md-3">
                        <div class="product-card-img">
                            <label class="stock bg-danger">New</label>                           
                            @if ($product->productImages->count() > 0)
                            <a href="{{ url('collections/'.$product->category->slug.'/'.$product->slug) }}">
                                <img src="{{ asset($product->productImages[0]->image) }}" alt="{{ $product->name }}">
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-9">
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
                            <p class="mt-3">
                                <b>Description</b> {{ Str::limit($product->small_description, 300) }}
                            </p>
                        </div>
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

        <div class="col-md-10">
            {{ $searchProducts->appends(request()->input())->links() }}
        </div>

        <div class="col-md-12 text-center mt-5">
            <a href="{{ url('/collections') }}" class="btn btn-warning px-3">View More</a>
        </div>
    </div>
  </div>
</div>
@endsection