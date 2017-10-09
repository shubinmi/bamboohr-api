<?php

namespace BambooHRApi\dto;

use BaseHelpers\hydrators\ConstructFromArrayOrJson;

class EmployeeBenefitDeductionDto extends ConstructFromArrayOrJson
{
    /**
     * @var int
     */
    public $employeeId;

    /**
     * @var string
     */
    public $employeeNumber;

    /**
     * @var string
     */
    public $employeeName;

    /**
     * @var int
     */
    public $benefitPlanId;

    /**
     * @var string
     */
    public $benefitPlanName;

    /**
     * @var string
     */
    public $deductionFrequency;

    /**
     * @var string
     */
    public $coverage;

    /**
     * @var float
     */
    public $employeePays;

    /**
     * @var float
     */
    public $companyPays;

    /**
     * @var string
     */
    public $employeePaysType;

    /**
     * @var string
     */
    public $companyPaysType;

    /**
     * @var string
     */
    public $currencyCode;
}