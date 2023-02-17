
import AppState from "../states/AppState";
import {ObjApi} from "web-api-v2";

export default class AppApi<T> extends ObjApi<T>{
    protected appState: AppState;
    constructor (appState:AppState,getUrlApiPortal: () => string, getId: (obj: T) => number) {
        const onLoadingChangeApi = (loading:boolean) => {
            appState.loadState.setIsLoading(loading);
        }
        const onError = (e:any) => {
            const status = e.response.status
            if (status > 400 && status < 404) {
                 appState.userState.logout();
            }
        }
        const getToken = () => {
            return appState.userState.token ? appState.userState.token : '';
        };
        const host = window.location.href;
        const urlDefault = host.startsWith(process.env.REACT_APP_HOST_LOCAL ?? 'nothing') ? 'local' : (host.startsWith(process.env.REACT_APP_HOST_DEVEL ?? 'nothing') ? 'devel' : 'prod')
        console.log(urlDefault);
        const configApi = {
            onError: onError,
            onLoadingChange: onLoadingChangeApi,
            getToken: getToken,
            url: {
                devel: process.env.REACT_APP_URL_API_DEVEL,
                local: process.env.REACT_APP_URL_API_LOCAL,
                prod: process.env.REACT_APP_URL_API_PROD ?? ''
            },
            urlDefault: urlDefault ?? 'prod',
            getUrlApi: getUrlApiPortal,
            getId: getId
        }

        super(configApi);
        this.appState = appState;
    }

}