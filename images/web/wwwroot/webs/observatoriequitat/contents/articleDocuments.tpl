{assign var="web_sufixAssets" value="ttt"}
{assign var="docs" value=$pagina.documents}
{assign var="content" value=$pagina.contingut}

<div class="titol">
    <h1>{$pagina.titol}</h1>
</div>
{if $content.contingut}
    <div  id="descripcio" class="descripcio">
        <div class="contingut-text">
            {$content.contingut}
        </div>
    </div>
{/if}
{if $docs}
    <div class="llistat">
        {include file="webs/`$web_sufixAssets`/helpers/llistatDocumentsBucle.tpl" arbre=$docs depth=0 sufix=$web_sufixAssets}
    </div>
{/if}