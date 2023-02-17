import * as React from 'react';

import { observer } from 'mobx-react';


import {Search} from "@mui/icons-material";
import {CercaProps} from "./index";
import { Fields } from 'web-fields-v2';

const PantCerca:React.FC<CercaProps>  =
    ({
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
                        label={"Vídeo"}
                        startIcon={<Search/>}
                        onChange={handleSearch}
                    />
            </>
        )

    }

export default observer(PantCerca);