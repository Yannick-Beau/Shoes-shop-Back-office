<div class="container my-4">
    <a href="<?= $router->generate('main-category_add') ?>" class="btn btn-success float-right">Ajouter</a>
    <h2>Liste des catégories</h2>
    <table class="table table-hover mt-4">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nom</th>
                <th scope="col">Sous-titre</th>
                <th scope="col">Image</th>
                <th scope="col">Ordre page home</th>
                <th scope="col">Date de création</th>
                <th scope="col">Date de mofification</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($categorys as $categoryCurrent) :
            ?>
                <tr>
                    <th scope="row"><?= $categoryCurrent->getId() ?></th>
                    <td><?= $categoryCurrent->getName() ?></td>
                    <td><?= $categoryCurrent->getSubtitle() ?></td>
                    <td><?= $categoryCurrent->getPicture() ?></td>
                    <td><?= $categoryCurrent->getHomeOrder() ?></td>
                    <td><?= $categoryCurrent->getCreatedAt() ?></td>
                    <td><?php if ($categoryCurrent->getUpdatedAt() === null) {
                            echo "null";
                        } else {
                            echo $categoryCurrent->getUpdatedAt();
                        } ?></td>
                    <td class="text-right">
                        <a href="" class="btn btn-sm btn-warning">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        </a>
                        <!-- Example single danger button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-sm btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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