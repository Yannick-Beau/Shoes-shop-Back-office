<?php

namespace App\Models;

use App\Utils\Database;
use PDO;

class Category extends CoreModel {

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $subtitle;
    /**
     * @var string
     */
    private $picture;
    /**
     * @var int
     */
    private $home_order;

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
     * Get the value of subtitle
     */ 
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     */ 
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * Get the value of home_order
     */ 
    public function getHomeOrder()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     */ 
    public function setHomeOrder($home_order)
    {
        $this->home_order = $home_order;
    }

    /**
     * Méthode permettant de récupérer un enregistrement de la table Category en fonction d'un id donné
     * 
     * @param int $categoryId ID de la catégorie
     * @return Category
     */
    public function find($categoryId)
    {
        // se connecter à la BDD
        $pdo = Database::getPDO();

        // écrire notre requête
        $sql = 'SELECT * FROM `category` WHERE `id` =' . $categoryId;

        // exécuter notre requête
        $pdoStatement = $pdo->query($sql);

        // un seul résultat => fetchObject
        $category = $pdoStatement->fetchObject(self::class);

        // retourner le résultat
        return $category;
    }

    /**
     * Méthode permettant de récupérer tous les enregistrements de la table category
     * 
     * @return Category[]
     */
    public static function findAll()
    {
        $pdo = Database::getPDO();
        $sql = 'SELECT * FROM `category`';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $results;
    }

    /**
     * Récupérer les 5 catégories mises en avant sur la home
     * 
     * @return Category[]
     */
    public function findAllHomepage()
    {
        $pdo = Database::getPDO();
        $sql = '
            SELECT *
            FROM category
            WHERE home_order > 0
            ORDER BY home_order ASC
        ';
        $pdoStatement = $pdo->query($sql);
        $categories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        
        return $categories;
    }


    public static function findThreeCategories(){
        $pdo = Database::getPDO();
        $sql = '
            SELECT * FROM `category` 
            ORDER BY `id` DESC
            LIMIT 3
        ';
        $pdoStatement = $pdo->query($sql);
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, self::class);
        return $results;
    }


    public function insert()
    {
        // Récupération de l'objet PDO représentant la connexion à la DB
        $pdo = Database::getPDO();

        // Ecriture de la requête INSERT INTO (ancienne façon de faire)
        /*
        $sql = "
            INSERT INTO `category` (name, subtitle, picture)
            VALUES ('{$this->name}', '{$this->subtitle}', '{$this->picture}')
        ";
        */

        $sql = "
            INSERT INTO `category` (name, subtitle, picture)
            VALUES (:name, :subtitle, :picture)
        ";

        // Préparation de la requête d'insertion (+ sécurisé que exec directement)
        // @see https://www.php.net/manual/fr/pdo.prepared-statements.php
        //
        // Permet de lutter contre les injections SQL
        // @see https://portswigger.net/web-security/sql-injection (exemples avec SELECT)
        // @see https://stackoverflow.com/questions/681583/sql-injection-on-insert (exemples avec INSERT INTO)

        $query = $pdo->prepare($sql);
        //dump($query);

        // on utilise ma methode bindValue pour chaque token/jeton/placeholder
        $query->bindValue(':name', $this->name, PDO::PARAM_STR);
        $query->bindValue(':subtitle', $this->subtitle, PDO::PARAM_STR);
        $query->bindValue(':picture', $this->picture, PDO::PARAM_STR);

        
        // pour terminer j'execute la requete grace a la methode execute()
        $query->execute();

        //dump($query);

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



}
