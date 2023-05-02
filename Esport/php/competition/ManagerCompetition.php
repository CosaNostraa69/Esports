<?php
    
    $currentDir = __DIR__;
$root = dirname($currentDir, 2); // Remonter de deux niveaux à partir du répertoire actuel
require($root . '/php/DBManager.php');
require($root . '/php/competition/Competition.php');


    class ManagerCompetition extends DBManager{

        public function findById($competitionID){

            $request = 'SELECT * FROM competition WHERE id =' . $competitionID;
            $query = $this->getConnexion()->query($request);
            $foundCompetition= $query->fetch();

            if($foundCompetition){
                $competition = new Competition();
                $competition->setName($foundCompetition['name']);
                $competition->setDescription($foundCompetition['description']);
                $competition->setCity($foundCompetition['city']);  
                $competition->setFormat($foundCompetition['format']);  
                $competition->setCashprize($foundCompetition['cash_prize']); 

                return $competition;
            }else{
                return null;
            }
        }

        public function getAllCompetition(){
            $res = $this->getConnexion()->query('SELECT * FROM competition');

            $competitions=[];

            foreach ($res as $competition){
                $newCompetition= new Competition;
                $newCompetition->setName($competition['name']);
                $newCompetition->setDescription($competition['description']);
                $newCompetition->setCity($competition['city']);  
                $newCompetition->setFormat($competition['format']);  
                $newCompetition->setCashprize($competition['cash_prize']);
                $newCompetition->setId($competition['id']);
  


                $competitions[] =$newCompetition;
            }

            return $competitions;
        }

        public function create($competition){
            $request ='INSERT INTO competition(name, description, city, format, cash_prize) VALUE (?, ?, ?, ?, ?)';
            $query= $this->getConnexion()->prepare($request);
            $query->execute([
                $competition->getName(), $competition->getDescription(), $competition->getCity(), $competition->getFormat(), $competition->getCashprize()
            
            ]);


        header('Refresh:0');
        return true;
    
        }


        public function update($competition)
        {
            $request = 'UPDATE competition SET name = ?, description = ?, city = ?, format = ?, cash_prize = ? WHERE id = ?;';
            $query = $this->getConnexion()->prepare($request);
            $query->execute([$competition->getName(), $competition->getDescription(), $competition->getCity(), $competition->getFormat(), $competition->getCashprize(), $competition->getId()]);
        }
    
        public function delete($competitionId)
        {
            // Marque l'équipe comme supprimée en mettant à jour le champ `deleted`
            $request = 'DELETE FROM competition WHERE id = ?;';
            $query = $this->getConnexion()->prepare($request);
            $query->execute([$competitionId]);
        }
    }
?>