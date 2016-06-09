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

    public function getTypeByCode($code)
    {
        $query = "SELECT * FROM race_type WHERE code = '$code'" ;
        $stmt = Database::prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }
}