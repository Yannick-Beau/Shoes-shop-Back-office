
<?php 

if(!empty($_POST)){
 

    $date = new DateTime();
    $product->setName($_POST['name']);
    $product->setDescription($_POST['description']);
    $product->setPicture($_POST['picture']);
    $product->setPrice($_POST['price']);
    $product->setRate($_POST['rate']);
    $product->setBrandId($_POST['brandId']);
    $product->setCategoryId($_POST['categoryId']);
    $product->setTypeId($_POST['typeId']);
    $product->setCreatedAt( $date->format('Y-m-d H:i:s') );
    $product->addProduct();

}

?>


<div class="container my-4">
        <a href="<?=$router->generate('product-list')?>" class="btn btn-success float-right">Retour</a>
        <h2>Ajouter un produit</h2>
        
        <form action="<?= $router->generate('product-addPost') ?>" method="POST" class="mt-5">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name='name' placeholder="Nom de la catégorie">
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
