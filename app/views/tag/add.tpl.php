
<form action="<?=$router->generate('tag-addPost')?>" method="POST" class="mt-5">
<h2>Ajouter un tag et le lier à un produit</h2>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="name">Nom du tag</label>
                <input type="text" class="form-control" id="name" name="nameTag" placeholder="Nom du tag" aria-describedby="nameHelpBlock">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="prduct">Produits</label>
                <select class="form-control" id="product" name="product">
                    <option value="" selected>choisissez un produit:</option>
                    <?php foreach ($products as $product) : ?>
                        <option value="<?= $product->getId() ?>"><?= $product->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <input type="hidden" name="token" value="<?=$_SESSION['csrfToken']?>">
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>


<form action="<?=$router->generate('tag-bindPost')?>" method="POST" class="mt-5">
<h2>Lier un tag à un produit</h2>
    <div class="row">
        <div class="col">
            <div class="form-group">
                <label for="tag">Tags</label>
                <select class="form-control" id="tag" name="tagId">
                    <option value="" selected>choisissez un tag:</option>
                    <?php foreach ($tags as $tag) : ?>
                        <option value="<?= $tag->getId() ?>"><?= $tag->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label for="prduct">Produits</label>
                <select class="form-control" id="product" name="productId">
                    <option value="" selected>choisissez un produit:</option>
                    <?php foreach ($products as $product) : ?>
                        <option value="<?= $product->getId() ?>"><?= $product->getName() ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
    <input type="hidden" name="token" value="<?=$_SESSION['csrfToken']?>">
    <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
</form>