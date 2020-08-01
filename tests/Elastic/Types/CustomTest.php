<?php

declare(strict_types=1);

// Licensed to Elasticsearch B.V under one or more agreements.
// Elasticsearch B.V licenses this file to you under the Apache 2.0 License.
// See the LICENSE file in the project root for more information

namespace Elastic\Tests\Types;

use \Elastic\Tests\BaseTestCase;
use Elastic\Types\Custom;
use Elastic\Types\BaseType;

/**
 * Test: Custom (Type)
 *
 * @version v1.x
 *
 * @see Elastic\Types\Custom
 *
 * @author Tobias Berg <tobias.hult@gmail.com>
 */
class CustomTest extends BaseTestCase
{

    /**
     * @covers Elastic\Types\User::__construct
     * @covers Elastic\Types\User::jsonSerialize
     * @covers Elastic\Types\User::setId
     * @covers Elastic\Types\User::setName
     */
    public function testSerialization()
    {
        $expectedName = 'myapp';
        $expectedFields = [
                'id' => rand(1, 99999),
                'name' => 'myapp',
        ];
        $Custom = new Custom($expectedName, $expectedFields);
        $this->assertInstanceOf(BaseType::class, $Custom);

        $json = json_encode($Custom);
        // Comply to the ECS format
        $decoded = json_decode($json, true);
        $this->assertIsArray($decoded);
        $this->assertArrayHasKey('myapp', $decoded);
        $this->assertArrayHasKey('id', $decoded['myapp']);
        $this->assertArrayHasKey('name', $decoded['myapp']);

        // Values correctly propagated
        $this->assertEquals($expectedFields['id'], $decoded['myapp']['id']);
        $this->assertEquals($expectedFields['name'], $decoded['myapp']['name']);
    }
}
