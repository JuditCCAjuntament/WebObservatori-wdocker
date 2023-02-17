import * as React from 'react';

import PantLlistat from "./llistat";
import {appState} from "../../index";

import PantForm from "./form";
import {FilterState, WebPant} from "web-fields-v2";
import ITema, {ITemaCerca} from "../../interfaces/ITema";
import TemesState from "../../states/TemesState";

export interface CercaProps {
    filtre: FilterState<ITema, ITemaCerca>
}

export interface EditProps {
    state: TemesState,
}

export interface LlistatProps {
    state: TemesState,
    filtre: FilterState<ITema, ITemaCerca>
}

const PantTemes  =
    () => {

        const stateApp = React.useContext(appState)
        const state = stateApp.temesState;
        React.useEffect(() => {
            state.onLoad();
        })

        const filtre = new FilterState<ITema,ITemaCerca>();
        filtre.setRowsPerPage(10);
        filtre.setFilter(state.cercarGenerica)

        return (
            <WebPant titol={"Temes"} onAdd={() => state.onAdd()} tipusAdd={'action'}>
                <PantLlistat
                    state={state}
                    filtre={filtre}
                />
                <PantForm state={state}/>
            </WebPant>
        )

    }

export default PantTemes;