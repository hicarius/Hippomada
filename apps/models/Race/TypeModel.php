<?php
class Race_TypeModel extends Model_Abstract
{
    public function getTypes()
    {
        $query = "SELECT * FROM race_type";
        $stmt = Database::prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function load($id)
    {
        $query = "SELECT * FROM race_type WHERE id = :id";
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