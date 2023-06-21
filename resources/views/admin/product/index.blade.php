@extends('admin.layouts.template')
@section('title')
    Product
@endsection
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Product</h1>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Product</li>
        </ol>
    </div>
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                    <a href="{{ route('admin.product.create') }}" class="btn btn-primary btn-icon-split">
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
                                    <th>Image</th>
                                    <th>Product</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (!empty($products))
                                    @foreach ($products as $row)
                                        <tr>
                                            <td>{{ $row->id }}</td>
                                            <td style="width:200px">
                                                <figure>
                                                    <img src="{{ asset('admin/uploads/products/'.$row->image) }}" alt="image" style="width:100%">
                                                    <figcaption>
                                                        <button type="button" class="btn btn-block btn-sm btn-primary" onclick="modal_update({{ $row->id }}, '{{ $row->image }}')">Update</button>
                                                    </figcaption>
                                                </figure>
                                            </td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->quantity }}</td>
                                            <td>Rp.{{ number_format($row->price, 0, ',','.') }}</td>
                                            <td>
                                                <a href="{{ route('admin.product.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                                <button type="button" class="btn btn-sm btn-danger" onclick="modal_delete({{ $row->id }}, '{{ $row->name }}')">Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6" align="center">-- No Data --</td>
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
    <!-- Modal Delete -->
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
                    <p>Are you want to delete this sub category <b id="delete-name"></b>?</p>
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
    
    <!-- Modal Update Image -->
    <div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Update Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form-update" action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <img src="" id="current_image" class="img-thumbnail mb-3" alt="image">
                        <div class="form-group mb-0">
                            <input type="file" name="image" id="image" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancel</button>
                        <input type="hidden" name="_method" value="put">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function modal_delete(id, name)
        {
            var action = '/admin/product/delete/'+id;
            $('#form-delete').attr('action', action);
            $('#delete-name').text(name);
            $('#modal-delete').modal('show');
        }
        
        function modal_update(id, filename)
        {
            var action = '/admin/product/updateimage/'+id;
            var src    = '/admin/uploads/products/'+filename;
            $('#form-update').attr('action', action);
            $('#current_image').attr('src', src);
            $('#modal-update').modal('show');
        }
    </script>
@endsection