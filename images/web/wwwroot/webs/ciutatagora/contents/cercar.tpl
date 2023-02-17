{assign var="content" value=$pagina}
<div class="titol">
    <h1>Cerca</h1>
</div>

{if isset($missatges) }
    <h2>Missatge</h2>
    <ul class="dadesTramit">
        {foreach name=errorGeneric item=item from=$missatges}
            <li>{$item}</li>
        {/foreach}
    </ul>

{/if}

{if $content}
<div>
<h2>Resultats:</h2>

    <div class="llistat">
        {foreach name=cerca item=item from=$content}
            {if $item.tipus == 2}
                {assign var="desti" value=$item.url}
                {assign var="extern" value="target='_blank'"}
            {else}
                {assign var="desti" value="menu/`$item.idseo`"}
                {assign var="extern" value=""}
            {/if}
            <div class="item-llistat">
                <a href="{$desti}" {$extern}>
                    <div class="card horizontal cerca" >
                        <div class="card-image">
                            <span class="material-icons">description</span>
                        </div>
                        <div class="card-stacked">
                            <div class="card-content">
                                <div class="title">{$item.titol}</div>
                                <div class="secondary">Inici > {$item.filAriana}</div>

    {*                            <div class="truncate4lines">*}
    {*                                {$item.descr}*}
    {*                            </div>*}

                            </div>
                        </div>
                    </div>
                </a>
            </div>
        {/foreach}
    </div>
 </div>
{else}
    <div>
        <p>No s'ha obtingut cap resultat</p>
    </div>
{/if}

