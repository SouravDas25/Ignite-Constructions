@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.'Outgoing Purchases')

@section('page_header')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <h1 class="page-title"><i class="icon-upload"></i> Outgoing Purchases</h1>
                <a href="{{ route('voyager.godowns.index') }}" class="btn btn-warning hoverable waves-effect waves-light"><i class="icon-th-list"></i> Return to list</a>
            </div>
        </div>
    </div>

@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-bordered">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Goods Item</th>
                                        <th>Quantity</th>
                                        <th>Date</th>
                                        <th>Site</th>
                                        <th>Site Address</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($godown->godownTransfers as $godownTransfer)
                                        @if(count($godownTransfer->siteGodownTransfers)>0)
                                            @foreach($godownTransfer->siteGodownTransfers as $siteGodownTransfer)
                                                <tr>
                                                    <td>{{ $godownTransfer->goods->name }}</td>
                                                    <td>{{ $siteGodownTransfer->quantity }} <small>{{ $godownTransfer->goods->unit->name }}</small></td>
                                                    <td>{{ $siteGodownTransfer->siteTransfer->date }}</td>
                                                    <td>{{ $siteGodownTransfer->siteTransfer->site->name }}</td>
                                                    <td>{{ $siteGodownTransfer->siteTransfer->site->address }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
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