<?php

namespace BambooHRApi\services;

use BambooHRApi\api\EmployeesApi;
use BambooHRApi\BambooHrClient;
use BambooHRApi\conf\BambooHrConf;
use BambooHRApi\dto\EmployeeDto;

class BambooHrApi
{
    /**
     * @var BambooHrClient
     */
    private $api;

    public function __construct($subdomain, $apiKey)
    {
        $conf = new BambooHrConf();
        $conf->setApiKey($apiKey)
            ->setSubdomain($subdomain);
        $this->api = new BambooHrClient($conf);
    }

    /**
     * @return EmployeeDto[]
     */
    public function getAllEmployees()
    {
        return EmployeesApi::getDirectoryEmployees($this->api);
    }

    /**
     * @param EmployeeDto[] $employees
     * @param array         $fields
     *
     * @return EmployeeDto[]
     */
    public function getMoreInfoForEmployees(
        array $employees, $fields = ['firstName', 'lastName', 'workEmail', 'photoUrl']
    ) {
        $result = [];
        foreach ($employees as $employee) {
            $properties = array_keys(get_object_vars($employee));
            if (empty(array_diff($fields, $properties))) {
                $result[] = $employee;
                continue;
            }
            $result[] = EmployeesApi::getEmployee($this->api, $employee->id, $fields);
        }

        return $result;
    }
}