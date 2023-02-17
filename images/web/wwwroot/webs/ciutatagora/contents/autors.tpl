{assign var="autors" value=$pagina.dades_gestor.autors}
{assign var="cerca" value=$pagina.dades_gestor.cerca}

{assign var="totalPag" value=$pagina.dades_gestor.totalPag}
{assign var="pagAct" value=$pagina.dades_gestor.pagAct}
{assign var="paramsAct" value=$pagina.dades_gestor.paramsAct}

<div class="titol">
    <h1>{$pagina.titol}</h1>
</div>
<section class="cercador">
    <form class="caixa" style="border: none;" action="menu/{$pagina.idseo}" method="get">
        <div class="item" style="width: calc(100% - 144px);">
            <input name="txCerca" type="text" value="{$cerca.text}" placeholder="Text a cercar"/>
        </div>
        <div class="item">
            <input type="submit" class="btn" name="cercar" value="Cercar"/>
        </div>
    </form>
</section>
<section class="autors">
    {if sizeof($autors) > 0}
        <div class="llistat horitzontal">
            {foreach name=autors item=item from=$autors}
                {assign var="position" value=$smarty.foreach.autors.iteration%4}
                <a class="item pos-{$position}" href="menu/{$pagina.idseo}/{$item.id}">
                    <div class="img">
                        <img src="{$web_urlMedia}{$item.imatge}" alt="{$item.nom}" title="{$item.nom}"/>
                    </div>
                    <div class="dades">
                        <div class="linia1">
                            <div class="subtitol">
                                {$item.nom}
                            </div>
                            <div>
                                <strong>{$item.resum}</strong>
                            </div>

                        </div>
                        <div class="linia2">
                            <div class="text">
                                {$item.text}
                            </div>
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







