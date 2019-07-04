import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Utility } from '../shared/Utility';
import { NavParams } from 'ionic-angular';

@Component({
	selector: 'page-activity-list',
	templateUrl: 'activity-list.html'
})
export class ActivityListPage {


	items = [];
	showLoader = true;
	siteTransfer_id;

	constructor(public http: HttpClient, public navParams: NavParams) {
		this.siteTransfer_id = this.navParams.get('stid');
	}

	ionViewWillEnter() {
		this.loadData();
	}

	loadData() {
		let THIS = this;
		let url = Utility.baseUrl + "/getTransferDetails"
		this.http.get(url, {
			params: {
				st_id: this.siteTransfer_id,
			}
		}).subscribe((data: any) => {
			THIS.items = data;
			THIS.showLoader = false;
		}, (error) => {
			console.log(error);
			THIS.showLoader = false;
		})
	}

}
