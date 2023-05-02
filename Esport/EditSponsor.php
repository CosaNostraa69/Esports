<?php

require_once './php/sponsor/ManagerSponsor.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $manager = new ManagerSponsor();

    if (isset($_POST['action'])) {
        $sponsor = new Sponsor();
        $sponsor->setId($_POST['sponsorId']);

        if ($_POST['action'] == 'update') {
            $sponsor->setTeamId($_POST['teamId']);
            $sponsor->setBrand($_POST['brand']);
            $manager->update($sponsor);
        } elseif ($_POST['action'] == 'delete') {
            $manager->delete($sponsor->getId());
        }
    }
}

header('Location: index.php');