<?php

class indexModel extends Model{

    function __construct()
    {
        parent::__construct();
    }
    
    public function obtenerUbi(){
        return $this->_db->query("select *from local")->fetchAll();
    }



    



}
