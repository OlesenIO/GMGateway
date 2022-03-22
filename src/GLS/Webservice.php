<?php

namespace OlesenIO\GMGateway\GLS;

class Webservice
{
    private $client = null;

    public function __construct($encoding = 'UTF-8')
    {
        $this->client = new \SoapClient('http://www.gls.dk/webservices_v4/wsShopFinder.asmx?WSDL', [
            'trace' => 1,
            'encoding' => $encoding,
        ]);
    }

    /**
     * Search for nearest ParcelShops to an address
     */
    public function searchNearestParcelShops($street, $zipcode, $country = 'DK', $amount = 10): array
    {
        try {
            $shops = $this->client->SearchNearestParcelShops([
                'street' => $street,
                'zipcode' => $zipcode,
                'countryIso3166A2' => $country,
                'Amount' => $amount,
            ]);
            return $shops->SearchNearestParcelShopsResult->parcelshops->PakkeshopData;
        } catch (\Exception$e) {
            return [];
        }
    }

    /**
     * Get ParcelShop droppoint close to an address
     */
    public function getParcelShopDropPoint($street, $zipcode, $country = 'DK', $amount = 1): array
    {
        try {
            $shops = $this->client->GetParcelShopDropPoint([
                'street' => $street,
                'zipcode' => $zipcode,
                'countryIso3166A2' => $country,
                'Amount' => $amount,
            ]);
            return $shops->GetParcelShopDropPointResult->parcelshops->PakkeshopData;
        } catch (\Exception$e) {
            return [];
        }
    }

}
