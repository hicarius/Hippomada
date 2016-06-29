<?php
class Race_TmpModel extends RaceModel
{

    public function getRaces($date=null)
    {
        $additionalColumns = "rc.title AS category_name, rg.group_name, rp.title AS piste_name, rh.title AS hippodrome_name";
        $additionalColumns .= ", rt.title AS type_name, rt.code";
        $joins =  " INNER JOIN race_category rc ON rc.id = r.category_id";
        $joins .=  " INNER JOIN race_group rg ON rg.id = r.group_id";
        $joins .=  " INNER JOIN race_hippodrome rh ON rh.id = r.hippodrome_id";
        $joins .=  " INNER JOIN race_type rt ON rt.id = r.type_id";
        $joins .=  " INNER JOIN race_piste rp ON rp.id = r.piste_id";

        $where = '';
        if($date != null){
            $where = " WHERE r.race_date LIKE '$date%'";
        }

        $query = "SELECT r.*, $additionalColumns FROM races_tmp r  $joins $where GROUP BY r.id ORDER BY r.meeting ASC";

        $stmt = Database::prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function load($id, $setData = true)
    {
        $additionalColumns = "rc.title AS category_name, rg.group_name, rp.title AS piste_name, rh.title AS hippodrome_name";
        $additionalColumns .= ", rt.title AS type_name, rp.title AS piste_name, rt.code";
        $joins =  " INNER JOIN race_category rc ON rc.id = r.category_id";
        $joins .=  " INNER JOIN race_group rg ON rg.id = r.group_id";
        $joins .=  " INNER JOIN race_hippodrome rh ON rh.id = r.hippodrome_id";
        $joins .=  " INNER JOIN race_type rt ON rt.id = r.type_id";
        $joins .=  " INNER JOIN race_piste rp ON rp.id = r.piste_id";
        $query = "SELECT r.*, $additionalColumns FROM races_tmp r  $joins WHERE r.id = :id GROUP BY r.id";
        $stmt = Database::prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result['id']>0) {
            if($setData) {
                $this->_data = $result;
                return $this;
            }else{
                return $result;
            }
        } else {
            return FALSE;
        }
    }

    public function create($data)
    {
        try{

            $query = "INSERT INTO races_tmp (name, category_id, group_id, type_id, piste_id, hippodrome_id, meeting, lenght, corde, race_date, price, recul_gain, recul_meter, max_gain, age_min, age_max, sexe, victory_price, status, created_at )
 				  VALUES(:name, :category_id, :group_id, :type_id, :piste_id, :hippodrome_id, :meeting, :lenght, :corde, :race_date, :price, :recul_gain, :recul_meter, :max_gain, :age_min, :age_max, :sexe, :victory_price, :status, :created_at)";
            $stmt = Database::prepare($query);

            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->bindParam(':group_id', $data['group_id']);
            $stmt->bindParam(':type_id', $data['type_id']);
            $stmt->bindParam(':piste_id', $data['piste_id']);
            $stmt->bindParam(':hippodrome_id', $data['hippodrome_id']);
            $stmt->bindParam(':meeting', $data['meeting']);
            $stmt->bindParam(':lenght', $data['lenght']);
            $stmt->bindParam(':corde', $data['corde']);
            $stmt->bindParam(':race_date', $data['race_date']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':recul_gain', $data['recul_gain']);
            $stmt->bindParam(':recul_meter', $data['recul_meter']);
            $stmt->bindParam(':max_gain', $data['max_gain']);
            $stmt->bindParam(':age_min', $data['age_min']);
            $stmt->bindParam(':age_max', $data['age_max']);
            $stmt->bindParam(':sexe', $data['sexe']);
            $stmt->bindParam(':victory_price', $data['victory_price']);
            $stmt->bindParam(':status', $data['status']);
            $stmt->bindParam(':created_at', date('Y-m-d H:i:s'));

            $stmt->execute();

            return Database::lastInsertId('races_tmp');
        }catch (Exception $e){
            $this->addMessage($e->getMessage(), 'danger');
            return FALSE;
        }
    }


