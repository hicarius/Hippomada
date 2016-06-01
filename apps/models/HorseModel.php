<?php
class HorseModel extends Model_Abstract
{
	public function getHorses()
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
		$query = "SELECT h.*, $additionalColumns FROM horses h $joins  ORDER BY id DESC";
		$stmt = Database::prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function load($id)
	{
		$query = "SELECT * FROM horses WHERE id = :id";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$result = $stmt->fetch();

		if ($result['id']>0) {
			return $result;
		} else {
			return FALSE;
		}
	}

	public function create($data)
	{
		try{

			$query = "INSERT INTO horses (name, proprio_id, trainer_id, eleveur_id, father_id, mother_id, age, sexe, gains, origine, quality, quality_production, evaluation_price, status, is_system, is_qualified, type)
 				  VALUES(:name, :proprio_id, :trainer_id, :eleveur_id, :father_id, :mother_id, :age, :sexe, :gains, :origine, :quality, :quality_production, :evaluation_price, :status, :is_system, :is_qualified, :type)";
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
			$stmt->bindParam(':sexe', $data['sexe']);
			$stmt->bindParam(':gains', $data['gains']);
			$stmt->bindParam(':origine', $data['origine']);
			$stmt->bindParam(':quality', $data['quality']);
			$stmt->bindParam(':quality_production', $data['quality_production']);

			//Set evaluation_price by the configurateur
			$stmt->bindParam(':evaluation_price', $this->_getEvaluationPrice($data['quality'], $data['quality_production'], $data['status']));

			$stmt->bindParam(':status', $data['status']);
			$stmt->bindParam(':is_qualified', $data['is_qualified']);
			$stmt->bindParam(':type', $data['type']);
			$stmt->bindParam(':is_system', $data['is_system']);

			$stmt->execute();

			return Database::lastInsertId('horses');
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
                                        mother_id = :mother_id, age = :age, sexe = :sexe, gains = :gains,
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
			$stmt->bindParam(':sexe', $data['sexe']);
			$stmt->bindParam(':gains', $data['gains']);
			$stmt->bindParam(':origine', $data['origine']);
			$stmt->bindParam(':quality', $data['quality']);
			$stmt->bindParam(':quality_production', $data['quality_production']);
			$stmt->bindParam(':evaluation_price', $data['evaluation_price']);
			$stmt->bindParam(':status', $data['status']);
			$stmt->bindParam(':is_system', $data['is_system']);

			$stmt->execute();

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

	private function _getEvaluationPrice($quality, $qualityProduction, $status)
	{

		$configurateurQuality = array(0, 1000, 2500, 5000, 10000, 15000, 35000, 75000, 100000, 250000, 500000);
		$configurateurQualityProd = array(0, 5000, 25000, 50000, 75000, 125000);

		if($status == 0){
			return $configurateurQualityProd[$qualityProduction];
		} else {
			return $configurateurQuality[$quality] + $configurateurQualityProd[$qualityProduction];
		}

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
}