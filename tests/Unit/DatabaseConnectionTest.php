<?php
namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class DatabaseConnectionTest extends TestCase
{
    /**
     * Check DB connection
     *
     * @return void
     */
    public function testDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            $this->assertTrue(true);
        } catch (\Exception $e) {
            $this->fail("Can't connect. Please, check your configuration. Error: " . $e->getMessage());
        }
    }
}
