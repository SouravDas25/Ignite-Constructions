@extends('voyager::master')

@section('page_title', __('voyager::generic.viewing').' '.'Site Transfers')

@section('page_header')
    <div class="container-fluid">
        <h1 class="page-title">
            <i class="icon-switch"></i> Site Transfers
        </h1>
        <a href="{{ route('voyager.site-transfers.create') }}" class="btn btn-success btn-lg hoverable waves-effect waves-light">
            <i class="voyager-plus"></i> Add New
        </a>
    </div>
    <style>
        #search-input{
            border : 0;
        }

        #search-input input {
            border: 1px black !important;
        }

        .nav-tabs .nav-item.open .nav-link, .nav-tabs .nav-link.active {
            color : black;
        }
    </style>
@stop

@section('content')
    <div class="container-fluid">
        <ul class="nav nav-tabs blue nav-justified">
            <li class="nav-item">
                <a class="nav-link"
                   href="{{ route('voyager.site-transfers.index') }}" >
                    All
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $status_id == \App\Status::PENDING()->id ? 'active' : '' }}"
                   href="{{ route('voyager.site-transfers.index',['status'=> \App\Status::PENDING()->id ]) }}" >
                    Pending
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $status_id == \App\Status::CONFIRMED()->id ? 'active' : '' }}" role="tab"
                   href="{{ route('voyager.site-transfers.index',['status'=> \App\Status::CONFIRMED()->id ]) }}" >
                    Confirmed
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $status_id == \App\Status::COMPLETED()->id ? 'active' : '' }}"
                   href="{{ route('voyager.site-transfers.index',['status'=> \App\Status::COMPLETED()->id ]) }}">
                    Completed
                </a>
            </li>
        </ul>
        <!-- Tab panels -->
        <div class=" card">
            <!--Panel 1-->
            <div class=" card-body tab-pane fade in show active" id="panel1" role="tabpanel">
                <br>
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table table-hover table-stripped table-ui">
                            <thead>
                            <tr>
                                <th>Goods Item</th>
                                <th>Quantity</th>
                                <th>Godown</th>
                                <th>Site</th>
                                <th>Labour</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($siteTransfers as $transfer)
                                <tr>
                                    <td>{{ $transfer->goods()->name }}</td>
                                    <td>
                                        {{ $transfer->transferQuantity() }}
                                        <small>{{ $transfer->goods()->unit->name }}</small>
                                    </td>
                                    <td>{{ $transfer->godown()->name}}</td>
                                    <td>{{ $transfer->site->name }}</td>
                                    <td>{{ $transfer->labour->name }}</td>
                                    <td>{{ $transfer->status->details }}</td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="" class="btn btn-mdb-color" data-toggle="modal" data-target="#changeStatus">Change Status</a>
                                            <a class="btn btn-warning btn-sm pull-right"
                                            href="{{ route('voyager.site-transfers.show',['id'=>$transfer->id]) }}">
                                                View Transfer
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal modal-warning fade" id="changeStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change Status of this Transfer Job</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <select class="mdb-select colorful-select dropdown-primary" name="godown_id">
                            <option value="" disabled selected>Choose an Option</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->id }}">{{ $status->details }}</option>
                            @endforeach
                        </select>
                        <label class="pt-4">Job Statuses</label>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning btn-block">Save Change</button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    
@stop



@section('javascript')
    
    <script>
        $('document').ready(function ()
        {
            $('.mdb-select').material_select();
        });
    </script>
 
@stop
