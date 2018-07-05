@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.'Outgoing Purchases')

@section('page_header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h1 class="page-title"><i class="icon-upload"></i> Outgoing Purchases</h1>
                <a href="" class="btn btn-success hoverable waves-effect waves-light"><i class="icon-plus-circled"></i> Add New</a>
                <a href="{{ route('voyager.godowns.index') }}" class="btn btn-warning hoverable waves-effect waves-light"><i class="icon-th-list"></i> Return to list</a>
            </div>
        </div>
    </div>

@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Goods Item</th>
                                        <th>Quantity</th>
                                        <th>Cost</th>
                                        <th>Date</th>
                                        <th>Site</th>
                                        <th>Site Address</th>
                                        {{-- <th class="text-right">Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop