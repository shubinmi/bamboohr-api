<?php

namespace BambooHRApi\dto;

use BaseHelpers\hydrators\ConstructFromArrayOrJson;

class BenefitGroupPlanDto extends ConstructFromArrayOrJson
{
    const ELIGIBILITY_MANUAL         = 'manual';
    const ELIGIBILITY_HIRE_DATE      = 'hire_date';
    const ELIGIBILITY_WAITING_PERIOD = 'waiting_period';
    const ELIGIBILITY_MONTH_AFTER_WP = 'month_after_waiting_period';

    const WAIT_TYPE_DAYS   = 'days';
    const WAIT_TYPE_WEEKS  = 'weeks';
    const WAIT_TYPE_MONTHS = 'months';
    const WAIT_TYPE_YEARS  = 'years';

    /**
     * @var int
     */
    public $id;

    /**
     * @var int
     */
    public $benefitGroupId;

    /**
     * @var int
     */
    public $benefitPlanId;

    /**
     * @var string
     */
    public $eligibility;

    /**
     * @var int
     */
    public $waitPeriod;

    /**
     * @var string
     */
    public $waitPeriodType;

    /**
     * @var string YYYY-MM-DD
     */
    public $startDate;

    /**
     * @var string YYYY-MM-DD
     */
    public $endDate;

    /**
     * @var bool
     */
    public $archived;
}