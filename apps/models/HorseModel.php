<?php
class HorseModel extends Model_Abstract
{
	public function getHorsesForStable($proprio_id)
	{
		$query = "SELECT * FROM horses WHERE proprio_id = :proprio_id";
		$stmt = Database::prepare($query);
		$stmt->bindParam(':proprio_id', $proprio_id);
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
}