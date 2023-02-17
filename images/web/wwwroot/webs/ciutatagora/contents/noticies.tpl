{assign var="dades" value=$pagina.dades_gestor}
{assign var="noticies" value=$pagina.dades_gestor.noticies}


    <div class="col s12">
        <h1>{$pagina.titol}</h1>
        {*<h2>Notícies</h2>*}
        <div class="llistat">
            {if sizeof($noticies) > 0}
                {foreach name=noticies item=item from=$noticies}
                    <div class="item-llistat items-3">
                        {*<a href="http://lapuntador.cat{$item->path}" target="_blank">*}
                        <a href="menu/{$pagina.idseo}/{$item.idseo}">
                            <div class="card horizontal noticia" >
                                <div class="card-image">
                                    {if $item.path != ''}
                                        <img src="https://media.manresa.cat/thumbnail.php?src={$item.path}&w=200" class="responsive-img" alt="{$item.Titol}"/>
                                    {/if}
                                </div>
                                <div class="card-stacked">
                                    <div class="card-content">
                                        <div class="title truncate4lines">
                                            {$item.Titol}
                                        </div>
                                        <div class="data">{$item.DataNoticia|dataFormatada:noticies}</div>

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                {/foreach}
            {else}
                <div>No s'ha trobat cap notícia</div>
            {/if}
        </div>
        <div class="col s12">
            {if $dades.anterior }
                <a class="btn left" href="menu/{$pagina.idseo}/@{$dades.numPag - 1}">Notícies anteriors</a>
            {/if}
            {if $dades.seguent}
                <a class="btn right" href="menu/{$pagina.idseo}/@{$dades.numPag + 1}">Més notícies</a>
            {/if}

        </div>
    </div>