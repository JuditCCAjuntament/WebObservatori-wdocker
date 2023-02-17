
import AppState from "./AppState";

import { ObjState } from "web-api-v2";
import IAutor, {IAutorCerca} from "../interfaces/IAutor";
import AutorsApi from "../api/AutorsApi";



export default class AutorsState extends ObjState<IAutor>{
    private appState: AppState

    constructor(appState:AppState) {
        super(new AutorsApi(appState));
        this.appState = appState;
    }

    public getNewObj = () => {
        return {
            id: 0,
            nom: 'Nom autor',
            resum: '',
            text: '',
            web: '',
            imatge: '',
            facebook: '',
            instagram: '',
            youtube: '',
            twitter: ''
        } as IAutor
    }

    public onLoad = () => {
        this.getObjApi()
            .catch((e:any) => {
                this.appState?.onErrorApi(e)
            });

    }

    public fileUpload(file:File[]){
        const directori = 'ciutat_agora/autors';
        return this.appState.uploadFile(file,directori,'')
    }

    public onDelImg(img_name:string) {
        if(this.objOrig.imatge !== img_name) {
            this.appState.delFile(img_name);
        }
    }

    public onAdd = () => {
        const obj = this.getNewObj()

        this.startEdit(obj, true)
        this.setOpenPopup(true);
    }

    public onEdit = (obj: IAutor) => {
        this.startEdit(obj, false)
        this.setOpenPopup(true);
    }

    public onSave = () => {

        if (this.validate()) {
            if (this.isNew) {
                this.addObjApi()
                    .then((o:IAutor) => {
                        this.setOpenPopup(false)
                        this.setObjs([...this.objs, o]);
                        this.appState.notiState.showMessage("Guardat correctament","success");
                    })
                    .catch((e:any) => {
                        this.appState?.onErrorApi(e)
                    });
            } else {
                this.updateObjApi()
                    .then((o:IAutor) => {
                        this.setOpenPopup(false)
                        this.setObjsByObj(o)
                        this.appState.notiState.showMessage("Modificat correctament","success");
                    })
                    .catch((e:any) => {
                        this.appState?.onErrorApi(e)
                    });

            }
            this.reset();

        } else {
            this.appState.notiState.showMessage("No es pot guardar, hi ha errors","error");
            // const ErrorsMsg = Object.keys(this.errors).map((o) => {
            //     return "- " + o.toUpperCase() +": " + this.errors[o]
            // })
            // this.appState.dialState.newAlert("Error",ErrorsMsg.join('<br/>'));
        }

    }

    public onDel = (obj: IAutor) => {
        this.appState.dialState.newAlert('Esborrar', 'Vols esborrar "' + obj.nom + '" ?',() => this.delObj(obj));
    }

    public delObj = (obj: IAutor) => {
        this.startEdit(obj);
        this.delObjApi()
            .then(() => {
                const allObj = this.objs.filter((o) => o !== obj)
                this.setObjs(allObj);
                this.appState.notiState.showMessage("Esborrat correctament","success");
            })
            .catch((e:any) => {
                this.appState?.onErrorApi(e)
            });
    }

    public onClose = () => {
        this.setOpenPopup(false);
        if(this.objOrig.imatge !== this.objSel.imatge) {
            this.appState.delFile(this.objSel.imatge);
        }
        this.reset();
    }
    public validateFunction = (fieldValues:IAutor ,fieldName?: string) => {

        if (!fieldName || fieldName === 'nom') {
            !fieldValues.nom && this.setError("nom","Aquest camp no pot esta buit");
        }
        // if (!fieldName || fieldName === 'permisos') {
        //     fieldValues.permisos.length === 0 && this.setError("permisos","Té de tenir algun permis");
        // }
    }

    public cercarGenerica = (items:IAutor[], cerca:IAutorCerca) => {
        if (cerca.text) {
            return items.filter((item) => item.nom.toLowerCase().includes(cerca.text.toLowerCase()))
        } else {
            return items
        }

    }



}