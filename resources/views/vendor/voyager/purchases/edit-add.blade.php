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
    <style>
        .select2 {
            width: 100% !important;
        }

        .voyager .table > thead > tr > th {
            background-color: transparent;
        }

        .table > thead > tr > th {
            color: inherit;
        }
    </style>
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-bordered ">
                    <!-- form start -->
                    <form role="form" id="VueApp"
                          class="form-edit-add pr-3 pl-3 pt-4"
                          action="{{ (isset($purchase->id)) ? route('voyager.purchases.update', $purchase->id) : route('voyager.purchases.store') }}"
                          method="POST" enctype="multipart/form-data">
                        <!-- PUT Method if we are editing -->
+
                        .
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

                            <div class="form-group">
                                <label>Seller</label>
                                <select class="select2-after-vue-select form-control" name="seller_id">
                                    <option value="" disabled {{ !isset($purchase) ? 'selected' : '' }} >Choose an
                                        Option
                                    </option>
                                    @php $selectSeller_id = isset($purchase) ? $purchase->seller_id : old('seller_id') @endphp
                                    @foreach($sellers as $seller)
                                        <option value="{{ $seller->id }}" {{ isset($selectSeller_id) && $selectSeller_id== $seller->id  ? 'selected' : "" }}>
                                            {{ $seller->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group pt-2">
                                <label for="date">Date</label>
                                <input type="date" id="Date" name="date"
                                       value="{{ isset($purchase) ? $purchase->date : old('date') }}"
                                       class="form-control">
                            </div>
                            <div class="form-group pt-2">
                                <label for="purchase_due">Puchase Due</label>
                                <input type="number" id="purchase_due" name="purchase_due"
                                       value="{{ isset($purchase) ? $purchase->purchase_due : old('purchase_due') }}"
                                       class="form-control">
                            </div>
                            <input name="itemList" id="itemList" type="hidden">

                            <div class="row">
                                <div class="col-md-12 grey lighten-3">
                                    <h5 class=" my-4">
                                        <b>Add items to purchase</b>
                                    </h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-3 form-group">
                                            <label>Godown</label>
                                            <select class="select2-after-vue-select form-control"
                                                    name="godown_id" id="godown_id">
                                                <option value="" disabled selected>Choose an option</option>
                                                <option v-for="items in godowns"
                                                        v-bind:value="items.val">
                                                    @{{ items.text }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label>Good</label>
                                            <select class="browser-default select2-after-vue-select" id="good_id"
                                                    name="good_id" onchange="replaceUnit()">
                                                <option value="" disabled selected>Choose an option</option>
                                                <option v-for="items in goods" v-bind:data-unit="items.unit"
                                                        v-bind:value="items.val">
                                                    @{{ items.text }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="quantity">Quantity</label>
                                            <div class="input-group input-group-sm mb-3">
                                                <input type="number" id="quantity" v-model.number="quantity"
                                                       name="quantity" class="form-control p-2">
                                                <div class="input-group-append bg-info">
                                                    <span class="input-group-text">@{{ unit }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="quantity">Cost / @{{ unit }}</label>
                                            <input type="number" id="cost" v-model.number="cost"
                                                   name="cost" class="form-control">
                                        </div>
                                        <div class="col-md-2 pt-4 form-group">
                                            <button v-on:click="additem" type="button"
                                                    class="btn btn-success waves-effect waves-light mt-2">
                                                <i class="voyager-plus pr-2"></i>
                                                Add
                                            </button>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-hover table-ui ">
                                            <thead class="grey darken-3 white-text">
                                            <tr>
                                                <th>Godowns</th>
                                                <th>Goods</th>
                                                <th>Quantity</th>
                                                <th>Cost</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(item, index) in allocation">
                                                <td>
                                                    @{{ item.godown_name }}
                                                </td>
                                                <td>
                                                    @{{ item.good_name }}
                                                </td>
                                                <td>
                                                    @{{ item.qty }} @{{ item.unit }}
                                                </td>
                                                <td>
                                                    @{{ item.cost }}
                                                </td>
                                                <td>
                                                    <button v-on:click="removeitem(index,$event)" type="button"
                                                            class="btn btn-danger btn-sm float-right waves-effects waves-light">
                                                        <i class="icon-trash-empty"></i> Remove
                                                    </button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel-footer form-group pt-4">
                            <button type="button" onclick="submitForm()"
                                    class="btn btn-primary btn-lg waves-effect waves-light ">
                                <i class="icon-flash"></i> {{__('voyager::generic.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



@stop

@section('javascript')
    <script>
        var params = {};
        var $image;

        var ModelGodowns = [
                @if(isset($purchase))
                @foreach($purchase->godownTransfers as $transfer)
            {
                godown_id: '{{ $transfer->godown->id }}',
                godown_name: '{{ $transfer->godown->name }}',
                good_id: '{{ $transfer->goods->id }}',
                good_name: '{{ $transfer->goods->name }}',
                qty: parseInt('{{ $transfer->quantity }}'),
                unit: '{{ $transfer->goods->unit->name }}',
                cost: parseFloat('{{ $transfer->cost }}'),
            },
            @endforeach
            @endif
        ];

        function submitForm() {
            var data = JSON.stringify(ModelGodowns);
            $('#itemList').val(data);
            $('#VueApp').submit();
        }

        function replaceUnit() {
            var goodSelect = $('#good_id option:selected');
            app.unit = goodSelect.data('unit');
        }

        var app;
        $('document').ready(function () {

            //$('.select2').mdb_select();


            app = new Vue({
                el: '#VueApp',
                data: {
                    quantity: 0,
                    cost: 0,
                    unit: "unit",
                    godowns: [
                            @foreach($godowns as $godown)
                        {
                            val: '{{ $godown->id }}', text: '{{ $godown->name }}'
                        },
                        @endforeach
                    ],
                    goods: [
                            @foreach($goods as $good)
                        {
                            val: '{{ $good->id }}', text: '{{ $good->name }}', unit: '{{ $good->unit->name }}'
                        },
                        @endforeach
                    ],
                    allocation: ModelGodowns,
                },
                methods: {
                    additem: function (event) {
                        var godownSelect = $('#godown_id option:selected');
                        var godownName = godownSelect.text().trim();
                        var godownId = godownSelect.val();
                        var goodSelect = $('#good_id option:selected');
                        var goodName = goodSelect.text().trim();
                        var goodId = goodSelect.val();
                        var unit = goodSelect.data('unit');
                        var obj = {
                            godown_id: godownId,
                            godown_name: godownName,
                            good_id: goodId,
                            good_name: goodName,
                            qty: parseInt(this.quantity),
                            unit: unit,
                            cost: parseFloat(this.cost),
                        };
                        if (godownId == "") {
                            toastr['error']('Select a Godown');
                            return;
                        }
                        if (goodId == "") {
                            toastr['error']('Select an Item');
                            return;
                        }
                        if (this.quantity < 1) {
                            toastr['error']('Quantity cannot be Zero');
                            return;
                        }

                        this.allocation.push(obj);
                        //Vue.set(this.allocation,this.allocation.length,obj);
                        console.log(this.allocation, obj);
                    },
                    removeitem: function (index, event) {
                        this.allocation.splice(index, 1);
                        //Vue.delete(this.allocation, id);
                        //console.log(id);
                    }
                }
            });

            $('.select2-after-vue-select').select2();
        });

    </script>
@stop
