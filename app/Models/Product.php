<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

/**
 * Une instance de Product = un produit dans la base de données
 * Product hérite de CoreModel
 */
class Product extends CoreModel {
    
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var float
     */
    private $price;
    /**
     * @var int
     */
    private $rate;
    /**
     * @var int
     */
    private $status;
    /**
     * @var int
     */
    private $brand_id;
    /**
     * @var int
     */
    private $category_id;
    /**
     * @var int
     */
    private $type_id;
    
    /**
     * Méthode permettant de récupérer un enregistrement de la table Product en fonction d'un id donné
     * 
     * @param int $productId ID du produit
     * @return Product
     */
    public static function find($productId)
    {
        // récupérer un objet PDO = connexion à la BDD
        $pdo = Database::getPDO();

        // on écrit la requête SQL pour récupérer le produit
        $sql = '
            SELECT *
            FROM product
            WHERE id = ' . $productId;

        // query ? exec ?
        // On fait de la LECTURE = une récupration => query()
        // si on avait fait une modification, suppression, ou un ajout => exec
        $pdoStatement = $pdo->query($sql);

        // fetchObject() pour récupérer un seul résultat
        // si j'en avais eu plusieurs => fetchAll
        $result = $pdoStatement->fetchObject(self::class);
        
        return $result;
    }

    public static function findThreeProducts(){
        $pdo = Database::getPDO();
        $sql = '
            SELECT * FROM `product` 
            ORDER BY `id` DESC
            LIMIT 3
        ';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        return $results;
    }

    public function insert()
    {
        $pdo = Database::getPDO();

        $sql = "
            INSERT INTO `product` (
                name, 
                description, 
                picture,
                price,
                rate,
                status,
                brand_id,
                category_id,
                type_id
            )
            VALUES (
                :name, 
                :description, 
                :picture,
                :price,
                :rate,
                :status,
                :brand_id,
                :category_id,
                :type_id
            )
        ";


        $query = $pdo->prepare($sql);

        $query->bindValue(':name', $this->name, PDO::PARAM_STR);
        $query->bindValue(':description', $this->description, PDO::PARAM_STR);
        $query->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $query->bindValue(':price', $this->price);
        $query->bindValue(':rate', $this->rate, PDO::PARAM_INT);
        $query->bindValue(':status', $this->status, PDO::PARAM_INT);
        $query->bindValue(':brand_id', $this->brand_id, PDO::PARAM_INT);
        $query->bindValue(':category_id', $this->category_id, PDO::PARAM_INT);
        $query->bindValue(':type_id', $this->type_id, PDO::PARAM_INT);

        $query->execute();


        

       if($query->rowCount() > 0){
        $this->id = $pdo->lastInsertId();
        return true;
       }
       // si on arrive ici, c'est qu'on a eu un pépéin
       return false;

    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table product
     * 
     * @return Product[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `product`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'App\Models\Product');
        
        return $results;
    }

    public function update()
    {
        $pdo = Database::getPDO();
        // on écrit la requete sql
        $sql = "
            UPDATE `product`
            SET
                `name` = :name,
                `description` = :description,
                `picture` = :picture,
                `price` = :price,
                `rate` = :rate,
                `status` = :status,
                `brand_id` = :brand_id,
                `category_id` = :category_id,
                `type_id` = :type_id,
                `updated_at` = NOW()
            WHERE id = :id
        ";
        $query = $pdo->prepare($sql);
        // on fait les bindValue
        $query->bindValue(':name', $this->name, PDO::PARAM_STR);
        $query->bindValue(':description', $this->description, PDO::PARAM_STR);
        $query->bindValue(':picture', $this->picture, PDO::PARAM_STR);
        $query->bindValue(':price', $this->price, PDO::PARAM_INT);
        $query->bindValue(':rate', $this->rate, PDO::PARAM_INT);
        $query->bindValue(':status', $this->status, PDO::PARAM_INT);
        $query->bindValue(':brand_id', $this->brand_id, PDO::PARAM_INT);
        $query->bindValue(':category_id', $this->category_id, PDO::PARAM_INT);
        $query->bindValue(':type_id', $this->type_id, PDO::PARAM_INT);
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
            DELETE FROM `product`
            WHERE id = :id
        ";
        $query = $pdo->prepare($sql);
        $query->bindValue(':id', $this->id, PDO::PARAM_INT);
        $query->execute();
        return ($query->rowCount() > 0);
    }

    /**
     * Get the value of name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param  string  $name
     */ 
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of description
     *
     * @return  string
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @param  string  $description
     */ 
    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    /**
     * Get the value of picture
     *
     * @return  string
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @param  string  $picture
     */ 
    public function setPicture(string $picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of price
     *
     * @return  float
     */ 
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set the value of price
     *
     * @param  float  $price
     */ 
    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    /**
     * Get the value of rate
     *
     * @return  int
     */ 
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     *
     * @param  int  $rate
     */ 
    public function setRate(int $rate)
    {
        $this->rate = $rate;
    }

    /**
     * Get the value of status
     *
     * @return  int
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  int  $status
     */ 
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * Get the value of brand_id
     *
     * @return  int
     */ 
    public function getBrandId()
    {
        return $this->brand_id;
    }

    /**
     * Set the value of brand_id
     *
     * @param  int  $brand_id
     */ 
    public function setBrandId($brand_id)
    {
        $this->brand_id = $brand_id;
    }

    /**
     * Get the value of category_id
     *
     * @return  int
     */ 
    public function getCategoryId()
    {
        return $this->category_id;
    }

    /**
     * Set the value of category_id
     *
     * @param  int  $category_id
     */ 
    public function setCategoryId(int $category_id)
    {
        $this->category_id = $category_id;
    }

    /**
     * Get the value of type_id
     *
     * @return  int
     */ 
    public function getTypeId()
    {
        return $this->type_id;
    }

    /**
     * Set the value of type_id
     *
     * @param  int  $type_id
     */ 
    public function setTypeId(int $type_id)
    {
        $this->type_id = $type_id;
    }
}
