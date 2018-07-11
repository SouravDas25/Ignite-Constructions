@extends('voyager::master')

@section('page_title', 'View Transfer')

@section('css')
    <link rel="stylesheet" href="{{ asset('/css/map-icons.css') }}">
@stop

@section('page_header')
    <h1 class="page-title">
        <i class="icon-switch"></i> Site Transfer&nbsp;
    </h1>
    @if( !$siteTransfer->isCompleted() )
        <a class="btn btn-success btn-lg" href="{{ route('voyager.site-transfers.complete',['id'=>$siteTransfer->id]) }}">
            Complete Transfer
        </a>
    @endif
    <div class="float-right page-title">
        Status :
        <span class="badge badge-primary"> {{ $siteTransfer->status->details }}</span>
    </div>
    <div class="float-right page-title">
        Labour : {{ $siteTransfer->labour->name }}
    </div>
    <style>
        #map {
            height: 600px;
            width: 100%;
        }

        .map-icon-label .map-icon {
            font-size: 18px;
            line-height: 48px;
            text-align: center;
            white-space: nowrap;
            padding-bottom: 5px;
        }

        .admin-up {
            margin-top: 0 !important;
        }

        .progress {
            height: 6px !important;
        }

        .Center-Container {
            position: relative;
            height: 100%;
        }

    </style>
@stop

