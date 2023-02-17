import {Assignment, LocalOffer, Person, Videocam} from '@mui/icons-material';
import * as React from 'react';
import { WebCardHome } from 'web-app-v2';



const Home  =
    () => {
        return (
            <WebCardHome container={true}>
                <WebCardHome
                    titol={"Vídeos"}
                    descripcio={"Afegir o editar videos"}
                    path={"/videos"}
                    icona = {<Videocam fontSize={"large"}/>}
                    xs={12}
                    md={6}
                    lg={4}
                />
                <WebCardHome
                    titol={"Autors"}
                    descripcio={"Afegir o editar autors"}
                    path={"/autors"}
                    icona = {<Person fontSize={"large"}/>}
                    xs={12}
                    md={6}
                    lg={4}
                />
                <WebCardHome
                    titol={"Projectes"}
                    descripcio={"Afegir o editar projectes"}
                    path={"/projectes"}
                    icona = {<Assignment fontSize={"large"}/>}
                    xs={12}
                    md={6}
                    lg={4}
                />
                <WebCardHome
                    titol={"Temes"}
                    descripcio={"Afegir o editar temes"}
                    path={"/temes"}
                    icona = {<LocalOffer fontSize={"large"}/>}
                    xs={12}
                    md={6}
                    lg={4}
                />
            </WebCardHome>
        )

    }

export default Home;