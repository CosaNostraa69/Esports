<?php

$currentDir = __DIR__;
$root = dirname($currentDir, 2);
require_once($root . '/php/DBManager.php');
require($root . '/php/team/Team.php');



class ManagerTeam extends DBManager
{
    public function findById($teamID){

        $request = 'SELECT * FROM team WHERE id =' . $teamID;
        $query = $this->getConnexion()->query($request);
        $foundTeam= $query->fetch();

        if($foundTeam){
            $team = new Team();
            $team->setName($foundTeam['name']);
            $team->setDescription($foundTeam['description']);
            return $team;
        }else{
            return null;
        }
    }
        public function getAllTeam()
    {
        $res = $this->getConnexion()->query('SELECT * FROM team WHERE deleted = FALSE');

        $teams = [];

        foreach ($res as $team) {
            $newTeam = new Team;
            $newTeam->setName($team['name']);
            $newTeam->setDescription($team['description']);
            $newTeam->setId($team['id']);
            $teams[] = $newTeam;
        }

        return $teams;
    }

    public function create($team)
    {

        $request = 'INSERT INTO team(name, description) VALUE (?, ?)';
        $query = $this->getConnexion()->prepare($request);
        $query->execute([
            $team->getName(), $team->getDescription()
        ]);
        header('Refresh:0');
        return true;
    }
   
    public function update($team)
    {
        $request = 'UPDATE team SET name = ?, description = ? WHERE id = ?;';
        $query = $this->getConnexion()->prepare($request);
        $query->execute([$team->getName(), $team->getDescription(), $team->getId()]);
    }

    public function delete($teamId)
    {
        // Marque l'équipe comme supprimée en mettant à jour le champ `deleted`
        $request = 'UPDATE team SET deleted = TRUE WHERE id = ?;';
        $query = $this->getConnexion()->prepare($request);
        $query->execute([$teamId]);
    }

}
?>