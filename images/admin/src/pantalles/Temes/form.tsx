import * as React from 'react';
import { observer } from 'mobx-react';
import {EditProps} from "./index";
import {Fields, WebDialog, WebForm} from "web-fields-v2";

const PantForm:React.FC<EditProps>  =
    ({
        state
     }) => {

        const item = state.objSel;

        return (
            <WebDialog
                open={state.openPopup}
                titol={"Temes"}
                descripcio={"Editar o afegit temes"}
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
                        name={"tema"}
                        required={true}
                        label={"Tema"}
                        value={item.tema}
                        onChange = {state.onChange}
                        onBlur = {state.validateSingleError}
                        flexGrow={true}
                        textError = {state.errors.tema}
                    />
                </WebForm>
            </WebDialog>
        )

    }

export default observer(PantForm);