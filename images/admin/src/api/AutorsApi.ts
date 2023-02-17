
import AppApi from "./AppApi";
import AppState from "../states/AppState";
import IAutor from "../interfaces/IAutor";


export default class AutorsApi extends AppApi<IAutor>{

    constructor (appState:AppState) {
        const getUrlApiPortal = ():string => {
            return 'autors/';
        }

        const getId = (obj: IAutor) => {
            return obj.id;
        }

        super(appState,getUrlApiPortal,getId);
    }

}