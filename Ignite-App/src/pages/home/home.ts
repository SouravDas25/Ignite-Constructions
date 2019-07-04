
import { LoginPage } from './../login/login';
import { Utility } from './../shared/Utility';
import { Component } from '@angular/core';
import { NavController, NavParams, AlertController, ToastController } from 'ionic-angular';
import { Geolocation } from '@ionic-native/geolocation';
import { Storage } from '@ionic/storage';

import { ActivityListPage } from '../activity-list/activity-list';
import { IgniteMap } from '../shared/IgniteMap';
import { HttpClient } from '@angular/common/http';
import { LocationAccuracy } from '@ionic-native/location-accuracy';
import { Platform } from 'ionic-angular';
import to from 'await-to-js';

declare var Pusher;

@Component({
	selector: 'page-home',
	templateUrl: 'home.html'
})
export class HomePage {
	//isLocationActive = false;
	map: any;
	display = "Map";
	siteTransfer_id = null;
	godown;
	site;
	goods;
	labour;
	GSMetric = {
		distance: '',
		duration: ''
	};

	LSMetric = {
		distance: '',
		duration: ''
	};
	lastLocationUpdate: Date;
	settings = {
		location_refresh_rate: 500
	};


	constructor(
		public navCtrl: NavController,
		private geolocation: Geolocation,
		private alertCtrl: AlertController,
		private toastCtrl: ToastController,
		private locationAccuracy: LocationAccuracy,
		private storage: Storage,
		public plt: Platform,
		public navParams: NavParams,
		private http: HttpClient) {
		this.godown = navParams.get('godown');
		this.site = navParams.get('site');
		this.goods = navParams.get('goods');
		this.labour = navParams.get('labour');
		this.siteTransfer_id = navParams.get('stid');
		this.GSMetric = navParams.get('metrics');
		//this.fillLabour();
		console.log(this);
		if (!this.labour.location) {
			this.labour.location = {
				lat: 0,
				lng: 0
			}
		}
		var THIS = this;
		this.storage.get('settings').then((val) => {
			if (val) THIS.settings = val;
		})
	}

	ionViewWillEnter() {
		this.requestForLocation();
		// This will only print when on iOS
		//this.loadPusher();
		//this.fillLocation();
		//this.watchPosition();
	}

	async getGPSStatus() {
		let status = false, error;
		let THIS = this;
		if (this.plt.is('cordova')) {
			console.log('Getting status');
			let response;
			[error, response] = await to(THIS.locationAccuracy.canRequest());
			if (error) {
				status = false;
				console.log(error);
			}
			status = !response;
			console.log('status', status);
			return status;
		}
		else status = true;
		return status;
	}

	async callLocationProc() {
		let THIS = this;
		let response, error;
		console.log("Requestion location");
		[error, response] = await to(this.locationAccuracy.request(this.locationAccuracy.REQUEST_PRIORITY_HIGH_ACCURACY));
		if (error) {
			Utility.logout(THIS.storage);
			THIS.navCtrl.setRoot(LoginPage);
		}
		else console.log('Request successful');
	}

	async requestForLocation() {
		let THIS = this;
		let gpsStatus = await this.getGPSStatus();
		console.log('Got Status ', gpsStatus);
		if (gpsStatus === false) {
			await this.callLocationProc();
		}
		await THIS.fillLocation();
		await THIS.watchPosition();
	}

	ionViewDidEnter() {
		this.loadMap();
	}

	setLocation(lat, lng) {
		//console.log('location Set');
		var THIS = this;
		this.labour.location.lat = lat;
		this.labour.location.lng = lng;
		//var newPosition = new google.maps.LatLng(this.lat, this.lng);
		if (this.labour.marker) {
			IgniteMap.setMarkerPostion(this.labour.marker, this.labour.location);
		}
		IgniteMap.getDistance(this.labour.location, this.site.location, (data) => {
			THIS.LSMetric.distance = data.distance.text;
			THIS.LSMetric.duration = data.duration.text;
		});
		if (Utility.getDiff(THIS.lastLocationUpdate) >= this.settings.location_refresh_rate ) {
			console.log("updating Location");
			let url = Utility.baseUrl + '/updateLocation';
			this.http.post(url, {
				labour: this.labour.id,
				lat: lat,
				lng: lng
			}).subscribe((data) => {
				console.log(data);
				THIS.lastLocationUpdate = new Date();
			}, (error) => {
				console.log(error);
			});
		}
	}

	async fillLocation() {
		//var THIS = this;
		console.log("Function Working");
		let response, err;
		[err, response] = await to(this.geolocation.getCurrentPosition());
		if (err) {
			alert('Error getting location : ' + err.message);
		}
		else {
			console.log(response);
			this.setLocation(response.coords.latitude, response.coords.longitude);
		}
	}

	watchPosition() {
		//var THIS = this;
		console.log("Function Watching");
		let watch = this.geolocation.watchPosition();
		watch.subscribe((data) => {
			// data can be a set of coordinates, or an error (if an error occurred).
			if (data.coords) {
				this.setLocation(data.coords.latitude, data.coords.longitude);
			}
			else {
				alert("Cannot Access Location.");
			}
		});
	}

	loadPusher() {
		Pusher.logToConsole = true;
		var pusher = new Pusher('d23ff382e22f5abbe1f9', {
			cluster: 'ap2',
			encrypted: true
		});

		var channel = pusher.subscribe('location');
		channel.bind('App\\Events\\SendLocation', function (data) {
			data = data.data;
			if (data.labour_id == this.labour.id) {
				//setLabourPosition(data.location);
				console.log(data);
			}
		});
	}

	loadMap() {
		var THIS = this;
		try {
			//var map = document.getElementById('map');
			let ig = new IgniteMap(document.getElementById('map'), THIS);
			ig.createMap();
		}
		catch (error) {
			alert("ERROR " + JSON.stringify(error));
		}


	}

	openAL() {
		this.navCtrl.push(ActivityListPage, {
			stid: this.siteTransfer_id,
		});
	}

	presentConfirm() {
		var THIS = this;
		let alert = this.alertCtrl.create({
			title: 'Confirm Completion',
			message: 'Are You Sure This Job is Completed ?',
			buttons: [
				{
					text: 'Cancel',
					role: 'cancel'
				},
				{
					text: 'Yes',
					handler: () => {
						let url = Utility.baseUrl + '/completeTransferJob';
						THIS.http.post(url, {
							st_id: THIS.siteTransfer_id,
						}).subscribe((data: any) => {
							if (data.status == "SUCCESS") {
								Utility.reset(THIS.storage);
								THIS.navCtrl.setRoot(LoginPage);
							}
						}, (error) => {
							THIS.presentToast("Error : Cannot Complete Transfer.");
						});
					}
				}
			]
		});
		alert.present();
	}

	presentToast(msg: string) {
		let toast = this.toastCtrl.create({
			message: msg,
			duration: 3000,
			position: 'bottom'
		});

		toast.present();
	}

	completeJob() {
		this.presentConfirm();
	}



}
