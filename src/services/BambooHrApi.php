<?php

namespace BambooHRApi\services;

use BambooHRApi\api\BenefitsApi;
use BambooHRApi\api\EmployeesApi;
use BambooHRApi\BambooHrClient;
use BambooHRApi\conf\BambooHrConf;
use BambooHRApi\dto\BenefitGroupDto;
use BambooHRApi\dto\BenefitGroupPlanDto;
use BambooHRApi\dto\EmployeeBenefitDeductionDto;
use BambooHRApi\dto\EmployeeDto;

class BambooHrApi
{
    /**
     * @var BambooHrClient
     */
    private $api;

    public function __construct($subdomain, $apiKey, $guzzleConfig = [])
    {
        $conf = new BambooHrConf();
        $conf->setApiKey($apiKey)
            ->setSubdomain($subdomain)
            ->setGuzzleConfig($guzzleConfig);
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
            $diff = array_diff($fields, $properties);
            if (empty($diff)) {
                $result[] = $employee;
                continue;
            }
            $result[] = EmployeesApi::getEmployee($this->api, $employee->id, $fields);
        }

        return $result;
    }

    /**
     * @return BenefitGroupDto[]
     */
    public function getBenefitGroups()
    {
        return BenefitsApi::getBenefitGroups($this->api);
    }

    /**
     * @return BenefitGroupPlanDto[]
     */
    public function getBenefitGroupPlans()
    {
        return BenefitsApi::getBenefitGroupPlans($this->api);
    }

    /**
     * @param $groupPlanId
     *
     * @return EmployeeBenefitDeductionDto[]
     */
    public function getEmployeesDeductions($groupPlanId)
    {
        return BenefitsApi::getBenefitEmployeeDeductions($this->api, $groupPlanId);
    }
}