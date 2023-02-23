{assign var="web_title" value="Observatori per l'equitat i la igualtat d'oportunitats educacives | Manresa"}

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

    <link rel="stylesheet" href="{$web_urlCss}menu.css">
    <link rel="stylesheet" href="{$web_urlCss}title.css">
    <link rel="stylesheet" href="{$web_urlCss}about.css">
    <link rel="stylesheet" href="{$web_urlCss}map.css">
    <link rel="stylesheet" href="{$web_urlCss}indicadors.css">
    <link rel="stylesheet" href="{$web_urlCss}gmap.css">
    <link rel="stylesheet" href="{$web_urlCss}contacte.css">

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
                        <li><a class="menu-text" href="index.html#conceptualMapID">Mapa conceptual</a></li>
                        <li><a class="menu-text collapsibleIndicadors" href="index.html#indicadors">Indicadors<i
                                    class="material-icons">expand_more</i></a></li>
                        <li><a class="menu-text" href="index.html#mapa">Divulgació</a></li>
                        <li><a class="menu-text" href="index.html#contacte">Contacte</a></li>
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
        <li><a class="menu-text" href="index.html#sobreLobservatoriID">Sobre l’observatori</a></li>
        <hr>
        <li><a class="menu-text" href="index.html#conceptualMapID">Mapa conceptual</a></li>
        <hr>
        <li>
            <a class="menu-text" href="index.html#indicadors">Indicadors</a>
            <ul class="submenu">
                <li><a href="indicadorsSocio.html">Indicadors Socioeconòmics</a></li>
                <li><a href="indicadorsDemo.html">Indicadors Demogràfics</a></li>
                <li><a href="indicadorsEscolars.html">Indicadors Escolars</a></li>

            </ul>
        </li>
        <hr>
        <li><a class="menu-text" href="index.html#mapa">Divulgació</a></li>
        <hr>
        <li><a class="menu-text" href="index.html#contacte">Contacte</a></li>
        <hr>
    </ul>

    <div class="mainBody">
        <div class="collapsibleItems">
            <a class="menu-text" href="indicadorsSocio.html">Indicadors Socioeconòmics</a>
            <a class="menu-text" href="indicadorsDemo.html">Idicadors Demogràfics</a>
            <a class="menu-text" href="indicadorsEscolars.html">Indicadors Escolars</a>
        </div>

        <div class="mainTitle">
            <h1>OBSERVATORI PER L’EQUITAT I LA <br> IGUALTAT D’OPORTUNITATS <br> EDUCATIVES</h1>
        </div>
    {if $dump_string}
        {foreach name=dumps item=item from=$dump_string}
            <div>{$item}</div>
        {/foreach}
    {/if}
        <div class="aboutDiv">
            <div class="sobreLobservatoriDiv aboutSuvDiv">
                <h2>Sobre l’Observatori</h2>
                <p>L’Observatori pretén ser una eina per a millorar el nivell de coneixement sobre l’equitat i la
                    igualtat d’oportunitats educatives, així com també apropar i difondre a la població de Manresa i
                    agents d’interès les dades recollides.
                </p>
                <img src="{$web_urlImg}observatori.png" alt="Image not found" id="sobreLobservatoriID">
            </div>
            <div class="perqueImportantDiv aboutSuvDiv">
                <h2>Per què és important l’Observatori?</h2>
                <ul>
                    <li>Tenir informació constant i actualitzada del fenomen d’interès.</li>
                    <li>Diagnosticar i prioritzar les necessitats del col·lectiu d’interès.</li>
                    <li>Permet detectar canvis i monitoritzar tendències.</li>
                    <li>Posa en contacte diferents agents que interaccionen/intervenen en un fenomen i permet coordinar
                        la seva actuació.</li>
                    <li>Formular possibles escenaris futurs/anticipar situacions.</li>
                    <li>Donar a conèixer problemàtiques/situacions a la resta de la població.</li>
                </ul>
            </div>
            <div class="poblacioInteressadaDiv aboutSuvDiv">
                <h2>Població interessada</h2>
                <ul>
                    <li>Professorat</li>
                    <li>Centres educatius </li>
                    <li>Consells escolars</li>
                    <li>AFA</li>
                    <li>Ajuntaments</li>
                    <li>Famílies</li>
                </ul>
            </div>

        </div>
        <div class="conceptualMapDiv">
            <img src="{$web_urlImg}mapa.jpg" alt="" id="conceptualMapID">
        </div>
        <div class="indicadorsDiv " id="indocadors">
            <div class="socioeDiv indicsDiv">
                <h3>Indicadors socioeconòmics</h3>
                <ul>
                    <li>Taxa d’atur</li>
                    <li>Renta familiar disponible bruta</li>
                    <li>Índex socioeconòmic del territori</li>
                </ul>
                <a class="socioeAnchor" href="indicadorsSocio.html">Indicadors socioeconòmics</a>
            </div>
            <div class="demograDiv indicsDiv">
                <h3>Indicadors demogràfics</h3>
                <ul>
                    <li>Nacionalitat</li>
                    <li>Nivell d’estudis assolit</li>
                    <li>Nivell instrucció famílies</li>
                </ul>
                <a class="socioeAnchor" href="indicadorsDemo.html">Indicadors demogràfics</a>
            </div>
            <div class="escolarsDiv indicsDiv">
                <h3>Indicadors escolars</h3>
                <ul>
                    <li>Nº alumnes amb necessitats educatives</li>
                    <li>Ajuts material escolar</li>
                    <li>Rendiment acadèmic</li>
                    <li>Índex alumnat amb cognom estranger</li>
                    <li>Índex demanda escolarització a I3</li>
                    <li>Índex demanda escolarització a 1r d’ESO</li>
                    <li>Graduació 4t d’ESO</li>
                    <li>Distribució matrícula viva</li>
                </ul>
                <a class="socioeAnchor" href="indicadorsEscolars.html">Indicadors escolars</a>
            </div>

        </div>
        <div class="interaccioDiv" id="mapa">
            <div class="interaccioTitleDiv">
                <h2>Context educatiu de Manresa</h2>
                <p>Mapa interactiu del conjunt de centres educatius que es troben a Manresa.</p>
            </div>
            <div class="interaccioMapDiv">
                <div style="width: 100%"><iframe width="100%" height="700" frameborder="0" scrolling="no"
                        marginheight="0" marginwidth="0" src="{$gmap_url}">
                    </iframe>
                </div>
            </div>

        </div>
        <div class="contacteDiv" id="contacte">
            <h1>Contacte</h1>
            <div class="contacteFlex">
                <div class="dades">
                    <h3>Utilitza les següents vies de contacte o omple el formulari.</h3>
                    <p>Correu electrònic</p>
                    <h3><a href="mailto:observatorieducacio@umanresa.cat">observatorieducacio@umanresa.cat</a></h3>
                    <p>Xarxes socials</p>
                    <h3>@observatorieducaciomanresa</h3>
                </div>
                <div class="inputs">
                    <div class="mailName">
                        <input type="text" id="name" name="name" placeholder="Nom">
                        <input type="text" id="mail" name="mail" placeholder="Correu electrònic">
                        <br>
                    </div>
                    <div class="mailName messageDiv">
                        <textarea type="text" id="Missatge" name="mail" placeholder="Missatge"></textarea>
                    </div>
                    <div class="sendDiv">
                        <a class="socioeAnchor" href="">Enviar</a>
                        <input type="text" id="sum" name="sum" placeholder="">
                        <p class="random-sum">2+3 =</p>
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