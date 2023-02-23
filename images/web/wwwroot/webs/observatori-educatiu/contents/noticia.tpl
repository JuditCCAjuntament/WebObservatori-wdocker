{assign var="noticia" value=$pagina.dades_gestor}

<div class="titol">
    <h1>{$noticia.Titol}</h1>
    <div class="data-titol">{$noticia.DataNoticia|dataFormatada:noticies|stripslashes}</div>
</div>

<div  id="descripcio" class="descripcio">
    {if $noticia.path}
        <div class="contingut-img">
            <img src="https://media.manresa.cat/thumbnail.php?src={$noticia.path}&w=600" class="responsive-img" alt="{$noticia.Titol}" title="{$noticia.Titol}"/>
        </div>
    {/if}
    <div class="contingut-text">
        <div class="resum">{$noticia.Resum|netejar:negretesHtml|stripslashes|netejar:nbsp}</div>
        <div>{$noticia.Contingut|stripslashes|netejar:nbsp}</div>
        <div class="">
            <a class="btn" href="menu/{$pagina.idseo}">Totes les notícies</a>
        </div>
    </div>


</div>