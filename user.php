<?php

class User
{
    
    private $_id;
    private $_Nom;
    private $_base;
    public function __construct($id, $nom, $basededonnees)
    {
        $this->_id = $id;
        $this->_Nom = $nom;
        $this->_base = $basededonnees;
    }
    public function getId()
    {
        return $this->_id;
    }
    public function getNom()
    {
        return $this->_Nom;
    }
    public function afficheUser()
    {

        echo '<br>Choix : ' . $this->_Nom . ' <br>ID : ' . $this->_id;
    }
    public function GiveDroit()
    {
        try {
            $this->_base->query("UPDATE `user` SET `rights` = 'admin' WHERE `user`.`id_user` =" . $this->_id . "");
            $this->_base->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } 
        catch (exception $e) {
            $e->getMessage();
        }
    }
}
