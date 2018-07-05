@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title', __('voyager::generic.'.(isset($purchase->id) ? 'edit' : 'add')).' '.'Purchase')

@section('page_header')
    <h1 class="page-title">
        <i class="voyager-basket"></i>
        {{ __('voyager::generic.'.(isset($purchase->id) ? 'edit' : 'add')).' '.'Purchase'}}
    </h1>
    @include('voyager::multilingual.language-selector')
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered">
                    <!-- form start -->
                    <form role="form"
                            class="form-edit-add pr-3 pl-3" id="myForm"
                            action="{{ (isset($purchase->id)) ? route('voyager.purchases.update', $purchase->id) : route('voyager.purchases.store') }}"
                            method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
                        
                        @if(isset($purchase->id))
                            {{ method_field("PUT") }}
                        @endif

                        <!-- CSRF TOKEN -->
                        {{ csrf_field() }}

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Adding / Editing -->
                            
                            <div class="md-form">
                                <select class="colorful-select dropdown-primary mdb-select" id="goods_id" name="goods_id">
                                    <option value="@if(isset($purchase->id)){{ $purchase->goods_id }}@endif" selected disabled>{{ (isset($purchase->id) ? $purchase->goods->name : 'Choose an Option')}}</option>
                                    @foreach($goods as $good)
                                        <option value="{{ $good->id }}">{{ $good->name }}</option>
                                    @endforeach
                                </select>
                                <label>Goods Item</label>
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" id="quantity" name="quantity" class="form-control" value="@if(isset($purchase->id)){{ $purchase->quantity }}@endif">
                            </div>

                            <div class="md-form">
                                <select class="colorful-select dropdown-primary mdb-select" id="seller_id" name="seller_id">
                                    <option value="@if(isset($purchase->id)){{ $purchase->seller_id }}@endif" selected disabled>{{ (isset($purchase->id)) ? $purchase->sellers->name : 'Choose an Option'}}</option>
                                    @foreach($sellers as $seller)
                                        <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                    @endforeach
                                </select>
                                <label>Seller</label>
                            </div>

                            <div class="form-group">
                                <label for="cost">Cost</label>
                                <input type="number" id="cost" name="cost" class="form-control" value="@if(isset($purchase->id)){{ $purchase->cost }}@endif">
                            </div>

                            <div class="form-group">
                                <label for="date">Date</label>
                                <input type="date" id="date" name="date" class="form-control" value="@if(isset($purchase->id)){{ $purchase->date }}@endif">
                            </div>

                            <div class="form-group">
                                <label for="purchase_due">Purchase Due</label>
                                <input type="number" id="purchase_due" name="purchase_due" class="form-control" value="@if(isset($purchase->id)){{ $purchase->purchase_due }}@endif">
                            </div>

                            <div class="pb-4">
                                <button type="button" class="btn hoverable btn-success waves-effect waves-light" data-toggle="modal" data-target="#quantitySharing">
                                    <i class="icon-shuffle-1"></i> Quantity Sharing
                                </button>
                                <i class="icon-question-circle-o" data-toggle="tooltip" data-placement="right" title="Share the goods quantity godown wise"></i>
                            </div>  

                            <div class="form-group col-md-12 pb-4">
                                <table class="table table-hover table-sm">
                                    <thead>
                                        <th>Godowns</th>
                                        <th>Quantity</th>
                                    </thead>
                                    <tbody id="QS_DisplayTABLE">

                                    </tbody>
                                </table>
                            </div>

                        </div><!-- panel-body -->

                        <input type="hidden" name="QS_godowns" id="QS_godowns">
                        <div class="panel-footer form-group">
                            <button type="submit" onclick="SubMitForm()" class="btn btn-info hoverable waves-effect waves-light save"><i class="icon-flash"></i> {{__('voyager::generic.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="quantitySharing" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;"aria-hidden="true">
        <div class="modal-dialog modal-lg modal-notify modal-info" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Quantity Allocation</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="white-text">&times;</span>
                        </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-6">
                                Total Quantity - <span id="QS_TOTALQ"></span> kg
                            </div>
                            <div class="col-sm-6">
                                Remaining Quantity - <span id="QS_REMQ"></span> kg
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8">
                                <select class="mdb-select" id="QS_GODOWN_NAME">
                                    <option value="" disabled selected>Choose your option</option>
                                    @foreach($godowns as $godown)
                                        <option value="{{ $godown->id }}">{{ $godown->name }}</option>
                                    @endforeach
                                </select>
                                <label>Select A Godown</label>
                            </div>
                            <div class="col-sm-4">
                                <button class="btn btn-success" onclick="AddGodownToModal()" type="button">
                                    Add
                                </button>
                            </div>
                            <table class="table table-hover table-sm">
                                <thead>
                                    <th>Godowns</th>
                                    <th>Quantity</th>
                                    <th>Action</th>
                                </thead>
                                <tbody id="QS_TABLE">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
                    <button type="button" data-dismiss="modal" onclick="submitQSModal()" class="btn btn-primary waves-effect waves-light">
                        Save changes
                    </button>
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
        var $image;

        var ModelGodowns = {};
        var Quantity = {total : 0, rem : 0};

        function updateRemainingQty()
        {
            $('#QS_REMQ').html(Quantity.rem.toString());
        }

        function QuantityChange(id)
        {
            //alert('HOLL');
            var qty = $('#QS_QTY_'+id).val();
            if(qty.length < 1) qty = 0;
            qty = parseFloat(qty);
            //console.log(qty);
            if(qty > ModelGodowns[id].qty + Quantity.rem){
                toastr['error']('Quantity Limit Exceeded');
                $('#QS_QTY_'+id).val("");
                $('#QS_QTY_'+id).val(ModelGodowns[id].qty);
                return false;
            }
            Quantity.rem += ModelGodowns[id].qty - qty;
            ModelGodowns[id].qty = qty;
            updateRemainingQty();
        }

        function removeGodown(id) {
            var qty = $('#QS_QTY_'+id).val();
            if(qty.length < 1) qty = 0;
            qty = parseFloat(qty);
            Quantity.rem += parseFloat(qty);
            $('#_tr_'+id).remove();
            delete ModelGodowns[id];
            updateRemainingQty();
        }

        function AddGodownToModal() {
            //e.preventDefault();
            var gSelect = $('#QS_GODOWN_NAME option:selected');
            var gName = gSelect.text();
            var gVal = gSelect.val();
            if (!(gVal in ModelGodowns)){
                ModelGodowns[gVal] = {id:gVal,name:gName,qty:Quantity.rem};
                var html = `<tr id="_tr_${gVal}"> <td> ${gName} </td>` +
                    ` <td> <input id="QS_QTY_${gVal}" type="number" value="${Quantity.rem}" `+
                    `onkeyup="QuantityChange(${gVal})"/> </td> `+
                    `  <td> <button class="btn btn-danger hoverable waves-effect waves-light" type="button" onclick="removeGodown(${gVal})"><i class="icon-trash-empty"></i> Remove </button> </td> </tr>`;
                $('#QS_TABLE').append(html);
                Quantity.rem = 0;
                updateRemainingQty();
            }
        }

        function submitQSModal()
        {
            //alert("lol");
            $('#OPENQSMODALBTN').removeClass('btn-success');
            $('#OPENQSMODALBTN').addClass('btn-primary');
            $('#OPENQSMODALBTN').text("Submit");
            for (var key in ModelGodowns){
                if (ModelGodowns.hasOwnProperty(key)) {
                    var item = ModelGodowns[key];
                    var html = `<tr><td>${item.name}</td><td>${item.qty}</td></tr>`;
                    $('#QS_DisplayTABLE').append(html);
                }
            }
        }

        function SubMitForm()
        {
            if(Object.keys(ModelGodowns).length < 1) {
                toastr['error']('Please Distrubute Your Resources Among Godowns');
                return false;
            }
            var value = JSON.stringify(ModelGodowns);
            $('#QS_godowns').val(value);
            $('#myForm').submit();
        }

        $('document').ready(function () 
        {
            $('.mdb-select').material_select();
            $("#quantitySharing").on('show.bs.modal', function () {
                if( !Quantity.total){
                    Quantity.rem = Quantity.total = parseFloat($('#quantity').val());
                    $('#QS_TOTALQ').html(Quantity.total.toString());
                    $('#QS_REMQ').html(Quantity.total.toString());
                }
            });

            $('.toggleswitch').bootstrapToggle();

            //Init datepicker for date fields if data-datepicker attribute defined
            //or if browser does not handle date inputs
            $('.form-group input[type=date]').each(function (idx, elt) {
                if (elt.type != 'date' || elt.hasAttribute('data-datepicker')) {
                    elt.type = 'text';
                    $(elt).datetimepicker($(elt).data('datepicker'));
                }
            });


            $('.side-body input[data-slug-origin]').each(function (i, el) {
                $(el).slugify();
            });

            $('.form-group').on('click', '.remove-multi-image', function (e) {
                e.preventDefault();
                $image = $(this).siblings('img');

                params = {
                    slug: 'purchases',
                    image: $image.data('image'),
                    id: $image.data('id'),
                    field: $image.parent().data('field-name'),
                    _token: '4LPphWph3cIC2iAEE3L3RaXhIubZAcGoWdt3FALz'
                }

                $('.confirm_delete_name').text($image.data('image'));
                $('#confirm_delete_modal').modal('show');
            });

            $('#confirm_delete').on('click', function () {
                $.post('http://localhost/Ignite-Constructions/public/admin/media/remove', params, function (response) {
                    if (response
                        && response.data
                        && response.data.status
                        && response.data.status == 200) {

                        toastr.success(response.data.message);
                        $image.parent().fadeOut(300, function () { $(this).remove(); })
                    } else {
                        toastr.error("Error removing image.");
                    }
                });

                $('#confirm_delete_modal').modal('hide');
            });
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@stop
