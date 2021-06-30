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

use Kecipir\DotEnv;

(new DotEnv(__DIR__ . '/.env'))->load();

echo getenv('APP_ENV');
class Model{
    
    protected $conn;
       
    public function loadConnection()
    {        
    
        $this->conn = new mysqli(getenv("DB_HOST"), getenv("DB_USER"), getenv("DB_PASSWORD"), getenv("DB_DATABASE"), getenv("DB_PORT"));
        
        
        if ($this->conn->connect_error) {
            error_log('Connect Error (' . $this->conn->connect_errno . ') ' . $this->conn->connect_error);
            die('Connect Error (' . $this->conn->connect_errno . ') ' . $this->conn->connect_error);
        }
        
        $this->conn->set_charset("utf8");
    }
    
}
