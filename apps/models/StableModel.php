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
		$query = "SELECT id FROM stables WHERE email = :email AND password = :password";
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

		$stmt->execute() ;

		return Database::lastInsertId('stables');
	}
}