<?php
class HorseModel extends Model_Abstract
{
	private $_horseData = array();

	public function getHorses()
	{
		$additionalColumns = "s1.name AS proprio, ";
		$additionalColumns .= "CONCAT_WS(' ', s2.firstname, s2.lastname) AS trainer, ";
		$additionalColumns .= "CONCAT_WS(' ', s3.firstname, s3.lastname) AS eleveur, ";
		$additionalColumns .= "IF(h.father_id=0, 'Inconnu', h2.name) AS father, ";
		$additionalColumns .= "IF(h.mother_id=0, 'Inconnu', h3.name) AS mother, ";
		$additionalColumns .= "IF(h.status=0, 'Inactif', 'Actif') AS status, ";
		$additionalColumns .= "IF(h.is_system=0, 'Non', 'Oui') AS is_system, ";
		$additionalColumns .= "IF(h.type=0, 'Standard', IF(h.type=1, '- de 1 an', IF(h.type=2, 'Etalon', 'Poulini&egrave;re'))) AS type ";
		$joins =  " INNER JOIN stables s1 ON s1.id = h.proprio_id";
		$joins .=  " INNER JOIN stables s2 ON s2.id = h.trainer_id";
		$joins .=  " INNER JOIN stables s3 ON s3.id = h.eleveur_id";
		$joins .=  " LEFT JOIN horses h2 ON h2.id = h.father_id";
		$joins .=  " LEFT JOIN horses h3 ON h3.id = h.mother_id";
		$query = "SELECT h.*, $additionalColumns FROM horses h $joins  ORDER BY id DESC";
		$stmt = Database::prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function load($id, $setData = true)
	{
		$query = "SELECT h.*, hc.itr,
								hc.itr_year,
								hc.btr,
								hc.trot_base,
								hc.trot_current,
								hc.trot_gene,
								hc.galop_base,
								hc.galop_current,
								hc.galop_gene,
								hc.endurance_base,
								hc.endurance_current,
								hc.endurance_gene,
								hc.vitesse_base,
								hc.vitesse_current,
								hc.vitesse_gene,
								hc.physique,
								hc.fatigue
					FROM horses h
					LEFT JOIN horses_caracteristique hc ON hc.horse_id = h.id
					WHERE h.id = :id";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$result = $stmt->fetch();
		if ($result['id']>0) {
			if($setData) {
				$this->_horseData = $result;
			}
			return $result;
		} else {
			return FALSE;
		}
	}

	public function loadByName($text, $additional)
	{
		$where =  'AND ';
		foreach($additional as $k => $column){
			$where .= "$k = $column ";
		}

		$query = "SELECT id, name FROM horses WHERE 1 $where AND lower(name) LIKE '%".strtolower($text)."%'";
		$stmt = Database::prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		if (count($result)>0) {
			return $result;
		} else {
			return 'no_data_found';
		}
	}

	public function create($data)
	{
		try{

			$query = "INSERT INTO horses (name, proprio_id, trainer_id, eleveur_id, father_id, mother_id, age, corde, sexe, gains, origine, status, is_system, is_qualified, type)
 				  VALUES(:name, :proprio_id, :trainer_id, :eleveur_id, :father_id, :mother_id, :age, :corde, :sexe, :gains, :origine, :status, :is_system, :is_qualified, :type)";
			$stmt = Database::prepare($query);

			$stmt->bindParam(':name', $data['name']);

			//Set proprietaire/entraineur/eleveur to Stable system
			$stmt->bindParam(':proprio_id', $data['proprio_id']);
			$stmt->bindParam(':trainer_id', $data['trainer_id']);
			$stmt->bindParam(':eleveur_id', $data['eleveur_id']);
			if( $data['is_system'] == 1){
				$defaultStable = $this->_getDefaultStableForCreation($data['age']);
				$stmt->bindParam(':proprio_id', $defaultStable);
				$stmt->bindParam(':trainer_id', $defaultStable);
				$stmt->bindParam(':eleveur_id', $defaultStable);
			}

			$stmt->bindParam(':father_id', $data['father_id']);
			$stmt->bindParam(':mother_id', $data['mother_id']);
			$stmt->bindParam(':age', $data['age']);
			$stmt->bindParam(':corde', $data['corde']);
			$stmt->bindParam(':sexe', $data['sexe']);
			$stmt->bindParam(':gains', $data['gains']);
			$stmt->bindParam(':origine', $data['origine']);
			$stmt->bindParam(':status', $data['status']);
			$stmt->bindParam(':is_qualified', $data['is_qualified']);
			$stmt->bindParam(':type', $data['type']);
			$stmt->bindParam(':is_system', $data['is_system']);

			$stmt->execute();

			$id = Database::lastInsertId('horses');
			$this->load($id);

			return $id;

		}catch (Exception $e){
			$this->addMessage($e->getMessage(), 'danger');
			return FALSE;
		}
	}

	public function update($data)
	{
		try{

			$query = "UPDATE horses
                      SET name = :name, proprio_id = :proprio_id, trainer_id = :trainer_id, eleveur_id = :eleveur_id, father_id = :father_id,
                                        mother_id = :mother_id, age = :age, corde = :corde, sexe = :sexe, gains = :gains,
                                        origine = :origine, quality = :quality, quality_production = :quality_production, evaluation_price = :evaluation_price,
                                        status = :status, is_system = :is_system
                     WHERE id = :id";
			$stmt = Database::prepare($query);

			$stmt->bindParam(':id', $data['id']);
			$stmt->bindParam(':name', $data['name']);
			$stmt->bindParam(':proprio_id', $data['proprio_id']);
			$stmt->bindParam(':trainer_id', $data['trainer_id']);
			$stmt->bindParam(':eleveur_id', $data['eleveur_id']);
			$stmt->bindParam(':father_id', $data['father_id']);
			$stmt->bindParam(':mother_id', $data['mother_id']);
			$stmt->bindParam(':age', $data['age']);
			$stmt->bindParam(':corde', $data['corde']);
			$stmt->bindParam(':sexe', $data['sexe']);
			$stmt->bindParam(':gains', $data['gains']);
			$stmt->bindParam(':origine', $data['origine']);
			$stmt->bindParam(':quality', $data['quality']);
			$stmt->bindParam(':quality_production', $data['quality_production']);
			$stmt->bindParam(':evaluation_price', $data['evaluation_price']);
			$stmt->bindParam(':status', $data['status']);
			$stmt->bindParam(':is_system', $data['is_system']);

			$stmt->execute();

			$this->load($data['id']);
			return $data['id'];
		}catch (Exception $e){
			$this->addMessage($e->getMessage(), 'danger');
			return FALSE;
		}
	}

	public function getHorsesForStable($proprio_id)
	{
		$additionalColumns = "s1.name AS proprio, ";
		$additionalColumns .= "CONCAT_WS(' ', s2.firstname, s2.lastname) AS trainer, ";
		$additionalColumns .= "CONCAT_WS(' ', s3.firstname, s3.lastname) AS eleveur, ";
		$additionalColumns .= "IF(h.father_id=0, 'Inconnu', h.father_id) AS father, ";
		$additionalColumns .= "IF(h.mother_id=0, 'Inconnu', h.mother_id) AS mother, ";
		$additionalColumns .= "IF(h.status=0, 'Inactif', 'Actif') AS status, ";
		$additionalColumns .= "IF(h.is_system=0, 'Non', 'Oui') AS is_system, ";
		$additionalColumns .= "IF(h.type=0, 'Standard', IF(h.type=1, '- de 1 an', IF(h.type=2, 'Etalon', 'Poulinière'))) AS type ";
		$joins =  " INNER JOIN stables s1 ON s1.id = h.proprio_id";
		$joins .=  " INNER JOIN stables s2 ON s2.id = h.trainer_id";
		$joins .=  " INNER JOIN stables s3 ON s3.id = h.eleveur_id";
		$query = "SELECT h.*, $additionalColumns FROM horses h $joins WHERE h.proprio_id = :proprio_id";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':proprio_id', $proprio_id);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getHorsesEngagedInRace($race_id)
	{
		$query = "SELECT * FROM race_participant WHERE race_id = :race_id";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':race_id', $race_id);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function setQualityAndPrice()
	{
		$status	= $this->_horseData['status'];
		$type	= $this->_horseData['type'];
		$production = $this->getQualityProduction();
		$note = $this->getQuality();

		$evaluation_price = 0;
		$production_price = 0;
		if($type == 2 || $type == 3){
			$production_price =  $production['price'];
		}

		if($status != 0){
			$evaluation_price =   $note['price'];
		}
		$price = $evaluation_price + $production_price;

		//save price and quality_production and ITR
		$query = "UPDATE horses
					SET evaluation_price = :evaluation_price, production_price = :production_price, price = :price, quality= :quality, quality_production = :quality_production
					WHERE id = :id";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':evaluation_price', $production_price);
		$stmt->bindParam(':production_price', $evaluation_price);
		$stmt->bindParam(':price', $price);
		$stmt->bindParam(':quality', $note['quality']);
		$stmt->bindParam(':quality_production', $production['quality']);
		$stmt->bindParam(':id', $this->_horseData['id']);
		$stmt->execute();

		//ITR
		if($this->_horseData['type'] == 3){
			$itr = $this->getFatherITR();
		} else {
			$itr = $this->_horseData['itr'];
		}

		//save ITR
		$query = "UPDATE horses_caracteristique SET itr = :itr WHERE horse_id = :horse_id";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':itr', $itr);
		$stmt->bindParam(':horse_id', $this->_horseData['id']);
		$stmt->execute();
	}

