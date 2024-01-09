<?php
class Database
{
    private $__conn;
    function __construct()
    {
        global $db_config;
        $this->__conn = Connection::getInstance($db_config);
    }

    function insert($table, $data)
    {
        if (!empty($data)) {
            $fieldStr = '';
            $valueStr = '';
            foreach ($data as $key => $value) {
                $fieldStr .= $key . ",";
                $valueStr .= "'" . $value . "',";
            }
            $fieldStr = rtrim($fieldStr, ",");
            $valueStr = rtrim($valueStr, ",");
            $sql = "INSERT INTO $table($fieldStr) VALUES($valueStr)";
            $status = $this->query($sql);
            if ($status) {
                return true;
            }
        }
        return false;
    }

    function update($table, $data, $condition = '')
    {
        if (!empty($data)) {
            $updataStr = '';
            foreach ($data as $key => $value) {
                $updataStr .= "$key='$value',";  // Sửa đoạn này để nối thêm chuỗi
            }
            $updataStr = rtrim($updataStr, ',');
            if (!empty($condition)) {
                $sql = "UPDATE $table SET $updataStr WHERE $condition";
            } else {
                $sql = "UPDATE $table SET $updataStr";
            }

            $status = $this->query($sql);
            if ($status) {
                return true;
            }
        }
        return false;
    }


    function query($sql, $params = [])
    {
        $statement = $this->__conn->prepare($sql);
        $statement->execute($params);
        return $statement;
    }


    function lastInsertId()
    {
        return $this->__conn->lastInsertId();
    }
}
