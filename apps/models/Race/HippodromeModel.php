<?php
class Race_HippodromeModel extends Model_Abstract
{
    public function getHippodromes()
    {
        $query = "SELECT * FROM race_hippodrome";
        $stmt = Database::prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll();
        if(count($data) > 0){
            return $data;
        }
    }

    public function getName($id)
    {
        $query = "SELECT title FROM race_hippodrome WHERE id= $id";
        $stmt = Database::prepare($query);
        $stmt->execute();
        $data = $stmt->fetch();
        if(count($data) > 0){
            return $data['title'];
        }
    }

    public function load($id)
    {
        $query = "SELECT * FROM race_hippodrome WHERE id = :id";
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