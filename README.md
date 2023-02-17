# Ciutat àgora

<h2>Contingut</h2>

<h3>Administrador</h3>
    <p>Administrador en react.</p>
    <p>El codi font esta a <code>/images/admin</code></p>

<h3>Api</h3>
    <p>Api publica i privada en php</p>
    <p>El codi font esta a:  <code>/images/api</code></p>
<h3>Mysql</h3>
    <p> Dase de dades de l'aplicació, només es carregarà per fer les proves, la db real serà la de "mysql-service"</p>
    <p> el fitxer de precarga amb les dades de prova i estructura està a: <code>/dbfiles/</code></p>
<h2>Entorn de proves</h2>
<p>
    L'entorn de proves fa servir una imatge amb el contingut local de la maquina per poder desenvolupar i anar veien els resultats dels canvis sense necesitat de crear una nova imatge.
</p>

<h3> Contingut </h3>

<ul>
    <li><b>Admin (react):</b> Administrador que fa servir la api react. Els fitxers es troben en local per poder fer les proves en local </li>
    <li><b>Api (PHP):</b> Api que fa les crides al mysql amb cache al redis. El codi font de la api estarà en local per poder-lo editar mentre es prova</li>
    <li><b>Mysql:</b> Base de dades sense persistencia, que es precarregarà amb dades de prova</li>
    <li><b>Adminer:</b> Administrador de bases de dades, per poder accedir a les dades de prova</li>
    <li><b>Redis:</b> Base de dades redis que es fa servir per la cache</li>
</ul>


<h3> Iniciar entorn de proves</h3>
<ol>
<li> Creem imatge: <br/><code>make create-devel-image</code></li>
<li> Iniciem tot l'entorn: <br/> <code>make start-devel</code></li>
</ol>


<h3>Accedir al entorn de proves</h3>
<ul>
    <li>Accedir a administració (s'obrirà sol al acabar de carregar-ho tot): <code>http://localhost:3000</code></li>
    <li>Accedir a api: <code>http://localhost:8080</code></li>
    <li>Accedir a mysql: <code>http://localhost:9090</code>
        <ul>
            <li>host: mysql_db</li>
            <li>user: usuaris</li>
            <li>pass: qwerty</li>
        </ul>
    </li>
</ul>

<h3>Executar testos de la api</h3>
<ol>
    <li>Accedir al contenidor de la api<br/><code>docker exec -it usuaris-api-devel /bin/bash</code></li>
    <li>Iniciarlitzar programa de testos<br/> <code>~/html$ ./vendor/bin/codecept bootstrap</code></li>
    <li>Executar testos<br/> <code>~/html$ ./vendor/bin/codecept run tests/unit/api/
</code>
    </li>
</ol>

<h3>Aturar entorn de proves</h3>
<p>Amb aquesta comanda pararem tot l'entorn de proves</p>
<p><code>make stop-devel</code></p>

<h2>Prova local del resultat final</h2>
<p> Per poder provar que funciona correctament l'aplicació que es pujarà es pot executar les seguents comandes i crearà una imatge igual que la que desprḉes es pujarà a kubernetes.</p>

<h3>Iniciar prova local</h3>
<p>Per iniciar la prova local que crearà les imatges i iniciarà l'entorn</p>
<P><code>make start-test-local</code></p>

<h3>Aturar prova local</h3>
<p>Per netejar tot el que ha generat la prova local</p>
<P><code>make stop-test-local</code></p>

<h2>Kubernetes</h2>

<h3>Primera vegada</h3>
<ul>
    <li>Crear la contrasenya de l'usuari de mysql tant a stage com default:<br/><code>kubectl create secret generic mysql-usuaris-credentials
    --from-literal MYSQL_PASSWORD=[password_del_usuari]
    --from-literal MYSQL_USER=[usuari]</code>
    <br/><code>kubectl create secret generic mysql-usuaris-credentials -n stage
    --from-literal MYSQL_PASSWORD=[password_del_usuari]
    --from-literal MYSQL_USER=[usuari]</code>
    </li>
</ul>

<h3>Pujar-ho a kubernetes manualment</h3>
<ul>
    <li>crear les imatges: <br/><code>make create-image</code></li>
    <li>pujar imatge al registry: 
        <br/><code>docker tag usuaris-api:latest eu.gcr.io/websmunicipals/usuaris-api:1</code>
        <br/><code>docker push eu.gcr.io/websmunicipals/usuaris-api:1</code>
        <br/><code>gcloud container images add-tag  eu.gcr.io/websmunicipals/usuaris-api:1 eu.gcr.io/websmunicipals/usuaris-api:latest</code>
        <br/><code>docker tag usuaris-admin:latest eu.gcr.io/websmunicipals/usuaris-admin:1</code>
        <br/><code>docker push eu.gcr.io/websmunicipals/usuaris-admin:1</code>
        <br/><code>gcloud container images add-tag  eu.gcr.io/websmunicipals/usuaris-admin:1 eu.gcr.io/websmunicipals/usuaris-admin:latest</code>
    </li>
    <li>crear l'entorn a kubernetes:
        <ul>
            <li>entorn stage: <code>kubectl apply -f k8s/stage</code></li></li>
            <li>entorn prod: <code>kubectl apply -f k8s/prod</code></li></li>
        </ul>
    </li>
</ul>
<h3>Aturar entorn kubrnetes</h3>
<ul>
    <li>entorn stage: <code>kubectl delete -f k8s/stage</code></li></li>
    <li>entorn prod: <code>kubectl delete -f k8s/prod</code></li></li>
</ul>



