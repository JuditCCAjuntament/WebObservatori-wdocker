import * as React from 'react';

import PantLlistat from "./llistat";
import {appState} from "../../index";

import PantForm from "./form";
import {FilterState, WebPant} from "web-fields-v2";
import IVideo, {IVideoCerca} from "../../interfaces/IVideo";
import VideosState from "../../states/VideosState";

export interface CercaProps {
    filtre: FilterState<IVideo, IVideoCerca>
}

export interface EditProps {
    state: VideosState,
}

export interface LlistatProps {
    state: VideosState,
    filtre: FilterState<IVideo, IVideoCerca>
}

const PantVideos  =
    () => {

        const stateApp = React.useContext(appState)
        const state = stateApp.videosState;
        React.useEffect(() => {
            state.onLoad();
        })

        const filtre = new FilterState<IVideo, IVideoCerca>();
        filtre.setRowsPerPage(10);
        filtre.setFilter(state.cercarGenerica)

        return (
            <WebPant titol={"Vídeos"} onAdd={() => state.onAdd()} tipusAdd={'action'}>
                <PantLlistat
                    state={state}
                    filtre={filtre}
                />
                <PantForm state={state}/>
            </WebPant>
        )

    }

export default PantVideos;