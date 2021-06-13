<?php
//dump($currentPage)
?>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">

        <div class="container">
            <a class="navbar-brand" href="<?=$router->generate('main-home')?>">oShop
            <?php 
            if(isset($_SESSION['userId'])){
                // si j'ai un utilisateur connecté, j'affiche son firstanme ! 
                echo $_SESSION['userObject']->getFirstname();
            }
            ?>
            
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <!--
                        Pour permettre la surbrillance des liens
                        J'utilise l'opérateur ternaire : 
                        conditon ? 'valeur si vrai' : 'valeur si faux'
                        et je me place dans un short echo tag
                        pour afficher active si la page demandée correspond au lien

                    -->

                    <?php if(!isset($_SESSION['userId'])) : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=$router->generate('user-login')?>">Connexion <span class="sr-only"></span></a>
                        </li>
                    <?php else : ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?=$router->generate('user-logout')?>">Deconnexion <span class="sr-only"></span></a>
                        </li>
                    <?php endif; ?>


                    <li class="nav-item <?= $currentPage === 'main/home' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= $router->generate('main-home') ?>">Accueil <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item <?= $currentPage === 'category/list' || $currentPage === 'category/add' ? 'active' : '' ?>">
                        <a class="nav-link" href="<?= $router->generate('category-list') ?>">Catégories</a>
                    </li>
                    <li class="nav-item <?= $currentPage === 'product/list' || $currentPage === 'product/add' ? 'active' : '' ?>">
                    
                        <a class="nav-link" href="<?= $router->generate('product-list') ?>">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Types</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Marques</a>
                    </li>
                    <li class="nav-item" <?= $currentPage === 'tag/add-bind' || $currentPage === 'tag/list' ? 'active' : '' ?>>
                        <a class="nav-link" href="<?= $router->generate('tag-list') ?>">Tags</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $router->generate('category-homeOrder') ?>">Sélections Accueil &amp; Footer</a>
                    </li>
                </ul>
                <!-- <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Rechercher" aria-label="Rechercher">
                    <button class="btn btn-outline-info my-2 my-sm-0" type="submit">Rechercher</button>
                </form> -->
            </div>
        </div>
    </nav>