<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Tag extends CoreModel {

  private $name;

  public static function find($tagId)
  {

  }

  public static function findAll()
  {

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
      //@TODO

  }

  public function update()
  {
      //@TODO
  }

  public function delete()
  {
      //@TODO
  }




}