import * as React from 'react';

import PantLlistat from "./llistat";
import {appState} from "../../index";

import PantForm from "./form";
import {FilterState, WebPant} from "web-fields-v2";
import IAutor, {IAutorCerca} from "../../interfaces/IAutor";
import AutorsState from "../../states/AutorsState";

export interface CercaProps {
    filtre: FilterState<IAutor, IAutorCerca>
}

export interface EditProps {
    state: AutorsState,
}

export interface LlistatProps {
    state: AutorsState,
    filtre: FilterState<IAutor, IAutorCerca>
}

const PantAutors  =
    () => {

        const stateApp = React.useContext(appState)
        const state = stateApp.autorsState;
        React.useEffect(() => {
            state.onLoad();
        })

        const filtre = new FilterState<IAutor, IAutorCerca>();
        filtre.setRowsPerPage(10);
        filtre.setFilter(state.cercarGenerica)

        return (
            <WebPant titol={"Autors"} onAdd={() => state.onAdd()} tipusAdd={'action'}>
                <PantLlistat
                    state={state}
                    filtre={filtre}
                />
                <PantForm state={state}/>
            </WebPant>
        )

    }

export default PantAutors;