import {Http} from "@angular/http";
import {Injectable, Observable,Promisse, NgZone} from "@angular/core";
import { VideoResource } from "../resources/video.resource";
import { VideoModel } from "../sqlite/video.model";
import { VideoPaths } from "./video-paths";
import { Transfer } from "@ionic-native/transfer";

@Injectable()
export class VideoDownload{
    
    files: Array<any> = [];
    videos: Array<any> = [];
    
    constructor(
        public videoResource: VideoResource,
        public videoModel: VideoModel,
        public videoPaths: VideoPaths,
        public transfer: Transfer,
        public zone: NgZone){
        console.log('VideoDownload Provider');
    }

    addVideo(videoId): Observable<Object> {
        this.videoResource.get(videoId)
        .map(video => {
            video.progress = '0%';
            this.videos.push(video);
            console.log(this.videos);
            return video;
        })

    }

    start(index):Promisse<any> {
        let fileTransfer = this.transfer.create();
        let video = this.videos[index];
        fileTransfer.onProgress((event: ProgressEvent) => {
            if (event.lengthComputable) {
                this.zone.run(() => {
                    let progress = (event.loaded/event.total) * 100;
                    progress = Math.ceil(progress);    
                    video.progress = `${progress}%`;
                })
                
            }
        });
        return fileTransfer.download(
            //video.file_url,
            'http://www.sample-videos.com/video/mp4/720/big_buck_bunny_720p_10mb.mp4',
            video.videoPaths.getFilePath(video)
        )
        .then(() => {
            return this.transferThumb(video);
        })
        .then(() => {
            this.insertVideo(this.videos[index]);
        })
        .catch((error) => console.log(error));
        this.insertVideo(this.videos[index]);
    }

    protected transferThumb(video) {
        let fileTransfer = this.transfer.create();
        fileTransfer.download(
            video.thumb_asset_url,
            video.videoPaths.getThumbPath(video)
        ).then((success) => {
            console.log(success);
        }).catch((error) => console.log(error));
    }

    protected insertVideo(video) {
        return this.videoModel.insert({
            id: video.id,
            title: video.title,
            description: video.description,
            duration: video.duration,
            thumb_url: this.videoPaths.getThumbPath(video),
            file_url: this.videoPaths.getFilePath(video),
            serie_title: video.serie_title,
            categories_name: JSON.stringify(video.categories_name),
            created_at: video.created_at.replace('T', ' ')
        });
    }

}