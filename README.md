# Framework
## Lumen PHP Framework

Laravel Lumen is a stunningly fast PHP *micro-framework* for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

# Languages & Tools
* PHP 7.3.3
* Lumen 8.0
* Postman

# How to run the service.
* Clone the service from git repo : 
* `composer install`
* `php -S localhost:8000 -t public`
* Open Postman
* Run - http://localhost:8000/api/lunarColony/getLunarTime
* Param
    * key: `earth-time-utc`
    * value: `string2021-10-10 15:28:14`

# Service & API Details
## API Method
* `getLunarTime` - Calculates the lunar time according to <br />
  http://lunarclock.org/what-is-lunar-standard-time.php
    * 2 Required parameters
    * Parameters type is string.


## Request
URL - http://localhost:8000/api/lunarColony/getLunarTime <br />
End Url - `http://localhost:8000/api/lunarColony/getLunarTime?earth-time-utc=2021-10-10 15:28:14`
* Input Param
    * key: `earth-time-utc`
    * value: `2021-10-10 15:28:14`

## Response
Output
```bash
53-11-10 ∇ 03:01:14
```

## Expected Errors
* 500 Internal Server Error - `No parameters passed, Invalid input !!!!`
* 500 Internal Server Error - `Incorrect parameter!. Please use `earth-time-utc` as KEY &amp; `yyyy-mm-dd HH:MM:SS` as VALUE in API param.`
* 500 Internal Server Error - `Error : Invalid Year, year should be greater than 1969`
* 500 Internal Server Error - `Error : Invalid Month, month should be &gt;0 &amp; &lt;=12`

## Unit Test
* Run via CLI - `vendor/bin/phpunit`
```bash
$ vendor/bin/phpunit
PHPUnit 9.5.10 by Sebastian Bergmann and contributors.

......                                                              6 / 6 (100%)

Time: 00:00.220, Memory: 14.00 MB

OK (6 tests, 11 assertions)
```

## How to use the service on other environments
* Clone the repo.
* Make sure that the lumen microservice server is running via `php -S localhost:8000 -t public` <br />
here localhost can be changed to the domain name.
* Start using the APIs via given URL <br />
`http://localhost:8000/api/lunarColony/getLunarTime?earth-time-utc=2021-10-10 15:28:14`
  
