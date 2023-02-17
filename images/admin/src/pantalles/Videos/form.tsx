import * as React from 'react';
import { observer } from 'mobx-react';
import {EditProps} from "./index";
import {Fields, FilterState, ILlistatItem, WebDialog, WebForm, WebLlistat, WebPaginacio} from "web-fields-v2";
import {appState} from "../../index";
import VideosTemesState from "../../states/VideosTemesState";
import {Check, CropSquare, Search} from "@mui/icons-material";
import VideosAutorsState from "../../states/VideosAutorsState";
import AutorsState from "../../states/AutorsState";
import IAutor, {IAutorCerca} from "../../interfaces/IAutor";
import VideosDocumentsState from "../../states/VideosDocumentsState";

const PantForm:React.FC<EditProps>  =
    ({
        state
     }) => {

        const stateApp = React.useContext(appState)
        const stateAutors = stateApp.autorsState;

        const item = state.objSel;

        const filtreAutors = new FilterState<IAutor,IAutorCerca>();
        filtreAutors.setRowsPerPage(5);
        filtreAutors.setFilter(stateAutors.cercarGenerica)

        let llistatTemesObj:ILlistatItem[] = []
        let llistatAutorsObj:ILlistatItem[] = []
        let llistatDocumentsObj:ILlistatItem[] = []

        if (item.temes)
            llistatTemesObj = item.temes.map((o,i) => {
                const disabled = o.id < 0;
                return {
                    titol: state.temes.getNomTema(o),
                    disabled: disabled,
                }
            })
        if (item.autors)
            llistatAutorsObj = item.autors.map((o,i) => {
                const disabled = o.id < 0;
                return {
                    titol: state.autors.getNom(o),
                    disabled: disabled,
                }
            })
        if (item.documents)
            llistatDocumentsObj = item.documents.map((o,i) => {
                const disabled = o.id < 0;
                return {
                    titol: state.documents.getNom(o),
                    disabled: disabled,
                    onClick: disabled ? undefined : () => state.documents.onEdit(o),
                    onEdit: disabled ? undefined : () => state.documents.onEdit(o),
                    onDelete: disabled ? undefined : () => state.documents.onDel(o),
                }
            })
        return (
            <WebDialog
                open={state.openPopup}
                titol={"Vídeos"}
                descripcio={"Editar o afegit vídeos"}
                onSave={state.onSave}
                onClose={state.onClose}
                fullscreen={true}
            >
                <WebForm>
                    <Fields.Input
                        name={"ordre"}
                        required={true}
                        label={"Posició"}
                        value={item.ordre}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        xs={3}
                        textError = {state.errors.ordre}
                    />
                    <Fields.Input
                        name={"nom"}
                        required={true}
                        label={"Nom"}
                        value={item.nom}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        flexGrow={true}
                        textError = {state.errors.nom}
                    />
                    <Fields.NewLine/>
                    <Fields.Input
                        name={"url_video"}
                        label={"Adreça del vídeo"}
                        value={item.url_video}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        xs={12}
                        md={6}
                        textError = {state.errors.url_video}
                    />
                    <Fields.Input
                        name={"durada"}
                        label={"Durada del vídeo"}
                        value={item.durada}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        xs={12}
                        md={3}
                        textError = {state.errors.durada}
                    />
                    <Fields.DatePicker
                        name={"data_video"}
                        label={"Data"}
                        required={true}
                        xs={12}
                        md={3}
                        value={item.data_video}
                        onChange={state.onChangeDate}
                        onBlur = {state.validateSingleError}
                        textError = {state.errors.data_video}
                    />
                    <Fields.Input
                        name={"resum"}
                        label={"Resum"}
                        value={item.resum}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        xs={12}
                        textError = {state.errors.resum}
                    />
                    <Fields.EditorHtml
                        name={'text'}
                        value={item.text}
                        label={'Text'}
                        onChange={state.onChange}
                        xs={12}
                        sourceTinyMce={process.env.PUBLIC_URL + '/tinymce/tinymce.min.js'}
                    />
                    <Fields.Switch
                        name={"destacat"}
                        label={"Destacat"}
                        value={item.destacat}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        xs={12}
                        md={6}
                        textError = {state.errors.destacat}
                    />
                    <Fields.Select
                        name={"id_projecte"}
                        label={"Projecte"}
                        value={item.id_projecte}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        xs={12}
                        md={6}
                        textError = {state.errors.id_projecte}
                        items={state.getProjectes()}
                    />
                </WebForm>
                <Fields.Titol
                    titol={"Autors"}
                    onAdd={() => state.autors.onAdd()}
                    titolButton={"Editar"}
                />
                <WebLlistat
                    items={llistatAutorsObj} />
                <FormPanallaAutors
                    state={state.autors}
                    stateAutors={stateAutors}
                    filtre={filtreAutors}
                />

                <Fields.Titol
                    titol={"Temes"}
                    onAdd={() => state.temes.onAdd()}
                    titolButton={"Editar"}
                />
                <WebLlistat
                    items={llistatTemesObj} />
                <FormPanallaTemes state={state.temes}/>

                <Fields.Titol
                    titol={"Proposta didàctica"}
                    onAdd={() => state.documents.onAdd()}
                />
                <WebLlistat
                    items={llistatDocumentsObj} />
                <FormPanallaDocuments
                    state={state.documents}
                />
                <Fields.Titol
                    titol={"Imatges"}
                />
                <WebForm>
                    <Fields.UploadFile
                        name={"imatge_v"}
                        label={"Imatge Vertical"}
                        required={true}
                        value={item.imatge_v}
                        xs={12}
                        md={6}
                        textError = {state.errors.imatge_v}
                        onChange = {state.onChange}
                        domainMedia={stateApp.urlMedia}
                        onLoad={(file:File[]) => state.fileUpload(file)}
                        onDelImg={(name:string) => state.onDelImg('imatge_v',name)}
                    />
                    <Fields.UploadFile
                        name={"imatge_h"}
                        label={"Imatge Horitzontal"}
                        required={true}
                        value={item.imatge_h}
                        xs={12}
                        md={6}
                        textError = {state.errors.imatge_h}
                        onChange = {state.onChange}
                        domainMedia={stateApp.urlMedia}
                        onLoad={(file:File[]) => state.fileUpload(file)}
                        onDelImg={(name:string) => state.onDelImg('imatge_h',name)}
                    />
                </WebForm>
                <Fields.Titol
                    titol={"Altres adreces"}
                    />
                <WebForm>
                    <Fields.Input
                        name={"url_subtitols"}
                        label={"Adreça amb subtítols"}
                        value={item.url_subtitols}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        xs={12}
                        textError = {state.errors.url_subtitols}
                    />
                    <Fields.Input
                        name={"url_podcast"}
                        label={"Adreça del podcast"}
                        value={item.url_podcast}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        xs={12}
                        textError = {state.errors.url_podcast}
                    />
                    <Fields.Input
                        name={"url_versio_original"}
                        label={"Adreça de la versió original del vídeo"}
                        value={item.url_versio_original}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        xs={12}
                        textError = {state.errors.url_versio_original}
                    />
                    <Fields.Input
                        name={"url_versio_eng"}
                        label={"Adreça de la versió en anglès del vídeo"}
                        value={item.url_versio_eng}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        xs={12}
                        textError = {state.errors.url_versio_eng}
                    />
                </WebForm>
            </WebDialog>
        )

    }

