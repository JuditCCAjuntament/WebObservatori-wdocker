{assign var="videos" value=$pagina.dades_gestor.videos}
{assign var="totalPag" value=$pagina.dades_gestor.totalPag}
{assign var="pagAct" value=$pagina.dades_gestor.pagAct}
{assign var="paramsAct" value=$pagina.dades_gestor.paramsAct}

<div class="titol">
    <h1>{$pagina.titol}</h1>
</div>

<section>
    <div class="caixa">
        <div class="item">
            Aquest és un espai adreçat a mestres, professors i educadors on podreu trobar diferents propostes didàctiques per treballar amb l’alumnat. Les diferents propostes han estat dissenyades pel Centre d’Innovació i Formació en Educació (CIFE) de la UManresa.
        </div>
    </div>
</section>
<section class="temes">
{if sizeof($videos) > 0}
    <div class="llistat vertical">
        {foreach name=videos item=item from=$videos}
            <div class="item" >
                <div class="img">
                    <a href="{$urlVideos}/{$item.id}">
                        <img src="{$web_urlMedia}{$item.imatge_h}" alt="{$item.nom}" title="{$item.nom}"/>
                    </a>
                </div>
                <div class="dades">
                    <div class="linia1 subtitol">
                        <a href="{$urlVideos}/{$item.id}">
                            {$item.nom}
                        </a>
                    </div>
                    <div class="linia1">
                        <ul class="llistat_documents">
                        {foreach name=documents item=item_doc from=$item.documents}
                            <li>
                                <a href="{$item_doc.url_document}" target="_blank">{$item_doc.nom_document}</a>
                            </li>
                        {/foreach}
                        </ul>
                    </div>
                </div>
            </div>
        {/foreach}
    </div>
    {if $totalPag > 1}
        <div class="paginacio">
            {for $paginacio=1 to $totalPag}
                {if $pagAct == $paginacio}{/if}
                <a href="menu/{$pagina.idseo}?pag={$paginacio - 1}{$paramsAct}" {if $pagAct + 1 == $paginacio} class="select"{/if}>{$paginacio}</a>
            {/for}
            {foreach name=videos item=item from=$videos}

            {/foreach}
        </div>
    {/if}

{/if}
</section>







