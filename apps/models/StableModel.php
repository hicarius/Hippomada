<?php
class StableModel extends Model_Abstract
{

	/**
	 * Connexion au site
	 * @param $email
	 * @param $password
	 * @return bool|mixed
	 */
	public function connectStable($email, $password)
	{
		$query = "SELECT * FROM stables WHERE email = :email AND password = :password";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':password', md5($password));
		$stmt->execute() ;
		$result = $stmt->fetch();

		if ($result['id']>0) {
			return $result;
		} else {
			return FALSE;
		}
	}

	/**
	 * création d'un écurie
	 * @param $data
	 * @return int
	 */
	public function create($data)
	{
		try{
			//check if this email is already use by another stable
			$this->checkIsNotUsedEmail($data['email']);

			$query = "INSERT INTO stables (name, firstname, lastname, last_activity, country, continent, level, banque, capital, gold, email, password )
 				  VALUES(:name, :firstname, :lastname, :last_activity, :country, :continent, :level, :banque, :capital, :gold, :email, :password)";
			$stmt = Database::prepare($query);

			$stmt->bindParam(':name', $data['name']);
			$stmt->bindParam(':firstname', $data['firstname']);
			$stmt->bindParam(':lastname', $data['lastname']);
			$stmt->bindParam(':last_activity', date('Y-m-d h:i:s'));
			$stmt->bindParam(':country', $data['country']);
			$stmt->bindParam(':continent', $data['continent']);
			$stmt->bindParam(':level', $data['level']);
			$stmt->bindParam(':banque', $data['banque']);
			$stmt->bindParam(':capital', $data['capital']);
			$stmt->bindParam(':gold', $data['gold']);
			$stmt->bindParam(':email', $data['email']);
			$stmt->bindParam(':password', md5($data['password']));

			$stmt->execute();

			return Database::lastInsertId('stables');
		}catch (Exception $e){
			$this->addMessage($e->getMessage(), 'danger');
			return FALSE;
		}
	}

	public function update($data)
	{
		try{

			$query = "UPDATE stables
                      SET name = :name, firstname = :firstname, lastname = :lastname, country = :country,
                                        continent = :continent, level = :level, banque = :banque, capital = :capital, gold = :gold,
                                        email = :email
                     WHERE id = :id";
			$stmt = Database::prepare($query);

			$stmt->bindParam(':id', $data['id']);
			$stmt->bindParam(':name', $data['name']);
			$stmt->bindParam(':firstname', $data['firstname']);
			$stmt->bindParam(':lastname', $data['lastname']);
			$stmt->bindParam(':country', $data['country']);
			$stmt->bindParam(':continent', $data['continent']);
			$stmt->bindParam(':level', $data['level']);
			$stmt->bindParam(':banque', $data['banque']);
			$stmt->bindParam(':capital', $data['capital']);
			$stmt->bindParam(':gold', $data['gold']);
			$stmt->bindParam(':email', $data['email']);

			$stmt->execute();
			return $data['id'];
		}catch (Exception $e){
			$this->addMessage($e->getMessage(), 'danger');
			return FALSE;
		}
	}

	public function getStables()
	{
		$query = "SELECT *, CONCAT_WS(' ', firstname, lastname) AS proprietaire FROM stables ORDER BY id DESC";
		$stmt = Database::prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function load($id, $setData = true)
	{
		$query = "SELECT *, CONCAT_WS(' ', firstname, lastname) AS proprietaire FROM stables WHERE id = :id";
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

	public function updateLastActivity($id)
	{
		$query = "UPDATE stables SET last_activity = :last_activity WHERE id = :id";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':last_activity', date("Y-m-d h:i:s"));
		$stmt->execute() ;
	}

	private function checkIsNotUsedEmail($email)
	{
		$query = "SELECT id FROM stables WHERE email = :email";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result['id']) {
			throw new Exception( Text::__('This email is already in use in another stable.'));
		}
	}

	public function getLevel()
	{
		$level = $this->_data['level'];
		$html = '';
		 if($level == 0) {
			 $html .= '<i class="fa fa-star-o fa-lg star-level-no"></i>';
			 $html .= '<i class="fa fa-star-o fa-lg star-level-no"></i>';
			 $html .= '<i class="fa fa-star-o fa-lg star-level-no"></i>';
		 }else{
			 for( $i=1; $i<=3; $i++){
				 if( $i <= $level) {
					 $html .= '<i class="fa fa-star fa-lg star-level-yes"></i>';
				 }else{
					 $html .= '<i class="fa fa-star-o fa-lg star-level-no"></i>';
				 }
			 }
		 }
	     switch($level){
			 case 0 : $html .= ' (Novice)';break;
			 case 1 : $html .= ' (Amateur)';break;
			 case 2 : $html .= ' (Moyenne)';break;
			 case 3 : $html .= ' (Grande)';break;
		 }
		return $html;
	}

	public function getMaxHorse()
	{
		$level = $this->_data['level'];
		switch($level){
			case 0 : return 10;break;
			case 1 : return 20;break;
			case 2 : return 30;break;
			case 3 : return 0;break;
		}
	}

	public function getHorsesEngagedInRace($race_id)
	{
		$query = "SELECT * FROM race_participant WHERE race_id = :race_id";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':race_id', $race_id);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getActiveHorse()
	{
		$stableId = $this->_data['id'];
		$query = "SELECT h.id FROM horses h WHERE h.proprio_id = :proprio_id AND h.status = 1 ORDER BY h.age DESC";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':proprio_id', $stableId);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getInactiveHorse()
	{
		$stableId = $this->_data['id'];
		$query = "SELECT h.id FROM horses h WHERE h.proprio_id = :proprio_id AND h.status = 0 ORDER BY h.age DESC";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':proprio_id', $stableId);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getHorsesForStable()
	{
		$proprio_id = $this->_data['id'];
		$additionalColumns = "s1.name AS proprio, ";
		$additionalColumns .= "CONCAT_WS(' ', s2.firstname, s2.lastname) AS trainer, ";
		$additionalColumns .= "CONCAT_WS(' ', s3.firstname, s3.lastname) AS eleveur, ";
		$additionalColumns .= "IF(h.father_id=0, 'Inconnu', h.father_id) AS father, ";
		$additionalColumns .= "IF(h.mother_id=0, 'Inconnu', h.mother_id) AS mother, ";
		$additionalColumns .= "IF(h.status=0, 'Inactif', 'Actif') AS status, ";
		$additionalColumns .= "IF(h.is_system=0, 'Non', 'Oui') AS is_system, ";
		$additionalColumns .= "IF(h.type=0, 'Standard', IF(h.type=1, '- de 1 an', IF(h.type=2, 'Etalon', 'Poulini&egrave;re'))) AS type ";
		$joins =  " INNER JOIN stables s1 ON s1.id = h.proprio_id";
		$joins .=  " INNER JOIN stables s2 ON s2.id = h.trainer_id";
		$joins .=  " INNER JOIN stables s3 ON s3.id = h.eleveur_id";
		$query = "SELECT h.*, $additionalColumns FROM horses h $joins WHERE h.proprio_id = :proprio_id";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':proprio_id', $proprio_id);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function getResultats()
	{
		$query = "SELECT * FROM gain_race_stable WHERE stable_id = :stable_id";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':stable_id', $this->_data['id']);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result['id']>0) {
			return $result;
		}else{
			return array(
				'carrer_race' => 0, 'carrer_win' => 0, 'carrer_placed' => 0, 'carrer_gain' => 0,
				'year_race' => 0, 'year_win' => 0, 'year_placed' => 0, 'year_gain' => 0,
				'mounth_race' => 0, 'mounth_win' => 0,'mounth_placed' => 0,'mounth_gain' => 0,
			);
		}
	}
}