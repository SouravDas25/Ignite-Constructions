
import { BrowserModule } from '@angular/platform-browser';
import { ErrorHandler, NgModule } from '@angular/core';
import { IonicApp, IonicErrorHandler, IonicModule } from 'ionic-angular';

import { MyApp } from './app.component';
import { HomePage } from '../pages/home/home';
import { ActivityListPage } from '../pages/activity-list/activity-list';
import { LoginPage } from '../pages/login/login';
import { ConformationPage } from '../pages/conformation/conformation';
import { SettingsPage } from '../pages/settings/settings';

import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';
import { IonicStorageModule } from '@ionic/storage';
import { Geolocation } from '@ionic-native/geolocation';
import { HttpClientModule } from  '@angular/common/http';
import { LocationAccuracy } from '@ionic-native/location-accuracy';


@NgModule({
  declarations: [
    MyApp,
    HomePage,
    ActivityListPage,
    LoginPage,
    ConformationPage,
    SettingsPage
  ],
  imports: [
    BrowserModule,
    IonicModule.forRoot(MyApp),
    HttpClientModule,
    IonicStorageModule.forRoot(),
  ],
  bootstrap: [IonicApp],
  entryComponents: [
    MyApp,
    HomePage,
    ActivityListPage,
    LoginPage,
    ConformationPage,
    SettingsPage,
  ],
  providers: [
    StatusBar,
    SplashScreen,
    Geolocation,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    LocationAccuracy
  ]
})
export class AppModule {}
