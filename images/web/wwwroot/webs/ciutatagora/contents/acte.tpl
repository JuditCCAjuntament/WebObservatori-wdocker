<div class="titol">
    <h1>{$acte.title}</h1>
</div>


<div  id="descripcio" class="descripcio">
    {if $acte.image}
        <div class="contingut-img">
            <img src="/thumbnail.php?src={$acte.image}&w=600" class="responsive-img" alt="{$acte.title}" title="{$acte.title}"/>
        </div>
    {/if}
    <div class="contingut-text">
        <div>{$acte.text|slash}</div>
        <div>
            <a class="btn" href="{$urlAgenda}">Tots els actes</a>
        </div>
    </div>
    <div class="contingut-detall">
        <div class="container-detall">
            <div class="detall-item">
                <div><span class="material-icons">today</span> {$acte.start|dataFormatada}</div>
                <div><span class="material-icons">watch_later</span> {$acte.start|dataFormatada:nomesHora}</div>
                <div><span class="material-icons">location_on</span> {$acte.lloc}</div>
            </div>
        </div>
    </div>
</div>


{*<section class="main article_box">*}
{*    <div class="head">*}
{*        <a href="{$tornarAgenda}"><span class="arrow left"></span> Tornar</a>*}
{*    </div>*}
{*    <article class="{$acte.tema|categoriaCultura:class}">*}
{*        <div class="article_head">*}
{*            <div class="category">*}
{*                <span class="glyphicons {$acte.tema|categoriaCultura:icon}"></span>*}
{*                <div class="value">{$acte.tema|categoriaCultura:title}</div>*}
{*            </div>*}
{*            <h1 class="title">{$acte.title}</h1>*}
{*            <h2 class="subtitle">{$acte.description}</h2>*}
{*        </div>*}
{*        <div class="article_info">*}
{*            <div class="place">*}
{*                <span class="glyphicons glyphicons-pin"></span>*}
{*                <div class="value">{$acte.lloc}</div>*}
{*            </div>*}
{*            <div class="date">*}
{*                <span class="glyphicons glyphicons-calendar"></span>*}
{*                <div class="value">{$acte.start|datesAgenda:$acte.end}</div>*}
{*             </div>*}
{*        </div>*}
{*        <div class="article_gallery">*}
{*            <img src="{$acte.image}" alt="{$acte.title}" style="width: 100%;">*}
{*        </div>*}
{*        <div class="article_body">*}
{*            {$acte.text|slash}*}
{*        </div>*}
{*    </article>*}
{*    <div class="share">*}
{*        <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4eb2eb1f66022224"></script>*}
{*        <div class="addthis_inline_share_toolbox" data-url="{$urlAct}" data-title="{$noticia.Titol}" data-description="{$noticia.Resum|treureNegretaHtml|treureEnllacHtml|cleanTags|slash}" style="clear: both;"><div id="atstbx" class="at-resp-share-element at-style-responsive addthis-smartlayers addthis-animated at4-show" aria-labelledby="at-8bdb88b3-8cf2-494a-8ba1-b33892dc3f3b" role="region"><span id="at-8bdb88b3-8cf2-494a-8ba1-b33892dc3f3b" class="at4-visually-hidden">AddThis Sharing Buttons</span><div class="at-share-btn-elements"><a role="button" tabindex="1" class="at-icon-wrapper at-share-btn at-svc-facebook" style="background-color: rgb(59, 89, 152); border-radius: 4px;"><span class="at4-visually-hidden">Share to Facebook</span><span class="at-icon-wrapper" style="line-height: 16px; height: 16px; width: 16px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-facebook-1" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-facebook"><title id="at-svg-facebook-1">Facebook</title><g><path d="M22 5.16c-.406-.054-1.806-.16-3.43-.16-3.4 0-5.733 1.825-5.733 5.17v2.882H9v3.913h3.837V27h4.604V16.965h3.823l.587-3.913h-4.41v-2.5c0-1.123.347-1.903 2.198-1.903H22V5.16z" fill-rule="evenodd"></path></g></svg></span></a><a role="button" tabindex="1" class="at-icon-wrapper at-share-btn at-svc-twitter" style="background-color: rgb(29, 161, 242); border-radius: 4px;"><span class="at4-visually-hidden">Share to Twitter</span><span class="at-icon-wrapper" style="line-height: 16px; height: 16px; width: 16px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-twitter-2" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-twitter"><title id="at-svg-twitter-2">Twitter</title><g><path d="M27.996 10.116c-.81.36-1.68.602-2.592.71a4.526 4.526 0 0 0 1.984-2.496 9.037 9.037 0 0 1-2.866 1.095 4.513 4.513 0 0 0-7.69 4.116 12.81 12.81 0 0 1-9.3-4.715 4.49 4.49 0 0 0-.612 2.27 4.51 4.51 0 0 0 2.008 3.755 4.495 4.495 0 0 1-2.044-.564v.057a4.515 4.515 0 0 0 3.62 4.425 4.52 4.52 0 0 1-2.04.077 4.517 4.517 0 0 0 4.217 3.134 9.055 9.055 0 0 1-5.604 1.93A9.18 9.18 0 0 1 6 23.85a12.773 12.773 0 0 0 6.918 2.027c8.3 0 12.84-6.876 12.84-12.84 0-.195-.005-.39-.014-.583a9.172 9.172 0 0 0 2.252-2.336" fill-rule="evenodd"></path></g></svg></span></a><a role="button" tabindex="1" class="at-icon-wrapper at-share-btn at-svc-google_plusone_share" style="background-color: rgb(220, 78, 65); border-radius: 4px;"><span class="at4-visually-hidden">Share to Google+</span><span class="at-icon-wrapper" style="line-height: 16px; height: 16px; width: 16px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-google_plusone_share-3" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-google_plusone_share"><title id="at-svg-google_plusone_share-3">Google+</title><g><path d="M12 15v2.4h3.97c-.16 1.03-1.2 3.02-3.97 3.02-2.39 0-4.34-1.98-4.34-4.42s1.95-4.42 4.34-4.42c1.36 0 2.27.58 2.79 1.08l1.9-1.83C15.47 9.69 13.89 9 12 9c-3.87 0-7 3.13-7 7s3.13 7 7 7c4.04 0 6.72-2.84 6.72-6.84 0-.46-.05-.81-.11-1.16H12zm15 0h-2v-2h-2v2h-2v2h2v2h2v-2h2v-2z" fill-rule="evenodd"></path></g></svg></span></a><a role="button" tabindex="1" class="at-icon-wrapper at-share-btn at-svc-linkedin" style="background-color: rgb(0, 119, 181); border-radius: 4px;"><span class="at4-visually-hidden">Share to LinkedIn</span><span class="at-icon-wrapper" style="line-height: 16px; height: 16px; width: 16px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-linkedin-4" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-linkedin"><title id="at-svg-linkedin-4">LinkedIn</title><g><path d="M26 25.963h-4.185v-6.55c0-1.56-.027-3.57-2.175-3.57-2.18 0-2.51 1.7-2.51 3.46v6.66h-4.182V12.495h4.012v1.84h.058c.558-1.058 1.924-2.174 3.96-2.174 4.24 0 5.022 2.79 5.022 6.417v7.386zM8.23 10.655a2.426 2.426 0 0 1 0-4.855 2.427 2.427 0 0 1 0 4.855zm-2.098 1.84h4.19v13.468h-4.19V12.495z" fill-rule="evenodd"></path></g></svg></span></a><a role="button" tabindex="1" class="at-icon-wrapper at-share-btn at-svc-compact" style="background-color: rgb(255, 101, 80); border-radius: 4px;"><span class="at4-visually-hidden">Share to Más...</span><span class="at-icon-wrapper" style="line-height: 16px; height: 16px; width: 16px;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-addthis-5" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-addthis"><title id="at-svg-addthis-5">Addthis</title><g><path d="M18 14V8h-4v6H8v4h6v6h4v-6h6v-4h-6z" fill-rule="evenodd"></path></g></svg></span></a></div></div></div>*}
{*    </div>*}
{*</section>*}
{*<div class="aside">*}
{*    <div class="social-links">*}
{*        <a class="social-facebook" href="http://www.facebook.com/Manresa-Cultura-2035882723294313" target="_blank">Facebook</a>*}
{*        <a class="social-instagram" href="https://www.instagram.com/culturamanresa/" target="_blank">Instagram</a>*}
{*        <a class="social-twitter" href="https://twitter.com/manresacultura" target="_blank">Twitter</a>*}
{*    </div>*}
{*    <div class="ban_box">*}
{*        *}{*<a href="/cultura/article/7780-programacio-2018" class="links"  target="_blank">*}
{*            *}{*<div class="box">*}
{*                *}{*<span class="glyphicons glyphicons-notes"></span>*}
{*                *}{*<span class="title">Programació</span>*}
{*                *}{*<p>Consulta tota la programació de Manresa Capital Catalana de la Cultura.</p>*}
{*            *}{*</div>*}
{*        *}{*</a>*}
{*        <a href="/cultura/article/7778-substriu-te-al-butlleti" class="links">*}
{*            <div class="box">*}
{*                <span class="glyphicons glyphicons-message-plus"></span>*}
{*                <span class="title">Subscriu-te</span>*}
{*                <p>per conèixer les últimes actualitzacions.</p>*}
{*            </div>*}
{*        </a>*}

{*    </div>*}
{*</div>*}


