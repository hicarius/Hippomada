<?php
class SimulationModel extends Model_Abstract
{
    protected $_race;

    public function setRace($oRace)
    {
        $this->_race = $oRace;
        return $this;
    }

    public function run()
    {
        function sortResult($a, $b)
        {
            if ($a['race_time'] == $b['race_time']) {
                return 0;
            }
            return ($a['race_time'] < $b['race_time']) ? -1 : 1;
        }

        $horses = Apps::getModel('Race')->getHorsesEngaged($this->_race['id']);

        $result = array();
        foreach($horses as $horse) {
            $result[] = $this->simulateHorse($horse['horse_id']);
        }

        usort($result, 'sortResult');

        return $result;
    }


    public function convertSecondeEnMinute($secondes)
    {

        $min = floor($secondes / 60);
        $sec = str_pad(number_format( ((($secondes / 60) - $min) * 60), 2), 5, '0', STR_PAD_LEFT);
        return "$min' $sec";
    }

    public function getReductionKilometric($seconds, $lenght)
    {
        return $seconds * 1000 / $lenght;
    }

    public function getReductionFatigue($endurance)
    {
        return abs(($endurance*4/50) - 6);
    }

    public function raVitesseByAptitude($aptitude)
    {
        $x = 1 - ($aptitude * 0.04);
        if($aptitude < 25){
            $x =  -$x;
        }elseif($aptitude > 25){
            $x =  -1 * $x;
        }else{
            $x =  0;
        }

        return $x;
    }


    public function simulateHorse($horseId)
    {
        $isDisqualified = false;
        $oHorse = Apps::getModel('Horse')->load($horseId);
        $code = $this->_race['code'];
        $lenght = $this->_race['lenght'];

        $fatigue = $oHorse->getData('fatigue');

        //vitesse moyenne en km/h
        $vitesse = $oHorse->getData('vitesse_current');

        /**
         * Influence sur fatigue et vitesse
         */
        $endurance = $oHorse->getData('endurance_current');
        $reductionFatigue = $this->getReductionFatigue($endurance);

        /*
         * Physique, si 100 aucune effet.
         * Si physique < 100
         */
        $physique = $oHorse->getData('physique');
        if( $physique <= 100 ){
            $reductionPhysique = (100-$physique) / 100;
            $vitesse -= $reductionPhysique;
        }

        /*
         * aptitude à galoper ou trotter
         * Aptitude, influance sur vitesse
         */
        if( in_array($code, array('a', 'm')) ){
            $aptitude = $oHorse->getData('trot_current');
        }else{
            $aptitude = $oHorse->getData('galop_current');
        }
        $vitesse += $this->raVitesseByAptitude($aptitude);


        //si trot monté, le vitesse finale est -1
        if($code == 'm'){
            $vitesse -=0.3;
        }

        //Préférence corde
        if($oHorse->getData('corde') != $this->_race['corde'] ){
            $vitesse -=0.3;
        }

        //vitesse en 100m / seconde
        $vitesse = (60*100) / (($vitesse*1000)/60);

        //on découpe le distance en tranche de 100m
        $vitesseArray = array();
        //$resultat_string = array()';
        $resultat_string = '';
        for($distance = 100; $distance <= $lenght; $distance+=100){

            $fatigue += $reductionFatigue;
            if($fatigue > 130 ){
                $vitesseArray[] = 0;
                $isDisqualified = true;
                //$resultat_string[$distance] = 0;
                $resultat_string .= "|$distance,0";
                break;
            }

            if($fatigue >= 100){
                $c_vitesse = $vitesse + 2;
                $time =  (60*60) / (10 * $c_vitesse);
            }else{
                $c_vitesse = $vitesse;
                $time = (60*60) / (10 * $c_vitesse);
            }

            $this->parseTimeToSimulation($time);

            //$resultat_string[$distance] =  number_format( round($time, 4), 4);
            $resultat_string .= "|$distance," . number_format( round($time, 4), 4);
            $vitesseArray[] = $c_vitesse;
        }

        $timeTotal = array_sum($vitesseArray); //en seconds
        $timeTotalMinute = $this->convertSecondeEnMinute($timeTotal);

        //Reduction kilometrique
        $rk = $this->convertSecondeEnMinute($this->getReductionKilometric($timeTotal, $lenght));

        $timeTotal = ($isDisqualified) ? 0 : $timeTotal;

        return array(
            'horse_id' => $horseId,
            'race_time' => $timeTotal,
            'rk' => $rk,
            'chrono' => $timeTotalMinute,
            'resultat_string' => $resultat_string,
            'physique' => $physique-20,
            'fatigue' => $fatigue
        );
    }

    public function parseTimeToSimulation(&$time)
    {
        //0.2547169811320755 = 45
        //? = $time
        // ? = $time * 0.2547169811320755 / 45;
        $time = $time * 0.2547169811320755 / 45;
    }

    public function getSimJson($raceId)
    {
        $output = '';
        //race
        $stmt = Database::prepare("
              SELECT r.*, IF(rt.code='p', 'galop', IF(rt.code='m', 'trotmonte', 'galop')) as type FROM races r
              INNER JOIN race_type rt ON rt.id = r.type_id
              WHERE r.id = $raceId");
        $stmt->execute();
        $result = $stmt->fetch();
        if($result['id']){
            $output2 = array();
            $output2['lenght'] = $result['lenght'];
            $output2['type'] = $result['type'];
        }

        //horse
        $query = "SELECT rp.resultat_string, h.robe, h.name FROM race_participant rp
                  INNER JOIN horses h ON h.id =  rp.horse_id
                  WHERE race_id = $raceId";
        $stmt = Database::prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if(count($result) > 0 ){
            $output2['horses'] = array();
            foreach($result as $k => $item){
                $resultat_string = explode('|', $item['resultat_string']);
                unset($resultat_string[0]);
                foreach( $resultat_string as $str){
                    $vitesse = explode(',', $str);
                    $output .= ($vitesse[0]-100) . ':' . $vitesse[1] . ', ';
                    $vitesseArray[(int) $vitesse[0]-100 ] = $vitesse[1];
                }
                $output2['horses'][] = array(
                    'name' => $item['name'],
                    'color' => $item['robe'],
                    'framerate' => 15 + ($k/10)*2,
                    'vitesse' => $vitesseArray,
                );
            }
        }
        return $output2;
    }
}