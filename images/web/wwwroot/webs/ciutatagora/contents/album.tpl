<div class="esquerra col-xs-12">
    {$album.0.descripcio}

    <ul class="col-xs-12 dadesArticle">
        {foreach name=imatges item=item from=$imatges}
            <div class="col-xs-12 col-sm-6 col-md-3" style="padding:10px"><a href="/img/albums/{$album.0.id_album}/{$item}" target="_blank"><img src="/img/albums/{$album.0.id_album}/{$item}" style="width:100%;" alt=""/></a></div>
        {/foreach}
    </ul>
</div>


</div>
