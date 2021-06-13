<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Tag extends CoreModel
{

  private $name;

  public static function find($tagId)
  {
      // récupérer un objet PDO = connexion à la BDD
      $pdo = Database::getPDO();

      // on écrit la requête SQL pour récupérer le produit
      $sql = '
            SELECT *
            FROM tag
            WHERE id = ' . $tagId;

      // query ? exec ?
      // On fait de la LECTURE = une récupration => query()
      // si on avait fait une modification, suppression, ou un ajout => exec
      $pdoStatement = $pdo->query($sql);

      // fetchObject() pour récupérer un seul résultat
      // si j'en avais eu plusieurs => fetchAll
      $result = $pdoStatement->fetchObject(self::class);

      return $result;
  }

  public static function findAll()
  {
      $pdo = Database::getPDO();
      $sql = 'SELECT * FROM `tag`';
      $pdoStatement = $pdo->query($sql);
      $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Tag');

      return $results;
  }

  public static function findAllByProductId($productId)
  {
      $pdo = Database::getPDO();
      $sql = "
        SELECT `tag`.* FROM `product_has_tag`
        INNER JOIN `tag`
        ON `product_has_tag`.`tag_id` = `tag`.`id`
        WHERE `product_has_tag`.`product_id` = :product_id
      ";
      $pdoStatement = $pdo->prepare($sql);
      $pdoStatement->bindValue(':product_id', $productId, PDO::PARAM_INT);
      $pdoStatement->execute();
      $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
      return $results;
  }

  public function insert()
  {
      $pdo = Database::getPDO();

      $sql = "
          INSERT INTO `tag` (
              name 
          )
          VALUES (
              :name
          )
      ";

      $query = $pdo->prepare($sql);

      $query->bindValue(':name', $this->name, PDO::PARAM_STR);

      $query->execute();

      if ($query->rowCount() > 0) {
        $this->id = $pdo->lastInsertId();
        return true;
      }
      // si on arrive ici, c'est qu'on a eu un pépéin
      return false;
  }

  public function update()
  {
      $pdo = Database::getPDO();
      // on écrit la requete sql
      $sql = "
          UPDATE `tag`
          SET
              `name` = :name,
              `updated_at` = NOW()
          WHERE id = :id
      ";
      $query = $pdo->prepare($sql);
      // on fait les bindValue
      $query->bindValue(':name', $this->name, PDO::PARAM_STR);
      $query->bindValue(':id', $this->id, PDO::PARAM_INT);
      // on execute
      $query->execute();
      // on return true si tout s'est bien passé ! 
      // ici je me suis permis de compacter l'écriture
      // SI la condition est vrai, on va return true
      // Si la condition est fausse on va return false
      return ($query->rowCount() > 0);
  }

  public function delete()
  {
      $pdo = Database::getPDO();
      $sql = "
          DELETE FROM `tag`
          WHERE id = :id
      ";
      $query = $pdo->prepare($sql);
      $query->bindValue(':id', $this->id, PDO::PARAM_INT);
      $query->execute();
      return ($query->rowCount() > 0);
  }

  public function bindByProductId($productId)
  {
    $pdo = Database::getPDO();
    $sql ="
    INSERT INTO `product_has_tag` (product_id, tag_id)
    VALUES ( :productId, :tagId)";
    $query = $pdo->prepare($sql);

    $query->bindValue(':productId', $productId, PDO::PARAM_INT);
    $query->bindValue(':tagId', $this->getId(), PDO::PARAM_INT);

    $query->execute();

    if ($query->rowCount() > 0) {
      $this->id = $pdo->lastInsertId();
      return true;
    }
    // si on arrive ici, c'est qu'on a eu un pépéin
    return false;
  }





  /**
   * Get the value of name
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set the value of name
   *
   * @return  self
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }
}
