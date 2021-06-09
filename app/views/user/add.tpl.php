<?php 
if(!empty($errorList)){
    dump($errorList);
}
?>

<a href="<?=$router->generate('user-list')?>" class="btn btn-success float-right">Retour</a>
        <?php
        //! On veut verifier si on ajoute ou si on modifie une
        //! categorie ! 
        // et nous allons adapter l'affichage du titre ET 
        // l'ACTION DU FORMULAIRE selon l'action que nous avons choisi
        if(!empty($user->getId())){
            echo "<h2>Modifier l'utilisateur' : " . $user->getFirstname() . $user->getLastname() ."</h2>";
            $route = $router->generate('user-update', ['id' => $user->getId()]);
            

        }else {
            echo "<h2>Ajouter d'un utilisateur</h2>";
            $route = $router->generate('user-add');
        }
        ?>
        
        <form action="" method="POST" class="mt-5">

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Adresse e-mail" value="<?=$user->getEmail();?>">
        </div>

        <div class="form-group">
            <label for="passeword">Passeword</label>
            <input type="password" class="form-control" id="passeword" name="password" placeholder="Password" value="">
        </div>

        <div class="form-group">
            <label for="firstname">Firstname</label>
            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="Firstname" value="<?=$user->getFirstname();?>" 
                aria-describedby="descriptionHelpBlock">
        </div>

        <div class="form-group">
            <label for="lastname">Lastname</label>
            <input class="form-control" id="lastname" name="lastname" placeholder="Lastname" value="<?=$user->getLastname();?>" 
                aria-describedby="priceHelpBlock">
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select class="custom-select" id="role" name="role" aria-describedby="statusHelpBlock" value="">
            <option value="admin" <?= $user->getStatus() == 1 ? 'selected' : ''?>>Admin</option>
                <option value="catalog-manager" <?= $user->getStatus() == 2 ? 'selected' : ''?> >Catalog-manager</option>
                
            </select>
            <small id="statusHelpBlock" class="form-text text-muted">
                Le role de l'utilisateur 
            </small>
        </div>

        <div class="form-group">
            <label for="status">Statut</label>
            <select class="custom-select" id="status" name="status" aria-describedby="statusHelpBlock" value="">
            <option value="1" <?= $user->getStatus() == 1 ? 'selected' : ''?>>Actif</option>
                <option value="2" <?= $user->getStatus() == 2 ? 'selected' : ''?> >Désactivé/Bloqué</option>
                
            </select>
            <small id="statusHelpBlock" class="form-text text-muted">
                Le statut de l'utilisateur 
            </small>
        </div>

            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    