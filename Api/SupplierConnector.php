<?php
/**
 * Created by PhpStorm.
 * User: micro
 * Date: 04-Oct-17
 * Time: 19:38
 */

namespace VuurwerkPOS\Api;


use Doctrine\Common\Collections\ArrayCollection;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use VuurwerkPOS\Entities\Delivery;
use VuurwerkPOS\Exception\Exception;

class SupplierConnector
{
    private $supplierKey;
    private $syncKey;
    private $endPoint = 'https://admin.vuurwerkpos.nl/api/';

    /**
     * SupplierConnector constructor.
     *
     * @param string $supplierKey
     * @param string $syncKey
     */
    public function __construct($supplierKey, $syncKey)
    {
        $this->supplierKey = $supplierKey;
        $this->syncKey     = $syncKey;
    }

    /**
     * @param ArrayCollection|Delivery[] $deliveries
     *
     * @return bool
     */
    public function postDeliveries(ArrayCollection $deliveries)
    {
        $deliveries = array_map(function ($a) {
            return $a->toArray();
        }, $deliveries->toArray());

        return $this->exec('delivery/syncList', [
            'deliveries' => $deliveries
        ]);
    }

    /**
     * @param $function
     * @param array|null $data
     *
     * @return bool
     *
     * @throws Exception
     */
    private function exec($function, array $data = null)
    {
        $client = new Client();

        try {
            $response = $client->request('POST', $this->endPoint . $function, [
                'json' => $this->getBody($data)
            ]);

            $data = \GuzzleHttp\json_decode($response->getBody(), true);

            if ( ! isset($data['status']) || $data['status'] != 200) {
                return false;
            }
        } catch (ClientException $exception) {
            $data = \GuzzleHttp\json_decode($exception->getResponse()->getBody(), true);

            throw new Exception(\GuzzleHttp\json_encode($data['errors']), $data['status']);
        }

        return true;
    }

    /**
     * @param array|null $data
     *
     * @return array
     */
    private function getBody(array $data = null)
    {
        return array_merge($data, [
            'auth' => [
                'supplier_key' => $this->supplierKey,
                'sync_key'     => $this->syncKey
            ]
        ]);
    }

    /**
     * @param string $syncKey
     */
    public function setSyncKey($syncKey)
    {
        $this->syncKey = $syncKey;
    }
}