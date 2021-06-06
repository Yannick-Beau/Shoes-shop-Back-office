
<?php 

if(!empty($_POST)){
 
    $date = new DateTime();
    $picture = $_POST['picture'];
    $price = $_POST['price'];
    $erreurForm = false;
    
    //On filtre $_POST['picture'] pour que la valeur soit bien une url valide sinon on passe $erreurForm à true pour indiquer qu'un que le cahmp est incorrect
    if (filter_var($_POST['picture'], FILTER_VALIDATE_URL)) {
        $product->setPicture($picture);
    } else {
        $erreurForm = true;
        echo "L'url de l'image n'est pas valide<br>";
    }
    //On filtre $_POST['price'] pour que la valeur soit bien un float sinon on passe $erreurForm à true pour indiquer qu'un que le cahmp est incorrect
    if (filter_var($_POST['price'], FILTER_VALIDATE_FLOAT)) {
        $product->setPrice($price);
    } else {
        $erreurForm = true;
        echo "Le prix est incorrect<br>";
    }

    //On filtre $_POST['rate'] pour que la valeur soit bien un int de 1 à 5 sinon on passe $erreurForm à true pour indiquer qu'un que le cahmp est incorrect
    if (filter_var($_POST['rate'], FILTER_VALIDATE_INT) && $_POST['rate'] >= 1 && $_POST['rate'] <= 5) {
        $product->setRate($_POST['rate']);
    } else {
        $erreurForm = true;
        echo "La note doit être de 1 à 5<br>";
    }

    //On filtre $_POST['status'] pour que la valeur soit bien un int de 1 ou 2 sinon on passe $erreurForm à true pour indiquer qu'un que le cahmp est incorrect
    if (filter_var($_POST['status'], FILTER_VALIDATE_INT) && $_POST['status'] == 1 || $_POST['status'] == 2) {
        $product->setStatus($_POST['status']);
    } else {
        $erreurForm = true;
        echo "La note doit être de 1 ou 2. 1 = disponible et 2 = pas disponible<br>";
    }

    //On filtre $_POST['brandId'] pour que la valeur soit bien un int sinon on passe $erreurForm à true pour indiquer qu'un que le cahmp est incorrect
    if (filter_var($_POST['brandId'], FILTER_VALIDATE_INT)) {
        $product->setBrandId($_POST['brandId']);
    } else {
        $erreurForm = true;
        echo "L'id de la marque doit être un nombre<br>";
    }

    //On filtre $_POST['categoryId'] pour que la valeur soit bien un int sinon on passe $erreurForm à true pour indiquer qu'un que le cahmp est incorrect
    if (filter_var($_POST['categoryId'], FILTER_VALIDATE_INT)) {
        $product->setCategoryId($_POST['categoryId']);
    } else {
        $erreurForm = true;
        echo "L'id de la category doit être un nombre<br>";
    }

    //On filtre $_POST['typeId'] pour que la valeur soit bien un int sinon on passe $erreurForm à true pour indiquer qu'un que le cahmp est incorrect
    if (filter_var($_POST['typeId'], FILTER_VALIDATE_INT)) {
        $product->setTypeId($_POST['typeId']);
    } else {
        $erreurForm = true;
        echo "L'id du type doit être un nombre<br>";
    }

    $product->setName($_POST['name']);
    $product->setDescription($_POST['description']);
    $product->setCreatedAt( $date->format('Y-m-d H:i:s') );
    
    //Si $erreurForm est false c'est qu'aucune erreur n'a été détecté alors on peut exécuter la requete pour ajouter à la DB
    //Si il n'y a pas d'erreur au moment d'inserer dans la DB alors on redirige l'utilisateur sur la liste des categories
    if (!$erreurForm) {
        $erreurInsert = $product->addProduct();
        if ($erreurInsert){
            header("Location: {$router->generate('product-list')}");
        }
        else {
            echo "Une erreur c'est produit au moment d'ajouter la catégorie. Veillez vérifier les informations saisie";
        }
    }
    
}

?>


<div class="container my-4">
        <a href="<?=$router->generate('product-list')?>" class="btn btn-success float-right">Retour</a>
        <h2>Ajouter un produit</h2>
        
        <form action="<?= $router->generate('product-addPost') ?>" method="POST" class="mt-5">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name='name' placeholder="Nom du produit">
            </div>
            <div class="form-group">
                <label for="subtitle">Description du produit</label>
                <input type="text" class="form-control" id="description" name="description" placeholder="Description du produit" aria-describedby="subtitleHelpBlock">
                <small id="subtitleHelpBlock" class="form-text text-muted">
                    Description du produit qui sera sur la page du produit
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
                <label for="picture">Prix du produit</label>
                <input type="text" class="form-control" id="price" name="price" placeholder="Prix du produit" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                    Prix du produit en €
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Note du produit</label>
                <input type="text" class="form-control" id="rate" name="rate" placeholder="L'avis sur le produit, de 1 à 5" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                L'avis sur le produit, de 1 à 5 qui sera afficher sur la fiche du produit
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Status du produit</label>
                <input type="text" class="form-control" id="picture" name="status" placeholder="Le statut du produit (1=dispo, 2=pas dispo)" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                Le statut du produit (1=dispo, 2=pas dispo)
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Id de la marque</label>
                <input type="text" class="form-control" id="picture" name="brandId" placeholder="Id de la marque" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                    Id de la marque du produit
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Id le la category</label>
                <input type="text" class="form-control" id="picture" name="categoryId" placeholder="Id le la category peut être null" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                Id le la category du produit peut être null
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Id du type</label>
                <input type="text" class="form-control" id="picture" name="typeId" placeholder="Id du type" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                   Id du type du produit
                </small>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    </div>
