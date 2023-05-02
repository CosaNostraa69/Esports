<?php
require('./php/competition/ManagerCompetition.php');



$managerCompetition = new ManagerCompetition();
$allCompetitions = $managerCompetition->getAllCompetition();
if (isset($_GET['delete'])) {
    $managerCompetition->delete(intval($_GET['delete']));
}

if (!empty($_POST['name']) && isset($_POST['description']) && isset($_POST['city']) && isset($_POST['format']) && isset($_POST['cash_prize'])) {
    $newCompetition = new Competition();
    $newCompetition->setName($_POST['name']);
    $newCompetition->setDescription($_POST['description']);
    $newCompetition->setCity($_POST['city']);
    $newCompetition->setFormat($_POST['format']);
    $newCompetition->setCashprize($_POST['cash_prize']);





    $managerCompetition->create($newCompetition);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
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
            <table class="table table-borderless text-white">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">City</th>
                        <th scope="col">Format</th>
                        <th scope="col">Cashprize</th>

                    </tr>
                </thead>

                <tbody>
                    <?php

                    $editCompetitionId = null;
                    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
                        $editCompetitionId = $_POST['edit'];
                    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel'])) {
                        $editCompetitionId = null;
                    }

                    foreach ($allCompetitions as $index => $competition) {
                        $isEditMode = $editCompetitionId == $competition->getId();
                        echo '<tr custom-row>';
                        echo '<form method="post" action="' . ($isEditMode ? 'EditCompetition.php' : 'competition.php') . '">'; // Changez l'attribut action ici
                        echo '<td class="custom-cell">' . ($index + 1) . '</th>';
                        echo '<td class="custom-cell">';
                        if ($isEditMode) {
                            echo '<input type="text" name="name" value="' . $competition->getName() . '">';
                        } else {
                            echo $competition->getName();
                        }
                        echo '</td>';
                        echo '<td class="custom-cell">';
                        if ($isEditMode) {
                            echo '<input type="text" name="description" value="' . $competition->getDescription() . '">';
                        } else {
                            echo $competition->getDescription();
                        }
                        echo '</td>';
                        echo '<td class="custom-cell">';
                        if ($isEditMode) {
                            echo '<input type="text" name="city" value="' . $competition->getCity() . '">';
                        } else {
                            echo $competition->getCity();
                        }
                        echo '</td>';
                        echo '<td class="custom-cell">';
                        if ($isEditMode) {
                            echo '<input type="text" name="format" value="' . $competition->getFormat() . '">';
                        } else {
                            echo $competition->getFormat();
                        }
                        echo '</td>';
                        echo '<td class="custom-cell">';
                        if ($isEditMode) {
                            echo '<input type="text" name="cash_prize" value="' . $competition->getCashprize() . '">';
                        } else {
                            echo $competition->getCashprize();
                        }
                        echo '</td>';
                        // echo '<td class="custom-cell">';

                        // echo '</td>';
                        if ($isEditMode) {
                            echo '<input type="hidden" name="id" value="' . $competition->getId() . '">';

                            // bouton Save
                            echo '<td class="action-row"><form method="post" action="EditCompetition.php">';
                            echo '<input type="hidden" name="action" value="update">';
                            echo '<input type="hidden" name="id" value="' . $competition->getId() . '">';
                            echo '<button type="submit" class="btn btn-primary">Save</button>';
                            echo '</form></td>';

                            // bouton Delete
                            echo '<td class="action-row"><form method="post" action="EditCompetition.php">';
                            echo '<input type="hidden" name="action" value="delete">';
                            echo '<input type="hidden" name="id" value="' . $competition->getId() . '">';
                            echo '<button type="submit" class="btn btn-danger">Delete</button>';
                            echo '</form><td>';

                            // bouton Annuler
                            echo '<td class="action-row"><form method="post" action="competition.php">';
                            echo '<button type="submit" class="btn btn-secondary">Cancel</button>';
                            echo '</form></td>';

                            // Mobile version
                            echo '</form>';
                            echo '</tr>';
                            echo '<tr class="mobile-action-row">';
                            echo '<td colspan="3" class="mobile-action-cell">';
                            echo '<div class="mobile-action-container">';

                            echo '<form method="post" action="EditCompetition.php">';
                            echo '<input type="hidden" name="description" value="update">';
                            echo '<input type="hidden" name="id" value="' . $competition->getId() . '">';

                            // bouton Save
                            echo '<button type="submit" class="btn btn-primary">Save</button>';
                            echo '</form>';

                            // bouton Delete
                            echo '<form method="post" action="EditCompetition.php">';
                            echo '<input type="hidden" name="action" value="delete">';
                            echo '<input type="hidden" name="id" value="' . $competition->getId() . '">';
                            echo '<button type="submit" class="btn btn-danger">Delete</button>';
                            echo '</form>';

                            // bouton Annuler
                            echo '<form method="post" action="competition.php">';
                            echo '<button type="submit" class="btn btn-secondary">Cancel</button>';
                            echo '</form>';

                            echo '</div>'; // Fermeture de .mobile-action-container
                            echo '</td>'; // Fermeture de .mobile-action-cell
                            echo '</tr>'; // Fermeture de .mobile-action-row
                        } else {
                            echo '<input type="hidden" name="edit" value="' . $competition->getId() . '">';
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
            <form class="text-white" action="./competition.php" method="post" class="w-30">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" id="name" aria-describedby="champ1">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" name="description" class="form-control" id="description" aria-describedby="champ2">
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" name="city" class="form-control" id="city" aria-describedby="champ3">
                </div>
                <div class="mb-3">
                    <label for="format" class="form-label">Format</label>
                    <input type="text" name="format" class="form-control" id="format" aria-describedby="champ4">
                </div>
                <div class="mb-3">
                    <label for="cash_prize" class="form-label">Cashprize</label>
                    <input type="text" name="cash_prize" class="form-control" id="cash_prize" aria-describedby="champ5">
                </div>
                <input type="submit" value="Submit" class="btn btn-primary">
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>