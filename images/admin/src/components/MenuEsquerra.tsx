import * as React from 'react';

import {observer} from "mobx-react";
import Home from "../pantalles/Home";
import {LocalOffer, Home as HomeIcon, Assignment, Person, Videocam} from "@mui/icons-material"
import { WebMenuOption } from 'web-app-v2';

const PantTemes = React.lazy(() => import("../pantalles/Temes"));
const PantProjectes = React.lazy(() => import("../pantalles/Projectes"));
const PantAutors = React.lazy(() => import("../pantalles/Autors"));
const PantVideos = React.lazy(() => import("../pantalles/Videos"));


export interface MenuEsquerraProps {
    children?: React.ReactNode;
}

export const rutes = [
    {path: "",element: <Home/>, index: true},
    {path: "videos",element: <PantVideos/>, lazy:true},
    {path: "autors",element: <PantAutors/>, lazy:true},
    {path: "projectes",element: <PantProjectes/>, lazy:true},
    {path: "temes",element: <PantTemes/>, lazy:true},
]

export const MenuEsquerra: React.FC<MenuEsquerraProps> =
    observer(() => {
        return (
            <WebMenuOption container={true}>
                <WebMenuOption path={"/"} titol={"Inici"} icon={<HomeIcon/>}/>
                <WebMenuOption path={"/videos"} titol={"Vídeos"} icon={<Videocam/>}/>
                <WebMenuOption path={"/autors"} titol={"Autors"} icon={<Person/>}/>
                <WebMenuOption path={"/projectes"} titol={"Projectes"} icon={<Assignment/>}/>
                <WebMenuOption path={"/temes"} titol={"Temes"} icon={<LocalOffer/>}/>
            </WebMenuOption>

        )
    })
