<?php

/**
 * Model.php
 * php version 7.2.0
 *
 * @category Exception
 * @package  Kecipir\Database
 * @author   Anovan <anovanmaximuz@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://kecipir.com
 * @support  check
 */

namespace Kecipir\Database;

use Kecipir\Supports\DotEnv;

(new DotEnv(__DIR__ . '/.env'))->load();

class Model{
    
    public $conn;

    public static function connectMysql()
    {        
    
        $connect = new mysqli(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_DATABASE"), getenv("DB_USER"));
        
        
        if ($connect->connect_error) {
            error_log('Connect Error (' . $connect->connect_errno . ') ' . $connect->connect_error);
            die('Connect Error (' . $connect->connect_errno . ') ' . $connect->connect_error);            
        }else{
            echo "ok connect";
        }
        
        $connect->set_charset("utf8");

        return $connect;
    }

    public function runTransaction($arrayFields, $table, $model, $where, $query=false){ 
        if($query!=false){
            $sqlInsert = $query;
        }else{
            $sqlInsert = $this->createQuery($arrayFields,$table,$model,$where);
            
        }
        
        $result = $this->conn->query($sqlInsert);
        if($result){
            if($this->conn->affected_rows > 0) {
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        } 
    }

    # createQuery($query,'tbl_nama','update',array('freequery'=>"dasdsa d"));
    protected function createQuery($arrays, $table, $action = 'insert', $where = array())
    {
        $q   = '';
        $num = 0;
        if (is_array($arrays)) {
            foreach ($arrays as $key => $value) {
                $q .= "$key ='$value'" . ((count($arrays) == $num + 1) ? '' : ',');
                $num++;
            }
        }
        
        if ($action == 'insert') {
            return 'INSERT INTO ' . $table . ' SET ' . $q;
        } else if ($action == 'delete') {
            $c  = '';
            $no = 0;
            foreach ($where as $key => $value) {
                $c .= (($no == 0) ? '' : ' AND ');
                $c .= "$key ='$value'";                
                $no++;
            }
            return 'DELETE FROM ' . $table . ' WHERE ' . $c;
        } else if ($action == 'update') {
            if (count($where) != 0) {
                if (isset($where['freequery'])) {
                    return 'UPDATE ' . $table . ' SET ' . $q . ' WHERE ' . $where['freequery'];
                } else {
                    $c  = '';
                    $no = 0;
                    foreach ($where as $key => $value) {
                        $c .= (($no == 0) ? '' : ' AND ');
                        $c .= "$key ='$value'";
                        $no++;
                    }
                    return 'UPDATE ' . $table . ' SET ' . $q . ' WHERE ' . $c;
                }
            } else {
                return 'UPDATE ' . $table . ' SET ' . $q;
            }
        }
        
    }

    protected function sqlBreak($table, $fields, $qWhere, $qSort, $offset, $limit, $fetchone = false)
    {
        if (!$fetchone) {
            $sql = sprintf("SELECT 
                        %s 
                    FROM 
                        %s
                    WHERE  %s 
                    ORDER BY
                        %s
                    LIMIT 
                        %d,%d", implode(',', $fields), $table, $qWhere, $qSort, $offset, $limit);
        } else {
            $sql = sprintf("SELECT 
                    %s 
                FROM 
                    %s
                WHERE  %s 
                ORDER BY
                    %s", implode(',', $fields), $table, $qWhere, $qSort);
        }
        return $sql;
    }
    

    public function getAll($query)
    {
        $result = $this->conn->query($query); 

        if($result){
            if($this->conn->affected_rows != 0) {
                $data = array();
                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                return (count($data)>0) ? $data : false;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function getOne($query)
    {
        $result = $this->conn->query($query);
        
        if ($result) {
            return $result->fetch_assoc();            
        } else {
            return false;
        }
    }
    
}
