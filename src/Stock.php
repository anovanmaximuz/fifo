<?php

/**
 * Stock.php
 * php version 7.3.27
 *
 * @category Class
 * @package  Kecipir
 * @author   Anovan <anovanmaximuz@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT License
 * @link     https://kecipir.com
 * @support  check
 */

namespace Kecipir;

use Kecipir\InvalidArgumentException;
use Kecipir\Model as Database;
use Kecipir\DotEnv;

(new DotEnv(__DIR__ . '/.env'))->load();

class Stock
{

    protected $table_fifo = "fifo_stock";

    function __construct()
    {
        $this->table_fifo = getenv("TABLE_FIFO");
    }

    /**
     * Available transaction type
     *
     * @return array
     */
    public  function transactionType()
    {
        return ["SELLING","RETURN","CORRECTION","EXPIRED","BUYING","BUYING","SWAP"];
    }

    /**
     * Available flow type
     *
     * @return array
     */
    public function flowType()
    {
        return ["IN","OUT"];
    }

    /**
     * Validation for transaction type
     *
     * @param string $transaction_type Account type
     *
     * @return void
     */
    public  function validateTransactionType($transaction_type = null)
    {
        if (!in_array($transaction_type, $this->transactionType())) {
            $msg = "Transaction type is invalid. Available transactions: ".implode(",", $this->transactionType());
            throw new InvalidArgumentException($msg);
        }
    }

    /**
     * Validation for transaction type
     *
     * @param string $transaction_type Account type
     *
     * @return void
     */
    public  function validateFlowType($flow_type = null)
    {
        if (!in_array($flow_type, $this->flowType())) {
            $msg = "Flow type is invalid. Available flows: ".implode(",", $this->flowType());
            throw new InvalidArgumentException($msg);
        }
    }


    /**
     * Send GET request to retrieve data stock
     *
     * @param string $id_harvest of stock
     *
     * @return array[
     *  'harvest' => int,
     *  'sell' => int,
     *  'balance' => int
     * ]
     * @throws Exceptions\StockException
     */
    public  function getBalance($id_harvest)
    {
        $this->validateTransactionType($id_harvest);
        $query = "SELECT * FROM ".$this->table_fifo." WHERE id_harvest= ".$id_harvest;
        $db = new Database;
        return $db->getOne($query);
    }



    /**
     * Send POST request to send transaction stock
     *
     * @param string $id_harvest of stock
     * @param string $qty of stock
     * @param string $transaction_type of stock
     * @param string $flow_type of stock
     *
     * @return array[
     *  'status' => boolean,
     *  'message' => string
     * ]
     * @throws Exceptions\StockException
     */
    public  function addTransaction($id_harvest, $qty, $transaction_type, $flow_type)
    {
        $this->validateTransactionType($transaction_type);
        $this->validateFlowType($flow_type);
        //...
    }
}
