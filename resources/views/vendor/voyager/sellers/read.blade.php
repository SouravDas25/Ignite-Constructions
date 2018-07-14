@extends('voyager::master')

@section('page_title', __('voyager::generic.view').' '.'seller')

@section('page_header')
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h1 class="page-title"><i class="voyager-people"></i>Viewing Seller</h1>
                <a href="{{route('voyager.sellers.edit',$seller->id)}}" class="btn btn-info hoverable"><i class="icon-pencil-4 pr-2"></i>Edit</a>
                <a class="btn btn-danger hoverable" data-toggle="modal" data-target="#delete_Modal"><i class="icon-trash-empty pr-2"></i>Delete</a>
                <a href="{{route('voyager.sellers.index')}}" class="btn btn-yellow hoverable"><i class="icon-th-list pr-2"></i>Return to list</a>
            </div>
        </div>
    </div>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')

  

    <div class="container pt-4">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-5">
                <h3 class="pl-3"><b>{{$seller->name}}</b></h3>

                <div class="pl-3">
                    @foreach($badges as $badge)
                        <?php $color=rand(0,18);?>
                        <span class="badge badge-pill {{$colorArray[$color]}}">{{ $badge->name }}</span>
                    @endforeach
                </div>

            </div>
            <div class="col-lg-1"></div>
            <div class="col-sm-12 col-md-6 col-lg-6" style="background-color:white; border-radius:5px;">
                <h5 class="pl-3 pt-3">Email : {{ $seller->email }}</h5>
                <h5 class="pl-3 pt-2 pb-2">Contact No : {{ $seller->contact_no }}</h5>
            </div>
        </div>
    </div>

    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-md-12">
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
                                        <th>Purchase Due</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($seller->purchases) > 0)
                                        @foreach($seller->purchases as $purchase)
                                            @foreach($purchase->godownTransfers as $transfer)
                                                <tr>
                                                    <td>{{ $transfer->goods->name }}</td>
                                                    <td>{{ $transfer->quantity }} <small>{{ $transfer->goods->unit->name }}</small></td>
                                                    <td>{{ $transfer->cost }}</td>
                                                    <td>{{ $purchase->date }}</td>
                                                    <td>{{ $purchase->purchase_due }}</td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
    <div class="modal modal-danger fade" id="delete_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Are you sure that you want to delete this seller?</b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-footer">
                    <form action="{{ route('voyager.sellers.destroy' , ['id' => $seller->id ] ) }}" id="delete_form" method="POST">
                        {{ method_field("DELETE") }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-danger hoverable" value="Delete this Seller">
                    </form>
                    <button type="button" class="btn btn-secondary btn-lg pull-right hoverable" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Single delete modal --}}
@stop

@section('javascript')
    
@stop
