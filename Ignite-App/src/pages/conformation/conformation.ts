
import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { Storage } from '@ionic/storage';
import { HttpClient } from '@angular/common/http';

import { HomePage } from '../home/home'
import { Utility } from '../shared/Utility';
import { LoginPage } from '../login/login';
import { IgniteMap } from '../shared/IgniteMap';

@Component({
	selector: 'page-conformation',
	templateUrl: 'conformation.html'
})
export class ConformationPage {

	map: any = null;
	mark: any;
	hasJob = false;
	showLoader = true;
	hasSiteId = false;
	siteTransfer_id = null;
	godown;
	site;
	goods;
	labour;
	GSMetric = {
		distance: "0 km",
		duration: "0 mins"
	};

	constructor(public navCtrl: NavController,
		public http: HttpClient,
		private storage: Storage) {
		this.initData();
	}

	async initData() {
		await this.fillLabour();
	}

	fetchTransfer() {
		var THIS = this;
		let url = Utility.baseUrl + "/getTransferJob"
		let params = {
			labour: THIS.labour.id,
		};
		if (THIS.siteTransfer_id != null) params['st_id'] = THIS.siteTransfer_id;
		THIS.http.get(url, {
			params: params
		})
			.subscribe((data: any) => {
				if (data.status == 'SUCCESS') {
					data = data.data;
					if (Object.keys(data).length > 0) {
						THIS.godown = data.godown;
						THIS.site = data.site;
						THIS.goods = data.goods;
						THIS.siteTransfer_id = data.siteTransfer_id;
						THIS.updateHasJob(true);
					}
				}
				console.log(THIS);
				if (Object.keys(data).length > 0) THIS.updateDistance();
				this.showLoader = false;
			}, (error) => {
				this.showLoader = false;
				alert(JSON.stringify(error));
			});
	}

	fillLabour() {
		var THIS = this;
		this.storage.get('user')
			.then(function (data) {
				if (data) {
					THIS.labour = data;
					THIS.fillTransferID();
				}
				else {
					Utility.logout(THIS.storage);
					THIS.navCtrl.setRoot(LoginPage);
				}
			});

	}

	fillTransferID() {
		var THIS = this;
		this.storage.get('siteTransfer_id')
			.then(function (data) {
				if (data) {
					THIS.siteTransfer_id = data;
					THIS.hasSiteId = true;
				}
				THIS.fetchTransfer();
			});
	}

	updateDistance() {
		var THIS = this;
		IgniteMap.getDistance(THIS.godown.location, THIS.site.location, (data) => {
			if (data.distance) {
				//console.log("GSM Updated");
				THIS.GSMetric.distance = data.distance.text;
				THIS.GSMetric.duration = data.duration.text;
			}
		});
	}

	updateHasJob(value) {
		this.hasJob = value;
		if (this.hasSiteId) {
			this.moveForward();
		}
		else {
			this.loadMap();
		}
	}

	ionViewDidLoad() {
		//this.loadMap();
	}

	loadMap() {
		var THIS = this;
		setTimeout(function () {
			if (THIS.hasJob == true && THIS.map === null) {
				//console.log('LOL');
				try {
					let ig = new IgniteMap(document.getElementById('cmap'), THIS);
					ig.createMap();
				}
				catch (error) {
					alert("ERROR " + JSON.stringify(error));
				}

			}

		}, 500);
	}

	logout() {
		Utility.logout(this.storage);
		this.navCtrl.setRoot(LoginPage);
	}

	confirm() {
		let url = Utility.baseUrl + "/confirmTransferJob";
		this.http.post(url, {
			'st_id': this.siteTransfer_id
		})
			.subscribe((data: any) => {
				if (data.status === 'SUCCESS') {
					this.storage.set('siteTransfer_id', this.siteTransfer_id);
				}
			}, (error) => {
				console.log(error);
			})
		this.moveForward();
	}

	moveForward() {
		this.navCtrl.setRoot(HomePage, {
			godown: this.godown,
			site: this.site,
			labour: this.labour,
			metrics: this.GSMetric,
			stid: this.siteTransfer_id,
			goods: this.goods
		});
	}

}
