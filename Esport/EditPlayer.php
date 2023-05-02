<?php

require_once './php/player/ManagerPlayer.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $manager = new ManagerPlayer();

    if (isset($_POST['action'])) {
        $player = new Player();
        $player->setId($_POST['id']);

        if ($_POST['action'] == 'update') {
            $player->setFirstname($_POST['first_name']);
            $player->setSecondname($_POST['second_name']);
            $player->setCity($_POST['city']);
            $manager->update($player);
        } elseif ($_POST['action'] == 'delete') {
            $manager->delete($player->getId());
        }
    }
}

header('Location: player.php');