	public function getQualityProduction($itr = null)
	{
		if( $itr == null ) {
			if ($this->_horseData['type'] == 3) {
				$itr = $this->getFatherITR();
			} else {
				$itr = $this->_horseData['itr'];
			}
		}

		switch($itr){
			case ($itr >= 170):
				$qualityProduction = 5;
				break;
			case ($itr > 170 && $itr >= 160):
				$qualityProduction = 4;
				break;
			case ($itr > 160 && $itr >= 150):
				$qualityProduction = 3;
				break;
			case ($itr > 150 && $itr >= 140):
				$qualityProduction = 2;
				break;
			case ($itr > 140 && $itr >= 120):
				$qualityProduction = 1;
				break;
			case ($itr < 120):
				$qualityProduction = 0;
				break;
		}

		$configurateurQualityProd = array(0, 5000, 25000, 50000, 75000, 125000);
		$price = $configurateurQualityProd[$qualityProduction];

		return array('quality' => $qualityProduction, 'price' => $price);
	}

	public function getQuality($horse = null)
	{
		//$configsNote = array(0, 40, 60, 100, 120, 140, 160, 180, 200, 220, 240);
		$configsNote = array(0, 30, 45, 75, 90, 105, 120, 135, 150, 165, 180);
		if($horse == null){
			$totalPerfBase = $this->_horseData['trot_base'] + $this->_horseData['galop_base'] + $this->_horseData['endurance_base'] + $this->_horseData['vitesse_base'];
		}else{
			$totalPerfBase = $horse->perf->trot_base + $horse->perf->galop_base + $horse->perf->endurance_base + $horse->perf->vitesse_base;
		}


		foreach($configsNote as $k => $v){
			if(isset($configsNote[$k + 1])) {
				if ($configsNote[$k + 1] >= $totalPerfBase && $totalPerfBase > $configsNote[$k]) {
					$quality = $k;
					break;
				}
			}
		}

		$configurateurQuality = array(0, 1000, 2500, 5000, 10000, 15000, 35000, 75000, 100000, 250000, 500000);
		$price = $configurateurQuality[$quality];
		return array('quality' => $quality, 'price' => $price);
	}

