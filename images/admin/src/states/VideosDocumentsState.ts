
import AppState from "./AppState";

import { ObjState } from "web-api-v2";
import IVideoDocument from "../interfaces/IVideoDocument";


export default class VideosDocumentsState extends ObjState<IVideoDocument>{
    private appState: AppState

    constructor(appState:AppState) {
        super();
        this.appState = appState;
    }

    public getNewObj = () => {
        return {
            id: 0,
            id_video: this.appState.videosState.objSel.id,
            nom_document: '',
            url_document:''
        } as IVideoDocument
    }

    public fileUpload(file:File[]){
        const directori = 'ciutat_agora/documents';
        return this.appState.uploadFile(file,directori,'')
    }

    public onDelImg(name:string, img_name:string) {
        const orig_value = this.objOrig.url_document
        if(orig_value !== img_name) {
            this.appState.delFile(img_name);
        }
    }
    public onAdd = () => {
        const obj = this.getNewObj()
        this.startEdit(obj, true)
        this.setOpenPopup(true);
    }

    public onEdit = (obj: IVideoDocument) => {

        this.startEdit(obj, false)
        this.setOpenPopup(true);
    }





    public onSave = () => {
        const item = this.objSel;
        if (this.validate()) {
            if (this.isNew) {
                this.setObjs([...this.objs, item]);
            } else {
                if (item.id === 0 ) {
                    if (this.objOrig.url_document !== item.url_document) {
                        this.appState.delFile(this.objOrig.url_document);
                    }
                }
                this.setObjsByObj(item)
            }
            this.appState.videosState.setObjSel({...this.appState.videosState.objSel,'documents':this.objs})
            this.setOpenPopup(false)
            this.reset();
        } else {
            this.appState.notiState.showMessage("No s'ha pogut guardar, hi ha errors","error")
        }


    }

    public onDel = (obj: IVideoDocument) => {
        this.appState.dialState.newAlert('Esborrar', 'Vols esborrar aquest "'+ this.getNom(obj) + '"?',() => this.delObj(obj));
    }

    public delObj = (obj: IVideoDocument) => {

        if (obj.id === 0 ) {
            const allObj = this.objs.filter((o) => o !== obj)
            this.setObjs(allObj);
            if (obj.url_document !== '') {
                this.appState.delFile(obj.url_document);
            }
        } else {

            this.startEdit(obj, false);

            const item = this.objSel;
            item.id = item.id * -1;

            this.setObjsByObj(item)
        }
        this.appState.videosState.setObjSel({...this.appState.videosState.objSel,'documents':this.objs})
    }

    public onClose = () => {
        this.setOpenPopup(false);
        // si cancelem i:
        // - el document és diferent del original
        // esborrem el document nou
        if (this.objOrig.url_document !== this.objSel.url_document) {
            this.appState.delFile(this.objSel.url_document);
        }
        this.reset();
    }
    public validateFunction = (fieldValues:IVideoDocument ,fieldName?: string) => {

        // if (!fieldName || fieldName === 'nom') {
        //     !fieldValues.nom && this.setError("nom","Aquest camp no pot esta buit");
        // }
        // if (!fieldName || fieldName === 'permisos') {
        //     fieldValues.permisos.length === 0 && this.setError("permisos","Té de tenir algun permis");
        // }
    }
    public getNom = (obj: IVideoDocument) => {
        const nom = obj.nom_document;

        return nom
    }

}