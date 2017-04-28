<?php

namespace BambooHRApi;

use BambooHRApi\conf\BambooHrConf;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class BambooHrClient
{
    /**
     * @var Client
     */
    private $httpClient;

    /**
     * @var Response
     */
    private $lastResponse;

    /**
     * @var array
     */
    private $errors = [];

    /**
     * @var string
     */
    private $endpoint;

    /**
     * @var array
     */
    private $guzzleConf = [];

    /**
     * @param BambooHrConf $conf
     */
    public function __construct(BambooHrConf $conf)
    {
        if (!$conf->getVersion()) {
            throw new \InvalidArgumentException('Version of bambooHr are required.');
        }
        if (!$conf->getSubdomain()) {
            throw new \InvalidArgumentException('Subdomain (company) of bambooHr are required.');
        }
        if (!$conf->getApiKey()) {
            throw new \InvalidArgumentException('Api key of bambooHr are required.');
        }
        $auth             = ['auth' => [$conf->getApiKey(), 'x']];
        $this->guzzleConf = array_merge($conf->getGuzzleConfig(), $auth);
        $this->endpoint   = sprintf($conf->getEndpoint(), $conf->getSubdomain(), $conf->getVersion());
        $this->httpClient = new Client();
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param Request $request
     * @param array   $options
     *
     * @return Response
     * @throws \Exception
     */
    public function send(Request $request, array $options = [])
    {
        $options = array_merge($this->guzzleConf, $options);
        try {
            $this->lastResponse = $this->httpClient->send($request, $options);
        } catch (\Exception $e) {
            $requestInfo    = [
                'uri'     => $request->getUri(),
                'method'  => $request->getMethod(),
                'headers' => $request->getHeaders(),
                'body'    => (string)$request->getBody()
            ];
            $errorMsg       =
                'ApiSalesforce request error: ' . $e->getCode() . ' ; ' . $e->getMessage() . ' ; Request info: '
                . json_encode($requestInfo);
            $this->errors[] = $errorMsg;

            throw new \Exception($errorMsg);
        }

        return clone $this->lastResponse;
    }

    /**
     * @return Response
     */
    public function getLastResponse()
    {
        return $this->lastResponse;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param string $msg
     */
    public function addError($msg)
    {
        $this->errors[] = (string)$msg;
    }
}