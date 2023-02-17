import * as React from 'react';
import { observer } from 'mobx-react';
import {EditProps} from "./index";
import {Fields, WebDialog, WebForm} from "web-fields-v2";
import {appState} from "../../index";

const PantForm:React.FC<EditProps>  =
    ({
        state
     }) => {

        const stateApp = React.useContext(appState)
        const item = state.objSel;

        return (
            <WebDialog
                open={state.openPopup}
                titol={"Projectes"}
                descripcio={"Editar o afegit projectes"}
                onSave={state.onSave}
                onClose={state.onClose}
                fullscreen={true}
            >
                <WebForm>
                    <Fields.Input
                        name={"id"}
                        required={true}
                        label={"Id"}
                        value={item.id}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        disabled={true}
                         xs={3}
                        textError = {state.errors.id}
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
                    <Fields.UploadFile
                        name={"imatge"}
                        label={"Imatge"}
                        required={true}
                        value={item.imatge}
                        xs={12}
                        md={6}
                        textError = {state.errors.imatge}
                        onChange = {state.onChange}
                        domainMedia={stateApp.urlMedia}
                        onLoad={(file:File[]) => state.fileUpload(file)}
                        onDelImg={(name:string) => state.onDelImg(name)}
                    />
                    <Fields.Input
                        name={"web"}
                        label={"Web"}
                        value={item.web}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        xs={12}
                        md={6}
                        textError = {state.errors.web}
                    />
                </WebForm>
            </WebDialog>
        )

    }

export default observer(PantForm);