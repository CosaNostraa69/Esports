<?php

require_once './php/game/ManagerGame.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $manager = new ManagerGame();

    if (isset($_POST['action'])) {
        $game = new Game();
        $game->setId($_POST['gameId']);

        if ($_POST['action'] == 'update') {
            $game->setName($_POST['name']);
            $game->setStation($_POST['station']);
            $game->setFormat($_POST['format']);
            $manager->update($game);
        } elseif ($_POST['action'] == 'delete') {
            $manager->delete($game->getId());
        }
    }
}

header('Location: game.php');