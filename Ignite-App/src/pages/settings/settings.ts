import { Component } from '@angular/core';
import { NavController, NavParams, AlertController } from 'ionic-angular';
import { Storage } from '@ionic/storage';
import { Utility } from '../shared/Utility';
import { LoginPage } from '../login/login';

/**
 * Generated class for the SettingsPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@Component({
  selector: 'page-settings',
  templateUrl: 'settings.html',
})
export class SettingsPage {

  settings = {
    location_refresh_rate: 500
  };

  constructor(public navCtrl: NavController,
    private storage: Storage,
    private alertCtrl: AlertController,
    public navParams: NavParams) {
    var THIS = this;
    this.storage.get('settings').then((val) => {
      if (val) THIS.settings = val;
    })
  }

  save() {
    this.storage.set('settings', this.settings);
  }

  logout(THIS) {
		Utility.logout(THIS.storage);
		THIS.navCtrl.setRoot(LoginPage);
	}

	reset(THIS) {
		Utility.reset(THIS.storage);
    THIS.navCtrl.setRoot(LoginPage);
    //alert('cic');
  }
  
  presentConfirm(about,handler) {
    let THIS = this;
    let alert = this.alertCtrl.create({
      title: 'Confirm ' + about,
      message: 'Are You Sure ? ',
      buttons: [
        {
          text: 'No',
          role: 'cancel',
          handler: () => {

          }
        },
        {
          text: 'Yes',
          handler: () => {
            handler(THIS)
          }
        }
      ]
    });
    alert.present();
  }

  ionViewDidLoad() {
    console.log('ionViewDidLoad SettingsPage');
  }

}
