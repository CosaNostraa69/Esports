<?php

$currentDir = __DIR__;
$root = dirname($currentDir, 2);
require($root . '/php/DBManager.php');
require($root . '/php/player/Player.php');



class ManagerPlayer extends DBManager
{

    public function findById($playerID)
    {

        $request = 'SELECT * FROM player WHERE id =' . $playerID;
        $query = $this->getConnexion()->query($request);
        $foundPlayer = $query->fetch();

        if ($foundPlayer) {
            $player = new Player();
            $player->setFirstname($foundPlayer['first_name']);
            $player->setSecondname($foundPlayer['second_name']);
            $player->setCity($foundPlayer['city']);

            return $player;
        } else {
            return null;
        }
    }
    public function getAllPlayer()
    {
        $res = $this->getConnexion()->query('SELECT * FROM player');

        $players = [];

        foreach ($res as $player) {
            $newPlayer = new Player;
            $newPlayer->setFirstname($player['first_name']);
            $newPlayer->setSecondname($player['second_name']);
            $newPlayer->setCity($player['city']);
            $newPlayer->setId($player['id']);

            $players[] = $newPlayer;
        }
        return $players;
    }
    public function create($player)
    {
        $request = 'INSERT INTO player (first_name, second_name, city) VALUE (?, ?, ?)';
        $query = $this->getConnexion()->prepare($request);
        $query->execute([
            $player->getFirstname(), $player->getSecondname(), $player->getCity(),

        ]);


        header('Refresh:0');
        return true;

    }

    public function update($player)
    {
        $request = 'UPDATE player SET first_name = ?, second_name = ?, city = ? WHERE id = ?;';
        $query = $this->getConnexion()->prepare($request);
        $query->execute([$player->getFirstname(), $player->getSecondname(), $player->getCity(), $player->getId()]);
    }

    public function delete($playerID)
    {
        $request = 'DELETE FROM player WHERE id = ?;';
        $query = $this->getConnexion()->prepare($request);
        $query->execute([$playerID]);
    }

}
?>