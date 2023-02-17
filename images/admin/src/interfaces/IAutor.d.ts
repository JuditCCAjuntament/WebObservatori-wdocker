
interface IAutor {
    id: number;
    nom: string;
    resum: string;
    text: string;
    web: string;
    imatge: string;
    facebook: string;
    instagram: string;
    youtube: string;
    twitter: string

}

export default IAutor;

export interface IAutorCerca {
    text: string;
}
