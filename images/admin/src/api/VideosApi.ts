
import AppApi from "./AppApi";
import AppState from "../states/AppState";
import IVideo from "../interfaces/IVideo";



export default class VideosApi extends AppApi<IVideo>{

    constructor (appState:AppState) {
        const getUrlApiPortal = ():string => {
            return 'videos/';
        }

        const getId = (obj: IVideo) => {
            return obj.id;
        }

        super(appState,getUrlApiPortal,getId);
    }

}