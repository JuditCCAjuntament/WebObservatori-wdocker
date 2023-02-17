
import AppState from "./AppState";

import { ObjState } from "web-api-v2";
import IVideoAutor from "../interfaces/IVideoAutor";


export default class VideosAutorsState extends ObjState<IVideoAutor>{
    private appState: AppState

    constructor(appState:AppState) {
        super();
        this.appState = appState;
    }

    public getNewObj = () => {
        return {
            id: 0,
            id_video: this.appState.videosState.objSel.id,
            id_autor: 0
        } as IVideoAutor
    }


    public onAdd = () => {
        this.setOpenPopup(true);
    }

    public onSelect = (id:number) => {
        const obj = this.objs.filter((o) => o.id_autor === id)
        const existeix = obj.length > 0
        if (existeix) {
            this.delObj(obj[0])
        } else {
            const newObj = this.getNewObj();
            newObj.id_autor = id;
            this.setObjs([...this.objs, newObj]);
        }


    }

    public onSave = () => {

        this.appState.videosState.setObjSel({...this.appState.videosState.objSel,'autors':this.objs})
        this.setOpenPopup(false);

    }

    public delObj = (obj: IVideoAutor) => {

        if (obj.id === 0 ) {
            const allObj = this.objs.filter((o) => o !== obj)
            this.setObjs(allObj);
        } else {

            this.startEdit(obj, false);

            const item = this.objSel;
            item.id = item.id * -1;

            this.setObjsByObj(item)
        }
    }

    public onClose = () => {
        this.setOpenPopup(false);
        this.reset();
    }
    public validateFunction = (fieldValues:IVideoAutor ,fieldName?: string) => {

        // if (!fieldName || fieldName === 'nom') {
        //     !fieldValues.nom && this.setError("nom","Aquest camp no pot esta buit");
        // }
        // if (!fieldName || fieldName === 'permisos') {
        //     fieldValues.permisos.length === 0 && this.setError("permisos","Té de tenir algun permis");
        // }
    }

    public getAutors = () => {
        return this.appState.autorsState.objs.map((o) => ({
            'id': o.id,
            'titol': o.nom
        }))
    }

    public getNom = (obj: IVideoAutor) => {
        const autor = this.appState.autorsState.objs.filter((objIntern) => objIntern.id === obj.id_autor).pop();
        const nom = autor ? autor.nom : '';

        return nom
    }

}