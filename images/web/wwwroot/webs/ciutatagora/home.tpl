
{assign var="web_title" value="Manresa Ciutat Àgora"}

{assign var="web_description" value=$portal.meta_description}
{assign var="web_canonical" value=$portal.canonical}

{assign var="dades_ciutatagora" value=$portal.dades_gestor}

{assign var="urlVideos" value="menu/15049-videos"}
{assign var="urlAutors" value="menu/15051-autors"}
{assign var="urlProjectes" value="menu/15050-projectes"}

{assign var="web_urlImgDefault" value="assets-default/img/"}
{assign var="web_urlMedia" value=$urlMedia}

{assign var="web_urlCss" value="assets/css/"}
{assign var="web_urlJs" value="assets/js/"}
{assign var="web_urlImg" value="assets/img/"}
{assign var="web_urlHelper" value="`$portal.dir_template`/helpers/"}



<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" lang="ca">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="cache-control" content="no-cache"/>
    <meta http-equiv="pragma" content="no-cache"/>
    <meta http-equiv="expires" content="-1"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="{$web_description}"/>

    <base href="{$portal.urlBase}/" />
    <title>{$web_title}</title>

    <link rel="icon" type="image/png" href="{$web_urlImg}favicon.png" />
    <link rel="shortcut icon" href="{$web_urlImg}favicon.ico" />

    <link rel="canonical" href="{$web_canonical}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css" media="all">

    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{$web_urlCss}estils.css" media="all"/>

    <!--[if lt IE 9]>
    <link href="/css/bootstrap/ie_patch.css" rel="stylesheet">

    <script src="/js/html5shiv.min.js" type="text/javascript" async="async"></script>
    <script type="text/javascript" src="/js/respond/respond.min.js"  async="async"></script>
    <![endif]-->

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</head>
<body>

<header>
    <div class="logo">
        <div class="botoMenuMbl hide-on-large-only">
            <a href="#" id="menuMbl" data-target="menuMobil" class="sidenav-trigger"><span class="material-icons">menu</span></a>
        </div>
        <div class="titol">
            <a href="#">{$web_title}</a>
        </div>
    </div>
    <div class="menu-header">
        <div class="hide-on-med-and-down menu">
            <a href="#" class="select">
                Inici
            </a>
            {foreach name=llistatmenu item=item from=$portal.menu}
                {assign var="extern" value=""}
                {assign var="desti" value="menu/`$item.idseo`"}
                {assign var="menuTopSel" value=""}

                {if $item.url != "" }
                    {assign var="desti" value=$item.url}
                    {if $item.enllac_extern == 1}
                        {assign var="extern" value="target=\"_blank\" "}
                    {/if}

                {/if}

                {if $item.publicat == 1}
                    <a href="{$desti}" {$extern} class="{$menuTopSel}">
                        {$item.titol}
                    </a>
                {/if}
            {/foreach}
        </div>
        <div class="hide-on-med-and-down cerca">
            <a href="{$urlVideos}">
                <span class="material-icons">search</span>
            </a>

        </div>

    </div>
    <div class="barra-inferior">
        <div class="punxa">
            <img src="{$web_urlImg}punxa2.png" alt="">
        </div>
    </div>
    <div class="barra_groga"></div>
    {if $mostrar_avis_cookies}
        <div id="barracookies" class="avis_cookie white">
            <div class="container">
                <p>
                    Aquest web utilitza galetes (cookies) per a oferir una millor experiència de navegació. Si continua navegant pel web, considerem que accepta la seva utilització.
                </p>
                <a href="javascript:acceptarCookies();void(0);" class="waves-effect waves-light btn">Acceptar</a>
            </div>
        </div>
    {/if}

</header>
<ul id="menuMobil" class="sidenav leftside-navigation ps-container ps-active-y">
    <li class="titolMenuMbl">
        <a href="{$urlVideos}">
            <span class="material-icons">search</span>
        </a>
        <a class="sidenav-close" href="#!">
            <span class="material-icons">close</span>
        </a>
    </li>
    <li class="menu-lateral">
        {include file="`$web_urlHelper`template-menus_materialize.tpl" depth=0 urlHelper=$web_urlHelper menu=$portal.menu home=1}
    </li>
