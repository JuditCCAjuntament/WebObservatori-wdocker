pipeline {
  environment {
    PROJECT = "websmunicipals"
    APP_NAME = "ciutat-agora"
    CLUSTER = "manresa"
    CLUSTER_ZONE = "europe-west1-b"
    IMAGE_TAG = "eu.gcr.io/${PROJECT}/${APP_NAME}"
    IMAGE_TAG_API = "${IMAGE_TAG}-api:"
    IMAGE_TAG_ADMIN = "${IMAGE_TAG}-admin"
    IMAGE_TAG_WEB = "${IMAGE_TAG}-web:"
    VERSION = "${env.BRANCH_NAME}.${env.BUILD_NUMBER}"
    LAST_VERSION = "${env.BRANCH_NAME}-latest"
    JENKINS_CRED = "${PROJECT}"
  }
  agent {
    kubernetes {
      label 'websmunicipals'
      defaultContainer 'jnlp'
      yaml """
apiVersion: v1
kind: Pod
metadata:
spec:
  # Use service account that can deploy to all namespaces
  serviceAccountName: jenkins
  containers:
  - name: gcloud
    image: gcr.io/cloud-builders/gcloud
    command:
    - cat
    tty: true
  - name: test
    image: eu.gcr.io/websmunicipals/api-component:devel-v1
    command:
    - cat
    tty: true
  - name: kubectl
    image: gcr.io/cloud-builders/kubectl
    command:
    - cat
    tty: true
"""
}
  }

  stages {
    stage('Test Api') {
      steps {
        container('test') {
        sh "cp -r /var/www/html ./test-directori"
        sh "cp -r images/api/wwwroot/app/api ./test-directori/app/"
        sh "cp -r images/api/tests ./test-directori/"
        sh "cp images/api/wwwroot/app/DB/login.php ./test-directori/app/DB/"

        dir(path: 'test-directori') {
              sh "./vendor/bin/codecept bootstrap"
              sh "./vendor/bin/codecept run tests/unit/api/ --xml"
          }
        }
      }
    }
    stage('Build and push image with Container Builder') {
      steps {
        container('gcloud') {
          withCredentials([file(credentialsId: 'websmunicipals-keyfile', variable: 'FILE')]) {
            sh "gcloud auth activate-service-account jenkins@websmunicipals.iam.gserviceaccount.com --key-file $FILE"
          }
          sh "gcloud builds submit -t ${IMAGE_TAG_API}:${VERSION} images/api/"
          sh "gcloud builds submit -t ${IMAGE_TAG_ADMIN}:${VERSION} images/admin/"
          sh "gcloud builds submit -t ${IMAGE_TAG_WEB}:${VERSION} images/web/"

          sh "gcloud container images add-tag ${IMAGE_TAG_API}:${VERSION} ${IMAGE_TAG_API}:${LAST_VERSION}"
          sh "gcloud container images add-tag ${IMAGE_TAG_ADMIN}:${VERSION} ${IMAGE_TAG_ADMIN}:${LAST_VERSION}"
          sh "gcloud container images add-tag ${IMAGE_TAG_WEB}:${VERSION} ${IMAGE_TAG_WEB}:${LAST_VERSION}"
        }
      }
    }
    stage('Deploy Devel (branca devel)') {
      // Devel branch
      when { branch 'devel' }
      steps {
        container('kubectl') {
          // Canviar nom de fitxer, si no es canvia no troba canvis i no fa res
          sh("sed -i.bak 's#${IMAGE_TAG_API}:${LAST_VERSION}#${IMAGE_TAG_API}:${VERSION}#' ./k8s/stage/*.yaml")
          sh("sed -i.bak 's#${IMAGE_TAG_ADMIN}:${LAST_VERSION}#${IMAGE_TAG_ADMIN}:${VERSION}#' ./k8s/stage/*.yaml")
          sh("sed -i.bak 's#${IMAGE_TAG_WEB}:${LAST_VERSION}#${IMAGE_TAG_WEB}:${VERSION}#' ./k8s/stage/*.yaml")

          step([$class: 'KubernetesEngineBuilder', namespace:'stage', projectId: env.PROJECT, clusterName: env.CLUSTER, zone: env.CLUSTER_ZONE, manifestPattern: 'k8s/stage', credentialsId: env.JENKINS_CRED, verifyDeployments: false])
       }
      }
    }
    stage('Deploy Prod (branca master)') {
      // Master branch
      when { branch 'master' }
      steps {
        container('kubectl') {
          // Canviar nom de fitxer, si no es canvia no troba canvis i no fa res
          sh("sed -i.bak 's#${IMAGE_TAG_API}:${LAST_VERSION}#${IMAGE_TAG_API}:${VERSION}#' ./k8s/prod/*.yaml")
          sh("sed -i.bak 's#${IMAGE_TAG_ADMIN}:${LAST_VERSION}#${IMAGE_TAG_ADMIN}:${VERSION}#' ./k8s/prod/*.yaml")
          sh("sed -i.bak 's#${IMAGE_TAG_WEB}:${LAST_VERSION}#${IMAGE_TAG_WEB}:${VERSION}#' ./k8s/prod/*.yaml")

          step([$class: 'KubernetesEngineBuilder', namespace:'default', projectId: env.PROJECT, clusterName: env.CLUSTER, zone: env.CLUSTER_ZONE, manifestPattern: 'k8s/prod', credentialsId: env.JENKINS_CRED, verifyDeployments: false])
       }
      }
    }
  }
  post {
      always {
          junit 'test-directori/tests/_output/*.xml'
      }
  }
}