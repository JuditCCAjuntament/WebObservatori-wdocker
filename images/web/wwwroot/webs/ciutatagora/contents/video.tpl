{assign var="video" value=$pagina.dades_gestor}
{assign var="documents" value=$pagina.dades_gestor.documents}

<div class="titol">
    <h1>{$video.nom}</h1>
</div>

<section class="video-detall">
    <div class="llistat">
        <div  class="item">
            <div class="caixa-youtube">
                <iframe class="video-youtube" src="https://www.youtube.com/embed/{$video.url_video|codiYoutube}" title="{$video.nom}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="versions">
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
            <div class="projecte">
                <div><a class="btn" href="{$urlProjectes}/{$video.id_projecte}">{$video.projecte}</a></div>
                {if sizeof($documents) > 0}
                    <div class="subtitol">
                        Proposta didàctica
                    </div>
                    <div class="item" style="padding-top: 0px;">
                        <ul>
                            {foreach name=documents item=item_document from=$documents}
                                <li><a href="{$item_document.url_document}" target="_blank">{$item_document.nom_document}</a></li>
                            {/foreach}
                        </ul>
                    </div>
                {/if}
                <div>{$video.durada} h</div>
            </div>
            <div class="autor">
                <div>
                    {if $video.autors !=''}
                        {assign var="autors" value=explode("#",$video.autors)}
                        {foreach name=autors item=item_autor from=$autors}
                            {assign var="autor" value=explode(":",$item_autor)}
                            <a href="{$urlAutors}/{$autor[1]}">{$autor[0]}</a>
                            {if !$smarty.foreach.autors.last}
                                <span>, </span>
                            {/if}
                        {/foreach}
                    {/if}
                </div>
                <div style="margin-top:20px"><strong>{$video.resum}</strong></div>
            </div>
            <div class="text">
                <div>{$video.text}</div>
            </div>
        </div>
    </div>
    <div class="barra_color vermell"></div>
</section>