</ul>
<main class="portada">
    {if $dump_string}
        {foreach name=dumps item=item from=$dump_string}
            <div>{$item}</div>
        {/foreach}
    {/if}
    <section class="caixa">
        {if $portal.destacats}
            <div class="destacats">
                {if sizeof($portal.destacats) > 1}
                    <div class="carousel carousel-slider autoplay" data-indicators="true">
                        {foreach name=destacats item=item from=$portal.destacats}
                            <div class="carousel-item" >
                                <a href="{$item.url}" target="_blank">
                                    <img src="{$web_urlMedia}docs/destacats/{$item.imatge}" class="responsive-img" style="min-width: 100%;" alt="{$item.descripcio}"/>
                                </a>

                            </div>
                        {/foreach}
                    </div>
                {else}
                    <a href="{$portal.destacats.0.url}" target="_blank">
                        <img src="{$web_urlMedia}docs/destacats/{$portal.destacats.0.imatge}" class="responsive-img" alt="{$portal.destacats.0.descripcio}"/>
                    </a>
                {/if}
            </div>
        {/if}
    </section>
    <section class="caixa temes">
            {if isset($dades_ciutatagora.temes) && sizeof($dades_ciutatagora.temes) > 0}
                {foreach name=temes item=item from=$dades_ciutatagora.temes}
                    <div class="item"><a href="{$urlVideos}?tema={$item.id}" >{$item.tema}</a></div>
                {/foreach}
            {/if}
    </section>
{*    <section class="caixa">*}
{*        <div class="item descripcio">*}
{*            Manresa Ciutat Àgora és un projecte transversal i vertebrador on podeu trobar continguts digitals de caire cultural, humanístic i científic generats a la ciutat.*}
{*        </div>*}
{*        <div class="item projectes">*}
{*            {if isset($dades_ciutatagora.projectes) && sizeof($dades_ciutatagora.projectes) > 0}*}
{*                {foreach name=projectes item=item from=$dades_ciutatagora.projectes}*}
{*                    <div><a class="btn {$item.nom|normaliza}" href="{$urlProjectes}/{$item.id}">{$item.nom}</a></div>*}
{*                {/foreach}*}
{*            {/if}*}
{*        </div>*}
{*    </section>*}
    {if sizeof($dades_ciutatagora.ultimes_act) > 0}
        <section class="ultimes_publicacions">
            <div class="subtitol">
                Últimes publicacions
            </div>
            <div style="display: flex;">
                <div class="llistat horitzontal">
                    {foreach name=ultimes_act item=item from=$dades_ciutatagora.ultimes_act}
                        {assign var="position" value=$smarty.foreach.ultimes_act.iteration%4}
                        {if $smarty.foreach.ultimes_act.iteration < 5 }
                                <div class="item  pos-{$position}" >
                                    <div class="img">
                                        <a href="{$urlVideos}/{$item.id}">
                                            <img src="{$web_urlMedia}{$item.imatge_v}" alt="{$item.nom}" title="{$item.nom}"/>
                                        </a>
                                    </div>
                                    <div class="dades">
                                        <div class="dades-generals">
                                            <div class="projecte">
                                                <a class="btn {$item.projecte|normaliza}" href="{$urlProjectes}/{$item.id_projecte}">{$item.projecte}</a>
                                            </div>
                                            <div class="autor">
                                                {if $item.autors !=''}
                                                    {assign var="autors" value=explode("#",$item.autors)}
                                                    {foreach name=autors item=item_autor from=$autors}
                                                        {assign var="autor" value=explode(":",$item_autor)}
                                                        <a href="{$urlAutors}/{$autor[1]}">{$autor[0]}</a>
                                                        {if !$smarty.foreach.autors.last}
                                                            <span>, </span>
                                                        {/if}
                                                    {/foreach}
                                                {/if}
                                            </div>
                                            <div class="espai-central">
                                                <div class="subtitol">
                                                    <a href="{$urlVideos}/{$item.id}">
                                                        {$item.nom}
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="resum">
                                                <div>
                                                    <a href="{$urlVideos}/{$item.id}">
                                                        {$item.resum}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="dades-enllac">
                                            <div class="durada">
                                                {$item.durada} h
                                            </div>
                                            <div class="boto-entrar">
                                                <a href="{$urlVideos}/{$item.id}">
                                                    <span class="material-icons">
                                                        east
                                                    </span>
                                                    </a>
                                            </div>

                                        </div>
{*                                        <div class="linia1">*}
{*                                            <div class="autor">*}
{*                                                {if $item.autors !=''}*}
{*                                                    {assign var="autors" value=explode("#",$item.autors)}*}
{*                                                    {foreach name=autors item=item_autor from=$autors}*}
{*                                                        {assign var="autor" value=explode(":",$item_autor)}*}
{*                                                        <a href="{$urlAutors}/{$autor[1]}">{$autor[0]}</a>*}
{*                                                        {if !$smarty.foreach.autors.last}*}
{*                                                            <span>, </span>*}
{*                                                        {/if}*}
{*                                                    {/foreach}*}
{*                                                {/if}*}
{*                                            </div>*}
{*                                            <div class="projecte">*}
{*                                                <a class="btn {$item.projecte|normaliza}" href="{$urlProjectes}/{$item.id_projecte}">{$item.projecte}</a>*}
{*                                            </div>*}
{*                                        </div>*}
{*                                        <div class="linia1 subtitol">*}
{*                                            <a href="{$urlVideos}/{$item.id}">*}
{*                                                {$item.nom}*}
{*                                            </a>*}
{*                                        </div>*}
{*                                        <div class="linia2">*}
{*                                            <div class="resum">*}
{*                                                <a href="{$urlVideos}/{$item.id}">*}
{*                                                    {$item.resum}*}
{*                                                </a>*}
{*                                            </div>*}
{*                                            <div class="durada">*}
{*                                                {$item.durada}*}
{*                                            </div>*}
{*                                        </div>*}
                                    </div>
                                </div>
                            {/if}
                    {/foreach}
                </div>
                <div class="barra_color verd"></div>
            </div>

            <div class="boto">
                <a class="btn gran" href="{$urlVideos}">Descobreix-los tots</a>
            </div>
        </section>
    {/if}
    {if sizeof($dades_ciutatagora.destacats) > 0}
        <section class="destacats">
            <div class="subtitol">
                Vídeo destacat
            </div>
            <div class="llistat vertical">
                {foreach name=destacats item=item from=$dades_ciutatagora.destacats}
                    {if $smarty.foreach.destacats.iteration < 6 }
                <div class="item">
                    <div class="video">
                        <div class="img">
                            <a href="{$urlVideos}/{$item.id}">
                                <img src="{$web_urlMedia}{$item.imatge_h}" alt="{$item.nom}" title="{$item.nom}"/>
                            </a>
                            <div class="boto-play">
                                <a class="btn gran" href="{$urlVideos}/{$item.id}">
                                    Play
                                </a>
                            </div>
                        </div>
                        <div class="dades">
                            <div class="linia1">
                                <div>
                                    {if isset($item.url_versio_original) && $item.url_versio_original != ''}
                                        <a href="{$item.url_versio_original}" target="_blank">Veure vídeo original</a>
                                    {/if}
                                </div>
                                <div>
                                    {if isset($item.url_subtitols) && $item.url_subtitols != ''}
                                        <a href="{$item.url_subtitols}" target="_blank">Veure en versió subtitulada</a>
                                    {/if}
                                </div>
                                <div>
                                    {if isset($item.url_podcast) && $item.url_podcast != ''}
                                        <a href="{$item.url_podcast}" target="_blank">Escoltar només en pòdcast</a>
                                    {/if}
                                </div>
                            </div>
                            <div class="linia2">
                                <div class="projecte-durada">
                                    <div>
                                        <a class="btn {$item.projecte|normaliza}" href="{$urlProjectes}/{$item.id_projecte}">{$item.projecte}</a>
                                    </div>
                                    <div class="durada">
                                        {$item.durada}
                                    </div>
                                </div>
                                <div>
                                    {if $item.autors !=''}
                                        {assign var="autors" value=explode("#",$item.autors)}
                                        {foreach name=autors item=item_autor from=$autors}
                                            {assign var="autor" value=explode(":",$item_autor)}
                                            <a href="{$urlAutors}/{$autor[1]}">{$autor[0]}</a><br/>
    {*                                        {if !$smarty.foreach.autors.last}*}
    {*                                            <span>, </span>*}
    {*                                        {/if}*}
                                        {/foreach}
                                    {/if}
                                    <div class="text-negreta">{$item.nom}</div>
                                </div>
                                <div class="text-negreta">
                                    {$item.resum}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="barra">

                    </div>
                </div>


                    {/if}
                {/foreach}
            </div>
        </section>
    {/if}
