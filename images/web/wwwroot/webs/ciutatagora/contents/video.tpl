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
                        <ul class="proposta-didactica">
                            {foreach name=documents item=item_document from=$documents}
                                <li><div><img src="{$web_urlImg}/doc.png"/><a href="{$item_document.url_document}" target="_blank">{$item_document.nom_document}</a></div></li>
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

<section class="ultimes_publicacions">
    <div class="subtitol">
        Relacionats
    </div>
    <div style="display: flex;">
        <div class="llistat horitzontal">
            {foreach name=relacionats item=item from=$video.relacionats}
                {assign var="position" value=$smarty.foreach.relacionats.iteration%4}
                {if $smarty.foreach.relacionats.iteration < 5 }
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
                        </div>
                    </div>
                {/if}
            {/foreach}
        </div>
        <div class="barra_color verd"></div>
    </div>

{*    <div class="boto">*}
{*        <a class="btn gran" href="{$urlVideos}">Descobreix-los tots</a>*}
{*    </div>*}
</section>






