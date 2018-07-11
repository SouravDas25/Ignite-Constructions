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
                          class="form-edit-add pr-3 pl-3 pt-4"
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

                            <div class="form-group">
                                <select class="mdb-select colorful-select dropdown-primary" name="seller_id">
                                    <option value="{{isset($purchase->id) ? $purchase->seller_id : "" }}" disabled selected>{{ isset($purchase->id) ? $purchase->seller->name : 'Choose an Option' }}</option>
                                    @foreach($sellers as $seller)
                                        <option value="{{ $seller->id }}">{{ $seller->name }}</option>
                                    @endforeach
                                </select>
                                <label>Seller</label>
                            </div>

                            <div>
                                <button class="btn btn-primary hoverable waves-effect waves-light" type="button" data-toggle="collapse" data-target="#quantityDistribution" aria-expanded="false" aria-controls="collapseExample">
                                    Quantity Distribution
                                </button>
                            </div>
                            
                            <div class="collapse" id="quantityDistribution">
                                <div class="mr-3 mt-3">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="panel grey lighten-3 z-depth-3 panel-bordered">
                                                    <div class="panel-body">
                                                        <h5><b>Select the followings</b></h5>
                                                        <hr>
                                                        <div class="row">
                                                            <div class="col-lg-3 pt-4 form-group">
                                                                <select class="mdb-select colorful-select dropdown-primary" name="godown_id">
                                                                    <option value="" disabled selected>Choose an option</option>
                                                                    @foreach($godowns as $godown)
                                                                        <option value="{{ $godown->id }}">{{ $godown->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label class="pt-4">Godown</label> 
                                                            </div>
                                                            <div class="col-lg-3 pt-4 form-group">
                                                                <select class="mdb-select colorful-select dropdown-primary" name="good_id">
                                                                    <option value="" disabled selected>Choose an option</option>
                                                                    @foreach($goods as $good)
                                                                        <option value="{{ $good->id }}">{{ $good->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <label class="pt-4">Good</label> 
                                                            </div>
                                                            <div class="col-lg-3 form-group">
                                                                <label for="quantity">Quantity</label>
                                                                <input type="number" id="quantity" name="quantity" class="form-control">
                                                            </div>
                                                            <div class="col-lg-3 pt-4 form-group">
                                                                <button class="btn btn-success hoverable waves-effect waves-light"><i class="voyager-plus pr-2"></i>Add</button>
                                                            </div>
                                                        </div>

                                                        @if(isset($purchase->id))
                                                            <div class="table-responsive">
                                                                <table class="table table-hover">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Godowns</th>
                                                                            <th>Goods</th>
                                                                            <th>Quantity</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($purchase->godownTransfers as $godownTransfer)
                                                                            <tr>
                                                                                <td>
                                                                                    <input type="text" id="godown" name="godown" value="{{ $godownTransfer->godown->name }}" class="form-control">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" id="good" name="good" value="{{ $godownTransfer->goods->name }}" class="form-control">
                                                                                </td>
                                                                                <td>
                                                                                    <input type="text" id="quantity" name="quantity" value="{{ $godownTransfer->quantity }}" class="form-control">
                                                                                </td>
                                                                                <td>
                                                                                    <button class="btn btn-danger btn-sm hoverable waves-effects waves-light"><i class="icon-trash-empty"></i> Remove</button>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @endif

                                                        <div class="row">
                                                            <div class="col-lg-12 pt-3">
                                                                <button class="btn btn-amber hoverable btn-lg btn-block waves-effect waves-dark">Save Changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                            @if(isset($purchase->id))
                                <div class="row">
                                    <div class="col-lg-12 pt-3">
                                        <div class="card grey lighten-3">
                                            <div class="card-header blue-grey white-text">
                                                Purchased Goods Details
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Godowns</th>
                                                                <th>Goods</th>
                                                                <th>Quantity</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($purchase->godownTransfers as $godownTransfer)
                                                                <tr>
                                                                    <td>{{ $godownTransfer->godown->name }}</td>
                                                                    <td>{{ $godownTransfer->goods->name }}</td>
                                                                    <td>{{ $godownTransfer->quantity }}</td>
                                                                </tr>                                                                    </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                                    
                            <div class="form-group pt-2">
                                <label for="date">Date</label>
                                <input type="date" id="Date" name="date" value="@if(isset($purchase->id)){{ $purchase->date }}@endif" class="form-control">
                            </div>

                        </div>

                        <div class="panel-footer form-group pt-4">
                            <button type="submit" class="btn btn-info hoverable waves-effect waves-light save">
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

        var ModelGodowns = {};
        var Quantity = {total: 0, rem: 0};

        function submitQSModal() {
            //alert("lol");
            var obj = $('#OPENQSMODALBTN');
            obj.removeClass('btn-success');
            obj.addClass('btn-primary');
            obj.text("Submit");
            obj = $('#QS_DisplayTABLE');
            obj.html('');
            for (var key in ModelGodowns) {
                if (ModelGodowns.hasOwnProperty(key)) {
                    var item = ModelGodowns[key];
                    var html = `<tr><td>${item.name}</td><td>${item.qty}</td></tr>`;
                    obj.append(html);
                }
            }
        }

        function UpdateQABTN() {
            var value = $('#quantity').val();
            var obj = $('#QuantityAllocationBTN');
            //console.log(value,value && isNaN(value) === false);
            if( value && isNaN(value) === false){
                obj.removeClass('disabled');
                obj.removeClass('btn-flat');
            }
            else {
                obj.addClass('disabled');
                obj.addClass('btn-flat');
            }
        }

        $('document').ready(function () {

            

            var app = new Vue({
                el: '#VueApp',
                data: {
                    quantity : Quantity.total,
                    godowns : [
                        { val : 1 , text : "Godown 1"},
                        { val : 2 , text : "Godown 2"},
                        { val : 3 , text : "Godown 3"},
                    ],
                    allocation : ModelGodowns,
                },
                computed : {
                    remaining : function () {
                        var sum = 0;
                        for (var key in this.allocation) {
                            if (this.allocation.hasOwnProperty(key)) {
                                //console.log(key + " -> " + p[key]);
                                sum += this.allocation[key].qty;
                            }
                        }
                        return parseInt(this.quantity) - parseInt(sum);
                    }
                },
                methods : {
                    addGodown : function (event) {
                        var gSelect = $('#QS_GODOWN_NAME option:selected');
                        var gName = gSelect.text();
                        var gVal = gSelect.val();
                        var gd = this.godowns[this.godownSelected];
                        var obj = {
                            id:  gVal ,
                            name: gName ,
                            qty : parseInt(this.remaining)
                        };
                        Vue.set(this.allocation,obj.id,obj);
                        //console.log(this.allocation);
                    },
                    removeGodown : function (event) {
                        var btnObj = $(event.target);

                        var id = btnObj.data('index');
                        Vue.delete(this.allocation, id);
                        //console.log(id);
                    }
                }
            });

            $('.mdb-select').material_select();
            $("#quantitySharing").on('show.bs.modal', function () {
                var Value = parseFloat($('#quantity').val());
                if (!Quantity.total || Quantity.total !== Value) {
                    Quantity.rem = Quantity.total = Value;
                    app.quantity = Quantity.total;
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
                        && response.data.status === 200) {

                        toastr.success(response.data.message);
                        $image.parent().fadeOut(300, function () {
                            $(this).remove();
                        })
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
