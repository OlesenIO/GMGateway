<?php

namespace OlesenIO\GMGateway\Economics;

class Webservice
{
    private $client;

    public function __construct()
    {
        try {
            $this->client = new \SoapClient('https://api.e-conomic.com/secure/api1/EconomicWebservice.asmx?WSDL', [
                'trace' => true,
                'exceptions' => true,
                'classmap' => [
                    'ProductData' => 'ProductData',
                    'ProductHandle' => 'Product',
                ],
            ]);
            $this->client->ConnectWithToken([
                'token' => config('GMGateway.economics_token'),
                'appToken' => config('GMGateway.economics_app_token'),
            ]);
        } catch (Exception $e) {
            throw new Exception('Could not connect. Check configuration.');
        }
    }

    public function create($data)
    {
        try {
            $currentInvoice = $this->client->CurrentInvoice_CreateFromData([
                "data" => [
                    "Id" => $data['order_id'],
                    "DebtorHandle" => [
                        "Number" => $data['order_id'],
                    ],
                    "DebtorName" => $data['customer']['name'],
                    "DebtorAddress" => $data['customer']['address'],
                    "DebtorPostalCode" => $data['customer']['zip'],
                    "DebtorCity" => $data['customer']['city'],
                    "OtherReference" => $data['order_id'],
                    "Date" => strtotime($data['date']),
                    "VatZone" => [
                        "Number" => 1,
                    ],
                    "CurrencyHandle" => [
                        "Code" => "DKK",
                    ],
                    "TermOfPaymentHandle" => [
                        "Id" => $data['payment_type'],
                    ],
                    "ExchangeRate" => 0,
                    "IsVatIncluded" => true,
                    "NetAmount" => 0,
                    "VatAmount" => 0.25,
                    "GrossAmount" => "0",
                    "Margin" => 0,
                    "MarginAsPercent" => 0,
                ],
            ])->CurrentInvoice_CreateFromDataResult;

            // insert product lines
            foreach ($data['products'] as $productLine) {
                $invoiceLine = $this->client->CurrentInvoiceLine_Create([
                    "invoiceHandle" => $currentInvoice,
                ])->CurrentInvoiceLine_CreateResult;

                $this->client->CurrentInvoiceLine_UpdateFromData([
                    "data" => [
                        "Handle" => [
                            "Id" => $invoiceLine->Id,
                            "Number" => $invoiceLine->Number,
                        ],
                        "Id" => $invoiceLine->Id,
                        "Number" => $invoiceLine->Number,
                        "InvoiceHandle" => [
                            "Id" => $invoiceLine->Id,
                        ],
                        "ProductHandle" => [
                            "Number" => $productLine->id,
                        ],
                        "Description" => $productLine->title,
                        "DeliveryDate" => 0,
                        "UnitNetPrice" => $productLine->price,
                        "TotalNetAmount" => $productLine->price * 1.2,
                        "UnitCostPrice" => 0,
                        "Quantity" => $productLine->amount,
                        "DepartmentHandle" => [
                            "Number" => 1,
                        ],
                        "DiscountAsPercent" => 0,
                        "TotalMargin" => 0,
                        "MarginAsPercent" => 0,
                    ],
                ]);
            }

            // book invoice
            return $this->client->CurrentInvoice_Book([
                "currentInvoiceHandle" => $currentInvoice,
            ])->CurrentInvoice_BookResult->Number;
        } catch (Exception $e) {
            throw new Exception('Could not create invoice.');
        }
    }
}
