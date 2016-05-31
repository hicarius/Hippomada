<?php
class Race_GroupModel extends Model_Abstract
{
    public function getGroups()
    {
        $query = "SELECT * FROM race_group";
        $stmt = Database::prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function load($id)
    {
        $query = "SELECT * FROM race_group WHERE id = :id";
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