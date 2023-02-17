{assign var="urlAgenda" value="menu/14480-agenda/"}

<div class="col s12 ">
    <h1>{$titol}</h1>
    {*<h2>Notícies</h2>*}
    <div class="llistat">
    {foreach name=agenda item=item from=$agenda}
        <div class="item-llistat items-3">
            {*<a href="http://lapuntador.cat{$item->path}" target="_blank">*}
            <a href="{$urlAgenda}/{$item.id}">
                <div class="card horizontal agenda" >
                    <div class="card-image">
                        {if $item.image != ''}
                            <img src="/thumbnail.php?src={$item.image}&w=200" class="responsive-img" alt="{$item.title}"/>
                        {/if}
                    </div>
                    <div class="card-stacked">
                        <div class="card-content">
                            <div class="title truncate2lines">
                                {$item.title}
                            </div>
                            <div class="data">
                                <div><span class="material-icons">today</span> {$item.start|dataFormatada}</div>
                                <div><span class="material-icons">watch_later</span> {$item.start|dataFormatada:nomesHora}</div>
                                <div class="truncate1lines"><span class="material-icons">location_on</span> {$item.lloc}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </a>
        </div>
    {/foreach}
    </div>
</div>