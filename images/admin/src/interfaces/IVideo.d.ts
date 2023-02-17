import IVideoTema from "./IVideoTema";
import IVideoAutor from "./IVideoAutor";
import IVideoDocument from "./IVideoDocument";

interface IVideo {
    id: number;
    nom: string;
    resum: string;
    text: string;
    imatge_h: string;
    imatge_v: string;
    url_video: string;
    destacat: boolean;
    ordre: number;
    url_subtitols: string;
    url_podcast: string;
    url_versio_original: string;
    url_versio_eng: string;
    id_projecte: number;
    durada: string;
    temes: IVideoTema[];
    autors: IVideoAutor[];
    documents: IVideoDocument[];
    data_video: string;
}

export default IVideo;

export interface IVideoCerca {
    text: string;
}
