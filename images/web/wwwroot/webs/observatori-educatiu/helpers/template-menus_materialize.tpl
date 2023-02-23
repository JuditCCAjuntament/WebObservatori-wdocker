<ul class="collapsible">

    {if $depth == 0}
        {if isset($home) && $home == 1}
            {assign var="menuInici" value="active select"}
        {else}
            {assign var="menuInici" value=""}
        {/if}
        <li class="{$menuInici}">
            <div class="collapsible-header">
                <a href="#" class="" title="Inici">Inici  </a>
            </div>
        </li>

    {/if}
    {foreach name=items_menu2 item=item from=$menu}
        {assign var="extern" value=""}
        {assign var="icono_extern" value=""}
        {assign var="desti" value="menu/`$item.idseo`"}
        {if $item.url != "" }
            {assign var="desti" value=$item.url}
            {if $item.enllac_extern == 1}
                {assign var="extern" value="target=\"_blank\" "}
            {/if}

        {/if}

        {if isset($item.select) && $item.select == 1}
            {assign var="menuTopSel" value="active select"}
        {else}
            {assign var="menuTopSel" value=""}
        {/if}
        {if $item.publicat == 1}
            <li class="{$menuTopSel}">
                <div class="collapsible-header">
                    <a href="{$desti}" class="" {$extern} title="{$item.titol}">{$item.titol}  </a>
                    {if $item.te_fills > 0 && $item.fills}
                        <div class="collapsible-secondary">
                            <span class="material-icons">expand_more</span>
                        </div>
                    {elseif $item.enllac_extern == 1}
                        <div class="collapsible-secondary">
                            <span class="material-icons extern">open_in_new</span>
                        </div>
                    {/if}

                </div>
                {if $item.te_fills > 0}
                    <div class="collapsible-body">
                        {if isset($item.select)}
                            {assign var="visible" value=$item.select}
                        {else}
                            {assign var="visible" value=0}
                        {/if}
                        {include file="`$urlHelper`template-menus_materialize.tpl" menu=$item.fills depth=$depth+1 menuAct=$item.id visible=$visible urlHelper=$urlHelper}
                    </div>
                {/if}
            </li>
        {/if}

    {/foreach}
</ul>
