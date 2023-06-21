@extends('admin.layouts.template')
@section('title')
    Edit Product
@endsection
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.product.create') }}">Product</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.product.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" value="put">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="product_code">Product Code</label>
                            <input type="text" class="form-control @error('product_code') is-invalid @enderror" id="product_code" name="product_code" value="{{ $product->product_code }}" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name">Product Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?: $product->name }}">
                        </div>
                        <div class="form-group">
                            <label for="details">Product Details</label>
                            <textarea class="form-control @error('details') is-invalid @enderror" id="details" name="details" rows="5">{{ old('details') ?: $product->details }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="10">{{ old('description') ?: $product->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="select2 form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" style="width:100%">
                                <option value="">Select Category</option>
                                <?php $category_id_val = old('category_id') ?: $product->category_id ?>
                                @foreach ($categories as $row)
                                    <option {{ $category_id_val == $row->id ? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subcategory_id">Sub Category</label>
                            <select class="select2 form-control @error('subcategory_id') is-invalid @enderror" id="subcategory_id" name="subcategory_id" style="width:100%">
                                <option value="">Select Sub Category</option>
                                <?php $subcategory_id_val = old('subcategory_id') ?: $product->subcategory_id ?>
                                @foreach ($subcategories as $row)
                                    <option {{ $subcategory_id_val == $row->id ? 'selected':'' }} value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" min="0" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') ?: $product->price }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="number" min="0" class="form-control @error('quantity') is-invalid @enderror" id="quantity" name="quantity" value="{{ old('quantity') ?: $product->quantity }}">
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('admin.product') }}" class="btn btn-secondary btn-icon-split">
                            <span class="icon text-white-50"><i class="fas fa-arrow-left"></i></span>
                            <span class="text">Back</span>
                        </a>
                        <button type="submit" class="btn btn-primary btn-icon-split">
                            <span class="icon text-white-50"><i class="fas fa-save"></i></span>
                            <span class="text">Sumbit</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
@endsection