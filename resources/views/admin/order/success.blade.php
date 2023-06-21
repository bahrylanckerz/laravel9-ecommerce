@extends('admin.layouts.template')
@section('title')
    Order Success
@endsection
@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Order Success</h1>
        <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Order Success</li>
        </ol>
    </div>
    <!-- Row -->
    <div class="row">
        <!-- Area Charts -->
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">List Order Success</h6>
                </div>
                <div class="card-body">
                    <h4>List Order Success</h4>
                </div>
            </div>
        </div>
    </div>
    <!--Row-->
@endsection