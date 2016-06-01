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
            foreach($data as $i => $item) {
                $query = "SELECT group_concat(group_name) as groups FROM race_group WHERE id IN (" . $item['group_ids'] . ")";
                $stmt = Database::prepare($query);
                $stmt->execute();
                $group = $stmt->fetch();
                $data[$i]['groups'] = $group['groups'];
            }
            return $data;
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