
import AppState from "./AppState";

import { ObjState } from "web-api-v2";
import ITema, {ITemaCerca} from "../interfaces/ITema";
import TemesApi from "../api/TemesApi";



export default class TemesState extends ObjState<ITema>{
    private appState: AppState

    constructor(appState:AppState) {
        super(new TemesApi(appState));
        this.appState = appState;
    }

    public getNewObj = () => {
        return {
            id: 0,
            tema: 'Nom tema',
        } as ITema
    }

    public onLoad = () => {
        this.getObjApi()
            .catch((e:any) => {
                this.appState?.onErrorApi(e)
            });

    }


    public onAdd = () => {
        const obj = this.getNewObj()

        this.startEdit(obj, true)
        this.setOpenPopup(true);
    }

    public onEdit = (obj: ITema) => {
        this.startEdit(obj, false)
        this.setOpenPopup(true);
    }

    public onSave = () => {

        if (this.validate()) {
            if (this.isNew) {
                this.addObjApi()
                    .then((o:ITema) => {
                        this.setOpenPopup(false)
                        this.setObjs([...this.objs, o]);
                        this.appState.notiState.showMessage("Guardat correctament","success");
                    })
                    .catch((e:any) => {
                        this.appState?.onErrorApi(e)
                    });
            } else {
                this.updateObjApi()
                    .then((o:ITema) => {
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

    public onDel = (obj: ITema) => {
        this.appState.dialState.newAlert('Esborrar', 'Vols esborrar "' + obj.tema + '" ?',() => this.delObj(obj));
    }

    public delObj = (obj: ITema) => {
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
        this.reset();
    }
    public validateFunction = (fieldValues:ITema ,fieldName?: string) => {

        if (!fieldName || fieldName === 'tema') {
            !fieldValues.tema && this.setError("tema","Aquest camp no pot esta buit");
        }
    }

    public cercarGenerica = (items:ITema[], cerca:ITemaCerca) => {
        if (cerca.text) {
            return items.filter((item) => item.tema.toLowerCase().includes(cerca.text.toLowerCase()))
        } else {
            return items
        }

    }



}