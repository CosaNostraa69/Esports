<?php

$currentDir = __DIR__ ;
$root = dirname($currentDir, 2) ;
require($root . '/php/DBManager.php');
require($root . '/php/game/Game.php');

class ManagerGame extends DBManager{

    public function findById($gameID){

        $request = 'SELECT * FROM game WHERE id =' . $gameID;
        $query = $this->getConnexion()->query($request);
        $foundGame= $query->fetch();

        if($foundGame){
            $game = new Game();
            $game->setName($foundGame['name']);
            $game->setStation($foundGame['station']);
            $game->setFormat($foundGame['format']);  
      

            return $game;
        }else{
            return null;
        }
    }


    public function getAllGame(){
        $res = $this->getConnexion()->query('SELECT * FROM game');

        $games = [];

        foreach ($res as $game) {
            $newGame = new Game;
            $newGame->setName($game['name']);
            $newGame->setStation($game['station']);
            $newGame->setFormat($game['format']);
            $newGame->setId($game['id']);


            $games[] = $newGame;
        }
        return $games;
    }
    

    public function create(Game $game) {
        // Je prépare ma requête
        $request = 'INSERT INTO game (name, station, format) VALUE (?, ?, ?);';
        $query = $this->getConnexion()->prepare($request);

        // Je définir les valeurs de ma requete (remplace les ???)
        $query->execute([
            $game->getName(), $game->getStation(), $game->getFormat()
        ]);


        // Rafraichie la page
        header('Refresh:0');
        return true;
    }

    public function delete($gameID){
        $gameToDelete = $this->findById($gameID);

            if ($gameToDelete){
                $request = 'DELETE FROM game WHERE id = ' . $gameID;
                $query = $this->getConnexion()->prepare($request);
                $query->execute();

                header('Location:game.php');
                exit();
            }
    }
}