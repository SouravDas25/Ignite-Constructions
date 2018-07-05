@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.'Incoming Purchases')

@section('page_header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h1 class="page-title"><i class="icon-download"></i> Incoming Purchases</h1>
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
                                        <th>Date</th>
                                        <th>Seller</th>
                                        {{-- <th class="text-right">Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($godown->godowntransfers)>0)
                                        @foreach($godown->godowntransfers as $godowntransfer)
                                            <tr>
                                                <td>{{ $godowntransfer->purchases->goods->name }}</td>
                                                <td>{{ $godowntransfer->quantity }}</td>
                                                <td>{{ $godowntransfer->date }}</td>
                                                <td>{{ $godowntransfer->purchases->sellers->name }}</td>
                                                {{-- <td><a class="btn btn-sm btn-danger hoverable waves-effect waves-light" data-toggle="modal" data-target="#delete_Modal"><i class="icon-trash-empty pr-2"></i> Delete</a></td> --}}
                                            </tr>
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
    

        {{-- <div class="modal modal-danger fade" id="delete_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"><b>Are you sure that you want to delete this purchase?</b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    
                    <div class="modal-footer">
                        <form action="{{ route('voyager.godowns.destroy' , ['id' => $godown->id ] ) }}" id="delete_form" method="POST">
                            {{ method_field("DELETE") }}
                            {{ csrf_field() }}
                            <input type="submit" class="btn btn-danger hoverable" value="Delete this Purchase">
                        </form>
                        <button type="button" class="btn btn-secondary btn-lg pull-right hoverable" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> --}}

@stop