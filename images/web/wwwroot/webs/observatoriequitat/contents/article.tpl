{assign var="content" value=$pagina.contingut}
{assign var="docs" value=$pagina.contingut.documents}
{assign var="vars" value=$pagina.contingut.vars}

    {$content.contingut}

    {if (isset($vars.total) && $vars.total > 0) || sizeof($docs) > 0}
    <div class="contingut-detall">
        {if (isset($vars.adreca) && $vars.adreca != '') ||
            (isset($vars.telefon) && $vars.telefon != '') ||
            (isset($vars.email) && $vars.email != '') ||
            (isset($vars.horari) && $vars.horari != '') ||
            (isset($vars.web) && $vars.web != '')}
            <div class="container-detall">
                <div class="detall-titol">Contacte</div>
                <div class="detall-item">
                    {if isset($vars.adreca) && $vars.adreca != ''}
                        <div><span class="material-icons">place</span><b>Adreça:</b>
                            <div style="padding-left: 34px">
                                {$vars.adreca}
                            </div>
                        </div>
                    {/if}
                    {if isset($vars.telefon) && $vars.telefon != ''}
                        <div><span class="material-icons">call</span><b>Telèfon:</b>
                            <div style="padding-left: 34px">
                                {$vars.telefon}
                            </div>
                        </div>
                    {/if}
                    {if isset($vars.email) && $vars.email != ''}
                        <div><span class="material-icons">email</span><b>Correu electrònic:</b>
                            <div style="padding-left: 34px">
                                <a href="mailto:{$vars.email}">{$vars.email}</a>
                            </div>
                        </div>
                    {/if}
                    {if isset($vars.horari) && $vars.horari != ''}
                        <div><span class="material-icons">event</span><b>Horari: </b>
                            <div style="padding-left: 34px">
                                {$vars.horari|nl2br}
                            </div>
                        </div>
                    {/if}
                    {if isset($vars.web) && $vars.web != ''}
                        <div><span class="material-icons">language</span><b>Web: </b>
                            <div style="padding-left: 34px"><a href="{$vars.web|validarUrl}" target="_blank">{$vars.web}</a></div>
                        </div>
                    {/if}
                </div>
            </div>
        {/if}

        {if (isset($vars.destinataris) && $vars.destinataris != '') || (isset($vars.cond_acces) && $vars.cond_acces != '') || (isset($vars.aforament) && $vars.aforament != '') }
            <div class="container-detall">

                <div class="detall-titol">Dades del centre</div>
                <div class="detall-item">
                    {if isset($vars.destinataris) && $vars.destinataris != ''}
                        <div><b>Destinataris:</b>
                            <div style="padding-left: 34px">
                                {$vars.destinataris}
                            </div>
                        </div>
                    {/if}
                    {if isset($vars.cond_acces) && $vars.cond_acces != ''}
                        <div><b>Condicions d'accés:</b>
                            <div style="padding-left: 34px">
                                {$vars.cond_acces}
                            </div>
                        </div>
                    {/if}
                    {if isset($vars.aforament) && $vars.aforament != ''}
                        <div><b>Aforament:</b>
                            <div style="padding-left: 34px">
                                {$vars.aforament}
                            </div>
                        </div>
                    {/if}
                </div>
            </div>
        {/if}
        {if (isset($vars.distancia) && $vars.distancia != '') || (isset($vars.desnivell) && $vars.desnivell != '') || (isset($vars.durada) && $vars.durada != '') || (isset($vars.quan_es_pot_fer) && $vars.quan_es_pot_fer != '') }
            <div class="container-detall">
                <div class="detall-titol">Dades tècniques</div>
                <div class="detall-item">
                    {if isset($vars.distancia) && $vars.distancia != ''}

                        <div><span class="material-icons">place</span><b>Distància:</b>
                            <div style="padding-left: 34px">{$vars.distancia}</div>
                        </div>
                    {/if}
                    {if isset($vars.desnivell) && $vars.desnivell != ''}
                        <div><span class="material-icons">terrain</span><b>Desnivell:</b>
                            <div style="padding-left: 34px">{$vars.desnivell}</div>
                        </div>
                    {/if}
                    {if isset($vars.durada) && $vars.durada != ''}
                        <div><span class="material-icons">watch_later</span><b>Durada aproximada:</b>
                            <div style="padding-left: 34px">{$vars.durada}</div>
                        </div>
                    {/if}
                    {if isset($vars.quan_es_pot_fer) && $vars.quan_es_pot_fer != ''}
                        <div><span class="material-icons">event</span><b>{$vars.quan_es_pot_fer}</b></div>
                    {/if}
                </div>
            </div>
        {/if}
        {if isset($vars.preu) && $vars.preu != ''  }
            <div class="container-detall">
                <div class="detall-titol">Preu</div>
                <div class="detall-item">
                    {if isset($vars.preu) && $vars.preu != ''}
                        <div><span class="material-icons">euro</span><b>Preu:</b>
                            <div style="padding-left: 34px">{$vars.preu|nl2br}</div>
                        </div>
                    {/if}
                </div>
            </div>
        {/if}

        {if isset($docs.enllacos_img) && sizeof($docs.enllacos_img) > 0}
            {foreach name=enllacosArticle item=item from=$docs.enllacos_img}
                {if $item.path != ''}
                    <a href="{$item.url}" target="_blank">
                        <img src="{$web_urlMedia}/docsArticle/{$content.id}/{$item.path}" class="responsive-img" alt ="{$item.descripcio}" style="min-width: 100%;"/>
                    </a>
                {else}
                    {assign var=teenllacos value=1}
                {/if}
            {/foreach}
        {/if}
        {if isset($docs.documents) && sizeof($docs.documents) > 0}

            <div class="container-detall">
                <div class="detall-titol">Documents</div>
                <div class="collection detall-item">
                    {foreach name=documentsArticle item=item from=$docs.documents}
                        <a href="{$web_urlMedia}/docsArticle/{$content.id}/{$item.path}" class="collection-item grey-text text-darken-3 " target="_blank">
                            <span class="material-icons circle">description</span>
                            <div class="title">{$item.descripcio}</div>
                        </a>
                    {/foreach}
                </div>
            </div>

        {/if}
        {if isset($docs.enllacos) && sizeof($docs.enllacos) > 0}
            <div class="container-detall">
                <div class="detall-titol">Enllaços</div>
                <div class="collection detall-item">
                    {foreach name=enllacosArticle item=item from=$docs.enllacos}
                        <a href="{$item.url}" class="collection-item grey-text text-darken-3 " target="_blank">
                            <span class="material-icons circle">insert_link</span>
                            <div class="title">{$item.descripcio}</div>
                        </a>
                    {/foreach}
                </div>
            </div>
        {/if}
    </div>
{/if}
</div>






