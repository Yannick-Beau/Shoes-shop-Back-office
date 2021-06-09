<?php

namespace App\Models;

// Classe mère de tous les Models
// On centralise ici toutes les propriétés et méthodes utiles pour TOUS les Models
abstract class CoreModel {
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $created_at;
    /**
     * @var string
     */
    protected $updated_at;

    //! TOUS LES ENFANTS DE COREMODELS DOIVENT
    //! OBLIGATOIREMENT
    //! AVOIR DES METHODES find($id), findAll(), insert() ...etc.

    abstract static public function find($id);
    abstract static public function findAll();
    abstract public function insert();
    abstract public function update();
    abstract public function delete();




    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId() 
    {
        return $this->id;
    }

    /**
     * Get the value of created_at
     *
     * @return  string
     */ 
    public function getCreatedAt() : string
    {
        return $this->created_at;
    }

    /**
     * Get the value of updated_at
     *
     * @return  string
     */ 
    public function getUpdatedAt() : string
    {
        if($this->updated_at !== null){
            return $this->updated_at;
        } else {
            return "vide !";
        }
        
    }

    public function save() 
    {
        // je dois choisir si je vais faire un insert() ou un update()
        if($this->id != null){
            return $this->update();
        } else {
            return $this->insert();
        }

    }


}








//$coreModelObject = new CoreModel;
//echo 'je viens d\'instancier CoreModel';
//die();