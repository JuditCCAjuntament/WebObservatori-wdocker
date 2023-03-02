# comandes per l'entorn de prova
create-devel-image:
	docker compose build --no-cache
start-devel:
	docker compose build --no-cache
	docker compose up -d
#	docker exec -it observatori-educatiu-api-devel vendor/bin/codecept bootstrap
stop-devel:
	docker compose down
test-api-devel:
#	docker exec -it observatori-educatiu-api-devel vendor/bin/codecept run tests/unit/api/
#comandes per fer una prova local
start-test-local:
	docker compose -f docker-compose-test-local.yml build --no-cache
	docker compose -f docker-compose-test-local.yml  up -d
stop-test-local:
	docker compose -f docker-compose-test-local.yml down

#comandes per poder fer els passos de pujar a kubernetes
create-image:
	docker build -t observatoriequitat-web:latest images/web/ --no-cache
	docker tag observatoriequitat-web:latest eu.gcr.io/websmunicipals/observatoriequitat-web:devel-latest
	docker tag observatoriequitat-web:latest eu.gcr.io/websmunicipals/observatoriequitat-web:master-latest
upload-image:
	docker push eu.gcr.io/websmunicipals/observatoriequitat-web:devel-latest
	docker push eu.gcr.io/websmunicipals/observatoriequitat-web:master-latest
deploy-stage:
	kubectl apply -f k8s/stage/
deploy-prod:
	kubectl apply -f k8s/prod/
redeploy-stage:
	docker build -t observatoriequitat-web:latest images/web/ --no-cache
	docker tag observatoriequitat-web:latest eu.gcr.io/websmunicipals/observatoriequitat-web:devel-latest
	docker tag observatoriequitat-web:latest eu.gcr.io/websmunicipals/observatoriequitat-web:master-latest
	docker push eu.gcr.io/websmunicipals/observatoriequitat-web:devel-latest
	docker push eu.gcr.io/websmunicipals/observatoriequitat-web:master-latest
	kubectl delete deployment observatoriequitat-web-stage -n stage
	kubectl apply -f k8s/stage/