    public function update($data)
    {
        try{

            $query = "UPDATE races_tmp
                      SET name = :name, category_id = :category_id, group_id = :group_id, type_id = :type_id, piste_id = :piste_id,
                                        hippodrome_id = :hippodrome_id, meeting = :meeting,
                                        lenght = :lenght, corde = :corde, race_date = :race_date, sexe = :sexe,
                                        price = :price, recul_gain = :recul_gain, recul_meter = :recul_meter, max_gain = :max_gain,
                                        age_min = :age_min, age_max = :age_max, victory_price = :victory_price, status = :status
                     WHERE id = :id";
            $stmt = Database::prepare($query);

            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->bindParam(':group_id', $data['group_id']);
            $stmt->bindParam(':type_id', $data['type_id']);
            $stmt->bindParam(':piste_id', $data['piste_id']);
            $stmt->bindParam(':hippodrome_id', $data['hippodrome_id']);
            $stmt->bindParam(':meeting', $data['meeting']);
            $stmt->bindParam(':lenght', $data['lenght']);
            $stmt->bindParam(':corde', $data['corde']);
            $stmt->bindParam(':race_date', $data['race_date']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':recul_gain', $data['recul_gain']);
            $stmt->bindParam(':recul_meter', $data['recul_meter']);
            $stmt->bindParam(':max_gain', $data['max_gain']);
            $stmt->bindParam(':age_min', $data['age_min']);
            $stmt->bindParam(':age_max', $data['age_max']);
            $stmt->bindParam(':sexe', $data['sexe']);
            $stmt->bindParam(':victory_price', $data['victory_price']);
            $stmt->bindParam(':status', $data['status']);

            $stmt->execute();

            return $data['id'];
        }catch (Exception $e){
            $this->addMessage($e->getMessage(), 'danger');
            return FALSE;
        }
    }

    /////////////////////////////////////////////////////////////////////
    ///////////////////GETTER/////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////

