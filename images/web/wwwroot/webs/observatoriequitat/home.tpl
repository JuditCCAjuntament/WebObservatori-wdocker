{assign var="web_title" value="Observatori per l'equitat i la igualtat d'oportunitats educacives | Manresa"}

{assign var="web_urlImgDefault" value="assets-default/img/"}
{assign var="web_urlMedia" value=$urlMedia}

{assign var="web_description" value=$portal.meta_description}
{assign var="web_canonical" value=$portal.canonical}

{assign var="web_urlCss" value="assets/css/"}
{assign var="web_urlJs" value="assets/js/"}
{assign var="web_urlImg" value="assets/img/"}
{assign var="web_urlHelper" value="`$portal.dir_template`/helpers/"}
{assign var="google_Icons" value="https://fonts.googleapis.com/icon?family=Material+Icons"}
{assign var="open_sans" value="https://fonts.googleapis.com/css2?family=Open+Sans:wght@200..900"}
{assign var="materialize_framework_css" value="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css"}
{assign var="jquery_cdn" value="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"}
{assign var="nuclia_search" value="https://cdn.nuclia.cloud/nuclia-widget.umd.js"}
{assign var="gmap_url" 
    value="https://maps.google.com/maps?width=100%25&amp;height=800&amp;hl=es&amp;q=Manresa,%20Barcelona+()&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"}
{assign var="menus" value="/observatoriequitat/menu/"}
{assign var="vars" value=$portal.vars}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$web_title}</title>
    <link rel="icon" type="image/x-icon" href="{$web_urlImg}observatori.png">
    <!-- Google icons -->
    <link href="{$google_Icons}" rel="stylesheet">
    <!-- materialize -->
    <link rel="stylesheet" href="{$materialize_framework_css}">
    <!-- JQuery -->
    <script src="{$jquery_cdn}"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link href="{$open_sans}" rel="stylesheet">
    <!-- Nuclia search cdn -->
    <script src="{$nuclia_search}"></script>

    <link rel="canonical" href="{$web_canonical}" />
    <link rel="stylesheet" href="{$web_urlCss}menu.css">
    <link rel="stylesheet" href="{$web_urlCss}title.css">
    <link rel="stylesheet" href="{$web_urlCss}about.css">
    <link rel="stylesheet" href="{$web_urlCss}map.css">
    <link rel="stylesheet" href="{$web_urlCss}indicadors.css">
    <link rel="stylesheet" href="{$web_urlCss}gmap.css">
    <link rel="stylesheet" href="{$web_urlCss}contacte.css">


</head>

