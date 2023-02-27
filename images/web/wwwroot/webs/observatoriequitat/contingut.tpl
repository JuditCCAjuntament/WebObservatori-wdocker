{assign var="web_description" value=""}
{assign var="web_title" value="Manresa Ciutat Àgora"}

{assign var="web_canonical" value=$portal.canonical}

{assign var="web_urlImgDefault" value="assets-default/img/"}
{assign var="web_urlMedia" value=$urlMedia}
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


{if isset($pagina.titol)}
    {assign var="web_meta_title" value="`$pagina.titol` - `$web_title`"}
{else}
    {assign var="web_meta_title" value="$web_title"}
{/if}


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" lang="ca">

<head>
    <meta charset="UTF-8">

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="expires" content="-1" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="{$web_description}" />

    <base href="{$portal.urlBase}/" />
    <title>{$web_meta_title}</title>

    <link rel="icon" type="image/png" href="{$web_urlImg}favicon.png" />
    <link rel="shortcut icon" href="{$web_urlImg}favicon.ico" />

    <link rel="canonical" href="{$web_canonical}" />



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
    <link rel="stylesheet" href="{$web_urlCss}contacte.css">
    <link rel="stylesheet" href="{$web_urlCss}iframes.css">
    <link rel="stylesheet" href="{$web_urlCss}estils.css">
    <link rel="stylesheet" href="{$web_urlCss}gmap.css">
</head>

<body>
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
                        <li><a class="menu-text" href="{$portal.menu[0].url}">{$portal.menu[0].titol}</a></li>
                        <li><a class="menu-text" href="{$portal.menu[1].url}">{$portal.menu[1].titol}</a></li>
                        <li><a class="menu-text collapsibleIndicadors"
                                href="{$portal.menu[2].url}">{$portal.menu[2].titol}<i
                                    class="material-icons">expand_more</i></a></li>
                        <li><a class="menu-text" href="{$portal.menu[3].url}">{$portal.menu[3].titol}</a></li>
                        <li><a class="menu-text" href="{$portal.menu[4].url}">{$portal.menu[4].titol}</a></li>
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
                <li><a class="menu-text" href="{$menus}/15391/">{$portal.menu[2].fills[0].titol}</a>
                </li>
                <li><a class="menu-text" href="{$menus}/15395/">{$portal.menu[2].fills[1].titol}</a>
                </li>
                <li><a class="menu-text" href="{$menus}/15396/">{$portal.menu[2].fills[2].titol}</a>
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
    {if $dump_string}

        {foreach name=dumps item=item from=$dump_string}
            <div>{$item}</div>

        {/foreach}
    {/if}
        {if isset($portal.template_contingut) }
            {include file=$portal.template_contingut}
        {/if}
    </div>
    <footer>
        <div class="footerText">
            Observatori per l'equitat i la igualtat d'oportunitats educatives - Tots els drets reservats
        </div>
    </footer>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/content.js"></script>
    <!-- Materialize Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

</body>

</html>