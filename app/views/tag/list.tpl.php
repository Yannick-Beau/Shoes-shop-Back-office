

<a href="<?=$router->generate('tag-addBind')?>" class="btn btn-success float-right">Gerer les Tags</a>
        <h2>Liste des produits lier aux tags</h2>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom du produit</th>
                    <th scope="col">Description</th>
                    <th scope="col">Nom des tag</th>
                </tr>
            </thead>
            <tbody>


            <?php foreach($products as $product) :?>
                <tr>
                    <th scope="row"><?=$product->getId()?></th>
                    <td><?=$product->getName()?></td>
                    <td><?=$product->getDescription()?></td>
                    <?php foreach($product->getTags() as $tag) :?>
                    <td><?=$tag->getName()?></td>
                    <td class="text-right">
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?=$router->generate('tag-unbind', ['idProduct' => $product->getId()],['idTag' => $tag->getId()]) ?>">Oui, je veux supprimer</a>
                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                            </div>
                        </div>
                    </td>
                    <?php endforeach ?>
                </tr>
            <?php endforeach ?>
  
            </tbody>
        </table>