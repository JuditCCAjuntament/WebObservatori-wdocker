{assign var="temes" value=$pagina.dades_gestor.temes}
{assign var="autors" value=$pagina.dades_gestor.autors}
{assign var="projectes" value=$pagina.dades_gestor.projectes}
{assign var="cerca" value=$pagina.dades_gestor.cerca}
{assign var="videos" value=$pagina.dades_gestor.videos}

{assign var="totalPag" value=$pagina.dades_gestor.totalPag}
{assign var="pagAct" value=$pagina.dades_gestor.pagAct}
{assign var="paramsAct" value=$pagina.dades_gestor.paramsAct}

<div class="titol">
    <h1>{$pagina.titol}</h1>
</div>

<section class="cercador">
    <form class="caixa" style="border: none;" action="menu/{$pagina.idseo}" method="get">
        <div class="item">
            <input name="txCerca" type="text" value="{$cerca.text}" placeholder="Text a cercar"/>
        </div>
        <div class="item">
            {if isset($temes) && sizeof($temes) > 0}
                <select name="tema">
                    <option value="">-- Temes -- </option>
                    {foreach name=temes item=item from=$temes}
                        <option value="{$item.id}" {if $cerca.tema == $item.id} selected="true"{/if}>{$item.tema}</option>
                    {/foreach}
                </select>
            {/if}
        </div>
        <div class="item">
            {if isset($autors) && sizeof($autors) > 0}
                <select name="autor">
                    <option value="">-- Autors -- </option>
                    {foreach name=temes item=item from=$autors}
                        <option value="{$item.id}" {if $cerca.autor == $item.id} selected="true"{/if}>{$item.nom}</option>
                    {/foreach}
                </select>
            {/if}
        </div>
        <div class="item">
            {if isset($projectes) && sizeof($projectes) > 0}
                <select name="projecte">
                    <option value="">-- Projecte -- </option>
                    {foreach name=temes item=item from=$projectes}
                        <option value="{$item.id}" {if $cerca.projecte == $item.id} selected="true"{/if}>{$item.nom}</option>
                    {/foreach}
                </select>
            {/if}
        </div>
        <div class="item">
            <input type="submit" class="btn" name="cercar" value="Cercar"/>
        </div>
    </form>
</section>
<section class="temes">
{if sizeof($videos) > 0}
    <div style="display: flex;">
        <div class="llistat horitzontal">
            {foreach name=videos item=item from=$videos}
                {assign var="position" value=$smarty.foreach.videos.iteration%4}
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
            {/foreach}
        </div>
        <div class="barra_color verd"></div>
    </div>
{*        {foreach name=entrevistes item=item from=$videos}*}
{*            <div class="item" >*}
{*                <div class="img">*}
{*                    <a href="{$urlVideos}/{$item.id}">*}
{*                        <img src="{$web_urlMedia}{$item.imatge_h}" alt="{$item.nom}" title="{$item.nom}"/>*}
{*                    </a>*}
{*                </div>*}
{*                <div class="dades">*}
{*                    <div class="linia1 subtitol">*}
{*                        <a href="{$urlVideos}/{$item.id}">*}
{*                            {$item.nom}*}
{*                        </a>*}
{*                    </div>*}
{*                    <div class="linia1">*}
{*                        <div class="autor">*}
{*                            {if $item.autors !=''}*}
{*                                {assign var="autors" value=explode("#",$item.autors)}*}
{*                                {foreach name=autors item=item_autor from=$autors}*}
{*                                    {assign var="autor" value=explode(":",$item_autor)}*}
{*                                    <a href="{$urlAutors}/{$autor[1]}">{$autor[0]}</a><br/>*}
{*                                {/foreach}*}
{*                            {/if}*}
{*                        </div>*}
{*                        <div class="projecte">*}
{*                            <a class="btn {$item.projecte|normaliza}" href="{$urlProjectes}/{$item.id_projecte}">{$item.projecte}</a>*}
{*                        </div>*}
{*                    </div>*}
{*                    <div class="linia2">*}
{*                        <div class="resum">*}
{*                            <a href="{$urlVideos}/{$item.id}">*}
{*                                {$item.resum}*}
{*                            </a>*}
{*                        </div>*}
{*                        <div class="durada">*}
{*                            {$item.durada}*}
{*                        </div>*}
{*                    </div>*}
{*                </div>*}
{*            </div>*}
{*        {/foreach}*}
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







