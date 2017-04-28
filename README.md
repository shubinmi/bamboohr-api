# Client for BambooHR Api 
## Easy way to manipulate your Employees data

Don't worry, Be happy

## Installation

Install the latest version with

```bash
$ composer require shubinmi/bamboohr-api
```

## Basic Usage

```php
<?php

use BambooHRApi\services\BambooHrApi;

// Init Api
$api = new BambooHrApi('myCompanySubdomain', 'myApiKey');

// Get all employees
$employees = $api->getAllEmployees();
// Get additional information of each employee
$employees = $api->getMoreInfoForEmployees($employees, ['bestEmail', 'facebook']);

foreach ($employees as $employee) {
    echo 'Email: ' .$employee->workEmail . PHP_EOL;
    echo 'First name: ' .$employee->firstName . PHP_EOL;
    echo 'Last name: ' .$employee->lastName . PHP_EOL;
    echo 'Facebook: ' .$employee->facebook . PHP_EOL;
}
```

Other way to get same

```php
<?php

use BambooHRApi\api\EmployeesApi;
use BambooHRApi\BambooHrClient;
use BambooHRApi\conf\BambooHrConf;

// Init Api client
$conf = new BambooHrConf();
$conf->setApiKey('apiKey')
    ->setSubdomain('subdomain');
$client = new BambooHrClient($conf);

// Get all employees
$employees = EmployeesApi::getDirectoryEmployees($client);
// Get additional information of first employee
$firstEmployee = EmployeesApi::getEmployee($client, current($employees)->id, ['bestEmail', 'facebook']);

foreach ($employees as $employee) {
    echo 'Email: ' . $employee->workEmail . PHP_EOL;
    echo 'First name: ' . $employee->firstName . PHP_EOL;
    echo 'Last name: ' . $employee->lastName . PHP_EOL;
    echo 'Facebook: ' . $employee->facebook . PHP_EOL;
}

echo 'Best email: ' . $firstEmployee->bestEmail . PHP_EOL;
echo 'Facebook: ' . $firstEmployee->facebook . PHP_EOL;

```

## Easy for contribute

Extend coverage bambooHR api at once. 
Just look at "api" folder and put your code here.
