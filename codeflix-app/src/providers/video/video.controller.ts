import {VideoAdapter} from "./video.adapter";
import {VideoModel} from "../sqlite/video.model";
import {Observable} from "rxjs/Observable";
import {Injectable} from "@angular/core";
import {Env} from "../../models/env";
import { Entry } from "@ionic-native/file";
import { PromiseObservable } from "rxjs/observable/PromiseObservable";
import { Promise } from "q";

declare var ENV: Env;

@Injectable()
export class VideoController implements VideoAdapter{

    constructor(public videoModel: VideoModel,
        public file: File){

    }

    latest(page: number, search:string): Observable<any>{
        return Observable.create(observer => {
            this.videoModel
            .latest(page, search)
            .then( rows => {
                this.formatRows(rows).then(formattedRows => {
                    observer.next({
                        data: formattedRows
                    });
                });   
            })
            .catch(error => IntersectionObserver.error(error))
        });
    }

    get(id: number): Observable<any>{
        return Observable.create(observer => {
            this.videoModel
            .find(id)
            .then(video => {
                this.formatVideo(video).then(this.formatVideo => {
                    observer.next(this.formatVideo);
                })                
            })
            .catch(error => observer.error(error))
        });
    }

    protected async formatVideo(video) {
        video.thumb_small_url = await this.getCdvFile(video.thumb_url);
        video.file_url = this.applyFileProtocol(video.file_url);
        video.categories_name = JSON.parse(video.categories_name);
        return Promise.resolve(video);
    }

    protected async formatRows(rows) {
        for (let row of rows) {
            row.thumb_small_url = await this.getCdvFile(row.thumb_url);
            row.file_url = this.applyFileProtocol(row.file_url);
            row.categories_name = {
                data: {
                    names: JSON.parse(row.categories_name)
                }  
            };
            if (row.serie_title) {
                row.serie_title = {
                    data: {
                        title: row.serie_title
                    }
                }
            }
        }
        return Promise.resolve(rows);
    }

    protected async getCdvFile(url) {
        let _url = this.applyFileProtocol.(url);
        _url = await this.file.resolveLocalFilesystemUrl(thumbUrl)
        .then((entry:Entry) => entry.toInternalURL()) 
        return _url;
    }

    protected applyFileProtocol(url) {
        let _url = url;

        if (_url.indexOf('file://')==-1) {
            _url = `file://${_url}`;
        }
        return _url;
    }


}