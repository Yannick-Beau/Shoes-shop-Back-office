<?php 
if(!empty($errorList)){
    dump($errorList);
}
//dump($category);
?>

<a href="<?=$router->generate('category-list')?>" class="btn btn-success float-right">Retour</a>
       
        <?php

        // avec cette conditon je viens verifier si l'objet $category
        // contient bien un id.
        //(petit rappel, lorsque je suis sur l'ajout d'une category,
        // je transmet a cette vue un objet $category VIDE )
        if(!empty($category->getId())){
            // Si j'ai bien un id c'est que je suis sur la modification d'une category
            echo "<h2>Modifier une catégorie</h2>";
            // ! ATTENTION la route category-update est une route dynamique
            $route = $router->generate('category-update', ['id' => $category->getId()]);

        } else {
            echo "<h2>Ajouter une catégorie</h2>";
            $route = $router->generate('category-add');
        }

        ?>
        
        <!-- 
            Ci dessous dans le action de mon form, je viens afficher la variable $route que j'ai rempli avec l'url correspondante a la route demandée dans la condition ci-dessus.

        -->
        <form action="<?=$route?>" method="POST" class="mt-5">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nom de la catégorie" value="<?=$category->getName()?>">
            </div>
            <div class="form-group">
                <label for="subtitle">Sous-titre</label>
                <input type="text" class="form-control" id="subtitle" name="subtitle" placeholder="Sous-titre"  value="<?=$category->getSubtitle()?>" aria-describedby="subtitleHelpBlock">
                <small id="subtitleHelpBlock" class="form-text text-muted">
                    Sera affiché sur la page d'accueil comme bouton devant l'image
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Image</label>
                <input type="text" class="form-control" id="picture" name="picture"  value="<?=$category->getPicture()?>"  placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                    URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
                </small>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    