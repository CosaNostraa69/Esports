<?php

class Sponsor
{
    private $id;
    private $brand;
    private $teamId;
    private $teamName;

    private $teamDeleted;

    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    public function getTeamId()
    {
        return $this->teamId;
    }

    public function setTeamId($teamId)
    {
        $this->teamId = $teamId;
    }

    public function getTeamName()
    {
        return $this->teamName;
    }

    public function setTeamName($teamName)
    {
        $this->teamName = $teamName;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getTeamDeleted()
    {
        return $this->teamDeleted;
    }

    public function setTeamDeleted($teamDeleted)
    {
        $this->teamDeleted = $teamDeleted;
    }
    public function isTeamDeleted()
    {
       return $this->teamDeleted == 1;
    }
}

?>