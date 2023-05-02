<?php
$currentDir = __DIR__;
$root = dirname($currentDir, 2); // Remonter de deux niveaux à partir du répertoire actuel
require($root . '/php/DBManager.php');
require($root . '/php/sponsor/Sponsor.php');

class ManagerSponsor extends DBManager
{
    public function getAllSponsors()
    {
        $sponsors = [];

        $results = $this->getConnexion()->query('SELECT s.id as sponsorId, t.id as teamId, t.name as tname, s.brand as brand, t.deleted as teamDeleted
        FROM sponsor AS s
        LEFT JOIN team AS t ON s.team_id = t.id;');

        foreach ($results as $sponsor) {
            $newSponsor = new Sponsor;
            $newSponsor->setId($sponsor['sponsorId']);
            $newSponsor->setBrand($sponsor['brand']);
            $newSponsor->setTeamName($sponsor['tname']);
            $newSponsor->setTeamId($sponsor['teamId']);
            $newSponsor->setTeamDeleted($sponsor['teamDeleted']);

            $sponsors[] = $newSponsor;
        }

        return $sponsors;
    }

    public function create($sponsor)
    {
        $request = 'INSERT INTO sponsor (brand, team_id) VALUES (?, ?);';
        $query = $this->getConnexion()->prepare($request);
        $query->execute([$sponsor->getBrand(), $sponsor->getTeamId()]);

        header('refresh:0');
        return true;
    }

    public function update($sponsor)
    {
        $request = 'UPDATE sponsor SET brand = ?, team_id = ? WHERE id = ?;';
        $query = $this->getConnexion()->prepare($request);
        $query->execute([$sponsor->getBrand(), $sponsor->getTeamId(), $sponsor->getId()]);
    }

    public function delete($sponsorId)
    {
        $request = 'DELETE FROM sponsor WHERE id = ?;';
        $query = $this->getConnexion()->prepare($request);
        $query->execute([$sponsorId]);
    }


}
?>