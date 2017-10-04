<?php
require_once 'vendor/autoload.php';

$supplierKey = 'supplier-connection-key';
$syncKey     = 'supplier-connection-key';

$connector = new \VuurwerkPOS\Api\SupplierConnector($supplierKey, $syncKey);

$delivery = new \VuurwerkPOS\Entities\Delivery();
$delivery->setExternalId(1094);
$delivery->setOrderDate(new \DateTime());
$delivery->setDeliverDateStart(
    (new \DateTime())
        ->add(new \DateInterval('P1W'))
);
$delivery->setDeliverDateEnd(
    (new \DateTime())
        ->add(new \DateInterval('P1W1D'))
);

$deliveryItems = new \Doctrine\Common\Collections\ArrayCollection([
    (new \VuurwerkPOS\Entities\DeliveryItem())
        ->setQuantity(25)
        ->setAmount(5)
        ->setSku('123'),
    (new \VuurwerkPOS\Entities\DeliveryItem())
        ->setQuantity(10)
        ->setAmount(6)
        ->setSku('124')
]);

$delivery->setDeliveryItems($deliveryItems);

try {
    $success = $connector->postDeliveries(
        new \Doctrine\Common\Collections\ArrayCollection([
            $delivery
        ])
    );

    echo ($success ? 'Success' : 'Failed') . PHP_EOL;
} catch (\VuurwerkPOS\Exception\Exception $exception) {
    echo $exception->getCode() . PHP_EOL;
    echo $exception->getMessage();
}