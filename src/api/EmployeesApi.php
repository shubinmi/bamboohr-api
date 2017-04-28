<?php

namespace BambooHRApi\api;

use BambooHRApi\BambooHrClient;
use BambooHRApi\dto\EmployeeDto;
use BambooHRApi\helpers\ApiHelper;
use GuzzleHttp\Psr7\Request;

class EmployeesApi
{
    /**
     * @param BambooHrClient $client
     *
     * @return EmployeeDto[]
     */
    public static function getDirectoryEmployees(BambooHrClient $client)
    {
        $request  = new Request(
            'GET',
            $client->getEndpoint() . 'employees/directory',
            ['Accept' => 'application/json']
        );
        $response = ApiHelper::getResponse($request, $client);
        $result   = json_decode($response->getBody()->getContents(), true);
        if (empty($result['employees'])) {
            return [];
        }
        $result    = $result['employees'];
        $employees = [];
        foreach ($result as $employee) {
            $employees[] = new EmployeeDto($employee);
        }

        return $employees;
    }

    /**
     * @param BambooHrClient $client
     * @param integer        $employeeId
     * @param array          $fields
     *
     * @return EmployeeDto
     */
    public static function getEmployee(
        BambooHrClient $client,
        $employeeId,
        array $fields = ['firstName', 'lastName', 'bestEmail']
    ) {
        $request  = new Request(
            'GET',
            $client->getEndpoint() . 'employees/' . $employeeId . '?' . implode(',', $fields),
            ['Accept' => 'application/json']
        );
        $response = ApiHelper::getResponse($request, $client);

        return new EmployeeDto($response->getBody()->getContents());
    }
}