	private function _getDefaultStableForCreation($age)
	{
		switch($age){
			case ($age <= 3): $id = DEF_STABLE_ID_YOUNG; break;
			case ($age == 4 OR $age == 5 OR $age == 6): $id = DEF_STABLE_ID_4_5_6_ANS; break;
			case ($age == 7 OR $age == 8 OR $age == 9): $id = DEF_STABLE_ID_7_8_9_ANS; break;
			case ($age == 10): $id = DEF_STABLE_ID_10_ANS; break;
			case ($age > 10): $id = DEF_STABLE_ID_OLD; break;
		}
		return $id;
	}

	public function createPerformance($perfData)
	{
		$columns = '';
		$columnsValue =  '';
		foreach($perfData as $column => $value){
			$columns .= ", $column";
			$columnsValue .= ", '$value'";
		}
		$query = "INSERT INTO horses_caracteristique (horse_id $columns)
 				  VALUES(:horse_id $columnsValue)";
		$stmt = Database::prepare($query);

		$stmt->bindParam(':horse_id', $this->_horseData['id']);
		$stmt->execute();

		$this->load($this->_horseData['id']);
	}

	public function getFatherITR()
	{
		$father = $this->load( $this->_horseData['father_id'], false);

		return $father['itr'];
	}

	public function generate($etalonId, $pouleId)
	{
		$horse = new stdClass();

		//HORSE DATA
		//get father data
		$horse->father_id = $etalonId;
		$fatherData = $this->load($etalonId, false);
		//get father data of mother
		$horse->mother_id = $pouleId;
		$motherData = $this->load($pouleId, false);
		if($motherData['father_id']) {
			$fatherOfMotherData = $this->load($motherData['father_id'], false);
		}else{
			$fatherOfMotherData =  null;
		}

		//name
		$horse->name = 'NoName'. rand(100, 99999);
		//age
		$horse->age = rand(2,10);
		//proprietaire/entraineur/jockey ID en fonction de l'age
		$proprio_id = $this->_getDefaultStableForCreation($horse->age);
		$horse->proprio_id = $proprio_id;
		$horse->trainer_id = $proprio_id;
		$horse->eleveur_id = $proprio_id;
		//sexe
		$sexeShuffle = str_shuffle('FM');
		$horse->sexe = $sexeShuffle[0];
		//corde
		if($fatherOfMotherData ==  null){
			$cordeShuffle = str_shuffle("{$fatherData['corde']}{$motherData['corde']}");
		}else{
			$cordeShuffle = str_shuffle("{$fatherData['corde']}{$fatherOfMotherData['corde']}{$motherData['corde']}");
		}

		$horse->corde = $cordeShuffle[0];
		//gains
		$horse->gains = 0;
		//origine
		$horse->origine = $fatherData['origine'];
		//status 0=inactif, 1=actif
		$horse->status = 1;
		//type 0=standard, 1=-1an, 2=etalon, 3=poulinières
		$horse->type = 0;
		//qualifié
		$horse->is_qualified = 0;
		//système
		$horse->is_system = 0;

		//HORSE PERFORMANCE DATA
		$horse->perf = new stdClass();
		//ITR
		if($horse->sexe == 'F'){
			$horse->perf->itr = $fatherData['itr'];
		}else{
			$horse->perf->itr = 1;
		}

		//Qualité de réproduction
		$QReprodutcion = $this->getQualityProduction($horse->perf->itr);
		$horse->quality_production = $QReprodutcion['quality'];
		$horse->production_price = 0;

		//Qualité d'évaluation BTR --> 33% père, 33% père de mère, 33% random
		$this->getBasePerf($horse, 'trot', $fatherData, $fatherOfMotherData);
		$this->getBasePerf($horse, 'galop', $fatherData, $fatherOfMotherData);
		$this->getBasePerf($horse, 'endurance', $fatherData, $fatherOfMotherData);
		$this->getBasePerf($horse, 'vitesse', $fatherData, $fatherOfMotherData);

		$QEvaluation = $this->getQuality($horse);
		$horse->quality = $QEvaluation['quality'];
		$horse->evaluation_price = $QEvaluation['price'];

		//moyenne des BTR de ses parents
		$this->getGenePerf($horse, 'trot', $fatherData, $fatherOfMotherData, $motherData);
		$this->getGenePerf($horse, 'galop', $fatherData, $fatherOfMotherData, $motherData);
		$this->getGenePerf($horse, 'endurance', $fatherData, $fatherOfMotherData, $motherData);
		$this->getGenePerf($horse, 'vitesse', $fatherData, $fatherOfMotherData, $motherData);

		//base * multiplier selon l'age
		$this->getCurrentPerf($horse, 'trot', $fatherData, $fatherOfMotherData, $motherData);
		$this->getCurrentPerf($horse, 'galop', $fatherData, $fatherOfMotherData, $motherData);
		$this->getCurrentPerf($horse, 'endurance', $fatherData, $fatherOfMotherData, $motherData);
		$this->getCurrentPerf($horse, 'vitesse', $fatherData, $fatherOfMotherData, $motherData);


		return $horse;
	}

