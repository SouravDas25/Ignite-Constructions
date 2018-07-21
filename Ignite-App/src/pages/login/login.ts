import { Component } from '@angular/core';
import { NavController, ToastController, Platform } from 'ionic-angular';
import { Storage } from '@ionic/storage';
import { HttpClient } from '@angular/common/http';
import { LoadingController } from 'ionic-angular';

import { ConformationPage } from '../conformation/conformation';
import { Utility } from '../shared/Utility';

@Component({
	selector: 'page-login',
	templateUrl: 'login.html'
})
export class LoginPage {

	email: string;
	password: string;
	loader: any;

	constructor(
		public navCtrl: NavController,
		private storage: Storage,
		public loadingCtrl: LoadingController,
		public http: HttpClient,
		public plt: Platform,
		private toastCtrl: ToastController) {
		this.postVerifyUser();
	}

	postVerifyUser() {
		let THIS = this;
		this.plt.ready().then(() => {
			THIS.storage.get('user')
			.then((val) => {
				if (val) {
					THIS.presentLoading();
					let url = Utility.baseUrl + '/verifyUser';
					//console.log(url);
					THIS.http.post(url, {
						id: val.id,
						email: val.userName
					})
						.subscribe((res: any) => {
							if (res.status == 'SUCCESS') {
								THIS.navCtrl.setRoot(ConformationPage);
							}
							THIS.loader.dismiss();
							//console.log(res);
						}, (err) => {
							console.log(err);
							THIS.loader.dismiss();
						});
				}
			});
		})
	}

	presentToast(msg: string) {
		let toast = this.toastCtrl.create({
			message: msg,
			duration: 3000,
			position: 'bottom'
		});

		toast.onDidDismiss(() => {
			console.log('Dismissed toast');
		});

		toast.present();
	}

	presentLoading() {
		this.loader = this.loadingCtrl.create({
			spinner: 'crescent',
		});
		this.loader.present();
	}

	verifyUser(email, password) {
		let url = Utility.baseUrl + '/verifyUser';
		this.http.post(url, {
			email: email,
			password: password,
		})
			.subscribe((res: any) => {
				if (res.status == 'SUCCESS') {
					this.storeUser(res.data);
					this.navCtrl.setRoot(ConformationPage);
				}
				else if (res.status == 'ERROR') {
					console.log(res.data);
					this.presentToast(res.data);
				}
				this.loader.dismiss();

			}, (err) => {
				alert(JSON.stringify(err));
				this.loader.dismiss();
			});
	}

	storeUser(user) {
		this.storage.set('user', user);
	}

	login() {
		this.presentLoading();
		if (this.email && this.password) {
			this.verifyUser(this.email, this.password);
			//this.navCtrl.setRoot(ConformationPage);
		}
		else {
			this.presentToast("Invalid Email Or Password.")
		}
	}

}
