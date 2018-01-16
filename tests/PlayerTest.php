<?php

class PlayerTest extends TestCase
{


    /**
     * A basic functional test example.
     *
     * @return void
     */

     
    public function testBasicExample()
    {
        $response = $this->call('GET', '/api');

        $this->assertEquals(200, $response->status());
             
    }
}