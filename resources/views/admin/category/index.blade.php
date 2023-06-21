@extends('admin.layouts.template')
@section('title')
    Category
@endsection
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Category</h1>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Category</li>
        </ol>
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50"><i class="fas fa-plus"></i></span>
                        <span class="text">Add New</span>
                    </a>
                </div>
                <div class="card-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success mb-2">
                            {{ session()->get('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Product</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($categories))
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->subcategory_count }}</td>
                                            <td>{{ $category->product_count }}</td>
                                            <td>
                                                <a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-sm btn-outline-warning">Edit</a>
                                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="modal_delete({{ $category->id }}, '{{ $category->name }}')">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" align="center">-- No Data --</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
    <!-- Modal Delet -->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Delete Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you want to delete this category <b id="delete-name"></b>?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                    <form id="form-delete" action="" method="post" class="inline-block">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function modal_delete(id, name)
        {
            var action = '/admin/category/delete/'+id;
            $('#form-delete').attr('action', action);
            $('#delete-name').text(name);
            $('#modal-delete').modal('show');
        }
    </script>
@endsection