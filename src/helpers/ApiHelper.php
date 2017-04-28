<?php

namespace BambooHRApi\helpers;

use BambooHRApi\BambooHrClient;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;

class ApiHelper
{
    /**
     * @param Request        $request
     * @param BambooHrClient $client
     *
     * @return Response
     * @throws \Exception
     */
    public static function getResponse(Request $request, BambooHrClient $client)
    {
        $response = $client->send($request);
        if ($response->getStatusCode() == 500) {
            $error = 'API error: ' . $response->getBody()->getContents();
            $client->addError($error);
            throw new \Exception($error);
        }
        if ($response->getStatusCode() >= 300) {
            $error =
                'API error: Status = ' . $response->getStatusCode() . ' ; ReasonPhrase = '
                . $response->getReasonPhrase() . ' ; Body = ' . $response->getBody()->getContents();
            $client->addError($error);
            throw new \Exception($error);
        }

        return $response;
    }
}