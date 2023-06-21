@extends('admin.layouts.template')
@section('title')
    Edit Sub Category
@endsection
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Sub Category</h1>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.subcategory') }}">Sub Category</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit</li>
        </ol>
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-body">
                    <form action="{{ route('admin.subcategory.update', $subcategory->id) }}" method="post">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <input type="hidden" name="_method" value="put">
                        <div class="form-group">
                            <label for="name">Sub Category Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') ?: $subcategory->name }}">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="select2 form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" style="width:100%">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option {{ old('category_id') == $category->id || $subcategory->id == $category->id ? 'selected':'' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <a href="{{ route('admin.subcategory') }}" class="btn btn-secondary btn-icon-split">
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