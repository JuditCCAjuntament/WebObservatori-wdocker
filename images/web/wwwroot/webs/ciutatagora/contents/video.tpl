{assign var="video" value=$pagina.dades_gestor}
{assign var="documents" value=$pagina.dades_gestor.documents}

<div class="titol">
    <h1>{$video.nom}</h1>
</div>

<section class="caixa video">
    <div class="item img">
        <div class="caixa-youtube">
            <iframe class="video-youtube" src="https://www.youtube.com/embed/{$video.url_video|codiYoutube}" title="{$video.nom}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <div class="item versions">
            <div>
                {if $video.url_versio_original != ""}
                    <a class="btn" href="{$video.url_versio_original}" target="_blank">Veure vídeo original</a>
                {/if}
            </div>
            <div>
                {if $video.url_versio_eng != ""}
                    <a class="btn" href="{$video.url_versio_eng}" target="_blank">Veure vídeo en anglès</a>
                {/if}
            </div>
            <div>
                {if $video.url_subtitols != ""}
                    <a class="btn" href="{$video.url_subtitols}" target="_blank">Veure vídeo subtitulat</a>
                {/if}

            </div>
            <div>
                {if $video.url_podcast != ""}
                    <a class="btn" href="{$video.url_podcast}" target="_blank">Escoltar podcast</a>
                {/if}

            </div>
        </div>
    </div>
    <div class="item dades">
        <div>
            {if $video.autors !=''}
                {assign var="autors" value=explode("#",$video.autors)}
                {foreach name=autors item=item_autor from=$autors}
                    {assign var="autor" value=explode(":",$item_autor)}
                    <a href="{$urlAutors}/{$autor[1]}">{$autor[0]}</a><br/>
                {/foreach}
            {/if}
        </div>
        <div><a class="btn" href="{$urlProjectes}/{$video.id_projecte}">{$video.projecte}</a></div>
        <div><strong>{$video.resum}</strong></div>
    </div>
</section>
<section class="caixa detall-video">

    <div class="item">
        <div>{$video.text}</div>
    </div>
</section>

{if sizeof($documents) > 0}
    <section class="caixa documents">
        <div class="subtitol" style="margin-top:0px">Proposta didàctica</div>
        <div class="item" style="padding-top: 0px;">
            <ul>
                {foreach name=documents item=item_document from=$documents}
                    <li><a href="{$item_document.url_document}" target="_blank">{$item_document.nom_document}</a></li>
                {/foreach}
            </ul>
        </div>
    </section>

{/if}




