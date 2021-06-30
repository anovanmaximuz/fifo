<?php

/**
 * Fifo.php
 * php version 7.3.27
 *
 * @category Class
 * @package  Kecipir
 * @author   Anovan <anovanmaximuz@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://kecipir.com
 * @support  selling,return,correction,expired,buying,harvest,swap
 */

namespace Kecipir;

use Kecipir\Stock as Stock;
use Kecipir\Database\Model as Database;

class Fifo{

    /**
     * Selling
     *
     * @return string
     */
    public static function selling($id_harvest, $qty){
        return  Stock::addTransaction($id_harvest, $qty, "SELLING", "OUT");
    }

    /**
     * Return
     *
     * @return string
     */
    public static function return($id_harvest, $qty){
        return  Stock::addTransaction($id_harvest, $qty, "RETURN", "IN");
    }

    /**
     * Correction
     *
     * @return string
     */
    public static function correction($id_harvest, $qty, $flow){
        return  Stock::addTransaction($id_harvest, $qty, "CORRECTION", $flow);
    }


    /**
     * Expired
     *
     * @return string
     */
    public static function expired($id_harvest, $qty){
        return  Stock::addTransaction($id_harvest, $qty, "EXPIRED", "OUT");
    }

     /**
     * Expired
     *
     * @return string
     */
    public static function buying($id_harvest, $qty){
        return  Stock::addTransaction($id_harvest, $qty, "BUYING", "IN");
    }


    /**
     * Swapp / tukar guling
     *
     * @return string
     */
    public static function swap($id_harvest, $qty, $trx_type, $flow){
        return  Stock::addTransaction($id_harvest, $qty, $trx_type, $flow);
    }

    /**
     * ApiBase getter
     *
     * @return string
     */
    public static function check($tetxt){
        echo $tetxt;
        return Database::connectMysql();
    }


}
