import * as React from 'react';
import { observer } from 'mobx-react';
import {LlistatProps} from "./index";
import PantCerca from "./cercar";
import {ILlistatItem, WebLlistat, WebPaginacio} from 'web-fields-v2';


const PantLlistat:React.FC<LlistatProps>  =
    ({
        state,
        filtre
     }) => {

        React.useEffect(() => {
            filtre.setObjs(state.objs)
        }, [state.objs,filtre])

        const llistatObj:ILlistatItem[] = filtre.getItems().map((o,i) => {
            return {
                titol: o.tema,
                // subtitol: o.nom,
                onClick: () => state.onEdit(o),
                // onAdd: () => state.onEdit(o),
                onEdit: () => state.onEdit(o),
                onDelete: () => state.onDel(o),

            }
        })

        return (
                <WebLlistat
                    header={<PantCerca filtre={filtre}/>}
                    footer={<WebPaginacio filtres={filtre}/>}
                    items={llistatObj} />
        )

    }

export default observer(PantLlistat);