import { Component } from '@angular/core';
import { IonicPage, NavController, NavParams } from 'ionic-angular';
import { VideoDownload } from '../../providers/video/video.download';

/**
 * Generated class for the DownloadsPage page.
 *
 * See http://ionicframework.com/docs/components/#navigation for more info
 * on Ionic pages and navigation.
 */
@IonicPage()
@Component({
  selector: 'page-downloads',
  templateUrl: 'downloads.html',
})
export class DownloadsPage {

  progress = '0%';
  videos: Array<any>;

  constructor(public navCtrl: NavController, public navParams: NavParams, public videoDownload: VideoDownload) {
    this.videos = this.videoDownload.videos;
    this.videoDownload.addVideo(3).subscribe(()=>{});
    this.videoDownload.addVideo(5).subscribe(()=>{});
    this.videoDownload.addVideo(6).subscribe(()=>{});
    this.videoDownload.addVideo(8).subscribe(()=>{});

  }

  ionViewDidLoad() {
    
    /*let cont = 0;
    setInterval(() => {
      cont++;
      this.progress = '${count}'; 
    }, 100);*/
    console.log('ionViewDidLoad DownloadsPage');
  }

}