@section('content')
    <div class="page-content read container-fluid">
        <div class="row">
            <div class="col-xl-5 col-md-5 mb-4 ">
                @component('includes.infoCard',[
                'infoCardName' => 'Godown',
                'infoCardTitle' => $siteTransfer->godown()->name,
                'infoCardSubTitle' => $siteTransfer->godown()->address,
                'infoCardColor' => 'bg-primary',
                'infoCardIcon' => 'fa map-icon map-icon-store',
                ])
                @endcomponent
            </div>
            <div class="col-xl-2 col-md-2 mb-4 ">
                <div style="font-size:15px" class="row font-weight-600 text-center my-5 Center-Container">
                    <div class="col-sm-12" id="distanceGS">
                        40 KM
                    </div>
                    <div class="col-sm-12 ">
                        <i class="fa fa-3x fa-exchange" aria-hidden="true"></i>
                    </div>
                    <div class="col-sm-12 " id="timeGS">
                        5 Mins
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-md-5 mb-4 ">
                @component('includes.infoCard',[
                'infoCardName' => 'Site',
                'infoCardTitle' => $siteTransfer->site->name,
                'infoCardSubTitle' => $siteTransfer->site->address,
                'infoCardColor' => 'bg-danger',
                'infoCardIcon' => 'fa fa-briefcase',
                ])
                @endcomponent
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-9">
                <div class="card pb-0" style="padding-bottom:5px;" id="app">
                    <div class="">
                        <div id="map" class="card-body"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 " >
                <h5 class="h5-responsive">Activity List</h5>
                <hr>
                <div  style="overflow-y: scroll;height: 550px">
                    <div class="list-group" id="activityListApp">
                        <a href="#" v-for="item in activityList"
                           class="list-group-item list-group-item-success list-group-item-action flex-column align-items-start card mb-1">
                            <div class="d-flex w-100 justify-content-between py-3">
                                <div class="mb-1 font-weight-bold"> @{{ item.title }}</div>
                                <small><i class="fa fa-clock-o" aria-hidden="true"></i> @{{ item.time }}</small>
                            </div>
                            <p class="mb-1">
                                <small> @{{ item.des }} @{{ item.sml }}</small>
                            </p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-xl-6 col-md-6 mb-4 ">
                @component('includes.infoCard',[
                'infoCardName' => 'Labour',
                'infoCardTitle' => $siteTransfer->labour->name,
                'infoCardColor' => 'bg-success',
                'infoCardSubTitle' => '',
                'infoCardIcon' => 'fa icon-user',])

                    <ul>
                        <li>
                            Distance To Site - <span id="distanceLS"> 0 KM</span>
                        </li>
                        <li>
                            Estimated Time - <span id="timeLS"> 0 KM</span>
                        </li>
                    </ul>

                @endcomponent
            </div>
            <div class="col-xl-6 col-md-6 mb-4 ">
                @component('includes.infoCard',[
                'infoCardName' => 'Goods',
                'infoCardTitle' => $siteTransfer->goods()->name,
                'infoCardColor' => 'bg-warning',
                'infoCardSubTitle' => $siteTransfer->goods()->details,
                'infoCardIcon' => 'fa voyager-puzzle',])

                    <ul>
                        <li> Quantity - {{ $siteTransfer->transferQuantity() }}
                            <small>unit</small>
                        </li>
                    </ul>

                @endcomponent
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script src="{{ asset('/js/map-icons.js') }}"></script>
    <script>
        Pusher.logToConsole = false;
        var pusher = new Pusher('d23ff382e22f5abbe1f9', {
            cluster: 'ap2',
            encrypted: true
        });

        var channel = pusher.subscribe('location');
        channel.bind('App\\Events\\SendLocation', function (data) {
            data = data.data;
            if (data.labour_id == Labour.id) {
                setLabourPosition(data.location);
                //console.log(data);
                updateActivityList();
            }
        });

        var Godown = {
            id: '{{ $siteTransfer->godown()->id }}',
            name: '{{ $siteTransfer->godown()->name }}',
            location: {
                lat: parseFloat("{{ $siteTransfer->godown()->getLatLng()->lat }}"),
                lng: parseFloat("{{ $siteTransfer->godown()->getLatLng()->lng }}")
            },
        };
        var Site = {
            id: '{{ $siteTransfer->site->id }}',
            name: '{{ $siteTransfer->site->name }}',
            location: {
                lat: parseFloat("{{ $siteTransfer->site->getLatLng()->lat }}"),
                lng: parseFloat("{{ $siteTransfer->site->getLatLng()->lng }}")
            },
        };

        var Labour = {
            id: '{{ $siteTransfer->labour->id }}',
            name: '{{ $siteTransfer->labour->name }}',
            location: {
                lat: parseFloat("{{ $siteTransfer->labour->getLatLng()->lat }}"),
                lng: parseFloat("{{ $siteTransfer->labour->getLatLng()->lng }}")
            },
        };

        function initMap() {

            var map = new google.maps.Map(document.getElementById('map'), {
                center: Godown.location,
                zoom: 0,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            Godown.marker = new mapIcons.Marker({
                map: map,
                position: Godown.location,
                title : 'Godown',
                icon: {
                    path: mapIcons.shapes.MAP_PIN,
                    fillColor: '#ff4444',
                    fillOpacity: 1,
                    strokeColor: '',
                    strokeWeight: 0
                },
                map_icon_label: '<span class="map-icon map-icon-store"></span>'
            });

            Godown.circle = new google.maps.Circle({
                strokeColor: 'blue',
                strokeOpacity: 0.8,
                strokeWeight: 1,
                fillColor: 'blue',
                fillOpacity: 0.2,
                map: map,
                center: Godown.location,
                radius: parseFloat("{{ setting('admin.detectRadius') }}"),
            });

            Godown.largeCircle = new google.maps.Circle({
                strokeColor: 'blue',
                strokeOpacity: 0.8,
                strokeWeight: 1,
                fillColor: 'blue',
                fillOpacity: 0.1,
                map: map,
                center: Godown.location,
                radius: parseFloat("{{ setting('admin.detectRadius') }}")*2,
            });

            Site.marker = new mapIcons.Marker({
                map: map,
                position: Site.location,
                title : 'Work Site',
                icon: {
                    path: mapIcons.shapes.MAP_PIN,
                    fillColor: '#FF8800',
                    fillOpacity: 1,
                    strokeColor: '',
                    strokeWeight: 0
                },
                map_icon_label: '<span class="map-icon map-icon-travel-agency"></span>'
            });

            Site.circle = new google.maps.Circle({
                strokeColor: 'blue',
                strokeOpacity: 0.8,
                strokeWeight: 1,
                fillColor: 'blue',
                fillOpacity: 0.2,
                map: map,
                center: Site.location,
                radius: parseFloat("{{ setting('admin.detectRadius') }}"),
            });

            Site.largeCircle = new google.maps.Circle({
                strokeColor: 'blue',
                strokeOpacity: 0.8,
                strokeWeight: 1,
                fillColor: 'blue',
                fillOpacity: 0.1,
                map: map,
                center: Site.location,
                radius: parseFloat("{{ setting('admin.detectRadius') }}")*2,
            });

            Labour.marker = new mapIcons.Marker({
                map: map,
                position: Labour.location,
                draggable: true,
                title : 'Driver',
                icon: {
                    path: mapIcons.shapes.MAP_PIN,
                    fillColor: '#00C851',
                    fillOpacity: 1,
                    strokeColor: '',
                    strokeWeight: 0
                },
                map_icon_label: '<span class="map-icon map-icon-moving-company"  style="padding-bottom: 2px;"></span>'
            });

            Labour.marker.addListener('dragend', function (event) {
                //console.log(event.latLng);
                var lat, lng;
                lat = event.latLng.lat();
                lng = event.latLng.lng();
                console.log(lat, lng);
                $.ajax({
                    url: '{{ route('api.updateLocation') }}',
                    method: 'POST',
                    data: {
                        lat: lat,
                        lng: lng,
                        labour: Labour.id,
                    },
                    success: function (data) {
                        console.log(data)
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
            });
            setLabourPosition(Labour.location);

            var directionsService = new google.maps.DirectionsService;
            var directionsDisplay = new google.maps.DirectionsRenderer;

            directionsDisplay.setMap(map);

            calculateAndDisplayRoute(directionsService, directionsDisplay,Godown.location,Site.location,map);

            getDistance(Godown.location,Site.location, function (data) {
                $('#distanceGS').html(data[0].distance.text);
                $('#timeGS').html(data[0].duration.text);
            });
        }

        function setLabourPosition(position) {
            //Labour.marker.setPosition(position);
            newposition = new google.maps.LatLng(position);
            Labour.marker.animateTo( newposition, {  easing: "linear",
                duration: 1000,
            });

            getDistance(Labour.location,Site.location, function (data) {
                $('#distanceLS').html(data[0].distance.text);
                $('#timeLS').html(data[0].duration.text);
            })
        }

        function getDistance(origin,destination,callback) {
            var distanceMatrixService = new google.maps.DistanceMatrixService();
            distanceMatrixService.getDistanceMatrix({
                origins : [origin ],
                destinations: [ destination ],
                travelMode: google.maps.DirectionsTravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC,
                drivingOptions: {
                    departureTime: new Date(Date.now() ),  // for the time N milliseconds from now.
                    trafficModel: 'optimistic',
                },
                avoidHighways: false,
                avoidTolls: false,
            }, function (response, status) {
                // See Parsing the Results for
                // the basics of a callback function.
                if(status === 'OK')
                {
                    var data = response.rows[0].elements;
                    callback(data);
                    console.log(data);
                }
            });
        }

        function calculateAndDisplayRoute(directionsService, directionsDisplay,origin,destination,map) {
            directionsService.route({
                origin: origin,
                destination: destination,
                travelMode: google.maps.DirectionsTravelMode.DRIVING,
                unitSystem: google.maps.UnitSystem.METRIC
            }, function (response, status) {
                if (status === 'OK') {
                    new google.maps.DirectionsRenderer({
                        map: map,
                        directions: response,
                        suppressMarkers: true
                    });
                } else {
                    window.alert('Directions request failed due to ' + status);
                }
            });
        }

        function updateActivityList() {
            $.ajax({
                url : '{{ route('api.getTransferDetails',['st_id'=>$siteTransfer->id]) }}',
                success : function (data) {
                    console.log(data);
                    //Vue.set()
                    activityApp.activityList = data;
                    toastr['info']('Activity Updated.');
                },
                error : function (error) {
                    console.log(error);
                }
            });
        }

        var activityList = [];
        var activityApp;
        $(document).ready(function () {
            initMap();
            activityApp = new Vue({
                el : '#activityListApp',
                data : {
                    activityList : activityList,
                }
            });
            updateActivityList();
        })
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('voyager.googlemaps.key') }}"></script>
    <script src="{{ asset('/js/markerAnimate.js') }}"></script>
@stop
