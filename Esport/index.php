<?php
require('./php/sponsor/ManagerSponsor.php');
require('./php/team/ManagerTeam.php');


$managerSponsor = new ManagerSponsor();
$allSponsor = $managerSponsor->getAllSponsors();

$managerTeam = new ManagerTeam();
$allTeam = $managerTeam->getAllTeam();

if (!empty($_POST['brand']) && (!empty($_POST['team_id']))) {
    $newSponsor = new Sponsor();
    $newSponsor->setBrand($_POST['brand']);
    $newSponsor->setTeamId(intval($_POST['team_id']));
    $managerSponsor->create($newSponsor);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Esport</title>
</head>

<body>
    <div class="background-container">
        <div class="overlay"></div>
    </div>
    <div class="mainContainer d-flex flex-column mt-3">
        <?php
        include($root . '/assets/navbar.php');
        ?>
        <div class="d-flex w-100 justify-content-evenly mt-5 contentWrapper">
            <table class="table  table-borderless text-white">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Team</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $editSponsorId = null;
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
                        $editSponsorId = $_POST['edit'];
                    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel'])) {
                        $editSponsorId = null;
                    }

                    foreach ($allSponsor as $index => $sponsor) {
               
                        $isEditMode = isset($editSponsorId) && $editSponsorId == $sponsor->getId();
                        echo '<tr custom-row>';
                        echo '<form method="post" action="' . ($isEditMode ? 'EditSponsor.php' : 'index.php') . '">'; // Changez l'attribut action ici
                        echo '<td class="custom-cell">' . ($index + 1) . '</th>';
                        echo '<td class="custom-cell">';
                        if ($isEditMode) {
                            echo '<input type="text" name="brand" value="' . $sponsor->getBrand() . '">';
                        } else {
                            echo $sponsor->getBrand();
                        }
                        echo '</td>';
                        echo '<td class="custom-cell">';
                        if ($isEditMode) {
                            echo '<select name="teamId" class="form-control">';
                            foreach ($allTeam as $team) {
                                $selected = $team->getId() == $sponsor->getTeamId() ? 'selected' : '';
                                echo '<option value="' . $team->getId() . '" ' . $selected . '>' . $team->getName() . '</option>';
                            }
                            echo '</select>';
                        } else {
                      
                            if ($sponsor->isTeamDeleted()) {
                                echo "Deleted Team";
                            } else {
                                echo $sponsor->getTeamName();
                            }
                        }
                    

                        echo '</td>';
                        if ($isEditMode) {
                            echo '<input type="hidden" name="sponsorId" value="' . $sponsor->getId() . '">';

                            // bouton Save
                            echo '<td class="action-row"><form method="post" action="EditSponsor.php">';
                            echo '<input type="hidden" name="action" value="update">';
                            echo '<input type="hidden" name="sponsorId" value="' . $sponsor->getId() . '">';
                            echo '<button type="submit" class="btn btn-primary">Save</button>';
                            echo '</form></td>';

                            // bouton Delete
                            echo '<td class="action-row"><form method="post" action="EditSponsor.php">';
                            echo '<input type="hidden" name="action" value="delete">';
                            echo '<input type="hidden" name="sponsorId" value="' . $sponsor->getId() . '">';
                            echo '<button type="submit" class="btn btn-danger">Delete</button>';
                            echo '</form><td>';

                            // bouton Annuler
                            echo '<td class="action-row"><form method="post" action="index.php">';
                            echo '<button type="submit" class="btn btn-secondary">Cancel</button>';
                            echo '</form></td>';

                            // Mobile version
                            echo '</form>';
                            echo '</tr>';
                            echo '<tr class="mobile-action-row">';
                            echo '<td colspan="3" class="mobile-action-cell">';
                            echo '<div class="mobile-action-container">';

                            echo '<form method="post" action="EditSponsor.php">';
                            echo '<input type="hidden" name="action" value="update">';
                            echo '<input type="hidden" name="sponsorId" value="' . $sponsor->getId() . '">';

                            // bouton Save
                            echo '<button type="submit" class="btn btn-primary">Save</button>';
                            echo '</form>';

                            // bouton Delete
                            echo '<form method="post" action="EditSponsor.php">';
                            echo '<input type="hidden" name="action" value="delete">';
                            echo '<input type="hidden" name="sponsorId" value="' . $sponsor->getId() . '">';
                            echo '<button type="submit" class="btn btn-danger">Delete</button>';
                            echo '</form>';

                            // bouton Annuler
                            echo '<form method="post" action="index.php">';
                            echo '<button type="submit" class="btn btn-secondary">Cancel</button>';
                            echo '</form>';

                            echo '</div>'; // Fermeture de .mobile-action-container
                            echo '</td>'; // Fermeture de .mobile-action-cell
                            echo '</tr>'; // Fermeture de .mobile-action-row
                        } else {
                            echo '<input type="hidden" name="edit" value="' . $sponsor->getId() . '">';
                            echo '<td class="custom-cell action-row edit-cell"><button type="submit" class="btn btn-primary">Edit</button></td>';
                            echo '</form>';
                            echo '</tr>';
                        }
                        echo '</form>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
            <form class="text-white" method="POST" action="./index.php" class="w-30">
                <div class="mb-3">
                    <label for="brand" class="form-label">Brand</label>
                    <input type="text" name="brand" class="form-control" id="brand" aria-describedby="brand">
                </div>
                <div class="mb-3">
                    <label for="team_id" class="form-label">Team</label>
                    <select name="team_id" id="team_d" class="form-control" aria-describedby="team_id">
                        <?php
                        foreach ($allTeam as $team) {
                            echo '<option value="' . $team->getId() . '">' . $team->getName() . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" value="Envoyer" class="btn btn-primary"></input>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>