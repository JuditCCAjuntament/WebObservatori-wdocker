import * as React from 'react';

import PantLlistat from "./llistat";
import {appState} from "../../index";

import PantForm from "./form";
import {FilterState, WebPant} from "web-fields-v2";
import IProjecte, {IProjecteCerca} from "../../interfaces/IProjecte";
import ProjectesState from "../../states/PorjectesState";

export interface CercaProps {
    filtre: FilterState<IProjecte, IProjecteCerca>
}

export interface EditProps {
    state: ProjectesState,
}

export interface LlistatProps {
    state: ProjectesState,
    filtre: FilterState<IProjecte, IProjecteCerca>
}

const PantProjectes  =
    () => {

        const stateApp = React.useContext(appState)
        const state = stateApp.projectesState;
        React.useEffect(() => {
            state.onLoad();
        })

        const filtre = new FilterState<IProjecte, IProjecteCerca>();
        filtre.setRowsPerPage(10);
        filtre.setFilter(state.cercarGenerica)

        return (
            <WebPant titol={"Projectes"} onAdd={() => state.onAdd()} tipusAdd={'action'}>
                <PantLlistat
                    state={state}
                    filtre={filtre}
                />
                <PantForm state={state}/>
            </WebPant>
        )

    }

export default PantProjectes;