@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title','Edit'.' '.'Site Transfer')

@section('page_header')
    <h1 class="page-title">
        <i class="icon-switch"></i>
        Edit Site Transfer
    </h1>
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                          class="form-edit-add pr-3 pl-3"
                          action="{{ route('voyager.site-transfers.update',$siteTransfer->id) }}"
                          method="POST" >
                        <!-- PUT Method if we are editing -->

                        {{ method_field("PUT") }}

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="md-form">
                                <select class="colorful-select dropdown-primary mdb-select" id="godown_id" name="godown_id">
                                    @foreach($godowns as $godown)
                                        <option value="{{ $godown->id }}"{{ isset($siteTransfer->godown()->id) && $siteTransfer->godown()->id== $godown->id  ? 'selected' : "" }}>{{ $godown->name }}</option>
                                    @endforeach
                                </select>
                                <label>Godown</label>
                            </div>

                            <div class="md-form">
                                <select class="colorful-select dropdown-primary mdb-select" id="good_id" name="good_id">
                                    @foreach($goods as $good)
                                        <option value="{{ $good->id }}"{{ isset($siteTransfer->goods()->id) && $siteTransfer->goods()->id== $good->id  ? 'selected' : "" }}>{{ $good->name }}</option>
                                    @endforeach
                                </select>
                                <label>Goods Item</label>
                            </div>

                            <div class="form-group">
                                <label for="quantity" >Quantity</label>
                                <input type="number" id="quantity" value="{{ $siteTransfer->transferQuantity() }}" name="quantity" class="form-control">
                            </div>

                            <div class="md-form">
                                <select class="colorful-select dropdown-primary mdb-select" id="site_id" name="site_id">
                                    @foreach($sites as $site)
                                        <option value="{{ $site->id }}"{{ isset($siteTransfer->id) && $siteTransfer->site->id== $site->id  ? 'selected' : "" }}>{{ $site->name }}</option>                                   
                                    @endforeach
                                </select>
                                <label>Site</label>
                            </div>

                            <div class="md-form">
                                <select class="colorful-select dropdown-primary mdb-select" id="labour_id" name="labour_id">
                                    @foreach($labours as $labour)
                                        <option value="{{ $labour->id }}"{{ isset($siteTransfer->id) && $siteTransfer->labour->id== $labour->id  ? 'selected' : "" }}>{{ $labour->name }}</option>
                                    @endforeach
                                </select>
                                <label>Labour</label>
                            </div>

                            <div class="form-group">
                                <label for="date" >Date</label>
                                <input type="date" id="date" value="{{ $siteTransfer->date }}" name="date" class="form-control">
                            </div>

                        </div><!-- panel-body -->

                        <div class="panel-footer">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg mx-0 save">{{ __('voyager::generic.save') }}</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-danger" id="confirm_delete_modal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"
                            aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="voyager-warning"></i> {{ __('voyager::generic.are_you_sure') }}</h4>
                </div>

                <div class="modal-body">
                    <h4>{{ __('voyager::generic.are_you_sure_delete') }} '<span class="confirm_delete_name"></span>'</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('voyager::generic.cancel') }}</button>
                    <button type="button" class="btn btn-danger" id="confirm_delete">{{ __('voyager::generic.delete_confirm') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete File Modal -->
@stop

@section('javascript')
    <script>
        var params = {};
        $('document').ready(function () {
            $('.mdb-select').material_select();
            $('.datepicker').pickadate();
        });
    </script>
@stop