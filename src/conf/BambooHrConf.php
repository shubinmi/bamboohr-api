<?php

namespace BambooHRApi\conf;

class BambooHrConf
{
    /**
     * @var string
     */
    private $version = 'v1';

    /**
     * @var array
     */
    private $guzzleConfig = ['timeout' => 3];

    /**
     * @var string
     */
    private $endpoint = 'https://api.bamboohr.com/api/gateway.php/%s/%s/';

    /**
     * @var string
     */
    private $subdomain;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @return string
     */
    public function getSubdomain()
    {
        return $this->subdomain;
    }

    /**
     * @param string $subdomain
     *
     * @return $this
     */
    public function setSubdomain($subdomain)
    {
        $this->subdomain = $subdomain;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     *
     * @return $this
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return array
     */
    public function getGuzzleConfig()
    {
        return $this->guzzleConfig;
    }

    /**
     * @param array $guzzleConfig
     *
     * @return $this
     */
    public function setGuzzleConfig(array $guzzleConfig)
    {
        $this->guzzleConfig = $guzzleConfig;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndpoint()
    {
        return $this->endpoint;
    }

    /**
     * @param string $endpoint
     *
     * @return $this
     */
    public function setEndpoint($endpoint)
    {
        $this->endpoint = $endpoint;
        return $this;
    }
}