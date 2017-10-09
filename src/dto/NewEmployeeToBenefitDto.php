<?php

namespace BambooHRApi\dto;

use BaseHelpers\hydrators\ConstructFromArrayOrJson;

class NewEmployeeToBenefitDto extends ConstructFromArrayOrJson
{
    /**
     * @var int
     */
    public $benefitGroupId;

    /**
     * @var int
     */
    public $employeeId;

    /**
     * @var string YYYY-MM-DD
     */
    public $startDate;

    /**
     * @var string|null YYYY-MM-DD
     */
    public $endDate;
}