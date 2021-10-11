<?php

class LunarColonyControllerTest extends TestCase
{
    public function testGetLunarTime()
    {
        $response = $this->call('GET', 'api/lunarColony/getLunarTime?earth-time-utc=2021-10-10 15:28:14');

        $this->assertEquals(200, $response->status());
        $this->assertEquals(
            '"53-11-10 \u2207 03:01:14"', $response->getContent()
        );
    }

    public function testGetLunarTimeWithoutParam()
    {
        $response = $this->call('GET', 'api/lunarColony/getLunarTime');

        $this->assertStringContainsString(
            '<!-- No parameters passed, Invalid input !!!! (500 Internal Server Error) -->',
            $response->getContent()
        );
        $this->assertEquals(500, $response->status());
    }

    public function testGetLunarTimeInvalidParam()
    {
        $response = $this->call('GET', 'api/lunarColony/getLunarTime?earth-time-usstc=2021-10-10 15:28:14');

        $this->assertStringContainsString(
            '<!-- Incorrect parameter!. Please use `earth-time-utc` as KEY &amp; `yyyy-mm-dd HH:MM:SS` as VALUE in API param. (500 Internal Server Error) -->',
            $response->getContent()
        );
        $this->assertEquals(500, $response->status());
    }

    public function testGetLunarTimeInvalidYear()
    {
        $response = $this->call('GET', 'api/lunarColony/getLunarTime?earth-time-utc=1968-10-10 15:28:14');

        $this->assertStringContainsString(
            '<!-- Error : Invalid Year, year should be greater than 1969 (500 Internal Server Error) -->',
            $response->getContent()
        );
        $this->assertEquals(500, $response->status());
    }

    public function testGetLunarTimeInvalidMonth()
    {
        $response = $this->call('GET', 'api/lunarColony/getLunarTime?earth-time-utc=2021-0-10 15:28:14');

        $this->assertStringContainsString(
            '<!-- Error : Invalid Month, month should be &gt;0 &amp; &lt;=12 (500 Internal Server Error) -->',
            $response->getContent()
        );
        $this->assertEquals(500, $response->status());
    }
}
