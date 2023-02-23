<ul >
    {foreach name=menus item=item from=$menus}
        {if $item.publicat == 1}
            {if $item.url}
                <li><a href="{$item.url}" target="_blank">{$item.titol}</a>
            {else}
                <li><a href="menu/{$item.idseo}">{$item.titol}</a>
            {/if}
            {if $item.te_fills == 1}
                {include file="`$urlHelper`menu_mapaweb.tpl" menus=$item.fills depth=$depth+1 urlHelper=$web_urlHelper}
            {/if}
            </li>
        {/if}
    {/foreach}
</ul>
