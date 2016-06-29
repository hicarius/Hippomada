<?php
class TrainingModel extends Model_Abstract
{
    public function saveTraining($data)
    {
        $query = "INSERT INTO horses_training(horse_id, training_trot, training_galop, training_endurance, training_vitesse, training_physique )
                  VALUES (:horse_id, :training_trot, :training_galop, :training_endurance, :training_vitesse, :training_physique) ";
        $stmt = Database::prepare($query);

        $stmt->bindParam(':horse_id', $data['horse_id'], PDO::PARAM_INT);
        $stmt->bindParam(':training_trot', $data['training_trot'], PDO::PARAM_INT);
        $stmt->bindParam(':training_galop', $data['training_galop'], PDO::PARAM_INT);
        $stmt->bindParam(':training_endurance', $data['training_endurance'], PDO::PARAM_INT);
        $stmt->bindParam(':training_vitesse', $data['training_vitesse'], PDO::PARAM_INT);
        $stmt->bindParam(':training_physique', $data['training_physique'], PDO::PARAM_INT);

        $stmt->execute();
    }

    public function updateTraining($data)
    {
        $query = "UPDATE horses_training
                  SET training_trot = :training_trot, training_galop =:training_galop, training_endurance =:training_endurance, training_vitesse =:training_vitesse, training_physique =:training_physique, training_fatigue = :training_fatigue
                  WHERE horse_id =:horse_id";
        $stmt = Database::prepare($query);

        $stmt->bindParam(':horse_id', $data['horse_id'], PDO::PARAM_INT);
        $stmt->bindParam(':training_trot', $data['training_trot'], PDO::PARAM_INT);
        $stmt->bindParam(':training_galop', $data['training_galop'], PDO::PARAM_INT);
        $stmt->bindParam(':training_endurance', $data['training_endurance'], PDO::PARAM_INT);
        $stmt->bindParam(':training_vitesse', $data['training_vitesse'], PDO::PARAM_INT);
        $stmt->bindParam(':training_physique', $data['training_physique'], PDO::PARAM_INT);
        $stmt->bindParam(':training_fatigue', $data['training_fatigue'], PDO::PARAM_INT);

        $stmt->execute();
    }
}