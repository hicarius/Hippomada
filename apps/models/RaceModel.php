<?php
class RaceModel extends Model_Abstract
{
    public function getRaces()
    {
        $additionalColumns = "rc.title AS category_name, rg.group_name, rp.title AS piste_name, rh.title AS hippodrome_name";
        $additionalColumns .= ", rt.title AS type_name";
        $joins =  " INNER JOIN race_category rc ON rc.id = r.category_id";
        $joins .=  " INNER JOIN race_group rg ON rg.id = r.group_id";
        $joins .=  " INNER JOIN race_hippodrome rh ON rh.id = r.hippodrome_id";
        $joins .=  " INNER JOIN race_type rt ON rt.id = r.type_id";
        $joins .=  " INNER JOIN race_piste rp ON rp.id = r.piste_id";
        $query = "SELECT r.*, $additionalColumns FROM races r  $joins GROUP BY r.id";
        $stmt = Database::prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function load($id)
    {
        $additionalColumns = "rc.title AS category_name, rg.group_name, rp.title AS piste_name, rh.title AS hippodrome_name";
        $additionalColumns .= ", rt.title AS type_name, rp.title AS piste_name";
        $joins =  " INNER JOIN race_category rc ON rc.id = r.category_id";
        $joins .=  " INNER JOIN race_group rg ON rg.id = r.group_id";
        $joins .=  " INNER JOIN race_hippodrome rh ON rh.id = r.hippodrome_id";
        $joins .=  " INNER JOIN race_type rt ON rt.id = r.type_id";
        $joins .=  " INNER JOIN race_piste rp ON rp.id = r.piste_id";
        $query = "SELECT r.*, $additionalColumns FROM races r  $joins WHERE r.id = :id GROUP BY r.id";
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

    public function create($data)
    {
        try{

            $query = "INSERT INTO races (name, category_id, group_id, type_id, piste_id, hippodrome_id, lenght, corde, race_date, price, recul_gain, recul_meter, max_gain, age_min, age_max, victory_price, status, created_at )
 				  VALUES(:name, :category_id, :group_id, :type_id, :piste_id, :hippodrome_id, :lenght, :corde, :race_date, :price, :recul_gain, :recul_meter, :max_gain, :age_min, :age_max, :victory_price, :status, :created_at)";
            $stmt = Database::prepare($query);

            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->bindParam(':group_id', $data['group_id']);
            $stmt->bindParam(':type_id', $data['type_id']);
            $stmt->bindParam(':piste_id', $data['piste_id']);
            $stmt->bindParam(':hippodrome_id', $data['hippodrome_id']);
            $stmt->bindParam(':lenght', $data['lenght']);
            $stmt->bindParam(':corde', $data['corde']);
            $stmt->bindParam(':race_date', $data['race_date']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':recul_gain', $data['recul_gain']);
            $stmt->bindParam(':recul_meter', $data['recul_meter']);
            $stmt->bindParam(':max_gain', $data['max_gain']);
            $stmt->bindParam(':age_min', $data['age_min']);
            $stmt->bindParam(':age_max', $data['age_max']);
            $stmt->bindParam(':victory_price', $data['victory_price']);
            $stmt->bindParam(':status', $data['status']);
            $stmt->bindParam(':created_at', date('Y-m-d H:i:s'));

            $stmt->execute();

            return Database::lastInsertId('races');
        }catch (Exception $e){
            $this->addMessage($e->getMessage(), 'danger');
            return FALSE;
        }
    }

    public function update($data)
    {
        try{

            $query = "UPDATE races
                      SET name = :name, category_id = :category_id, group_id = :group_id, type_id = :type_id, piste_id = :piste_id,
                                        hippodrome_id = :hippodrome_id, lenght = :lenght, corde = :corde, race_date = :race_date,
                                        price = :price, recul_gain = :recul_gain, recul_meter = :recul_meter, max_gain = :max_gain,
                                        age_min = :age_min, age_max = :age_max, victory_price = :victory_price, status = :status
                     WHERE id = :id";
            $stmt = Database::prepare($query);

            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':name', $data['name']);
            $stmt->bindParam(':category_id', $data['category_id']);
            $stmt->bindParam(':group_id', $data['group_id']);
            $stmt->bindParam(':type_id', $data['type_id']);
            $stmt->bindParam(':piste_id', $data['piste_id']);
            $stmt->bindParam(':hippodrome_id', $data['hippodrome_id']);
            $stmt->bindParam(':lenght', $data['lenght']);
            $stmt->bindParam(':corde', $data['corde']);
            $stmt->bindParam(':race_date', $data['race_date']);
            $stmt->bindParam(':price', $data['price']);
            $stmt->bindParam(':recul_gain', $data['recul_gain']);
            $stmt->bindParam(':recul_meter', $data['recul_meter']);
            $stmt->bindParam(':max_gain', $data['max_gain']);
            $stmt->bindParam(':age_min', $data['age_min']);
            $stmt->bindParam(':age_max', $data['age_max']);
            $stmt->bindParam(':victory_price', $data['victory_price']);
            $stmt->bindParam(':status', $data['status']);

            $stmt->execute();
            //print_r($data);die;
            return $data['id'];
        }catch (Exception $e){
            $this->addMessage($e->getMessage(), 'danger');
            return FALSE;
        }
    }
}