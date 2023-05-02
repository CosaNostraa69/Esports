<?php

require_once './php/team/ManagerTeam.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $manager = new ManagerTeam();

    if (isset($_POST['action'])) {
        $team = new Team();
        $team->setId($_POST['id']);

        if ($_POST['action'] == 'update') {
            $team->setName($_POST['name']);
            $team->setDescription($_POST['description']);
            $manager->update($team);
        } elseif ($_POST['action'] == 'delete') {
            $manager->delete($team->getId());
        }
    }
}

header('Location: team.php');