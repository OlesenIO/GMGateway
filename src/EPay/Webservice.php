<?php

namespace OlesenIO\GMGateway\EPay;

class Webservice
{
    private $client = null;
    private $merchant = '';
    private $pwd = '';

    public function __construct()
    {
        $this->client = new \SoapClient(config('GMGateway.client'));
        $this->merchant = config('GMGateway.merchant');
        $this->pwd = config('GMGateway.password');
    }

    /**
     * Capture the payment
     *
     * @param mixed $transactionid
     * @param mixed $amount
     * @return mixed
     */
    public function capture($transactionid, $amount)
    {
        return $this->client->capture([
            'merchantnumber' => $this->merchant,
            'transactionid' => $transactionid,
            'amount' => (string) $amount,
            'pwd' => $this->pwd,
            'pbsResponse' => '-1',
            'epayresponse' => '-1',
        ]);
    }

    /**
     * Move the payment as captured
     *
     * @param mixed $transactionid
     * @return mixed
     */
    public function moveascaptured($transactionid)
    {
        return $this->client->move_as_captured([
            'merchantnumber' => $this->merchant,
            'transactionid' => $transactionid,
            'pwd' => $this->pwd,
            'epayresponse' => '-1',
        ]);
    }

    /**
     * Credit the payment
     *
     * @param mixed $transactionid
     * @param mixed $amount
     * @return mixed
     */
    public function credit($transactionid, $amount)
    {
        return $this->client->credit([
            'merchantnumber' => $this->merchant,
            'transactionid' => $transactionid,
            'amount' => (string) $amount,
            'pwd' => $this->pwd,
            'pbsResponse' => '-1',
            'epayresponse' => '-1',
        ]);
    }

    /**
     * Delete the payment
     *
     * @param mixed $transactionid
     * @return mixed
     */
    public function delete($transactionid)
    {
        return $this->client->delete([
            'merchantnumber' => $this->merchant,
            'transactionid' => $transactionid,
            'pwd' => $this->pwd,
            'epayresponse' => '-1',
        ]);
    }

    /**
     * Get ePay error message
     *
     * @param mixed $epay_response_code
     * @param mixed $language
     * @return mixed
     */
    public function getEpayError($epay_response_code, $language)
    {
        $result = $this->client->getEpayError([
            'merchantnumber' => $this->merchant,
            'language' => $language,
            'pwd' => $this->pwd,
            'epayresponsecode' => $epay_response_code,
            'epayresponse' => '-1',
        ]);

        if ($result->getEpayErrorResult) {
            return $result->epayresponsestring;
        } else {
            return "";
        }
    }

    /**
     * Get PBS error message
     *
     * @param mixed $pbs_response_code
     * @param mixed $language
     * @return mixed
     */
    public function getPbsError($pbs_response_code, $language)
    {
        $result = $this->client->getPbsError([
            'merchantnumber' => $this->merchant,
            'language' => $language,
            'pwd' => $this->pwd,
            'pbsresponsecode' => $pbs_response_code,
            'epayresponse' => '-1',
        ]);

        if ($result->getPbsErrorResult) {
            return $result->pbsresponsestring;
        } else {
            return "";
        }
    }

    /**
     * Get a transaction
     *
     * @param mixed $transactionid
     * @return mixed
     */
    public function gettransaction($transactionid)
    {
        return $this->client->gettransaction([
            'merchantnumber' => $this->merchant,
            'transactionid' => $transactionid,
            'pwd' => $this->pwd,
            'epayresponse' => '-1',
        ]);
    }

    /**
     * Get card information
     *
     * @param mixed $cardno_prefix
     * @param mixed $amount
     * @param mixed $currency
     * @param mixed $acquirer
     * @return mixed
     */
    public function getcardinfo($cardno_prefix, $amount, $currency, $acquirer)
    {
        return $this->client->capture([
            'merchantnumber' => $this->merchant,
            'cardno_prefix' => $cardno_prefix,
            'amount' => (string) $amount,
            'currency' => $currency,
            'acquirer' => $acquirer,
            'pwd' => $this->pwd,
            'epayresponse' => '-1',
        ]);
    }
}
