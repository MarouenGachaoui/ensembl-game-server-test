Installation de l'environnement web + redis via Docker
------------------------------------------------------
Lancer les conteneurs docker web + redis via ***docker-compose*** :

* Aller au répertoire docker puis créer le fichier ***config/.env.local*** à partir du fichier ***config/.env***. La variable ***ROOT_PATH*** doit correspondre la racine où le projet a été cloné. Exemple: ***/home/marouen***.
* Lancer les conteneurs avec la commande : 

        docker-compose --env-file ./config/.env.local up -d  



Installation de l'application
-----------------------------
* Si on souhaite changer les variables d'environnement définies par défaut, créer le fichier ***.env.local*** pour écraser les variables définies dans le fichier ***.env***. Voici la description du rôle de chaque variable:
  * ***APP_ENV*** : spécifique à Symfony pour définir le mode d'exécution (dev ou prod)
  * ***APP_SECRET*** : spécifique à Symfony et utilisée dans son système de sécurité. Changer sa valeur est fortement recommandé
  * ***APP_REDIS_URL*** : la chaîne de connexion à ***redis***. Sa valeur par défaut correspond à la configuration docker dédiée à cette application. Elle peut être redéfinie si on souhaite utiliser une instance différente de ***redis***
  * ***APP_REDIS_MAP_STATE_TTL*** : le nombre de secondes correspondant à la durée après laquelle le jeu expire si le joueur ne fait aucune action.
  * ***APP_MAP_SIDE_POSITIONS*** : le nombre de cases de cotés de la carte
  * ***APP_MAP_NB_HITS_TO_FINISH*** : le nombre de touchées nécessaires pour terminer le jeu


* Ouvrir le conteneur Web avec un utilisateur autre que le root pour éviter les problèmes de permission :

    `docker ps -a` pour repérer le nom ou l'id du conteneur web (docker_ensembl-game-server-test-web)
 
    `docker exec -it -u $(id -u <user_name>) <nom_ou_id_repéré> bash`


* Aller vers le dossier monté: `cd /app` puis lancer `composer install`


* Le serveur est accessible via l'URL: http://ensembl-game-server-test.loc:8001/


* Tester l'API avec les requêtes comme défini dans le sujet du test (https://github.com/ma-residence/php-coding-challenge-game/blob/main/README.md)
