<?php

namespace RClusterPOC;

use PHPUnit\Framework\TestCase;

class RedisConnectionTest extends TestCase {
    public function testBulkInsertKey() {
        $dataSource = null;
        try {
            $dataSource = new \RedisCluster(NULL, array("173.17.0.3:7001"));
        } catch (\RedisClusterException $e) {
            echo $e;
        }

        $this->assertNotNull($dataSource);
        // $dataSource = new \RedisCluster(NULL,array("173.17.0.2:7000","173.17.0.3:7001","173.17.0.4:7002","173.17.0.6:7003","173.17.0.7:7004","173.17.0.8:7005"));
        for ($i = 0; $i < 10000; $i++) {
            $dataSource->set($i, $i);
        }

        for ($i = 0; $i < 10000; $i++) {
            $this->assertEquals(strval($i), $dataSource->get($i));
        }
    }
}