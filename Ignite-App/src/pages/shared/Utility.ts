
//import {RequestOptions} from '@angular/http';
import { Storage } from '@ionic/storage';

export class Utility {

    //public static baseUrl = 'http://localhost/Ignite-Constructions/Ignite-Constructions/public_html/api';
    public static domain = 'http://pratapcrit.000webhostapp.com';
    public static baseUrl = Utility.domain + '/api';



    public static logout(storage : Storage){
        storage.remove('user');
        //storage.remove('siteTransfer_id');
    }

    public static reset(storage : Storage) {
        storage.remove('siteTransfer_id');
        storage.remove('user');
    }

    public static getDiff(datetime){
        var datetime = typeof datetime !== 'undefined' ? datetime : "2014-01-01 01:02:03.123456";
        datetime = new Date( datetime ).getTime();
        var now = new Date().getTime();
        if( isNaN(datetime) )
        {
            return 0;
        }
        var milisec_diff = 0;
        if (datetime < now) {
            milisec_diff = now - datetime;
        }else{
            milisec_diff = datetime - now;
        }
        return milisec_diff;
    }

}
