
import AppState from "./AppState";

import { ObjState } from "web-api-v2";
import IVideoTema from "../interfaces/IVideoTema";

export default class VideosTemesState extends ObjState<IVideoTema>{
    private appState: AppState

    constructor(appState:AppState) {
        super();
        this.appState = appState;
    }

    public getNewObj = () => {
        return {
            id: 0,
            id_video: this.appState.videosState.objSel.id,
            id_tema: 0
        } as IVideoTema
    }


    public onAdd = () => {
        this.setOpenPopup(true);
    }

    public onSelect = (id:number) => {
        const obj = this.objs.filter((o) => o.id_tema === id)
        const existeix = obj.length > 0
        if (existeix) {
            this.delObj(obj[0])
        } else {
            const newObj = this.getNewObj();
            newObj.id_tema = id;
            this.setObjs([...this.objs, newObj]);
        }


    }

    public onSave = () => {

        this.appState.videosState.setObjSel({...this.appState.videosState.objSel,'temes':this.objs})
        this.setOpenPopup(false);

    }

    public delObj = (obj: IVideoTema) => {

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
    public validateFunction = (fieldValues:IVideoTema ,fieldName?: string) => {

        // if (!fieldName || fieldName === 'nom') {
        //     !fieldValues.nom && this.setError("nom","Aquest camp no pot esta buit");
        // }
        // if (!fieldName || fieldName === 'permisos') {
        //     fieldValues.permisos.length === 0 && this.setError("permisos","Té de tenir algun permis");
        // }
    }

    public getTemes = () => {
        return this.appState.temesState.objs.map((o) => ({
            'id': o.id,
            'titol': o.tema
        }))
    }

    public getNomTema = (obj: IVideoTema) => {
        const tema = this.appState.temesState.objs.filter((objIntern) => objIntern.id === obj.id_tema).pop();
        const nom_tema = tema ? tema.tema : '';

        return nom_tema
    }

}