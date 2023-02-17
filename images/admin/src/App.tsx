import React, {useContext} from 'react';

import {appState} from "./index";
import {rutes, MenuEsquerra} from "./components/MenuEsquerra";
import { WebApp } from 'web-app-v2';


const App = () => {
  const state = useContext(appState)
  return (
    <WebApp titol={"Administració ciutat Àgora"} appState={state} menu={<MenuEsquerra/>} rutes={rutes}/>
  );
}

export default App;


