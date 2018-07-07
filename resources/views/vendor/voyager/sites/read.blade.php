@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.'Site')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-milestone"></i> View Site &nbsp;
    </h1>

    <a href="{{route('voyager.sellers.edit',$site->id)}}" class="btn btn-info hoverable"><i class="icon-pencil-4 pr-2"></i>Edit</a>
    <a class="btn btn-danger hoverable" data-toggle="modal" data-target="#delete_Modal"><i class="icon-trash-empty pr-2"></i>Delete</a>
    <a href="{{route('voyager.sellers.index')}}" class="btn btn-yellow hoverable"><i class="icon-th-list pr-2"></i>Return to list</a>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')

    <div class="container pt-4">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="pl-3"><b>{{ $site->name }}</b></h3>
                <h5 class="pt-3 pl-3"><b>Address</b> : {{ $site->address }}</h5>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Goods Item</th>
                                        <th>Quantity</th>
                                        <th>Cost</th>
                                        <th>Godown</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@stop

@section('javascript')
    
   
@stop
