<?php

namespace BambooHRApi\dto;

use BambooHRApi\common\ConstructFromArrayOrJson;

class EmployeeDto extends ConstructFromArrayOrJson
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $bestEmail;

    /**
     * @var string
     */
    public $firstName;

    /**
     * @var string
     */
    public $lastName;

    /**
     * @var string
     */
    public $gender;

    /**
     * @var string
     */
    public $jobTitle;

    /**
     * @var string
     */
    public $workPhone;

    /**
     * @var string
     */
    public $facebook;

    /**
     * @var string
     */
    public $workEmail;

    /**
     * @var string
     */
    public $photoUrl;
}