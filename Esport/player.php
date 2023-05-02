<?php
require('./php/player/ManagerPlayer.php');

$managerPlayer = new ManagerPlayer();
$allPlayers = $managerPlayer->getAllPlayer();


if (!empty($_POST['firstname']) && isset($_POST['secondname']) && isset($_POST['city'])) {
    $newPlayer = new Player();

    $newPlayer->setFirstname($_POST['first_name']);
    $newPlayer->setSecondname($_POST['second_name']);
    $newPlayer->setCity($_POST['city']);

    $managerPlayer->create($newPlayer);
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
    <title>Player</title>
</head>

<body>
    <div class="background-container">
        <div class="overlay"></div>
    </div>
    <div class="mainContainer d-flex flex-column mt-3">

        <?php
        $currentDir = __DIR__;
        $root = dirname($currentDir, 2); // Remonter de deux niveaux à partir du répertoire actuel
        include('./assets/navbar.php');
        ?>

        <div class="d-flex w-100 justify-content-evenly mt-5 contentWrapper">
            <table class="table table-borderless text-white">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Second Name</th>
                        <th scope="col">City</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $editPlayerId = null;
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
                        $editPlayerId = $_POST['edit'];
                    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel'])) {
                        $editPlayerId = null;
                    }

                    foreach ($allPlayers as $index => $player) {
                        $isEditMode = $editPlayerId == $player->getId();
                        echo '<tr custom-row>';
                        echo '<form method="post" action="' . ($isEditMode ? 'EditPlayer.php' : 'player.php') . '">'; // Changez l'attribut action ici
                        echo '<td class="custom-cell">' . ($index + 1) . '</th>';
                        echo '<td class="custom-cell">';
                        if ($isEditMode) {
                            echo '<input type="text" name="first_name" value="' . $player->getFirstname() . '">';

                        } else {
                            echo $player->getFirstname();
                        }
                        echo '</td>';
                        echo '<td class="custom-cell">';
                        if ($isEditMode) {
                            echo '<input type="text" name="second_name" value="' . $player->getSecondname() . '">';
                        } else {
                            echo $player->getSecondname();
                        }
                        echo '</td>';
                        echo '<td class="custom-cell">';
                        if ($isEditMode) {
                            echo '<input type="text" name="city" value="' . $player->getCity() . '">';
                        } else {
                            echo $player->getCity();
                        }
                        echo '</td>';

                        if ($isEditMode) {
                            echo '<input type="hidden" name="id" value="' . $player->getId() . '">';

                            // bouton Save
                            echo '<td class="action-row"><form method="post" action="EditPlayer.php">';
                            echo '<input type="hidden" name="action" value="update">';
                            echo '<input type="hidden" name="id" value="' . $player->getId() . '">';
                            echo '<button type="submit" class="btn btn-primary">Save</button>';
                            echo '</form></td>';

                            // bouton Delete
                            echo '<td class="action-row"><form method="post" action="EditPlayer.php">';
                            echo '<input type="hidden" name="action" value="delete">';
                            echo '<input type="hidden" name="id" value="' . $player->getId() . '">';
                            echo '<button type="submit" class="btn btn-danger">Delete</button>';
                            echo '</form><td>';

                            // bouton Annuler
                            echo '<td class="action-row"><form method="post" action="player.php">';
                            echo '<button type="submit" class="btn btn-secondary">Cancel</button>';
                            echo '</form></td>';

                            // Mobile version
                            echo '</form>';
                            echo '</tr>';
                            echo '<tr class="mobile-action-row">';
                            echo '<td colspan="3" class="mobile-action-cell">';
                            echo '<div class="mobile-action-container">';

                            echo '<form method="post" action="EditPlayer.php">';
                            echo '<input type="hidden" name="action" value="update">';
                            echo '<input type="hidden" name="id" value="' . $player->getId() . '">';

                            // bouton Save
                            echo '<button type="submit" class="btn btn-primary">Save</button>';
                            echo '</form>';

                            // bouton Delete
                            echo '<form method="post" action="EditPlayer.php">';
                            echo '<input type="hidden" name="action" value="delete">';
                            echo '<input type="hidden" name="id" value="' . $player->getId() . '">';
                            echo '<button type="submit" class="btn btn-danger">Delete</button>';
                            echo '</form>';

                            // bouton Annuler
                            echo '<form method="post" action="player.php">';
                            echo '<button type="submit" class="btn btn-secondary">Cancel</button>';
                            echo '</form>';

                            echo '</div>'; // Fermeture de .mobile-action-container
                            echo '</td>'; // Fermeture de .mobile-action-cell
                            echo '</tr>'; // Fermeture de .mobile-action-row
                        } else {
                            echo '<input type="hidden" name="edit" value="' . $player->getId() . '">';
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
            <!-- Formulaire -->
            <!-- Prénom -->
            <form class="text-white" action="./player.php" class="w-30" method="post">
                <div class="mb-3">
                    <label for="firstname" class="form-label">Prénom</label>
                    <input type="text" name="firstname" class="form-control" id="firstname"
                        aria-describedby="firstname">
                </div>
                <!-- Nom -->
                <div class="mb-3">
                    <label for="secondname" class="form-label">Nom</label>
                    <input type="text" name="secondname" class="form-control" id="secondname"
                        aria-describedby="secondname">
                </div>
                <!-- Ville -->
                <div class="mb-3">
                    <label for="city" class="form-label">Ville</label>
                    <input type="text" name="city" class="form-control" id="city" aria-describedby="city">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
</body>

</html>