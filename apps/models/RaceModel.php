<?php
class RaceModel extends Model_Abstract
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

        $query = "SELECT r.*, $additionalColumns FROM races r  $joins $where GROUP BY r.id ORDER BY r.meeting, r.race_number ASC";

        $stmt = Database::prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRacesOfficial()
    {
        $additionalColumns = "rc.title AS category_name, rg.group_name, rp.title AS piste_name, rh.title AS hippodrome_name";
        $additionalColumns .= ", rt.title AS type_name, rt.code";
        $joins =  " INNER JOIN race_category rc ON rc.id = r.category_id";
        $joins .=  " INNER JOIN race_group rg ON rg.id = r.group_id";
        $joins .=  " INNER JOIN race_hippodrome rh ON rh.id = r.hippodrome_id";
        $joins .=  " INNER JOIN race_type rt ON rt.id = r.type_id";
        $joins .=  " INNER JOIN race_piste rp ON rp.id = r.piste_id";

        $where = " WHERE r.status = 2";

        $query = "SELECT r.*, $additionalColumns FROM races r  $joins $where GROUP BY r.id ORDER BY r.meeting, r.race_number ASC";

        $stmt = Database::prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRacesEnd()
    {
        $additionalColumns = "rc.title AS category_name, rg.group_name, rp.title AS piste_name, rh.title AS hippodrome_name";
        $additionalColumns .= ", rt.title AS type_name, rt.code";
        $joins =  " INNER JOIN race_category rc ON rc.id = r.category_id";
        $joins .=  " INNER JOIN race_group rg ON rg.id = r.group_id";
        $joins .=  " INNER JOIN race_hippodrome rh ON rh.id = r.hippodrome_id";
        $joins .=  " INNER JOIN race_type rt ON rt.id = r.type_id";
        $joins .=  " INNER JOIN race_piste rp ON rp.id = r.piste_id";

        $where = " WHERE r.status = 0";

        $query = "SELECT r.*, $additionalColumns FROM races r  $joins $where GROUP BY r.id ORDER BY r.meeting, r.race_number ASC";

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
        $query = "SELECT r.*, $additionalColumns FROM races r  $joins WHERE r.id = :id GROUP BY r.id";
        $stmt = Database::prepare($query);
        $stmt->bindParam(':id', $id);
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

            $query = "INSERT INTO races (name, category_id, group_id, type_id, piste_id, hippodrome_id, meeting, race_number, lenght, corde, race_date, price, recul_gain, recul_meter, max_gain, age_min, age_max, sexe, victory_price, status, created_at )
 				  VALUES(:name, :category_id, :group_id, :type_id, :piste_id, :hippodrome_id, :meeting, :race_number, :lenght, :corde, :race_date, :price, :recul_gain, :recul_meter, :max_gain, :age_min, :age_max, :sexe, :victory_price, :status, :created_at)";
            $stmt = Database::prepare($query);

            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->bindParam(':group_id', $data['group_id']);
            $stmt->bindParam(':type_id', $data['type_id']);
            $stmt->bindParam(':piste_id', $data['piste_id']);
            $stmt->bindParam(':hippodrome_id', $data['hippodrome_id']);
            $stmt->bindParam(':meeting', $data['meeting']);
            $stmt->bindParam(':race_number', $data['race_number']);
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

            return Database::lastInsertId('races');
        }catch (Exception $e){
            $this->addMessage($e->getMessage(), 'danger');
            return FALSE;
        }
    }


    public function update($data)
    {
        try{

            $query = "UPDATE races
                      SET name = :name, category_id = :category_id, group_id = :group_id, type_id = :type_id, piste_id = :piste_id,
                                        hippodrome_id = :hippodrome_id, meeting = :meeting, race_number = :race_number,
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
            $stmt->bindParam(':race_number', $data['race_number']);
            $stmt->bindParam(':lenght', $data['lenght']);
            $stmt->bindParam(':corde', $data['corde']);
            $stmt->bindParam(':race_date', $data['race_date']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':recul_gain', $data['recul_gain']);
            $stmt->bindParam(':recul_meter', $data['recul_meter']);
            $stmt->bindParam(':max_gain', $data['max_gain']);
            $stmt->bindParam(':age_min', $data['age_min']);
            $stmt->bindParam(':sexe', $data['sexe']);
            $stmt->bindParam(':age_max', $data['age_max']);
            $stmt->bindParam(':victory_price', $data['victory_price']);
            $stmt->bindParam(':status', $data['status']);

            $stmt->execute();

            return $data['id'];
        }catch (Exception $e){
            $this->addMessage($e->getMessage(), 'danger');
            return FALSE;
        }
    }

    public function generate()
    {
        // R = [1, 2, 3] choisir 03 Hippodromes(au hasard)
        // C = [1, 2, 3, 4, 5, 6] créer 3 à 6 course pour chaque R
        // ET retourne CODE pour choisir TYPE(au hasard)
        // ET choisir PISTE(au hasard) en fonction de TYPE
        //

        //Choisir un hippodrome au hasard
        $hippodromes = Apps::getModel('Race_Hippodrome')->getHippodromes();
        $selectedHippodromeKeys = array_rand($hippodromes, 3);

        $date = date('Y-m-d', strtotime());
        foreach($selectedHippodromeKeys as $key => $selectedHippodromeKey) {
            $reunion = $key + 1;
            $selectedHippodrome = $hippodromes[$selectedHippodromeKey];

            //Choisir au hasard le nombre de course par réunion
            $maxCourse = mt_rand(3,6);
            for($course = 1; $course <= $maxCourse; $course++){
                //new race
                $race = new stdClass();
                $race->created_at = date('Y-m-d H:i:s');
                $race->meeting = $reunion;
                $race->race_number = $course;
                $race->hippodrome_id = $selectedHippodrome['id'];

                //On chosit ah hasard le CODE de l'hippodrome pour chosir le TYPE
                $hippodromeCodes = explode(',', $selectedHippodrome['code']);
                $hippodromeCodeKey = array_rand($hippodromeCodes);
                $type = Apps::getModel('Race_Type')->getTypeByCode($hippodromeCodes[$hippodromeCodeKey]);
                $race->type_id = $type['id'];

                //On choisit PISTE en fonction de TYPE
                $pistes = Apps::getModel('Race_Piste')->getPisteByCode($hippodromeCodes[$hippodromeCodeKey]);
                $selectedPisteKey = array_rand($pistes);
                $race->piste_id = $pistes[$selectedPisteKey]['id'];

                //On choisit CORDE
                $cordes = str_shuffle('DG');
                $race->corde = $cordes[0];

                Debugger::dump($race);
            }
        }

        $category = Apps::getModel('Race_Category')->getCategories();
        $selectedCategory = array_rand($category);
        $selectedCategory0 = shuffle($category);


        die;
    }

    /////////////////////////////////////////////////////////////////////
    ///////////////////GETTER/////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////
    /**
     * @param null $raceId
     * @return array
     */
    public function getHorsesEngaged($raceId = null)
    {
        $additionalColumns = ", h.proprio_id, h.specialization, h.name, h.age, h.sexe, h.id as horse_id";
        $additionalColumns .= ", CONCAT_WS(' ', s2.firstname, s2.lastname) AS entraineur  ";
        $additionalColumns .= ", CONCAT_WS(' ', s3.firstname, s3.lastname) AS jockey ";
        $joins =  " INNER JOIN horses h ON h.id = rp.horse_id";
        $joins .=  " INNER JOIN stables s2 ON s2.id = h.trainer_id";
        $joins .=  " LEFT JOIN stables s3 ON s3.id = rp.jockey_id";

        $query = "SELECT rp.* $additionalColumns FROM race_participant rp $joins";
        $query .= " WHERE rp.race_id = :race_id";
        $stmt = Database::prepare($query);

        if($raceId==null){
            $stmt->bindParam(':race_id', $this->_data['id']);
        }else{
            $stmt->bindParam(':race_id',  $raceId);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getRaceResult($raceId = null)
    {
        $additionalColumns = ", h.name, h.age, h.sexe, h.id as horse_id";
        $additionalColumns .= ", CONCAT_WS(' ', s2.firstname, s2.lastname) AS entraineur  ";
        $additionalColumns .= ", CONCAT_WS(' ', s3.firstname, s3.lastname) AS jockey ";
        $joins =  " INNER JOIN horses h ON h.id = rp.horse_id";
        $joins .=  " INNER JOIN stables s2 ON s2.id = h.trainer_id";
        $joins .=  " LEFT JOIN stables s3 ON s3.id = rp.jockey_id";

        $query = "SELECT rp.* $additionalColumns FROM race_participant rp $joins ";
        $query .= " WHERE rp.race_id = :race_id";
        $stmt = Database::prepare($query . " ORDER BY rp.rang ASC");

        if($raceId==null){
            $stmt->bindParam(':race_id', $this->_data['id']);
        }else{
            $stmt->bindParam(':race_id',  $raceId);
        }

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function setEngagedThisRace($data)
    {
        //Inscription to the officiel race
        $query = "INSERT INTO race_participant (race_id, horse_id, status, numero )
              VALUES(:race_id, :horse_id, 0, :numero)";
        $stmt = Database::prepare($query);
        $stmt->bindParam(':race_id', $data['race_id']);
        $stmt->bindParam(':horse_id', $data['horse_id']);
        $stmt->bindParam(':numero', $data['numero']);
        $stmt->execute();

    }


    public function getMeetingsAndRaceNumber($races)
    {
        $meetings = array();
        foreach($races as $race){
            if(!isset($meetings[ $race['meeting'] ])) {
                $meetings[$race['meeting']] = array('name' => $race['hippodrome_name']);
            }
            $meetings[$race['meeting']]['course'][$race['race_number']] = $race['race_number'];
        }

        return $meetings;
    }

    public function getAgeMinMax($race)
    {
        $html = '';
        if( $race['age_min'] == $race['age_max']){
            $html .= $race['age_min'] . " ans";
        }else{
            if($race['age_max'] == 0){
                $html .= $race['age_min'] . " ans et plus";
            } else {
                $html .= $race['age_min'] . " ans à " .$race['age_max'] . " ans";
            }
        }
        return $html;
    }

    public function getGainsMax($race)
    {
        $html = '';
        if( in_array($race['category_id'], array(3,4))){
            if($race['type_id'] == 1){
                $html .= "<br/>Pour être qualifié, il faut atteindre : <br />2 ans : 1'22.0, 3 ans : 1'20.5, 4 ans : 1'18.5, 5 ans et + : 1'18.0";
            }elseif($race['type_id'] == 2){
                $html .= "<br/>Pour être qualifié, il faut atteindre : <br />2 ans : 1'21.5, 3 ans : 1'20.0, 4 ans : 1'18.0, 5 ans et + : 1'17.5";
            }

            return $html;
        }
        if( $race['max_gain'] != -1 ){
            $html .= " qui ont gagnés <b>".number_format($race['max_gain'], 0, '.', ' ')." ".Text::__('turfoos')." max</b>.";
        }

        return $html;
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

    public function getRacePrizeAjax($race)
    {
        $html = '';
        if($race['victory_price']){
            $data = explode('|', $race['victory_price']);
            $html .= number_format($data[0], 0, '.', ' ');
        }
        return $html;
    }

    public function getCorde($race)
    {
        if($race['corde'] == 'D'){
            return 'Droite';
        }else{
            return 'Gauche';
        }
    }

    public function getName($race_name, $race_id, $isTemp = false)
    {
        if($isTemp){
            return '<a href="javascript:void(0)" rel="' . $race_id . '|1" class="race-name">' . $race_name . '</a>';
        }else{
            return '<a href="javascript:void(0)" rel="' . $race_id . '" class="race-name">' . $race_name . '</a>';
        }

    }

    public function getSexe($race)
    {
        if($race['sexe'] == 'F') {
            return 'femelles';
        }elseif($race['sexe'] == 'M'){
            return 'mâles';
        }else{
            return 'chevaux';
        }
    }

    public function getNextRaceNumberForMeeting($date, $meeting)
    {
        $query = "SELECT IF(race_number=null, 1, race_number+1) as race_number FROM races
                  WHERE race_date LIKE '$date%' AND meeting =  :meeting ORDER BY race_number DESC LIMIT 1";
        $stmt = Database::prepare($query);
        $stmt->bindParam(':meeting',  $meeting);
        $stmt->execute();
        $result = $stmt->fetch();
        if($result['race_number']){
            return    $result['race_number'];
        }else{
            return 1;
        }
    }

    public function getNextRaceDateForJourney($date)
    {
        $query = "SELECT IF(race_date=null, '$date 12:00:00', race_date) as race_date FROM races
                  WHERE race_date LIKE '$date%'ORDER BY race_date DESC LIMIT 1";
        $stmt = Database::prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        if($result['race_date']){
            return date('Y-m-d H:i:s', strtotime('+30minutes', strtotime($result['race_date'])));
        }else{
            return "$date 12:00:00";
        }
    }

    public function getAddPointPerf($horse)
    {
        $age = $horse['age'];
        switch($age){
            case ($age <= 4 && $age >= 1) :
                $value = 0.16;
                break;
            case ($age == 5) :
                $value = 0.33;
                break;
            default:
                $value = 0.5;
                break;
        }
        if($horse['specialization'] == 'G') {
            $critere = Commons::array_random(array('galop', 'vitesse', 'endurance'));
        }else {
            $critere = Commons::array_random(array('trot', 'vitesse', 'endurance'));
        }

        return array('critere' => $critere . '_current', 'value' => $value);
    }

    /**
     * Status , 0 = disq, 1 = ok avec temps
     * @param $raceId
     */
    public function simulate($raceId)
    {
        $race = $this->load($raceId, false);

        //Get gains
        $gains = explode('|', $race['victory_price']);

        //@todo : simulation du course à travailler
        $oSimulation = Apps::getModel('Simulation');
        $horses = $oSimulation->setRace($race)
                        ->run();

        foreach($horses as $k => $data){
            $horse = Apps::getModel('Horse')->load($data['horse_id'], false);

            //get stable by horse
            $stable = Apps::getModel('Stable')->load($horse['proprio_id'])->getData();

            $rang = $k+1;
            $gain = isset($gains[$rang]) ? $gains[$rang] : 0 ;

            $query = "UPDATE race_participant SET
                        rang = $rang,
                        status = 1,
                        gain = '$gain',
                         resultat_string = '{$data['resultat_string']}',
                         rk = '".addslashes($data['rk'])."',
                         chrono = '".addslashes($data['chrono'])."',
                         race_time = '{$data['race_time']}'
                      WHERE race_id = {$raceId} AND horse_id = {$horse['id']}";
            Database::prepare($query)->execute();

            //Mise à jour horses_caracteristique (fatigue, physique, radom perf)
            $addPointPerf = $this->getAddPointPerf($horse);
            $fatigue = ($data['resultat_string'] >= 100) ? 100 : $data['resultat_string'];
            $randomPerf = $addPointPerf['critere'];
            $additionalPerf =  $addPointPerf['value'];
            $query =  "UPDATE horses_caracteristique SET
                        $randomPerf = ($randomPerf + $additionalPerf),
                        physique = {$data['physique']},
                        fatigue = $fatigue
                       WHERE horse_id = {$horse['id']}";
            Database::prepare($query)->execute();

            if(!in_array($race['category_id'], array(3,4))){
                //Mise à jour du horses (gains, réevaluation price, type(etal, poule) )
                Database::prepare("UPDATE horses SET gains = (gains+$gain) WHERE id = {$horse['id']}")->execute();
                //@todo : Mise à jour ITR, BTR

                //Mise à jour du gain_race_horse
                $placed = ( $rang <= 5 ) ? 1 : 0 ;
                $win = ( $rang == 1 ) ? 1 : 0 ;
                $query =    "UPDATE gain_race_horse SET " .
                    "carrer_race = (carrer_race+1), carrer_win = (carrer_win+$win), carrer_placed = (carrer_placed+$placed), carrer_gain = (carrer_gain+$gain), " .
                    "year_race = (year_race+1), year_win = (year_win+$win), year_placed = (year_placed+$placed), year_gain = (year_gain+$gain), " .
                    "mounth_race = (mounth_race+1), mounth_win = (mounth_win+$win), mounth_placed = (mounth_placed+$placed), mounth_gain = (mounth_gain+$gain)" .
                    " WHERE horse_id = {$horse['id']}";
                Database::prepare($query)->execute();

                //Mise à jour du stable (banque, gains)
                Database::prepare("UPDATE stables SET banque = (banque+$gain) WHERE id = {$stable['id']}")->execute();
                //@todo : mise à jour du finances du stable

                //Mise à jour du gain_race_stable
                $query =    "UPDATE gain_race_stable SET " .
                            "carrer_race = (carrer_race+1), carrer_win = (carrer_win+$win), carrer_placed = (carrer_placed+$placed), carrer_gain = (carrer_gain+$gain), " .
                            "year_race = (year_race+1), year_win = (year_win+$win), year_placed = (year_placed+$placed), year_gain = (year_gain+$gain), " .
                            "mounth_race = (mounth_race+1), mounth_win = (mounth_win+$win), mounth_placed = (mounth_placed+$placed), mounth_gain = (mounth_gain+$gain)" .
                            " WHERE stable_id = {$stable['id']}";
                Database::prepare($query)->execute();

            }elseif($race['category_id'] == 3){
                //Mise à jour du horses (is_qualified )
                //@todo: ajout test sur temps atteint
                Database::prepare("UPDATE horses SET is_qualified = 1 WHERE id = {$horse['id']}")->execute();
            }elseif($race['category_id'] == 4){
                //@todo : mise à jour du jockey si temps atteint
            }

        }

        //Mise à jour du course
        Database::prepare("UPDATE races SET status = 0 WHERE id = {$raceId}")->execute();
    }

}