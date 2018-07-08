@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.'Site Transfers')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="icon-paper-plane"></i> Site Transfers
        </h1>
        <a href="{{ route('voyager.site-transfers.create') }}" class="btn btn-success btn-lg hoverable waves-effect waves-light"><i class="voyager-plus"></i> Add New</a>
    </div>
    <style>
        #search-input{
            border : 0;
        }

        #search-input input {
            border: 1px black !important;
        }
    </style>
@stop

@section('content')
    <ul class="nav nav-tabs blue nav-justified">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">Active</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#panel2" role="tab">Completed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#panel3" role="tab">Pending</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#panel4" role="tab">Canceled</a>
        </li>
    </ul>
    <!-- Tab panels -->
    <div class="tab-content card">
        <!--Panel 1-->
        <div class="tab-pane fade in show active" id="panel1" role="tabpanel">
            <br>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Goods Item</th>
                                <th>Quantity</th>
                                <th>Godown</th>
                                <th>Site</th>
                                <th>Labour</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!--/.Panel 1-->
        <!--Panel 2-->
        <div class="tab-pane fade" id="panel2" role="tabpanel">
            <br>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Goods Item</th>
                                <th>Quantity</th>
                                <th>Godown</th>
                                <th>Site</th>
                                <th>Labour</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!--/.Panel 2-->
        <!--Panel 3-->
        <div class="tab-pane fade" id="panel3" role="tabpanel">
            <br>
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Goods Item</th>
                                <th>Quantity</th>
                                <th>Godown</th>
                                <th>Site</th>
                                <th>Labour</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!--/.Panel 3-->
    </div>

    {{-- Single delete modal --}}
    
@stop



@section('javascript')
    <!-- DataTables -->
 
@stop
