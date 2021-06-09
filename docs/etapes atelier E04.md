# Etapes 

- Créer une page (route + view) avec formulaire de connexion (input mail et password)
- créer une route pour traiter les données du formulaire
- si un tuiisateur es trouvé, on compare son mot de passe avec celui tapé dans l'input password
- si on a un match entre les mot de passe on stoque l'état connecté dans la variable $_SESSION, sinon on revient en arrière avec un message d'erreur.

Autrement formulé : 

- page de connexion => formulaire avec email et password, en POST
- vérification user valide => récupération des données, table "app_user"
- si OK, on conserve l'état "connecté" pour la suite
=> stock l'objet User en session ($_SESSION['connectedUser'] par exemple)
- sinon un message d'erreur => tableau d'erreur à transmettre a la View