@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.'Purchase')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-basket"></i>Viewing Purchase
    </h1>

    <a href="{{route('voyager.purchases.edit',$purchase->id)}}" class="btn btn-info hoverable waves-effect waves-light"><i class="icon-pencil-4 pr-2"></i>Edit</a>
    <a href="{{route('voyager.purchases.index')}}" class="btn btn-warning hoverable waves-effect waves-light"><i class="icon-th-list pr-2"></i>Return to list</a>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    
    <div class="container pl-3 pt-4">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="pl-3"><b>Seller :</b> {{ $purchase->seller->name }}</h3>
                <h5 class="pl-3 pt-3"><b>Date :</b> {{ $purchase->date }}</h5>
            </div>
        </div>
    </div>

    <div class="container-fluid pt-5">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Goods Item</th>
                                        <th>Quantity</th>
                                        <th>Godown</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchase->godownTransfers as $godownTransfer)
                                        <tr>
                                            <td>{{ $godownTransfer->goods->name }}</td>
                                            <td>{{ $godownTransfer->quantity }}</td>
                                            <td>{{ $godownTransfer->Godown->name }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
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
