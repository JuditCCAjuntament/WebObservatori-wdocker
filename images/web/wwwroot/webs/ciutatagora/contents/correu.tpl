<div class="col s12 caixa">
    <div class="titolApartat">
        <h2>{$titol}</h2>
    </div>
    {if $dadesCorreu.enviat}
        {if $msg_ok}
            <p> {$msg_ok} </p>
        {else}
            <p>Gràcies per enviar-nos informació</p>
        {/if}
        <div>
            <input type="button" value="Tornar" class="btn" onclick="history.back()" />
        </div>


    {else}
        {if $dadesCorreu.errors}
            Corregiu els següents errors i torneu-ho a provar.<br/>
            <ul>
                {foreach name=errors item=item from=$dadesCorreu.errors}
                    <li>{$item}</li>
                {/foreach}
            </ul>
        {else}
            El correu no s'ha pogut enviar. <br/><br/>
            Torneu-ho a provar d'aquí a uns minuts i si encara no funciona poseu-vos en contacte amb l'ajuntament. <br/>
        {/if}
        <br/><br/>
        <input type="button" value="Tornar" class="btn" onclick="history.back()" />
        <br/>

    {/if}
</div>
