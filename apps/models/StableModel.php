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

			$query = "INSERT INTO stables (name, firstname, lastname, last_activity, country, continent, level, banque, gold, email, password )
 				  VALUES(:name, :firstname, :lastname, :last_activity, :country, :continent, :level, :banque, :gold, :email, :password)";
			$stmt = Database::prepare($query);

			$stmt->bindParam(':name', $data['name']);
			$stmt->bindParam(':firstname', $data['firstname']);
			$stmt->bindParam(':lastname', $data['lastname']);
			$stmt->bindParam(':last_activity', date('Y-m-d h:i:s'));
			$stmt->bindParam(':country', $data['country']);
			$stmt->bindParam(':continent', $data['continent']);
			$stmt->bindParam(':level', $data['level']);
			$stmt->bindParam(':banque', $data['banque']);
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

	public function getStables()
	{
		$query = "SELECT *, CONCAT_WS(' ', firstname, lastname) AS proprietaire FROM stables";
		$stmt = Database::prepare($query);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public function load($id)
	{
		$query = "SELECT *, CONCAT_WS(' ', firstname, lastname) AS proprietaire FROM stables WHERE id = :id";
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
}