<?php 

if(!empty($_POST)){

    $date = new DateTime();
    $erreurForm = false;
    
    //On filtre $_POST['homeOrder'] pour que la valeur soit bien un int de 0 à 5 sinon on passe $erreurForm à true pour indiquer qu'un que le cahmp est incorrect
    if (filter_var($_POST['homeOrder'], FILTER_VALIDATE_INT) === 0 && $_POST['homeOrder'] >= 0 && $_POST['homeOrder'] <= 5) {
        $category->setHomeOrder($_POST['homeOrder']);
    } else {
        $erreurForm = true;
        echo "L'ordre de la page doit être un chiffre de 0 à 5<br>";
    }

    //On filtre $_POST['picture'] pour que la valeur soit bien une url valide sinon on passe $erreurForm à true pour indiquer qu'un que le cahmp est incorrect
    if (filter_var($_POST['picture'], FILTER_VALIDATE_URL)) {
        $category->setPicture($_POST['picture']);
    } else {
        $erreurForm = true;
        echo "L'url de l'image n'est pas valide<br>";
    }

    $category->setName($_POST['name']);
    $category->setSubtitle($_POST['subtitle']);
    $category->setCreatedAt( $date->format('Y-m-d H:i:s') );

    //Si $erreurForm est false c'est qu'aucune erreur n'a été détecté alors on peut exécuter la requete pour ajouter à la DB
    //Si il n'y a pas d'erreur au moment d'inserer dans la DB alors on redirige l'utilisateur sur la liste des categories
    if (!$erreurForm) {
        $erreurInsert = $category->addCategory();
        if ($erreurInsert){
            header("Location: {$router->generate('category-list')}");
        }
        else {
            echo "Une erreur c'est produit au moment d'ajouter la catégorie. Veillez vérifier les informations saisie";
        }
    }

}

?>

<div class="container my-4">
    <a href="<?= $router->generate('category-list') ?>" class="btn btn-success float-right">Retour</a>
    <h2>Ajouter une catégorie</h2>

    <form action="<?= $router->generate('category-addPost') ?>" method="POST" class="mt-5">
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la catégorie">
        </div>
        <div class="form-group">
            <label for="subtitle">Sous-titre</label>
            <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Sous-titre" aria-describedby="subtitleHelpBlock">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                Sera affiché sur la page d'accueil comme bouton devant l'image
            </small>
        </div>
        <div class="form-group">
            <label for="picture">Image</label>
            <input type="text" class="form-control" id="picture" name="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock">
            <small id="pictureHelpBlock" class="form-text text-muted">
                URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
            </small>
        </div>
        <div class="form-group">
            <label for="subtitle">Ordre de la page</label>
            <input type="text" class="form-control" id="home_order" name="homeOrder" placeholder="Ordre de la page" aria-describedby="subtitleHelpBlock">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                Ordre sur la page home.
            </small>
        </div>
        <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
    </form>
</div>