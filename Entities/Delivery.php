<?php
/**
 * Created by PhpStorm.
 * User: micro
 * Date: 04-Oct-17
 * Time: 20:06
 */

namespace VuurwerkPOS\Entities;


use Doctrine\Common\Collections\ArrayCollection;

class Delivery
{
    private $orderDate;
    private $deliverDateStart;
    private $deliverDateEnd;
    private $externalId;
    private $deliveryItems;

    /**
     * Delivery constructor.
     */
    public function __construct()
    {
        $this->orderDate        = new \DateTime();
        $this->deliverDateStart = new \DateTime();
        $this->deliverDateEnd   = new \DateTime();
        $this->deliveryItems    = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @param \DateTime $orderDate
     *
     * @return Delivery
     */
    public function setOrderDate(\DateTime $orderDate)
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDeliverDateStart()
    {
        return $this->deliverDateStart;
    }

    /**
     *
     *
     * @param \DateTime $deliverDateStart
     *
     * @return Delivery
     */
    public function setDeliverDateStart(\DateTime $deliverDateStart)
    {
        $this->deliverDateStart = $deliverDateStart;

        return $this;
    }

    /**
     * Max expected delivery date
     *
     * @return mixed
     */
    public function getDeliverDateEnd()
    {
        return $this->deliverDateEnd;
    }

    /**
     * @param mixed $deliverDateEnd
     *
     * @return Delivery
     */
    public function setDeliverDateEnd($deliverDateEnd)
    {
        $this->deliverDateEnd = $deliverDateEnd;

        return $this;
    }

    /**
     * Unique reference for supplier
     *
     * @return mixed
     */
    public function getExternalId()
    {
        return $this->externalId;
    }

    /**
     * @param mixed $externalId
     *
     * @return Delivery
     */
    public function setExternalId($externalId)
    {
        $this->externalId = $externalId;

        return $this;
    }

    /**
     * @return ArrayCollection|DeliveryItem[]
     */
    public function getDeliveryItems()
    {
        return $this->deliveryItems;
    }

    /**
     * @param ArrayCollection|DeliveryItem[] $deliveryItems
     *
     * @return Delivery
     */
    public function setDeliveryItems(ArrayCollection $deliveryItems)
    {
        $this->deliveryItems = $deliveryItems;

        return $this;
    }

    /**
     * @param DeliveryItem $deliveryItem
     *
     * @return Delivery
     */
    public function addDeliveryItem(DeliveryItem $deliveryItem)
    {
        $this->deliveryItems->add($deliveryItem);

        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $dateTimeFormat = 'Y-m-d H:i:s';

        $deliveryItems = array_map(function ($a) {
            return $a->toArray();
        }, $this->deliveryItems->toArray());

        return [
            'external_id'        => $this->externalId,
            'order_date'         => $this->orderDate->format($dateTimeFormat),
            'deliver_date_start' => $this->deliverDateStart->format($dateTimeFormat),
            'deliver_date_end'   => $this->deliverDateEnd->format($dateTimeFormat),
            'delivery_items'     => $deliveryItems
        ];
    }
}