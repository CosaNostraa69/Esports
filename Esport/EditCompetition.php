<?php

require_once './php/competition/ManagerCompetition.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $manager = new ManagerCompetition();

    if (isset($_POST['action'])) {
        $competition = new Competition();
        $competition->setId($_POST['id']);

        if ($_POST['action'] == 'update') {
            $competition->setName($_POST['name']);
            $competition->setDescription($_POST['description']);
            $competition->setCity($_POST['city']);
            $competition->setFormat($_POST['format']);
            $competition->setCashprize($_POST['cash_prize']);
            $manager->update($competition);
        } elseif ($_POST['action'] == 'delete') {
            $manager->delete($competition->getId());
        }
    }
}

header('Location: competition.php');