# API Jeux-collectionne !

#### Sécurité

La sécurité est gérée par des tokens jwt et certaines routes de l'api en ont besoin. Le dossier contenant les clés n'étant pas inclus dans git, il faudra exécuter la commande suivante pour les générer: <br><br>
                php bin/console lexik:jwt:generate-keypair
Lexik va ainsi générer la paire de clé mais au mauvais endroit. Il va créer un dossier à la racine avec des '%' au début et à la fin du nom. Il faudra prendre les clés et les placer dans le dossier (qu'il faudra créer) **'config/jwt'**. <br><br>

Mais ce n'est pas tout ! Il faut maintenant décrypter la clé privée, parce qu'elle ne l'est pas automatiquement.
Pour ce faire, il faudra créer un fichier, dans le dossier jwt créé juste au dessus, nommé **private_decrypted.pem**. Ensuite sur Linux et Mac il faut, dans le terminal et à la racine du projet, taper cette commande:
                openssl rsa -in private.pem -out private_decrypted.pem
Ce qui va décrypter la clé et mettre le résultat dans **private_decrypted.pem**. On peut ensuite mettre la clé décryptée dans le fichier **private.pem**.