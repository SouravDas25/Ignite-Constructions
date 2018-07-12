@extends('voyager::master')

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('page_title','Add'.' '.'Site Transfer')

@section('page_header')
    <h1 class="page-title">
        <i class="icon-paper-plane"></i>
        Add Site Transfer
    </h1>
    <style>
        .select2 {
            width: 100% !important;
            border : 1px lightgrey solid !important;
        }
    </style>
@stop

@section('content')
    <div class="page-content edit-add container-fluid">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form role="form" id="VueApp"
              class="form-edit-add pr-3 pl-3"
              action="{{ route('voyager.site-transfers.store') }}"
              method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-5 ">
                    <div class="card">
                        <div class="card-header white-text bg-default">
                            <h3 class="card-title">Godowns</h3>
                        </div>
                        <ul class="list-group">
                            @foreach($godowns as $godown)
                                <li class="list-group-item">
                                    <h5 class="my-3 font-weight-bold">
                                        {{$godown->name}}
                                        <a class="float-right badge cyan" aria-expanded="false"
                                           type="button" data-toggle="collapse"
                                           aria-controls="collapseTable_{{ $godown->id }}"
                                           data-target="#collapseTable_{{ $godown->id }}">
                                            +
                                        </a>
                                    </h5>
                                    <table class="table table-sm table-ui collapse"
                                           id="collapseTable_{{ $godown->id }}">
                                        <thead>
                                        <tr>
                                            <th>Goods</th>
                                            <th>Quantity</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($godown->allGoods() as $good)
                                            <tr>
                                                <td>{{ $good->name }}</td>
                                                <td>
                                                    {{ $good->quantity }}
                                                    <small>{{ $good->unit->name }}</small>
                                                </td>
                                                <td>
                                                    <div class="input-group input-group-sm" style="height: 35px">
                                                        <div class="input-group-prepend">
                                                            <button class="btn btn-sm btn-primary m-0"
                                                                    onclick="incrementQuantity('godown_good_{{ $good->id }}{{ $godown->id }}',
                                                                    {{ $good->quantity }})"
                                                                    type="button">
                                                                <i class="fa fa-plus" style="font-size: 1.2em;min-width:20px"></i>
                                                            </button>
                                                        </div>
                                                        <input type="number" class="form-control p-1" style="max-width: 50%"
                                                               id="godown_good_{{ $good->id }}{{ $godown->id }}">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-sm btn-danger m-0"
                                                                    onclick="decrementQuantity('godown_good_{{ $good->id }}{{ $godown->id }}')"
                                                                    type="button">
                                                                <i class="fa fa-minus" style="font-size: 1.2em;min-width:20px"></i>
                                                            </button>
                                                            <button type="button"
                                                                    onclick="addTransfer(
                                                                            'godown_good_{{ $good->id }}{{ $godown->id }}',
                                                                            '{{ $good->unit->name }}','{{ $good->quantity }}',
                                                                            '{{$godown->id}}','{{ $godown->name }}',
                                                                            '{{ $good->id }}','{{ $good->name }}')"
                                                                    class="btn btn-success m-0">
                                                                <i class="fa fa-arrow-right " style="font-size: 1.2em;min-width:20px" aria-hidden="true"></i>
                                                            </button>

                                                        </div>
                                                    </div>


                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">

                            <div class="form-group">
                                <label>Site</label>
                                <select class="select2-after-vue-select form-control" id="site_id" name="site_id">
                                    <option value="" selected disabled>Choose an Option</option>
                                    @foreach($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Labour</label>
                                <select class="select2-after-vue-select form-control" id="labour_id"
                                        name="labour_id">
                                    <option value="" selected disabled>Choose an Option</option>
                                    @foreach($labours as $labour)
                                        <option value="{{ $labour->id }}">{{ $labour->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="table-responsive my-5">
                                <h3>Transfers to Save</h3>
                                <table class="table table-sm table-ui">
                                    <thead>
                                    <tr>
                                        <th>Quantity</th>
                                        <th>Good</th>
                                        <th>Godown</th>
                                        <th>Site</th>
                                        <th>Labour</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(item, key) in transferData">
                                        <td> @{{ item.quantity }} @{{ item.unit }}</td>
                                        <td> @{{ item.good_name }}</td>
                                        <td> @{{ item.godown_name }}</td>
                                        <td> @{{ item.site_name }}</td>
                                        <td> @{{ item.labour_name }}</td>
                                        <td>
                                            <button type="button" v-on:click="removeitem(key,$event)"
                                                    class="btn btn-danger btn-sm">
                                                remove
                                            </button>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            <input type="hidden" name="transferList" id="transferList">

                        </div><!-- panel-body -->

                        <div class="card-footer">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="button" onclick="submitForm()"
                                            class="btn btn-primary btn-lg mx-0 save">
                                        {{ __('voyager::generic.save') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@section('javascript')
    <script>

        function incrementQuantity(id,limit) {
            let val = $('#'+id).val();
            val = parseInt(val) | 0;
            if(val+1 <= limit){
                val++;
                $('#'+id).val(val);
            }
        }
        function decrementQuantity(id) {
            let val = $('#'+id).val();
            val--;
            $('#'+id).val(val);
        }

        function submitForm() {
            var data = JSON.stringify(transferData);
            $('#transferList').val(data);
            $('#VueApp').submit();
        }

        var transferData = {};
        var app ;
        $('document').ready(function () {

            app = new Vue({
                el : '#VueApp',
                data : {
                    transferData : transferData,
                },
                methods : {
                    removeitem : function (key,event) {
                        Vue.delete(this.transferData,key);
                    }
                }
            });

            $('.select2-after-vue-select').select2();
        });

        function addTransfer(quantity_sel,unit,limit,godown_id,godown_name, goods_id,good_name, event = null) {
            var siteSelect = $('#site_id').find('option:selected');
            var site_id = siteSelect.val();
            var site_name = siteSelect.text();
            var labourSelect = $('#labour_id').find('option:selected');
            var labour_id = labourSelect.val();
            var labour_name = labourSelect.text();
            var quantity = parseInt($('#' + quantity_sel).val());
            if(site_id == "")  return toastr['error']('Site not selected.');
            if(labour_id == "")  return toastr['error']('Labour not selected.');
            if( isNaN(quantity) === true || quantity < 0)  return toastr['error']('Quantity cannot be zero.');
            if( quantity > limit ) return toastr['error'](quantity + ' ' + unit + ' of ' + good_name+ ' is not present in the godown.');
            var obj = {
                godown_id :godown_id,
                godown_name :godown_name,
                goods_id :goods_id,
                good_name :good_name,
                site_id : site_id,
                site_name :site_name,
                labour_id :labour_id,
                labour_name :labour_name,
                quantity :quantity,
                unit : unit,
            };
            //app.transferData.push(obj);
            var key = godown_id + "_" + goods_id + "_" + site_id;
            Vue.set(app.transferData,key,obj);
            //console.log(obj);
            return toastr['success']('Transfer Added.');
        }
    </script>
@stop
