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

use Kecipir\Exceptions\InvalidArgumentException;

class Stock
{
    /**
     * Available transaction type
     *
     * @return array
     */
    public static function transactionType()
    {
        return ["SELLING","RETURN","CORRECTION","EXPIRED","BUYING","BUYING","SWAP"];
    }

    /**
     * Available flow type
     *
     * @return array
     */
    public static function flowType()
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
    public static function validateTransactionType($transaction_type = null)
    {
        if (!in_array($transaction_type, self::transactionType())) {
            $msg = "Transaction type is invalid. Available transactions: ".implode(",", self::transactionType());
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
    public static function validateFlowType($flow_type = null)
    {
        if (!in_array($flow_type, self::flowType())) {
            $msg = "Flow type is invalid. Available flows: ".implode(",", self::flowType());
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
    public static function getBalance($id_harvest = null)
    {
        self::validateTransactionType($id_harvest);
        //...
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
    public static function addTransaction($id_harvest, $qty, $transaction_type, $flow_type)
    {
        self::validateTransactionType($transaction_type);
        self::validateFlowType($flow_type);
        //...
    }
}
