
import {Injectable} from "@angular/core";
import { Storage } from "@ionic/storage";
import { File } from "@ionic-native/file"

@Injectable()
export class AppConfig{
    private off:boolean;
    private appOffKey = 'app_off';
    private baseFilePath = '/storage/sdcard1';
    private appFileFolder = 'codeflix';

    constructor(
        public storage: Storage,
        public file: File
        ) {
        this.file.checkDir
    }

    load() {

        let off = await this.storage.get(this.appOffKey);
        this.off = off;
        try {
            await this.file.resolveDirectoryUrl(`file://${this.baseFilePath}`);  
        } catch (error) {
            this.baseFilePath = this.file.externalApplicationStorageDirectory;  
            console.log(error);  
        }
        console.log(this.baseFilePath);
        console.log(this.off)
        return Promise.resolve(null);
    }

    getOff():boolean{
        return this.off;
    }

    setOff(off:boolean):Promisse<any> {
        this.off = off;
        return this.storage.set(this.appOffKey, off);
    }

    getAppFilePath() {
        return ${this.baseFilePath}/${this.appFileFolder};
    }

}