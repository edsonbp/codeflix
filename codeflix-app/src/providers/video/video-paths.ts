import {AppConfig} from "../app-config";
import {VideoResource} from "../resources/video.resource";
import {VideoController} from "./video.controller";
import {VideoAdapter} from "./video.adapter";
import {Injectable} from "@angular/core";
import md5 from 'crypto-md5';

@Injectable()
export class VideoPaths {

    private videosDir = 'videos';
    private videosPath;

    constructor(public appConfig: AppConfig){
        this.videosDir = ${this.appConfig.getAppFilePath()}/${this.videosDir};
    }

    getFilePath(video) {
        return `${this.videosPath}/${video.id}/${md5(video.title, 'hex')}.mp4`;
    }

    getThumbPath(video) {
        return `${this.videosPath}/${video.id}/${md5(video.title, 'hex')}.jpg`;

    }

}