
import AppState from "./AppState";

import { ObjState } from "web-api-v2";
import IProjecte, {IProjecteCerca} from "../interfaces/IProjecte";
import ProjectesApi from "../api/ProjectesApi";



export default class ProjectesState extends ObjState<IProjecte>{
    private appState: AppState

    constructor(appState:AppState) {
        super(new ProjectesApi(appState));
        this.appState = appState;
    }

    public getNewObj = () => {
        return {
            id: 0,
            nom: 'Nom projecte',
            resum: '',
            text: '',
            web: '',
            imatge: ''
        } as IProjecte
    }

    public onLoad = () => {
        this.getObjApi()
            .catch((e:any) => {
                this.appState?.onErrorApi(e)
            });

    }

    public fileUpload(file:File[]){
        const directori = 'ciutat_agora/projectes';
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

    public onEdit = (obj: IProjecte) => {
        this.startEdit(obj, false)
        this.setOpenPopup(true);
    }

    public onSave = () => {

        if (this.validate()) {
            if (this.isNew) {
                this.addObjApi()
                    .then((o:IProjecte) => {
                        this.setOpenPopup(false)
                        this.setObjs([...this.objs, o]);
                        this.appState.notiState.showMessage("Guardat correctament","success");
                    })
                    .catch((e:any) => {
                        this.appState?.onErrorApi(e)
                    });
            } else {
                this.updateObjApi()
                    .then((o:IProjecte) => {
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

    public onDel = (obj: IProjecte) => {
        this.appState.dialState.newAlert('Esborrar', 'Vols esborrar "' + obj.nom + '" ?',() => this.delObj(obj));
    }

    public delObj = (obj: IProjecte) => {
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
    public validateFunction = (fieldValues:IProjecte ,fieldName?: string) => {

        if (!fieldName || fieldName === 'nom') {
            !fieldValues.nom && this.setError("nom","Aquest camp no pot esta buit");
        }
        // if (!fieldName || fieldName === 'permisos') {
        //     fieldValues.permisos.length === 0 && this.setError("permisos","Té de tenir algun permis");
        // }
    }

    public cercarGenerica = (items:IProjecte[], cerca:IProjecteCerca) => {
        if (cerca.text) {
            return items.filter((item) => item.nom.toLowerCase().includes(cerca.text.toLowerCase()))
        } else {
            return items
        }

    }



}