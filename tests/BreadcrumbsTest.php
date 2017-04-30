<?php

/*
 * This file is part of Raven.
 *
 * (c) Sentry Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Raven_Tests_BreadcrumbsTest extends PHPUnit_Framework_TestCase
{
    public function testBuffer()
    {
        $breadcrumbs = new \Raven\Breadcrumbs(10);
        for ($i = 0; $i <= 10; $i++) {
            $breadcrumbs->record(['message' => $i]);
        }

        $results = $breadcrumbs->fetch();

        $this->assertEquals(count($results), 10);
        for ($i = 1; $i <= 10; $i++) {
            $this->assertEquals($results[$i - 1]['message'], $i);
        }
    }

    public function testJson()
    {
        $breadcrumbs = new \Raven\Breadcrumbs(1);
        $breadcrumbs->record(['message' => 'test']);
        $json = $breadcrumbs->to_json();

        $this->assertEquals(count($json['values']), 1);
        $this->assertEquals($json['values'][0]['message'], 'test');
    }
}