export default observer(PantForm);

interface IPropsTemes {
    state: VideosTemesState;
}

const FormPanallaTemes:React.FC<IPropsTemes> =
    observer(({
                  state
              }) => {

        const llistatObj:ILlistatItem[] = state.getTemes().map((o,i) => {
            const selected = state.objs.filter((obj) => (obj.id >= 0 && obj.id_tema === o.id)).length > 0
            return {
                titol: o.titol,
                icona: selected ? <Check color={"success"}/> : <CropSquare/>,
                onClick: () => state.onSelect(o.id),

            }
        })
        return (
            <WebDialog
                open={state.openPopup}
                titol={"Temes"}
                onSave={state.onSave}
                onClose={() => state.onClose()}
                fullscreen={false}
            >
                <WebLlistat
                    items={llistatObj}
                />
            </WebDialog>
        )
    })


interface IPropsAutors {
    filtre: FilterState<IAutor,IAutorCerca>,
    state: VideosAutorsState;
    stateAutors: AutorsState;
}

const FormPanallaAutors:React.FC<IPropsAutors> =
    observer(({
                  filtre,
                  state,
                  stateAutors
              }) => {

        React.useEffect(() => {
            filtre.setObjs(stateAutors.objs)
        }, [stateAutors.objs, filtre])

        const llistatObj:ILlistatItem[] = filtre.getItems().map((o,i) => {
            const selected = state.objs.filter((obj) => (obj.id >= 0 && obj.id_autor === o.id)).length > 0
            return {
                titol: o.nom,
                icona: selected ? <Check color={"success"}/> : <CropSquare/>,
                onClick: () => state.onSelect(o.id),

            }
        })
        return (
            <WebDialog
                open={state.openPopup}
                titol={"Autors"}
                onSave={state.onSave}
                onClose={() => state.onClose()}
                fullscreen={false}
            >
                <WebLlistat
                    items={llistatObj}
                    header={<FormPanallaCercaAutors filtre={filtre} state={stateAutors}/>}
                    footer={<WebPaginacio filtres={filtre}/>}
                />
            </WebDialog>
        )
    })

interface IPropsCercaAutors {
    filtre: FilterState<IAutor,IAutorCerca>,
    state: AutorsState;
}

const FormPanallaCercaAutors:React.FC<IPropsCercaAutors> =
    observer(({
                  state,
                  filtre
              }) => {


        const handleSearch = (e:any) => {
            const {name,value}  = e.target;
            filtre.setCerca({...filtre.cerca,[name]:value});
        }

        return (
            <>
                <Fields.Input
                    name={"text"}
                    label={"Autor"}
                    startIcon={<Search/>}
                    onChange={handleSearch}
                />
            </>
        )
    })

interface IPropsDocuments {
    state: VideosDocumentsState;
}

const FormPanallaDocuments:React.FC<IPropsDocuments> =
    observer(({
                  state
              }) => {

        const stateApp = React.useContext(appState)
        const item = state.objSel;

        return (
            <WebDialog
                open={state.openPopup}
                titol={"Proposta didàctica"}
                onSave={state.onSave}
                onClose={() => state.onClose()}
                fullscreen={false}
            >
                <WebForm>
                    <Fields.Input
                        name={"nom_document"}
                        required={true}
                        label={"Nom"}
                        value={item.nom_document}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        xs={12}
                        textError = {state.errors.nom_document}
                    />
                    <Fields.UploadFile
                        name={"url_document"}
                        label={"Document"}
                        required={true}
                        value={item.url_document}
                        xs={12}
                        md={6}
                        textError = {state.errors.url_document}
                        onChange = {state.onChange}
                        domainMedia={stateApp.urlMedia}
                        onLoad={(file:File[]) => state.fileUpload(file)}
                        onDelImg={(name:string) => state.onDelImg('url_document',name)}
                        tipus={'pdf'}
                    />
                </WebForm>
            </WebDialog>
        )
    })