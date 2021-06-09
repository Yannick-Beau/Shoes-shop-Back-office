# Modifier une catégorie

- On va dans notre point d'entrée (index.php)
- On fabrique la route
- On fabrique la méthode liée à la route
- Dans cette methode je récupère les infos de la categorie a modifier grace a un Model (et grace a la methode find() qui existe déjà).
- Dans cette même methode, je vais afficher  une vue grâce a la methode show tout en lui transmettant les infos de la catégories à modifier (précédement récupérés grâce au Model)
- Il faut donc fabriquer cette vue si elle n'existe pas. Ou utiliser une vue qui existe déja et modifier son code pour qu'elle puisse savoir qui l'appelle.


Pour traiter les donnés du formulaire nous allons faire une route POST !
- On va dans index.php
- On fabrique la route POST
- On fabrique la methode liée à la route
- Dans cette methode je vais récupérer les données du formulaire ...
- ... pour permettre l'update de la categorie grâce a une methode update de notre Model Category
- Il faut donc coder cette methode update ! 
