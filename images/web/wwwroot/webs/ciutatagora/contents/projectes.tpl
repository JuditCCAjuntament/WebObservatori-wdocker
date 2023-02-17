{assign var="projectes" value=$pagina.dades_gestor.projectes}

{assign var="totalPag" value=$pagina.dades_gestor.totalPag}
{assign var="pagAct" value=$pagina.dades_gestor.pagAct}
{assign var="paramsAct" value=$pagina.dades_gestor.paramsAct}

<div class="titol">
    <h1>{$pagina.titol}</h1>
</div>

<section class="projectes">
{if sizeof($projectes) > 0}
    <div class="llistat vertical">
        {foreach name=entrevistes item=item from=$projectes}
            <a class="item" href="menu/{$pagina.idseo}/{$item.id}">
                <div class="img">
                    <img src="{$web_urlMedia}{$item.imatge}" alt="{$item.nom}" title="{$item.nom}"/>
                </div>
                <div class="dades">
                    <div class="linia1 subtitol">
                        {$item.nom}
                    </div>
                    <div class="linia2">
                        <strong>{$item.resum}</strong>
                    </div>
                </div>
            </a>
        {/foreach}
    </div>
    {if $totalPag > 1}
        <div class="paginacio">
            {for $paginacio=1 to $totalPag}
                {if $pagAct == $paginacio}{/if}
                <a href="menu/{$pagina.idseo}?pag={$paginacio - 1}{$paramsAct}" {if $pagAct + 1 == $paginacio} class="select"{/if}>{$paginacio}</a>
            {/for}
        </div>
    {/if}
{/if}
</section>







