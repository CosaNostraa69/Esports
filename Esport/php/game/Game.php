<?php

class Game {
    private $id;
    private $name; 
    private $station;
    private $format;

    

    public function getId(){
        return $this->id;
    
    }
    
    public function setId($id){
        $this->id=$id;
    }
    public function getName() { 
        return $this->name;
    }

    public function setName($name) { 
        $this->name = $name;
    }

    public function getStation() { 
        return $this->station;
    }

    public function setStation($station) { 
        $this->station = $station;
    }

    public function getFormat() { 
        return $this->format;
    }

    public function setFormat($format) { 
        $this->format = $format;
    }

  
}

?>