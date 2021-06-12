@extends('admin.layout')
@section('title', 'Dịch vụ')
@section('menu-data')
<input type="hidden" name="" class="menu-data" value="services-group | services">
@endsection()

@section('css')

<!-- page css -->
<link href="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">

<!-- <link href="{{ asset('assets/css/dragula.min.css') }}" rel="stylesheet"> -->

@endsection()

@section('body')

<div class="page-header no-gutters has-tab">
    <div class="d-md-flex m-b-15 align-items-center justify-content-between notification relative">
        <div class="media align-items-center justify-content-between m-b-15 w-100">
            <div class="m-l-15">
                <h4 class="m-b-0">Danh mục Đặt onliine</h4>
            </div>
            @include('admin.alert')
        </div>
    </div>
</div>
<?php 
    $token = Request::cookie('token');
?>
<div class="container-fluid">
    <div class="tab-content m-t-15">
        <div class="tab-pane fade active show" id="services-overview">
            <div class="card">
                <div class="card-body">
                    <div class="m-t-25">
                        <table id="data-table" class="table"> </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection()

@section('sub_layout')


@endsection()


@section('js')
<!-- page js -->
<script src="{{ asset('assets/vendors/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/vendors/datatables/dataTables.bootstrap.min.js') }}"></script>



<!-- <script src="{{ asset('assets/js/dragula.min.js') }}"></script> -->
<script src="{{ asset('assets/js/page/bookingonline.js') }}"></script>


@endsection()