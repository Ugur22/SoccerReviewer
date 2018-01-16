<?php

abstract class TestCase extends Laravel\Lumen\Testing\TestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */

    public function setUp()
    {
        parent::setUp();
        $this->app->instance('middleware.disable', true);
    }
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }
}
