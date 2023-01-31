@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <h4 class="alert alert-success">{{ session('message') }}</h4>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>
                        Edit Product
                        <a href="{{ url('admin/products') }}" class="btn btn-danger btn-sm float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/products/'.$product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="seo" data-bs-toggle="tab" data-bs-target="#seo-pane" type="button" role="tab" aria-controls="seo-pane" aria-selected="false">Seo</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="details" data-bs-toggle="tab" data-bs-target="#details-pane" type="button" role="tab" aria-controls="details-pane" aria-selected="false">Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="image" data-bs-toggle="tab" data-bs-target="#image-pane" type="button" role="tab" aria-controls="image-pane" aria-selected="false">Image</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="color" data-bs-toggle="tab" data-bs-target="#color-pane" type="button" role="tab" aria-controls="color-pane" aria-selected="false">Color</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active p-3" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                <div class="mb-3">
                                    <label class="mb-1">Select Category</label>
                                    <select name="category_id" class="form-control">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected':'' }}>
                                                {{ $category->name }}
                                            </option>                                      
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Name</label>
                                    <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Slug</label>
                                    <input type="text" name="slug" class="form-control" value="{{ $product->slug }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Select Brand</label>
                                    <select name="brand" class="form-control">
                                        @foreach ($brands as $brand)
                                            <option value="{{ $brand->name }}" {{ $brand->name == $product->brand ? 'selected':'' }}>
                                                {{ $brand->name }}
                                            </option>                                      
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Small Description</label>
                                    <textarea name="small_description" cols="30" rows="10" class="form-control">{{ $product->small_description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Description</label>
                                    <textarea name="description" cols="30" rows="10" class="form-control">{{ $product->description }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade p-3" id="seo-pane" role="tabpanel" aria-labelledby="seo" tabindex="0">
                                <div class="mb-3">
                                    <label class="mb-1">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" value="{{ $product->meta_title }}">
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Meta Keyword</label>
                                    <textarea name="meta_keyword" cols="30" rows="10" class="form-control">{{ $product->meta_keyword }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="mb-1">Meta Description</label>
                                    <textarea name="meta_description" cols="30" rows="10" class="form-control">{{ $product->meta_description }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade p-3" id="details-pane" role="tabpanel" aria-labelledby="details" tabindex="0">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Original Price</label>
                                            <input type="text" class="form-control" name="original_price" value="{{ $product->original_price }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label>Selling Price</label>
                                            <input type="text" class="form-control" name="selling_price" value="{{ $product->selling_price }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label>Quantity</label>
                                            <input type="number" class="form-control" name="quantity" value="{{ $product->quantity }}">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-4">
                                            <label class="mt-3">Trending</label>
                                            <input type="checkbox" name="trending" {{ $product->trending == '1' ? 'checked':'' }}>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-4">
                                            <label class="mt-3">Featured</label>
                                            <input type="checkbox" name="featured" {{ $product->featured == '1' ? 'checked':'' }}>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="mb-3">
                                            <label class="mt-3">Status</label>
                                            <input type="checkbox" name="status" {{ $product->status == '1' ? 'checked':'' }}>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade p-3" id="image-pane" role="tabpanel" aria-labelledby="image" tabindex="0">
                                <div class="mb-3">
                                    <label class="mb-1">Upload Image Product</label>
                                    <input type="file" multiple class="form-control" name="image[]">
                                </div>
                                <div class="row">
                                    @if ($product->productImages)
                                    @foreach ($product->productImages as $image)
                                    <div class="col-md-2">
                                        <img src="{{ asset($image->image) }}" alt="" width="100px" height="100px"> 
                                        <a href="{{ url('admin/product-image/'.$image->id.'/delete') }}" class="btn btn-sm btn-danger ms-2 mt-2">Remove</a>          
                                    </div>
                                    @endforeach
                                @else
                                <div class="col-md-12 alert alert-danger">
                                    <h5>No Product Image</h5>                            
                                </div>
                                @endif
                                </div>
                            </div>
                            <div class="tab-pane fade p-3" id="color-pane" role="tabpanel" aria-labelledby="color" tabindex="0">
                                <div class="mb-3">
                                    <h4>Add Color</h4>
                                    <hr>
                                    <label class="mb-2">Select Color Product:</label>
                                    <div class="row">
                                        @forelse ($colors as $color)
                                        <div class="col-md-3">
                                            <div class="p-2 border mb-3">
                                                Color: <input type="checkbox" name="colors[{{ $color->id }}]" value="{{ $color->id }}">
                                                {{ $color->name }}
                                                <br>
                                                Quantity: <input type="number" name="quantitycolor[{{ $color->id }}]" style="width:70px;">
                                            </div>
                                        </div>
                                        @empty
                                        <div class="col-md-12">
                                            <h1 class="alert alert-danger text-center">No Colors Found</h1>
                                        </div>
                                        @endforelse                     
                                    </div>
                                </div>
                                <div>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Color Name</th>
                                                <th>Quantity</th>
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($product->productColors as $prodColor)
                                            <tr class="product-color-tr">
                                                <td>
                                                    @if ($prodColor->color)
                                                        {{ $prodColor->color->name }}
                                                    @else
                                                        No Color Found
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="input-group mb-3" style="width:200px">
                                                        <input type="text" value="{{ $prodColor->quantity }}" class="productColorQuantity form-control form-control-sm">
                                                        <button type="button" value="{{ $prodColor->id }}" class="updateProductColorBtn btn btn-primary btn-sm">Update</button>
                                                    </div>
                                                </td>
                                                <td>
                                                <button type="button" value="{{ $prodColor->id }}" class="deleteProductColorBtn btn btn-danger btn-sm">Delete</button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary float-end">Update Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.updateProductColorBtn', function () {
                var product_id = "{{ $product->id }}";
                var prod_color_id = $(this).val();
                var qty = $(this).closest('.product-color-tr').find('.productColorQuantity').val();

                if (qty <= 0) {
                    alert('Quantity is Required');
                    return false;
                }

                var data = {
                    'product_id' : product_id,
                    'qty' : qty
                };

                $.ajax({
                    type: "POST",
                    url: "/admin/product-color/"+prod_color_id,
                    data: data,
                    success: function (response) {
                        alert(response.message);
                    }
                });
            });

            $(document).on('click', '.deleteProductColorBtn', function () {
                var prod_color_id = $(this).val();
                var thisClick = $(this);
                
                $.ajax({
                    type: "GET",
                    url: "/admin/product-color/"+prod_color_id+"/delete",
                    success: function (response) {
                        thisClick.closest('.product-color-tr').remove();
                        alert(response.message);
                    }
                });
            });

        });
    </script>
@endsection