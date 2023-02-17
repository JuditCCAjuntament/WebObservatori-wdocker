
import AppState from "./AppState";

import { ObjState } from "web-api-v2";
import IVideo, {IVideoCerca} from "../interfaces/IVideo";
import VideosApi from "../api/VideosApi";
import VideosTemesState from "./VideosTemesState";
import VideosAutorsState from "./VideosAutorsState";
import VideosDocumentsState from "./VideosDocumentsState";


export default class VideosState extends ObjState<IVideo>{
    private appState: AppState
    public temes: VideosTemesState;
    public autors: VideosAutorsState;
    public documents: VideosDocumentsState;
    constructor(appState:AppState) {
        super(new VideosApi(appState));
        this.appState = appState;
        this.temes = new VideosTemesState(appState);
        this.autors = new VideosAutorsState(appState);
        this.documents = new VideosDocumentsState(appState);
    }

    public getNewObj = () => {
        return {
            id: 0,
            nom: 'Nom vídeo',
            resum: '',
            text: '',
            imatge_h: '',
            imatge_v: '',
            url_video: '',
            destacat: false,
            ordre: 1,
            id_projecte: -1,
            url_podcast: '',
            url_subtitols: '',
            url_versio_original: '',
            url_versio_eng: '',
            durada: '',
            temes: [],
            autors: [],
            documents: [],
            data_video: new Date().toISOString().split('T')[0]
        } as IVideo
    }

    public onLoad = () => {
        this.appState.projectesState.onLoad();
        this.appState.temesState.onLoad();
        this.appState.autorsState.onLoad();
        this.getObjApi()
            .catch((e:any) => {
                this.appState?.onErrorApi(e)
            });

    }

    public onChangeDate = (e:any) => {
        if (e.target.value && e.target.value != null) {
            e.target.value = this.appState.convertDateToUTC(e.target.value);
        }

        this.onChange(e);
    }

    public fileUpload(file:File[]){
        const directori = 'ciutat_agora/videos';
        return this.appState.uploadFile(file,directori,'')
    }

    public onDelImg(name:string, img_name:string) {
        const orig_value = name === 'imatge_h' ? this.objOrig.imatge_h : (name === 'imatge_v' ? this.objOrig.imatge_v : img_name)
        if(orig_value !== img_name) {
            this.appState.delFile(img_name);
        }
    }

    public onAdd = () => {
        const obj = this.getNewObj()

        this.startEdit(obj, true)
        this.temes.setObjs(obj.temes)
        this.autors.setObjs(obj.autors)
        this.documents.setObjs(obj.documents)
        this.setOpenPopup(true);
    }

    public onEdit = (obj: IVideo) => {
        this.startEdit(obj, false)
        this.temes.setObjs(obj.temes)
        this.autors.setObjs(obj.autors)
        this.documents.setObjs(obj.documents)
        this.setOpenPopup(true);
    }

    public onSave = () => {

        this.setObjSel({...this.objSel,'temes': this.temes.objs,'autors': this.autors.objs,'documents': this.documents.objs});

        if (this.validate()) {
            if (this.isNew) {
                this.addObjApi()
                    .then((o:IVideo) => {
                        this.setOpenPopup(false)
                        this.onLoad();
                        this.appState.notiState.showMessage("Guardat correctament","success");
                    })
                    .catch((e:any) => {
                        this.appState?.onErrorApi(e)
                    });
            } else {
                this.updateObjApi()
                    .then((o:IVideo) => {
                        this.setOpenPopup(false)
                        this.onLoad();
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

    public onDel = (obj: IVideo) => {
        this.appState.dialState.newAlert('Esborrar', 'Vols esborrar "' + obj.nom + '" ?',() => this.delObj(obj));
    }

    public delObj = (obj: IVideo) => {
        this.startEdit(obj);
        this.delObjApi()
            .then(() => {
                this.onLoad();
                this.appState.notiState.showMessage("Esborrat correctament","success");
            })
            .catch((e:any) => {
                this.appState?.onErrorApi(e)
            });
    }

    public onClose = () => {
        this.setOpenPopup(false);
        if(this.objOrig.imatge_v !== this.objSel.imatge_v) {
            this.appState.delFile(this.objSel.imatge_v);
        }
        if(this.objOrig.imatge_h !== this.objSel.imatge_h) {
            this.appState.delFile(this.objSel.imatge_h);
        }
        // si cancelem les modificacions esborrem:
        // - documents no guardats
        this.objSel.documents.map((o,i) => {
            if (o.id === 0) {
                this.appState.delFile(o.url_document);
            }
            return "ok";
        })

        this.reset();
    }
    public validateFunction = (fieldValues:IVideo ,fieldName?: string) => {

        if (!fieldName || fieldName === 'nom') {
            !fieldValues.nom && this.setError("nom","Aquest camp no pot esta buit");
        }
        if (!fieldName || fieldName === 'data_video') {
            !fieldValues.data_video && this.setError("data_video","Aquest camp no pot esta buit");
        }
        // if (!fieldName || fieldName === 'permisos') {
        //     fieldValues.permisos.length === 0 && this.setError("permisos","Té de tenir algun permis");
        // }
    }

    public cercarGenerica = (items:IVideo[], cerca:IVideoCerca) => {
        if (cerca.text) {
            return items.filter((item) => item.nom.toLowerCase().includes(cerca.text.toLowerCase()))
        } else {
            return items
        }

    }

    public getProjectes = () => {
        return this.appState.projectesState.objs.map((o) => ({
            'id': o.id,
            'titol': o.nom
        }))
    }

}