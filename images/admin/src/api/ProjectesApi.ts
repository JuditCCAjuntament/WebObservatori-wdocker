
import AppApi from "./AppApi";
import AppState from "../states/AppState";
import IProjecte from "../interfaces/IProjecte";


export default class ProjectesApi extends AppApi<IProjecte>{

    constructor (appState:AppState) {
        const getUrlApiPortal = ():string => {
            return 'projectes/';
        }

        const getId = (obj: IProjecte) => {
            return obj.id;
        }

        super(appState,getUrlApiPortal,getId);
    }

}