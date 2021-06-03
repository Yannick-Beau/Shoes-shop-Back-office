<div class="container my-4">
        <a href="<?=$router->generate('main-product_add')?>" class="btn btn-success float-right">Ajouter</a>
        <h2>Liste des produits</h2>
        <table class="table table-hover mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Note</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date de création</th>
                    <th scope="col">Date de mise à jour</th>
                    <th scope="col">Marque id</th>
                    <th scope="col">Catégorie id</th>
                    <th scope="col">Type id</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
               <?php
                foreach($products as $productCurrent) :
               ?>
                <tr>
                    <th scope="row"><?=$productCurrent->getId() ?></th>
                    <td><?=$productCurrent->getName() ?></td>
                    <td><?=$productCurrent->getDescription() ?></td>
                    <td><?=$productCurrent->getPicture() ?></td>
                    <td><?=$productCurrent->getPrice() ?></td>
                    <td><?=$productCurrent->getRate() ?></td>
                    <td><?=$productCurrent->getStatus() ?></td>
                    <td><?=$productCurrent->getCreatedAt() ?></td>
                    <td><?php if ($productCurrent->getUpdatedAt() === null) {
                            echo "null";
                        } else {
                            echo $productCurrent->getUpdatedAt();
                        } ?></td>
                    <td><?=$productCurrent->getBrandID() ?></td>
                    <td><?=$productCurrent->getCategoryId() ?></td>
                    <td><?=$productCurrent->getTypeId() ?></td>
                    <td class="text-right">
                        <a href="" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-trash-o" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Oui, je veux supprimer</a>
                                <a class="dropdown-item" href="#" data-toggle="dropdown">Oups !</a>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>