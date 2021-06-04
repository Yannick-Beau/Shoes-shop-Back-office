<?php if(isset($_POST)){
    $date = new DateTime();
    $category->setName($_POST['name']);
    $category->setSubtitle($_POST['subtitle']);
    $category->setPicture($_Post['picture']);
    $category->setHomeOrder($_Post['homeOrder']);
    $category->setCreatedAt( $date->getTimestamp() );
}
?>

<?php $date = new DateTime();
echo $date->getTimestamp(); ?>

<div class="container my-4">
    <a href="<?= $router->generate('main-categories') ?>" class="btn btn-success float-right">Retour</a>
    <h2>Ajouter une catégorie</h2>

    <form action="" method="POST" class="mt-5">
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