
import { Component, ViewChild } from '@angular/core';
import { Nav, Platform } from 'ionic-angular';
import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import { Storage } from '@ionic/storage';

//import { HomePage } from '../pages/home/home';
//import { ActivityListPage } from '../pages/activity-list/activity-list';
import { LoginPage } from '../pages/login/login';
import { ConformationPage } from '../pages/conformation/conformation';
//import { Utility } from '../pages/shared/Utility';
import { SettingsPage } from '../pages/settings/settings';

@Component({
	templateUrl: 'app.html'
})
export class MyApp {
	@ViewChild(Nav) nav: Nav;

	rootPage: any;
	labour = { userName: "" };

	pages: Array<{ title: string, component: any, icon: string }>;

	constructor(
		public platform: Platform,
		public statusBar: StatusBar,
		private storage: Storage,
		public splashScreen: SplashScreen) {
		this.initializeApp();
		// used for an example of ngFor and navigation
		this.pages = [
			{ title: 'Home', component: ConformationPage, icon: 'home' },
			{ title: 'Settings', component: SettingsPage, icon: 'cog' },
		];

	}

	initializeApp() {
		this.platform.ready().then(() => {
			// Okay, so the platform is ready and our plugins are available.
			// Here you can do any higher level native things you might need.
			this.statusBar.styleDefault();
			this.splashScreen.hide();
			this.rootPage = LoginPage;
			var THIS = this;
			this.storage.get('user')
				.then(function (data) {
					if (data) {
						THIS.labour = data;
					}
				});
		});
	}

	openPage(page) {
		// Reset the content nav to have just this page
		// we wouldn't want the back button to show in this scenario
		this.nav.setRoot(page.component);
	}

}
