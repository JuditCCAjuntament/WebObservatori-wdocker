# comandes per l'entorn de prova
create-devel-image:
	docker compose build --no-cache
start-devel:
	docker compose build --no-cache
	docker compose up -d
	docker exec -it ciutat-agora-api-devel vendor/bin/codecept bootstrap
	yarn --cwd images/admin/ start
stop-devel:
	docker compose down
test-api-devel:
	docker exec -it ciutat-agora-api-devel vendor/bin/codecept run tests/unit/api/
#comandes per fer una prova local
start-test-local:
	yarn --cwd images/admin/ build
	docker compose -f docker-compose-test-local.yml build --no-cache
	docker compose -f docker-compose-test-local.yml  up -d
stop-test-local:
	docker compose -f docker-compose-test-local.yml down

#comandes per poder fer els passos de pujar a kubernetes
create-image:
	docker build -t ciutat-agora-api:latest images/api/ --no-cache
	docker tag ciutat-agora-api:latest eu.gcr.io/websmunicipals/ciutat-agora-api:devel-latest
	docker tag ciutat-agora-api:latest eu.gcr.io/websmunicipals/ciutat-agora-api:master-latest
	docker build -t ciutat-agora-admin:latest images/admin/ --no-cache
	docker tag ciutat-agora-admin:latest eu.gcr.io/websmunicipals/ciutat-agora-admin:devel-latest
	docker tag ciutat-agora-admin:latest eu.gcr.io/websmunicipals/ciutat-agora-admin:master-latest
	docker build -t ciutat-agora-web:latest images/web/ --no-cache
	docker tag ciutat-agora-web:latest eu.gcr.io/websmunicipals/ciutat-agora-web:devel-latest
	docker tag ciutat-agora-web:latest eu.gcr.io/websmunicipals/ciutat-agora-web:master-latest
upload-image:
	docker push eu.gcr.io/websmunicipals/ciutat-agora-api:devel-latest
	docker push eu.gcr.io/websmunicipals/ciutat-agora-api:master-latest
	docker push eu.gcr.io/websmunicipals/ciutat-agora-admin:devel-latest
	docker push eu.gcr.io/websmunicipals/ciutat-agora-admin:master-latest
	docker push eu.gcr.io/websmunicipals/ciutat-agora-web:devel-latest
	docker push eu.gcr.io/websmunicipals/ciutat-agora-web:master-latest
deploy-stage:
	kubectl apply -f k8s/stage/
deploy-prod:
	kubectl apply -f k8s/prod/
