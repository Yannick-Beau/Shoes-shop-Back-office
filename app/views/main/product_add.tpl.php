<div class="container my-4">
        <a href="<?=$router->generate('main-product')?>" class="btn btn-success float-right">Retour</a>
        <h2>Ajouter un produit</h2>
        
        <form action="" method="POST" class="mt-5">
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" class="form-control" id="name" placeholder="Nom de la catégorie">
            </div>
            <div class="form-group">
                <label for="subtitle">Description du produit</label>
                <input type="text" class="form-control" id="subtitle" placeholder="Description du produit" aria-describedby="subtitleHelpBlock">
                <small id="subtitleHelpBlock" class="form-text text-muted">
                    Description du produit qui sera sur la page du produit
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Image</label>
                <input type="text" class="form-control" id="picture" placeholder="image jpg, gif, svg, png" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                    URL relative d'une image (jpg, gif, svg ou png) fournie sur <a href="https://benoclock.github.io/S06-images/" target="_blank">cette page</a>
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Prix du produit</label>
                <input type="text" class="form-control" id="picture" placeholder="Prix du produit" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                    Prix du produit en €
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Note du produit</label>
                <input type="text" class="form-control" id="picture" placeholder="L'avis sur le produit, de 1 à 5" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                L'avis sur le produit, de 1 à 5 qui sera afficher sur la fiche du produit
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Status du produit</label>
                <input type="text" class="form-control" id="picture" placeholder="Le statut du produit (1=dispo, 2=pas dispo)" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                Le statut du produit (1=dispo, 2=pas dispo)
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Id de la marque</label>
                <input type="text" class="form-control" id="picture" placeholder="Id de la marque" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                    Id de la marque du produit
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Id le la category</label>
                <input type="text" class="form-control" id="picture" placeholder="Id le la category peut être null" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                Id le la category du produit peut être null
                </small>
            </div>
            <div class="form-group">
                <label for="picture">Id du type</label>
                <input type="text" class="form-control" id="picture" placeholder="Id du type" aria-describedby="pictureHelpBlock">
                <small id="pictureHelpBlock" class="form-text text-muted">
                   Id du type du produit
                </small>
            </div>
            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    </div>