<body>
    {* <script type="text/javascript">
        console.log(window.location.href);
window.location = "{$menus}15398/";

    </script> *}
    <!-- Nav -->
    <nav class="white">
        <div class="nav-wrapper">
            <div class="mobileHolder">
                <div class="imgContainer">
                    <img class=" brand-logobrowser-default logo-img" src="{$web_urlImg}logo-observatori-educacio.jpg"
                        alt="Img not Found">
                </div>
                <div class="linksContainer">
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
                    <ul class="hide-on-med-and-down">
                        {foreach from=$portal.menu item=menu}
                            {if $menu.te_fills == 1}
                                <li><a class="menu-text collapsibleIndicadors" href="{$menu.url}" id="{$menu.titol}">{$menu.titol}<i
                                            class="material-icons">expand_more</i></a></li>
                            {else}
                                <li><a class="menu-text" href="{$menu.url}" id="{$menu.titol}">{$menu.titol}</a></li>
                            {/if}
                        {/foreach}
                        <li><a class="searchTrigger"><i class="material-icons">search</i></li>

                    </ul>
                </div>
                <div class="searchContainer">
                    <nuclia-search class="notMobile" knowledgebox="efe163df-f88a-4c28-8602-89d555213cd5" zone="europe-1"
                        type="popup" features="navigateToLink"></nuclia-search>
                    <a class="goBack"><i class="material-icons">arrow_back_ios_new</i></a>
                </div>
            </div>
            <div class="moibleSearch">

            </div>
        </div>

    </nav>

    <ul class="sidenav mobileNavContainer" id="mobile-demo">
        <li><a class="menu-text" href="{$portal.menu[0].url}">{$portal.menu[0].titol}</a></li>
        <hr>
        <li><a class="menu-text" href="{$portal.menu[1].url}">{$portal.menu[1].titol}</a></li>
        <hr>
        <li>
            <a class="menu-text" href="index.html#indicadors">Indicadors</a>
            <ul class="submenu">
                <li><a class="menu-text" href="{$menus}15391/">{$portal.menu[2].fills[0].titol}</a>
                </li>
                <li><a class="menu-text" href="{$menus}15395/">{$portal.menu[2].fills[1].titol}</a>
                </li>
                <li><a class="menu-text" href="{$menus}15396/">{$portal.menu[2].fills[2].titol}</a>
                </li>

            </ul>
        </li>
        <hr>
        <li><a class="menu-text" href="{$portal.menu[3].url}">{$portal.menu[3].titol}</a></li>
        <hr>
        <li><a class="menu-text" href="{$portal.menu[4].url}">{$portal.menu[4].titol}</a></li>
        <hr>
    </ul>

    <div class="mainBody">
        <div class="collapsibleItems">
            {foreach from=$portal.menu item=menu}
                {if $menu.te_fills == 1 }
                    {foreach from=$menu.fills item=submenu} 
                        {if $submenu.url == ""}
                            {assign var="link" value="{$menus}{$submenu.id}"}
                        {else}
                            {assign var="link" value=$submenu.url}
                        {/if}
                            <a class="menu-text" id="{$menu.titol}" href="{$link}">{$submenu.titol}</a>
                    {/foreach}
                {/if}
            {/foreach}
        </div>


        <div class="mainTitle">
            <h1>OBSERVATORI PER L’EQUITAT I LA <br> IGUALTAT D’OPORTUNITATS <br> EDUCATIVES</h1>

        </div>
        {if $dump_string}

            {foreach name=dumps item=item from=$dump_string}
                <div>{$item}</div>

            {/foreach}

        {/if}
        <div class="aboutDiv" id="sobreLobservatoriID">
            <div class="sobreLobservatoriDiv aboutSuvDiv">
                {$vars.sobre_observatori.contingut}
            </div>
            <div class="perqueImportantDiv aboutSuvDiv">
                {$vars.pk_important.contingut}
            </div>
            <div class="poblacioInteressadaDiv aboutSuvDiv">
                {$vars.poblacio_interessada.contingut}
            </div>

        </div>
        <div class="conceptualMapDiv" id="conceptualMapID">
            {$vars.mapa_conceptual.contingut}
        </div>
        <div class="indicadorsDiv " id="indicadors">
            {$vars.indicadors_socio.contingut}
            {$vars.indicadors_demo.contingut}
            {$vars.indicadors_escolars.contingut}
        </div>
        <div class="interaccioDiv" id="mapa">
            <div class="interaccioTitleDiv">
                <h2>Context educatiu de Manresa</h2>
                <p>Mapa interactiu del conjunt de centres educatius que es troben a Manresa.</p>
            </div>
            <div class="interaccioMapDiv">
                <div style="width: 100%">
                    <iframe width="100%" height="700" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                        src="{$gmap_url}">
                    </iframe>
                </div>
            </div>

        </div>
        <div class="contacteDiv" id="contacte">
            <h1>Contacte</h1>
            <div class="contacteFlex">
                <div class="dades">
                    <p>Utilitza les següents vies de contacte o omple el formulari.</p>
                    <h3>Correu electrònic</h3>
                    <p><a href="mailto:observatorieducacio@umanresa.cat">observatorieducacio@umanresa.cat</a></p>
                    <h3>Xarxes socials</h3>
                    <p>@observatorieducaciomanresa</p>
                </div>
                <div class="inputs">

                    <div class="mailName">
                        <input type="text" id="name" name="name" placeholder="Nom">
                        <input type="text" id="mail" name="mail" placeholder="Correu electrònic">
                        <br>
                    </div>
                    <div class="mailName messageDiv">
                        <textarea type="text" id="Missatge" name="message" placeholder="Missatge"></textarea>
                    </div>
                    <div class="sendDiv">
                        <a class="socioeAnchor">Enviar</a>
                        <input type="text" id="sum" name="sum" placeholder="">
                        <p class="random-sum">2+3 =</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    </div>
    <footer>
        <div class="footerText">
            Observatori per l'equitat i la igualtat d'oportunitats educatives - Tots els drets reservats
        </div>
    </footer>
    <script src="assets/js/main.js"></script>
    <!-- Materialize Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>

</html>