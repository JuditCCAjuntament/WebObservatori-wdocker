import { AppStateGeneric } from "web-app-v2";
import TemesState from "./TemesState";
import ProjectesState from "./PorjectesState";
import AutorsState from "./AutorsState";

import {WebApi} from "web-api-v2";
import VideosState from "./VideosState";

export default class AppState extends AppStateGeneric{
    public temesState = new TemesState(this)
    public projectesState = new ProjectesState(this)
    public autorsState = new AutorsState(this)
    public videosState = new VideosState(this)

    public urlMedia: string;
    public urlApiMedia: string;

    constructor() {
        super(11);
        this.urlMedia = process.env.REACT_APP_URL_DOCS_MEDIA_PROD ?? '';
        this.urlApiMedia = process.env.REACT_APP_URL_API_MEDIA_PROD + 'adm/v1/media';
    }

    public convertDateToUTC = (date:string) => {
        return new Date(date).toLocaleString('sv-SE').split(" ")[0];
    }

    public uploadFile(file:File[], directori: string, mida?: string){
        const uploadApi = new WebApi();

        const url = this.urlApiMedia;

        const formData:FormData = new FormData();

        formData.append('file',file[0])
        formData.append('carpeta',directori)

        if (mida && mida !== '') {
            formData.append('mides', mida)
        }
        const header = {'Content-Type': 'multipart/form-data', "Authorization" : "Bearer " + this.userState.token}
        return uploadApi.postRequest(url, formData,header).then((response:any) => {
            return response.dades.file
        }).catch((e: any) => {
            // this.error = 'Error ines
            // perat: ' + error;
            this.onErrorApi(e)
        });
    }

    public delFile = (name:string) => {
        const uploadApi = new WebApi();
        const url = this.urlApiMedia;

        const formData = {
            obj: {
                action: 'delete',
                nom: name
            }
        }
        const header = {"Authorization" : "Bearer " + this.userState.token}
        return uploadApi.putRequest(url,formData,header).then( (response:any) => {
            // return response.file
        }).catch((e: any) => {
            this.onErrorApi(e)
        });
    }
}