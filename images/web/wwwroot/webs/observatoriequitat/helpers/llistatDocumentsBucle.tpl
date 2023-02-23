{*{if $depth <3}*}
{assign var="urlImatges" value="/webs/default/img/icones/"}
{assign var="urlPubDocs" value="https://media.manresa.cat"}
{assign var="carpetes" value=0}
{if $depth == 0}
    <div style="width: 100%" >
{/if}
{foreach name=arbre item=item from=$arbre}
    {if $item.tipus == 'C'}
        {if $carpetes == 0}
            {assign var="carpetes" value=1}
            <ul class="collapsible item-llistat documents" >
        {/if}

        <li>
            <div class="collapsible-header" onClick="collapsibleToggle(this)">
{*                <a class="" name="{$item.id_document}"  href="javascript:$('.submenu{$item.id_document}').toggle();void(0);" >*}
                    <div class="container-llistat-documents">
                        <div class="llistat-documents-img">
                            <img src="{$urlImatges}carpeta.png" alt="Icona carpeta"/>
                        </div>
                        <div class="llistat-documents-content">
                                {$item.titol}
                        </div>
                    </div>
{*                </a>*}
            </div>
            <div class="collapsible-body">

                {if $item.items}
                    {include file="webs/`$sufix`/helpers/llistatDocumentsBucle.tpl" arbre=$item.items depth=$depth+1 sufix=$sufix}
                {/if}
            </div>
        </li>
    {else}

    {/if}
{/foreach}
{if $carpetes == 1}
    </ul>
{/if}
{assign var="arxius" value=0}
{foreach name=arbre item=item from=$arbre}
    {if $item.tipus == 'A'}
        {if $arxius == 0}
            {assign var="arxius" value=1}
            <div class="llistat-arxius">
        {/if}

        {assign var="icones_def" value="ai,doc,docx,eps,jpg,ods,odt,pdf,png,tif,xls,xlsx"}
        {assign var="imatge" value=$item.url_document|extension|strtolower}
        {if !in_array($imatge, explode(",",$icones_def))}
            {assign var="imatge" value="default"}
        {/if}

        <a href="{$urlPubDocs}{$item.url_document}" target="_blank">
            <div class="container-llistat-documents">
                <div class="llistat-documents-img">
                    <img src="{$urlImatges}{$imatge}.png" alt="Icona extensió"/>
                </div>
                <div class="llistat-documents-content">
                    {$item.titol}
                </div>
            </div>
        </a>
{*        {if $item.url_document_csv}*}
{*            {assign var="imatge" value=$item.url_document_csv|extension|strtolower}*}
{*            <a class="col s12" href="/docs/arxius/{$item.url_document_csv}" target="_blank">*}
{*                <div class="llistat-item">*}
{*                    <div class="llistat-img">*}
{*                        <img src="/img/cultura/{$imatge}.png" alt="Icona extensió"/>*}
{*                    </div>*}
{*                    <div class="llistat-content">*}
{*                        {$item.denominacio}*}
{*                    </div>*}
{*                </div>*}
{*            </a>*}

{*        {/if}*}
{*        {if $item.url_document_xml}*}
{*            {assign var="imatge" value=$item.url_document_xml|extension|strtolower}*}
{*            <a class="col s12" href="/docs/arxius/{$item.url_document_xml}" target="_blank">*}
{*                <div class="llistat-item">*}
{*                    <div class="llistat-img">*}
{*                        <img src="/img/cultura/{$imatge}.png" alt="Icona extensió"/>*}
{*                    </div>*}
{*                    <div class="llistat-content">*}
{*                        {$item.denominacio}*}
{*                    </div>*}
{*                </div>*}
{*            </a>*}
{*        {/if}*}
    {/if}
{/foreach}
{if arxius == 1}
    </div>
{/if}
{if $depth == 0}
    </div>
{/if}

{*                <div class="col s12" style="padding-left:calc(20px*{$depth})">*}