    public function getValidRaceForEngagement($data)
    {
        $dateMax = date('Y-m-d', strtotime('+30days'));
        $curDate = date('Y-m-d');
        $horse = Apps::getModel('Horse')->load($data['horse_id'], false);
        $aTypeCodes = ($horse['specialization'] == 'T') ? array('a', 'm') : array('p') ;

        $query = "SELECT rt.*, rc.title AS category_name, rp.title AS piste_name, rty.code, rg.group_name FROM races_tmp rt";
        $query .=  " LEFT JOIN race_category rc ON rc.id = rt.category_id";
        $query .= " LEFT JOIN race_type rty ON rty.id = rt.type_id ";
        $query .= " LEFT JOIN race_group rg ON rg.id = rt.group_id";
        $query .=  " LEFT JOIN race_piste rp ON rp.id = rt.piste_id";
        $query .= " WHERE (rt.age_min <= :age AND rt.age_max >= :age )";
        $query .= " AND rt.sexe LIKE  '%{$horse['sexe']}%'";
        $query .= " AND ( rt.race_date >= :curDate AND rt.race_date <= :dateMax)";
        $query .= " AND rty.code IN ('".implode("','", $aTypeCodes)."')";
        $query .= " AND rt.status = 1";

        if(!$horse['is_qualified']){
            $query .= " AND rt.category_id = 3";
        }else{
            $query .= " AND rt.max_gain >= :gains";
        }

        $stmt = Database::prepare($query);
        $stmt->bindParam(':gains', $horse['gains']);
        $stmt->bindParam(':age', $horse['age']);
        $stmt->bindParam(':curDate', $curDate);
        $stmt->bindParam(':dateMax', $dateMax);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function setEngagedThisRace($data)
    {
        $sessionUser = Session::getUser();

        //get current banque
        $stable = Apps::getModel('Stable')->load($sessionUser['id'])->getData();

        if( $stable['banque'] >= $data['price']){
            //Deduction du montant d'engagement
            $query = "UPDATE stables s SET s.banque = (s.banque - :price) WHERE s.id=:id";
            $stmt = Database::prepare($query);
            $stmt->bindParam(':id', $sessionUser['id'], PDO::PARAM_INT);
            $stmt->bindParam(':price', $data['price']);
            $stmt->execute();

            //@todo: Ajout code pour le livre de compte du  - $data['price']

            //Inscription
            $query = "INSERT INTO race_participant_tmp (race_tmp_id, horse_id, status )
 				  VALUES(:race_tmp_id, :horse_id, 1)";
            $stmt = Database::prepare($query);
            $stmt->bindParam(':race_tmp_id', $data['race_id'], PDO::PARAM_INT);
            $stmt->bindParam(':horse_id', $data['horse_id'], PDO::PARAM_INT);
            $stmt->execute();
        }
    }

    public function setDisengagedThisRace($data)
    {
        $sessionUser = Session::getUser();
        //get current race price
        $race = Apps::getModel('Race_Tmp')->load($data['race_id'])->getData();

        //Deduction du montant d'engagement
        $query = "UPDATE stables s SET s.banque = (s.banque + :price) WHERE s.id= :id" ;
        $stmt = Database::prepare($query);
        $stmt->bindParam(':id', $sessionUser['id'], PDO::PARAM_INT);
        $stmt->bindParam(':price', $race['price']);
        $stmt->execute();

        //@todo: Ajout code pour le livre de compte du  + $data['price']

        //Inscription
        $query = "DELETE FROM race_participant_tmp
                  WHERE race_tmp_id = :race_tmp_id AND horse_id = :horse_id";
        $stmt = Database::prepare($query);
        $stmt->bindParam(':race_tmp_id', $data['race_id']);
        $stmt->bindParam(':horse_id', $data['horse_id']);
        $stmt->execute();
    }

    /**
     * @param null $raceId
     * @return array
     */
    public function getHorsesEngaged($raceId = null)
    {
        $additionalColumns = ", h.name, h.age, h.sexe, h.id as horse_id";
        $additionalColumns .= ", CONCAT_WS(' ', s2.firstname, s2.lastname) AS entraineur  ";
        $additionalColumns .= ", CONCAT_WS(' ', s3.firstname, s3.lastname) AS jockey ";
        $joins =  " INNER JOIN horses h ON h.id = rp.horse_id";
        $joins .=  " INNER JOIN stables s2 ON s2.id = h.trainer_id";
        $joins .=  " LEFT JOIN stables s3 ON s3.id = rp.jockey_id";

        $query = "SELECT rp.* $additionalColumns FROM race_participant_tmp rp $joins";
        $query .= " WHERE rp.race_tmp_id = :race_tmp_id";
        $stmt = Database::prepare($query);

        if($raceId==null){
            $stmt->bindParam(':race_tmp_id', $this->_data['id'], PDO::PARAM_INT);
        }else{
            $stmt->bindParam(':race_tmp_id',  $raceId, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRacePrize($race)
    {
        $html = '';
        if($race['victory_price']){
            $data = explode('|', $race['victory_price']);
            $html .= "<b>Gain :</b> ".number_format($data[0], 0, '.', ' ')." (".number_format($data[1], 0, '.', ' ').", ".number_format($data[2], 0, '.', ' ').",
            ".number_format($data[3], 0, '.', ' ').", ".number_format($data[4], 0, '.', ' ').", ".number_format($data[5], 0, '.', ' ').")";
        }
        return $html;
    }

    public function getAllRaceDay()
    {
        $date = date('Y-m-d');
        $query = "SELECT id FROM races_tmp WHERE race_date LIKE '$date%' ORDER BY meeting ASC";
        $stmt = Database::prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if($result){
            return $result;
        }else{
            return false;
        }
    }

    public function validRace($raceTmpId)
    {
        $gpP = array('0', 'A', 'B', 'C', 'D', 'E');

        $raceModel = Apps::getModel('Race');

        //collect race_tmp information
        $race_tmp = $this->load($raceTmpId)->getData();
        //Debugger::dump($race_tmp);

        //collect race_participant_tmp information
        $race_part_tmp = $this->getHorsesEngaged();

        //get number of group to create
        $nbrGroup = ceil(count($race_part_tmp)/RACE_GROUP_PARTICIPANT_MAX);

        if(count($race_part_tmp) > 0) {

            //création de race groupe
            $nextParticipant = 1;
            $debut = 0;
            for ($i = 1; $i <= $nbrGroup; $i++) {
                $data = $race_tmp;
                if ($nbrGroup > 1) {
                    $data['name'] = "{$data['name']} {$gpP[$i]} ";
                }
                $data['status'] = 2; //fermée
                $data['race_number'] = $raceModel->getNextRaceNumberForMeeting(date('Y-m-d', strtotime($data['race_date'])), $data['meeting']);
                $data['race_date'] = $raceModel->getNextRaceDateForJourney(date('Y-m-d', strtotime($data['race_date'])));
                $raceId = $raceModel->create($data);

                $numberInRace = RACE_GROUP_PARTICIPANT_MAX;
                $participants = array_slice($race_part_tmp, $debut, $numberInRace);

                //add participant
                $numero = 1;
                foreach ($participants as $k => $participant) {
                    $data_p = array(
                        'race_id' => $raceId,
                        'horse_id' => $participant['horse_id'],
                        'jockey_id' => $participant['jockey_id'],
                        'is_recul' => $participant['is_recul'],
                        'numero' => $numero,
                    );
                    $raceModel->setEngagedThisRace($data_p);
                    $numero++;
                }
                $debut += $numberInRace;
            }
        }

        $query = "DELETE FROM races_tmp WHERE id = :raceTmpId; DELETE FROM race_participant_tmp WHERE race_tmp_id = :raceTmpId;";
        $stmt = Database::prepare($query);
        $stmt->bindParam(':raceTmpId', $raceTmpId, PDO::PARAM_INT);
        $stmt->execute();
    }
}