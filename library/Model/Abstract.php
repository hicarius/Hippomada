<?php
abstract class Model_Abstract
{
    public $_id;

    protected $_tablename;

    protected function save(){

    }

    protected function delete($table, $id)
    {
        $this->_id = $id;
        $this->_tablename = $table;

        $query = "DELETE FROM {$this->_tablename} WHERE id = :id";
        $stmt = Database::prepare($query);
        $stmt->bindParam(':id', $this->_id);
        return $stmt->execute();
    }

    public function addMessage( $msg, $code)
    {
        Session::addMessage($msg, $code);
    }
}