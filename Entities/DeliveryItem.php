<?php
/**
 * Created by PhpStorm.
 * User: micro
 * Date: 04-Oct-17
 * Time: 20:09
 */

namespace VuurwerkPOS\Entities;


class DeliveryItem
{
    private $sku;
    private $quantity;
    private $amount;

    /**
     * Unique supplier identifier
     *
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     *
     * @return DeliveryItem
     */
    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    /**
     * Number of items in a packaging unit
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param integer $quantity
     *
     * @return DeliveryItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Amount of packaging units
     *
     * @return integer
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param integer $amount
     *
     * @return DeliveryItem
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }


    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'sku'      => $this->sku,
            'quantity' => $this->quantity,
            'amount'   => $this->amount
        ];
    }


}