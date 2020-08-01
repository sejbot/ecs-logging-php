<?php

declare(strict_types=1);

// Licensed to Elasticsearch B.V under one or more agreements.
// Elasticsearch B.V licenses this file to you under the Apache 2.0 License.
// See the LICENSE file in the project root for more information

namespace Elastic\Types;

use JsonSerializable;

/**
 * Serializes to ECS Custom Field
 *
 * @version v1.x
 *
 * @see https://www.elastic.co/guide/en/ecs/current/ecs-custom-fields.html
 *
 * @author Tobias Berg <tobias.hult@gmail.com>
 */
class Custom extends BaseType implements JsonSerializable
{

    /**
     * @var array
     */
    private $data;

    function __construct(string $name, array $fields) {
        $this->data = [$name => $fields];
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->data;
    }
}