</main>
<footer >
    <div class="segueixnos">
        <div class="subtitol">
            Segueix-nos
        </div>
        <div class="caixa">
            <div class="item"><a href="#">Instagram</a></div>
            <div class="item"><a href="#">Facebook</a></div>
            <div class="item"><a href="#">Youtube</a></div>
        </div>
    </div>
    <div class="item contacte">
        <div class="subtitol">
            Contacte
        </div>
        <div class="caixa">
            <div class="item">
                <p>
                    Pl. Major 1, Manresa<br/>
                    <a href="mailto:ajt@ajmanresa.cat">ajt@ajmanresa.cat</a><br/>
                    <a href="tel:938782300">938782300</a>
                </p>
            </div>
            <div class="item">
                <p>
                    2022 &copy;<br/>
                    Crèdits<br/>
                    Informació legal<br/>
                </p>
            </div>
            <div class="item">
                <a href="https://www.manresa.cat" target="_blank"><img class="logo_ajmanresa" src="{$web_urlImg}Aj_Manresa.svg" alt="Ajuntament de Manresa"/></a>
            </div>
        </div>

    </div>
    <div class="suport">
        <div class="subtitol">
            Amb el suport
        </div>
        <div class="caixa">
            <div class="item">
                <img src="{$web_urlImg}Diputacio_barcelona.svg" alt="Diputació de Barcelona"/>
            </div>
            <div class="item">
                <img src="{$web_urlImg}UPC.svg" alt="Universitat Politècnica de Catalunya"/>
            </div>
            <div class="item">
                <img src="{$web_urlImg}Manresa_transforma.svg" alt="Manresa 2022"/>
            </div>
            <div class="item">
                <img src="{$web_urlImg}UManresa.svg" alt="UManresa"/>
            </div>
        </div>
    </div>
</footer>

<script type="text/javascript" src="{$web_urlJs}init.js"></script>

</body>
</html>