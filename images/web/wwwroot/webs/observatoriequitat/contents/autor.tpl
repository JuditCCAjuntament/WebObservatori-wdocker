{assign var="autor" value=$pagina.dades_gestor}
{assign var="videos" value=$pagina.dades_gestor.videos}
{assign var="totalPag" value=$pagina.dades_gestor.totalPag}
{assign var="pagAct" value=$pagina.dades_gestor.pagAct}

<div class="titol">
    <h1>{$autor.nom}</h1>
</div>
<section class="detall-autor">
    <div class="img">
        <img src="{$web_urlMedia}{$autor.imatge}" alt="{$autor.nom}"  title="{$autor.nom}"/>
    </div>
    <div class="dades">
        <div><strong>{$autor.resum}</strong></div>
        <div>{$autor.text}</div>
    </div>

</section>
<a name="videos"></a>
<section class="videos">

    {if sizeof($videos) > 0}
        <div class="subtitol">
            Vídeos relacionats
        </div>
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
                            <div class="autor">
                                {if $item.autors !=''}
                                    {assign var="autors" value=explode("#",$item.autors)}
                                    {foreach name=autors item=item_autor from=$autors}
                                        {assign var="autor_item" value=explode(":",$item_autor)}
                                        <a href="{$urlAutors}/{$autor_item[1]}">{$autor_item[0]}</a><br/>
                                    {/foreach}
                                {/if}
                            </div>
                            <div class="projecte">
                                <a class="btn {$item.projecte|normaliza}" href="{$urlProjectes}/{$item.id_projecte}">{$item.projecte}</a>
                            </div>
                        </div>
                        <div class="linia2">
                            <div class="resum">
                                <a href="{$urlVideos}/{$item.id}">
                                    <strong>{$item.resum}</strong>
                                </a>
                            </div>
                            <div class="durada">
                                {$item.durada}
                            </div>
                        </div>
                    </div>
                </div>
            {/foreach}
        </div>
        {if $totalPag > 1}
            <div class="paginacio">
                {for $paginacio=1 to $totalPag}
                    {if $pagAct == $paginacio}{/if}
                    <a href="menu/{$pagina.idseo}/{$autor.id}?pag={$paginacio - 1}#videos" {if $pagAct + 1 == $paginacio} class="select"{/if}>{$paginacio}</a>
                {/for}
                {foreach name=videos item=item from=$videos}

                {/foreach}
            </div>
        {/if}
    {else}
        <div class="subtitol">
            No té vídeos relacionats
        </div>
    {/if}
</section>







