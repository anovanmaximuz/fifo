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

class Fifo{

    /**
     * ApiBase getter
     *
     * @return string
     */
    public static function swap($id_harvest, $qty, $trx_type, $flow){
        return  Stock::addTransaction($id_harvest, $qty, $trx_type, $flow);
    }

}