	/**
	 * BTR --> 33% père, 33% père de mère, 33% random
	 * si gene = 100%, 33% du 100%
	 * @param $horse
	 */
	public function getBasePerf(&$horse, $perfKey ,$fatherData, $fatherOfMotherData)
	{
		//BASE
		//father
		$fatherGenetic = $fatherData[$perfKey . '_base'] * $fatherData[$perfKey . '_gene'] / 100 ;
		$parFather = $fatherGenetic * 33 / 100 ;

		//father of mother
		if($fatherOfMotherData == null){
			$parFatherOfMother = $parFather;
		}else{
			$fatherOfMotherGenetic = $fatherOfMotherData[$perfKey . '_base'] * $fatherOfMotherData[$perfKey . '_gene'] / 100 ;
			$parFatherOfMother = $fatherOfMotherGenetic * 33 / 100 ;
		}

		//random
		$parRandom = rand(0, $parFather) * 33 / 100;
		$perfCode = "{$perfKey}_base";
		$horse->perf->$perfCode = $parFather + $parFatherOfMother + $parRandom;
	}

	/**
	 * BTR --> (moyenne des BTR de ses parents
	 * @param $horse
	 */
	public function getGenePerf(&$horse, $perfKey ,$fatherData, $fatherOfMotherData, $motherData)
	{
		$btrCode = "{$perfKey}_gene";
		if($fatherOfMotherData == null){
			$horse->perf->$btrCode = ($fatherData[$perfKey . '_gene'] + $fatherData[$perfKey . '_gene'] + $motherData[$perfKey . '_gene']) / 3;
		}else{
			$horse->perf->$btrCode = ($fatherData[$perfKey . '_gene'] + $fatherOfMotherData[$perfKey . '_gene'] + $motherData[$perfKey . '_gene']) / 3;
		}
	}

	/**
	 * BTR --> (moyenne des BTR de ses parents
	 * @param $horse
	 */
	public function getCurrentPerf(&$horse, $perfKey)
	{
		//CURRENT
		$additionnalEcart = array(0, 30, 30, 30, 40, 40, 45, 45, 50, 55, 60);
		$multiplier = $horse->age - 1;

		$perfBase = "{$perfKey}_base";
		$perfCurrent = "{$perfKey}_current";
		if($horse->perf->$perfBase == 0){
			$horse->perf->$perfCurrent = 0;
		}else{
			$horse->perf->$perfCurrent = $horse->perf->$perfBase + $additionnalEcart[$horse->quality] * $multiplier;
		}
	}

}