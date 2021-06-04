<?php

namespace App\Models;

// Classe mère de tous les Models
// On centralise ici toutes les propriétés et méthodes utiles pour TOUS les Models
class CoreModel {
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


    /**
     * Get the value of id
     *
     * @return  int
     */ 
    public function getId() : int
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

    /**
     * Set the value of created_at
     *
     * @param  string  $created_at
     *
     * @return  self
     */ 
    public function setCreatedAt(string $created_at)
    {
        $this->created_at = $created_at;

        return $this;
    }
}
