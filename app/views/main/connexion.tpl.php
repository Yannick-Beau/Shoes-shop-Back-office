<?php 
if(!empty($errorList)){
    dump($errorList);
}

if(isset($user))
{
    echo "connexion réussi";
    
    
} else 
{
    if (isset($error)) {
        echo $error;
    }
}
?>

        <h2>Connexion</h2>
        
        <form action="" method="POST" class="mt-5">

        <div class="form-group">
            <label for="name">Email</label>
            <input type="text" class="form-control" id="name" name="email" placeholder="Email" value="">
        </div>

        <div class="form-group">
            <label for="description">Mot de passe</label>
            <input type="text" class="form-control" id="description" name="password" placeholder="Mot de passe" value="" 
                aria-describedby="descriptionHelpBlock">
        </div>

            <button type="submit" class="btn btn-primary btn-block mt-5">Valider</button>
        </form>
    