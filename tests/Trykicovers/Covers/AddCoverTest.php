<?php

namespace DatabaseTesting\Tests\Trykicovers\Covers;

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

require "system/add_cover.php";


class AddCoverTest extends TestCase
{
    use TestCaseTrait;

    // only instantiate pdo once for test clean-up/fixture load
    private $pdo = null;

    // only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
    private $conn = null;

    public function getConnection()
    {
        if ($this->conn === null) {
            if ($this->pdo == null) {
                $this->pdo = new \PDO( $GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD'] );
                ;
            }
            $this->conn = $this->createDefaultDBConnection( $this->pdo, $GLOBALS['DB_DBNAME'] );
        }

        return $this->conn;
    }

    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(__DIR__ . '/../dataset.xml');
    }

    public function testSherlock()
    {
        $this->assertEquals( 1, choose_shelf($this->pdo, [23]) );
    }

    public function testClassic()
    {
        $this->assertEquals( 2, choose_shelf($this->pdo, [21]) );
    }

    public function testArtisan()
    {
        $this->assertEquals( 4, choose_shelf($this->pdo, [22]) );
    }

}