@extends('voyager::master')

@section('content')
    <div class="page-content">
        @include('voyager::dimmers')
        <div class="analytics-container">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12  pt-4">
                        <h3>
                            <b class="text-center">Welcome {{ Auth::user()->name }}</b>
                            <a class="btn btn-primary float-right" href="{{ setting('admin.app_download_url') }}">
                                Download Ignite App
                            </a>
                        </h3>
                        <h5 class="pt-3">
                            <small>Hope, you a good day ahead !</b>
                            </small>
                        </h5>

                    </div>
                </div>
                <hr>
                <div class="row ">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Your Goods Chart</h4>
                                @php
                                    $goodsChart = new \App\Charts\GoodsChart();
                                @endphp
                                <div>{!! $goodsChart->container() !!}</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Your Site Chart</h4>
                                @php
                                    $siteChart = new \App\Charts\SiteChart();
                                @endphp
                                <div>{!! $siteChart->container() !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header blue-grey white-text">
                                <i class="icon-rupee"></i> Your Cost Chart
                            </div>
                            <div class="card-body">
                                @php
                                    $costChart = new \App\Charts\CostChart();
                                @endphp
                                <div>{!! $costChart->container() !!}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach(\App\SiteTransfer::activeTransfers() as $transfer)
                    <div class="row mt-4">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header blue white-text">
                                    <h4><b>Active Site Transfers</b></h4>
                                </div>
                                <div class="list-group">
                                    <style>
                                        dd {
                                            display: block;
                                            margin-left: 40px;
                                        }
                                    </style>
                                    
                                        <a href="{{ route('voyager.site-transfers.show',['id'=>$transfer->id]) }}" class="list-group-item list-group-item-action flex-column align-items-start ">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h4>
                                                    <i class="icon-location-5 blue-text"></i>From {{ $transfer->godown()->name }}
                                                    <i class="fa fa-long-arrow-right mx-4" aria-hidden="true"></i>
                                                    <i class="icon-location-5 red-text"></i> To {{ $transfer->site->name }}
                                                </h4>
                                                <small>{{ Carbon\Carbon::parse($transfer->date)->diffForHumans() }}</small>
                                            </div>
                                            <dl class="ml-5">
                                                <dt>Godown</dt>
                                                <dd>
                                                    <ul>
                                                        <li>{{ $transfer->godown()->name }}</li>
                                                        <li> {{ $transfer->godown()->address }}</li>
                                                    </ul>
                                                </dd>
                                                <dt>Site</dt>
                                                <dd>
                                                    <ul>
                                                        <li>{{ $transfer->site->name }}</li>
                                                        <li>{{ $transfer->site->address }}</li>
                                                    </ul>
                                                </dd>
                                                <dt>Goods</dt>
                                                <dd>
                                                    <ul>
                                                        <li>{{ $transfer->goods()->name }}</li>
                                                        <li> {{ $transfer->goods()->details }}</li>
                                                    </ul>
                                                </dd>
                                                <dt>Labour</dt>
                                                <dd>
                                                    <ul>
                                                        <li>{{ $transfer->labour->name }}</li>
                                                    </ul>
                                                </dd>
                                            </dl>
                                            <small>Donec id elit non mi porta.</small>
                                        </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop

@section('javascript')



    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <!-- script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/1.1.1/Chart.min.js"></script -->
    {!! $costChart->script() !!}
    {!! $goodsChart->script() !!}
    {!! $siteChart->script() !!}
@stop
