<?php
class Race_PisteModel extends Model_Abstract
{
    public function getPistes()
    {
        $query = "SELECT * FROM race_piste";
        $stmt = Database::prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function load($id)
    {
        $query = "SELECT * FROM race_piste WHERE id = :id";
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

    public function getPisteByCode($typeCode)
    {
        $query = "SELECT * FROM race_piste WHERE type LIKE '%$typeCode%'" ;
        $stmt = Database::prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result;
    }
}