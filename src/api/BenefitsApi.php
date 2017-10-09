<?php

namespace BambooHRApi\api;

use BambooHRApi\BambooHrClient;
use BambooHRApi\dto\BenefitGroupDto;
use BambooHRApi\dto\BenefitGroupPlanDto;
use BambooHRApi\dto\EmployeeBenefitDeductionDto;
use BambooHRApi\dto\NewEmployeeToBenefitDto;
use BambooHRApi\helpers\ApiHelper;
use GuzzleHttp\Psr7\Request;

class BenefitsApi
{
    /**
     * @param BambooHrClient $client
     *
     * @return BenefitGroupDto[]
     */
    public static function getBenefitGroups(BambooHrClient $client)
    {
        $request  = new Request(
            'GET',
            $client->getEndpoint() . 'benefitgroups',
            ['Accept' => 'application/json']
        );
        $response = ApiHelper::getResponse($request, $client);
        $result   = json_decode($response->getBody()->getContents(), true);
        if (empty($result['Benefit Groups'])) {
            return [];
        }
        $result        = $result['Benefit Groups'];
        $benefitGroups = [];
        foreach ($result as $item) {
            $benefitGroups[] = new BenefitGroupDto($item);
        }

        return $benefitGroups;
    }

    /**
     * @param BambooHrClient $client
     *
     * @return BenefitGroupPlanDto[]
     */
    public static function getBenefitGroupPlans(BambooHrClient $client)
    {
        $request  = new Request(
            'GET',
            $client->getEndpoint() . 'benefitgroupplans',
            ['Accept' => 'application/json']
        );
        $response = ApiHelper::getResponse($request, $client);
        $result   = json_decode($response->getBody()->getContents(), true);
        if (empty($result['Benefit Group Plans'])) {
            return [];
        }
        $result        = $result['Benefit Group Plans'];
        $benefitGroups = [];
        foreach ($result as $item) {
            $benefitGroups[] = new BenefitGroupPlanDto($item);
        }

        return $benefitGroups;
    }

    /**
     * @param BambooHrClient      $client
     * @param BenefitGroupPlanDto $groupPlan
     *
     * @return bool
     */
    public static function addBenefitGroupPlan(BambooHrClient $client, BenefitGroupPlanDto $groupPlan)
    {
        $request = new Request(
            'POST',
            $client->getEndpoint() . 'benefitgroupplans',
            ['Accept' => 'application/json'],
            $groupPlan->toJson()
        );
        ApiHelper::getResponse($request, $client);

        return true;
    }

    /**
     * @param BambooHrClient $client
     * @param int            $benefitGroupPlanId
     *
     * @return EmployeeBenefitDeductionDto[]
     */
    public static function getBenefitEmployeeDeductions(BambooHrClient $client, $benefitGroupPlanId)
    {
        $request  = new Request(
            'GET',
            $client->getEndpoint() . 'deductions/' . $benefitGroupPlanId,
            ['Accept' => 'application/json']
        );
        $response = ApiHelper::getResponse($request, $client);
        $result   = json_decode($response->getBody()->getContents(), true);
        if (empty($result['employeeBenefitDeductions'])) {
            return [];
        }
        $result        = $result['employeeBenefitDeductions'];
        $benefitGroups = [];
        foreach ($result as $item) {
            $benefitGroups[] = new EmployeeBenefitDeductionDto($item);
        }

        return $benefitGroups;
    }

    /**
     * @param BambooHrClient  $client
     * @param BenefitGroupDto $group
     *
     * @return bool
     */
    public function addBenefitGroup(BambooHrClient $client, BenefitGroupDto $group)
    {
        $request = new Request(
            'POST',
            $client->getEndpoint() . 'benefitgroups',
            ['Accept' => 'application/json'],
            $group->toJson()
        );
        ApiHelper::getResponse($request, $client);

        return true;
    }

    /**
     * @param BambooHrClient          $client
     * @param NewEmployeeToBenefitDto $employee
     *
     * @return bool
     */
    public function addEmployeeToBenefitGroup(BambooHrClient $client, NewEmployeeToBenefitDto $employee)
    {
        $request = new Request(
            'POST',
            $client->getEndpoint() . 'benefitgroupemployees',
            ['Accept' => 'application/json'],
            $employee->toJson()
        );
        ApiHelper::getResponse($request, $client);

        return true;
    }
}