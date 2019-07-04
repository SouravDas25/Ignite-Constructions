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
    <div class="container-fluid pt-5">
        <div class="row mb-4">
            <div class="col-lg-12">
                <h3 class="pl-3"><b>Seller :</b> {{ $purchase->seller->name }}</h3>
                <h5 class="pl-3 pt-3"><b>Date :</b> {{ $purchase->date }}</h5>
                <h5 class="pl-3 pt-3"><b>Due :</b> ₹ {{ number_format($purchase->purchase_due,2) }}</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-bordered">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="grey darken-3 white-text">
                                    <tr>
                                        <th>Godown</th>
                                        <th>Goods Item</th>
                                        <th>Quantity</th>
                                        <th>Cost / unit </th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchase->godownTransfers as $godownTransfer)
                                        <tr>
                                            <td>{{ $godownTransfer->Godown->name }}</td>
                                            <td>{{ $godownTransfer->goods->name }}</td>
                                            <td>
                                                {{ $godownTransfer->quantity }}
                                                <small>{{ $godownTransfer->goods->unit->name  }}</small>
                                            </td>
                                            <td>₹ {{ number_format($godownTransfer->cost,2) }}</td>
                                            <td>
                                                ₹ {{ number_format($godownTransfer->cost * $godownTransfer->quantity,2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="grey lighten-4">
                                <tr>
                                    <td colspan="4" class="text-right">
                                        Total Amount
                                    </td>
                                    <td>
                                        ₹ {{ number_format($purchase->totalAmount(),2) }}
                                    </td>
                                </tr>
                                </tfoot>
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
