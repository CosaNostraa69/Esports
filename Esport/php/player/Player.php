<?php

class Player{

    private $firstname; 
    private $secondname;
    private $city;

    private $id;
    
    public function getFirstname() { 
        return $this->firstname;
    }

    public function setFirstname($firstname) { 
        $this->firstname = $firstname;
    }

    public function getSecondname() { 
        return $this->secondname;
    }

    public function setSecondname($secondame) { 
        $this->secondname = $secondame;
    }

    public function getCity() { 
        return $this->city;
    }

    public function setCity($city) { 
        $this->city = $city;
    }

    public function getId() { 
        return $this->id;
    }

    public function setId($id) { 
        $this->id = $id;
    }
}

?>