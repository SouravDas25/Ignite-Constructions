

declare var google;
declare var mapIcons;

export class IgniteMap {

    constructor(public element, public data) {

    }

    createMap() {
        var mapdom = this.element;
        let radius = 50;
        this.data.map = new google.maps.Map(mapdom, {
            center: this.data.godown.location,
            zoom: 0,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        this.data.godown.marker = new mapIcons.Marker({
            map: this.data.map,
            position: this.data.godown.location,
            icon: {
                path: mapIcons.shapes.MAP_PIN,
                fillColor: '#ff4444',
                fillOpacity: 1,
                strokeColor: '',
                strokeWeight: 0
            },
            map_icon_label: '<span class="map-icon map-icon-store"></span>'
        });

        this.data.godown.circle = new google.maps.Circle({
            strokeColor: 'blue',
            strokeOpacity: 0.8,
            strokeWeight: 1,
            fillColor: 'blue',
            fillOpacity: 0.2,
            map: this.data.map,
            center: this.data.godown.location,
            radius: radius,
        });

        this.data.godown.largeCircle = new google.maps.Circle({
            strokeColor: 'blue',
            strokeOpacity: 0.8,
            strokeWeight: 1,
            fillColor: 'blue',
            fillOpacity: 0.1,
            map: this.data.map,
            center: this.data.godown.location,
            radius: radius*2,
        });

        this.data.site.marker = new mapIcons.Marker({
            map: this.data.map,
            position: this.data.site.location,
            icon: {
                path: mapIcons.shapes.MAP_PIN,
                fillColor: '#FF8800',
                fillOpacity: 1,
                strokeColor: '',
                strokeWeight: 0
            },
            map_icon_label: '<span class="map-icon map-icon-travel-agency"></span>'
        });

        this.data.site.circle = new google.maps.Circle({
            strokeColor: 'blue',
            strokeOpacity: 0.8,
            strokeWeight: 1,
            fillColor: 'blue',
            fillOpacity: 0.2,
            map: this.data.map,
            center: this.data.site.location,
            radius: radius,
        });

        this.data.site.largeCircle = new google.maps.Circle({
            strokeColor: 'blue',
            strokeOpacity: 0.8,
            strokeWeight: 1,
            fillColor: 'blue',
            fillOpacity: 0.1,
            map: this.data.map,
            center: this.data.site.location,
            radius: radius*2,
        });

        if(this.data.labour.location !== undefined ) {
            this.data.labour.marker = new mapIcons.Marker({
                map: this.data.map,
                position: this.data.labour.location,
                draggable: false,
                icon: {
                    path: mapIcons.shapes.MAP_PIN,
                    fillColor: '#00C851',
                    fillOpacity: 1,
                    strokeColor: '',
                    strokeWeight: 0
                },
                map_icon_label: '<span class="map-icon map-icon-moving-company"  style="padding-bottom: 2px;"></span>'
            });
        }

        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer;

        directionsDisplay.setMap(this.data.map);

        this.calculateAndDisplayRoute(directionsService, directionsDisplay,
            this.data.godown.location,this.data.site.location,this.data.map);

        //let THIS = this;

    }

    calculateAndDisplayRoute(directionsService, directionsDisplay, origin, destination, map) {
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
                alert('Directions request failed due to ' + status);
            }
        });
    }

    static getDistance(origin,destination,callback,fallback=null) {
        var distanceMatrixService = new google.maps.DistanceMatrixService();
        distanceMatrixService.getDistanceMatrix({
            origins : [origin ],
            destinations: [ destination ],
            travelMode: google.maps.DirectionsTravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
            drivingOptions: {
                departureTime: new Date(Date.now()),  // for the time N milliseconds from now.
                trafficModel: 'optimistic',
            },
            avoidHighways: false,
            avoidTolls: false,
        }, function (response, status) {
            // See Parsing the Results for
            // the basics of a callback function.
            if(status === 'OK')
            {
                var data = response.rows[0].elements[0];
                callback(data);
                //console.log(data);
            }
            else {
                if(fallback)fallback();
            }
        });
    }

    static setMarkerPostion(marker,position)
    {
        let newposition = new google.maps.LatLng(position);
        marker.animateTo( newposition, {  easing: "linear",
            duration: 1000,
        });
    }

}