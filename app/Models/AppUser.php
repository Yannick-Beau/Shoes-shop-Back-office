<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class AppUser extends CoreModel {


  private $email;
  private $password;
  private $firstname;
  private $lastname;
  private $role;
  private $status;




  public static function findByEmail($email)
  {
    $pdo = Database::getPDO();
    //! Pas besoin de mettre le token :email entre simple quotes ! 
    // 
    $sql = '
      SELECT *
      FROM `app_user`
      WHERE email = :email
    ';

    // on utilise prepare() car $email vient d'une saisie de l'utilisateur => Pas confiance !
    $pdoStatement = $pdo->prepare($sql);

    //! ci dessous, plutot que de faire un ->bindValue(':name', $email) PUIS un execute()
    //! je peux directement dans le execute préciser a quoi correspondent les tokens
    //$pdoStatement->execute([':email' => $email]);
    // Je donne à PDO la valeur à utiliser pour remplacer ':email'
    $pdoStatement->bindValue(':email', $email);
    // on exécute la requête 
    $pdoStatement->execute();
    // on récupère le résultat sous la forme d'un objet de la classe AppUser
    $result = $pdoStatement->fetchObject(self::class);
    return $result;

  }


  /**
   * Méthode permettant la récupération d'un model en base
   */
  public static function find($userId)
  {
      // pour l'instant, la méthode ne fait rien, on l'implémente juste pour respecter les méthodes abstraites de CoreModel
  }

  /**
   * Méthode permettant la récupération de tous les models en base
   */
  public static function findAll()
  {
      // pour l'instant, la méthode ne fait rien, on l'implémente juste pour respecter les méthodes abstraites de CoreModel
      $pdo = Database::getPDO();
      $sql = 'SELECT * FROM `app_user`';
      $pdoStatement = $pdo->query($sql);
      $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
      return $results;
  }

      /**
   * Méthode permettant la création du model en base
   */
  public function insert()
  {
              // Récupération de l'objet PDO représentant la connexion à la DB
              $pdo = Database::getPDO();

              $sql = "
                  INSERT INTO `app_user` (email, password, firstname, lastname, role, status)
                  VALUES (:email, :password, :firstname, :lastname, :role, :status)
              ";
      
              $query = $pdo->prepare($sql);
              
      
              // on utilise ma methode bindValue pour chaque token/jeton/placeholder
              $query->bindValue(':email', $this->email, PDO::PARAM_STR);
              $query->bindValue(':password', $this->password, PDO::PARAM_STR);
              $query->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
              $query->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
              $query->bindValue(':role', $this->role, PDO::PARAM_STR);
              $query->bindValue(':status', $this->status, PDO::PARAM_INT);
      
              
              // pour terminer j'execute la requete grace a la methode execute()
              $query->execute();
      
              // la methode rowCount de l'objet query me permet d'obtenir le nombre
              // de ligne qui ont été affectés par la requete précédement executée
      
              // si au moins une ligne a été ajoutée
             if($query->rowCount() > 0){
              // alors on récupère l'id auto-incrémenté généré par MySQL
              $this->id = $pdo->lastInsertId();
              // puis je retounre true car l'ajout a parfaitement fonctionné
              return true;
      
             }
             // si on arrive ici, c'est qu'on a eu un pépéin
             return false;
      
  }

  /**
   * Méthode permettant la mise à jour du model en base
   */
  public function update()
  {
      // pour l'instant, la méthode ne fait rien, on l'implémente juste pour respecter les méthodes abstraites de CoreModel
  }

  /**
   * Méthode permettant la suppression du model en base
   */
  public function delete()
  {
      // pour l'instant, la méthode ne fait rien, on l'implémente juste pour respecter les méthodes abstraites de CoreModel
  }



  /**
   * Get the value of email
   */ 
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set the value of email
   *
   * @return  self
   */ 
  public function setEmail($email)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get the value of password
   */ 
  public function getPassword()
  {
    return $this->password;
  }

  /**
   * Set the value of password
   *
   * @return  self
   */ 
  public function setPassword($password)
  {
    $this->password = $password;

    return $this;
  }

  /**
   * Get the value of firstname
   */ 
  public function getFirstname()
  {
    return $this->firstname;
  }

  /**
   * Set the value of firstname
   *
   * @return  self
   */ 
  public function setFirstname($firstname)
  {
    $this->firstname = $firstname;

    return $this;
  }

  /**
   * Get the value of lastname
   */ 
  public function getLastname()
  {
    return $this->lastname;
  }

  /**
   * Set the value of lastname
   *
   * @return  self
   */ 
  public function setLastname($lastname)
  {
    $this->lastname = $lastname;

    return $this;
  }
  /**
   * Get the value of status
   */ 
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * Set the value of status
   *
   * @return  self
   */ 
  public function setStatus($status)
  {
    $this->status = $status;

    return $this;
  }

  /**
   * Get the value of role
   */ 
  public function getRole()
  {
    return $this->role;
  }

  /**
   * Set the value of role
   *
   * @return  self
   */ 
  public function setRole($role)
  {
    $this->role = $role;

    return $this;
  }
}