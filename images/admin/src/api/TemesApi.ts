
import AppApi from "./AppApi";
import AppState from "../states/AppState";
import ITema from "../interfaces/ITema";

export default class TemesApi extends AppApi<ITema>{

    constructor (appState:AppState) {
        const getUrlApiPortal = ():string => {
            return 'temes/';
        }

        const getId = (obj: ITema) => {
            return obj.id;
        }

        super(appState,getUrlApiPortal,getId);
    }

}