{assign var="web_description" value=""}
{assign var="web_title" value="Manresa Ciutat Àgora"}

{assign var="web_canonical" value=$portal.canonical}

{assign var="web_urlImgDefault" value="assets-default/img/"}
{assign var="web_urlMedia" value=$urlMedia}

{assign var="urlVideos" value="menu/15049-videos"}
{assign var="urlProjectes" value="menu/15050-projectes"}
{assign var="urlAutors" value="menu/15051-autors"}

{assign var="web_urlCss" value="assets/css/"}
{assign var="web_urlJs" value="assets/js/"}
{assign var="web_urlImg" value="assets/img/"}
{assign var="web_urlHelper" value="`$portal.dir_template`/helpers/"}

{if isset($pagina.meta_description) && $pagina.meta_description != ''}
    {assign var="web_meta_description" value=$pagina.meta_description}
{elseif isset($pagina.titol)}
    {assign var="web_meta_description" value=$pagina.titol}
{else}
    {assign var="web_meta_description" value=""}
{/if}

{if isset($pagina.titol)}
    {assign var="web_meta_title" value="`$pagina.titol` - `$web_title`"}
{else}
    {assign var="web_meta_title" value="$web_title"}
{/if}


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
    <title>{$web_meta_title}</title>

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
            <a href="#" >
                Inici
            </a>
            {assign var="submenuSel" value=""}
            {foreach name=llistatmenu item=item from=$portal.menu}
                {assign var="extern" value=""}
                {assign var="desti" value="menu/`$item.idseo`"}
                {assign var="menuTopSel" value=""}

                {if isset($item.select) && $item.select == 1}
                    {assign var="menuTopSel" value="select"}
                    {if isset($item.fills)}
                        {assign var="submenuSel" value=$item.fills}
                    {/if}
                {/if}

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
    {if isset($mostrar_avis_cookies) && $mostrar_avis_cookies}
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
        {include file="`$web_urlHelper`template-menus_materialize.tpl" depth=0 urlHelper=$web_urlHelper menu=$portal.menu}
    </li>
</ul>
<main>
    {if $dump_string}
        {foreach name=dumps item=item from=$dump_string}
            <div>{$item}</div>
        {/foreach}
    {/if}
    {if $submenuSel|teFillsVisibles}
        <section class="menu-lateral hide-on-med-and-down">
            {include file="`$web_urlHelper`template-menus_materialize.tpl" depth=0 menu=$submenuSel urlHelper=$web_urlHelper}
        </section>
    {/if}
{*    {if isset($pagina.filAriadna) && $pagina.filAriadna}*}
{*    <section class="filAriadna">*}
{*        <a href="#" class="breadcrumb">Inici</a>*}
{*        {foreach name=filAriana item=item from=$pagina.filAriadna }*}
{*            <a href="menu/{$item.idseo}" class="breadcrumb">{$item.titol}</a>*}
{*        {/foreach}*}
{*    </section>*}
{*    {/if}*}
    <section class="contingut">
        {if isset($portal.template_contingut) }
            {include file=$portal.template_contingut web_urlMedia=$web_urlMedia}
        {/if}
    </section>
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
