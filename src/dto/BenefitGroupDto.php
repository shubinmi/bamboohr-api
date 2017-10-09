<?php

namespace BambooHRApi\dto;

use BaseHelpers\hydrators\ConstructFromArrayOrJson;

class BenefitGroupDto extends ConstructFromArrayOrJson
{
    const PAY_PERIOD_DAILY         = 'daily';
    const PAY_PERIOD_WEEKLY        = 'weekly';
    const PAY_PERIOD_BI_WEEKLY     = 'bi-weekly';
    const PAY_PERIOD_SEMI_MONTHLY  = 'semi-monthly';
    const PAY_PERIOD_QUARTERLY     = 'quarterly';
    const PAY_PERIOD_SEMI_ANNUALLY = 'semi-annually';
    const PAY_PERIOD_ANNUALLY      = 'annually';

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string ["daily", "weekly", "bi-weekly", "semi-monthly", "monthly", "quarterly", "semi-annually", "annually"]
     */
    public $payPeriod;

    /**
     * @var string YYYY-MM-DD
     */
    public $startDate;

    /**
     * @var string|null YYYY-MM-DD
     */
    public $endDate;

    /**
     * @var bool
     */
    public $archived;
}