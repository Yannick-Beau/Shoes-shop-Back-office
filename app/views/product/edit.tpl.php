<?php 
if(!empty($errorList)){
    dump($errorList);
}
?>

<a href="<?=$router->generate('product-list')?>" class="btn btn-success float-right">Retour</a>
        <h2>Modifier un produit</h2>
        
        <form action="" method="POST" class="mt-5">

        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la catégorie" value="<?= $product->getName() ?>">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="<?= $product->getDescription() ?>" 
                aria-describedby="descriptionHelpBlock">
            <small id="subtitleHelpBlock" class="form-text text-muted">
                La description du produit 
            </small>
        </div>

        <div class="form-group">
            <label for="picture">Image</label>
            <input type="text" class="form-control" id="picture" name="picture" placeholder="image jpg, gif, svg, png" value="<?= $product->getPicture() ?>" aria-describedby="pictureHelpBlock">
            <small id="pictureHelpBlock" class="form-text text-muted">
                URL relative d'une image (jpg, gif, svg ou png) fournie sur 
                <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
            </small>
        </div>

        <div class="form-group">
            <label for="price">Prix</label>
            <input class="form-control" id="price" name="price" placeholder="Prix" value="<?= $product->getPrice() ?>" 
                aria-describedby="priceHelpBlock">
            <small id="priceHelpBlock" class="form-text text-muted">
                Le prix du produit 
            </small>
        </div>

        <div class="form-group">
            <label for="rate">Note</label>
            <input type="text" class="form-control" id="rate" name="rate" placeholder="Note" value="<?= $product->getRate() ?>" 
                aria-describedby="rateHelpBlock">
            <small id="rateHelpBlock" class="form-text text-muted">
                Le note du produit 
            </small>
        </div>


        <div class="form-group">
            <label for="status">Statut</label>
            <select class="custom-select" id="status" name="status" aria-describedby="statusHelpBlock" value="<?= $product->getStatus() ?>">
                <option value="2">Inactif</option>
                <option value="1">Actif</option>
            </select>
            <small id="statusHelpBlock" class="form-text text-muted">
                Le statut du produit 
            </small>
        </div>


        <?php 
        //TODO IL VA NOUS FALLOIR DYNAMISER CETTE LISTE !
        ?>
        <div class="form-group">
            <label for="category">Catégorie</label>
            <select class="custom-select" id="category" name="category_id" aria-describedby="categoryHelpBlock" value="<?= $product->getCategoryId() ?>">
                <option value="1">Détente</option>
                <option value="2">Au travail</option>
                <option value="3">Cérémonie</option>
            </select>
            <small id="categoryHelpBlock" class="form-text text-muted">
                La catégorie du produit 
            </small>
        </div>


        <div class="form-group">
            <label for="brand">Marque</label>
            <select  class="custom-select" id="brand" name="brand_id" aria-describedby="brandHelpBlock" value="<?= $product->getBrandId() ?>">
                <option value="1">oCirage</option>
                <option value="2">BOOTstrap</option>
                <option value="3">Talonette</option>
            </select>
            <small id="brandHelpBlock" class="form-text text-muted">
                La marque du produit 
            </small>
        </div>
 
        
        <div class="form-group">
            <label for="type">Type</label>
            <select class="custom-select" id="type" name="type_id" aria-describedby="typeHelpBlock" value="<?= $product->getTypeId() ?>">
                <option value="1">Chaussures de ville</option>
                <option value="2">Chaussures de sport</option>
                <option value="3">Tongs</option>
            </select>
            <small id="typeHelpBlock" class="form-text text-muted">
                Le type de produit 
            </small>
        </div>



            <!--
            emmet : div.form-group>label+input
            <div class="form-group">
                <label for=""></label>
                <input type="text">
            </div>
            -->

            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    