<?php

/**
 * This file is part of the Elephant.io package
 *
 * For the full copyright and license information, please view the LICENSE file
 * that was distributed with this source code.
 *
 * @copyright Wisembly
 * @license   http://www.opensource.org/licenses/MIT-License MIT License
 */

namespace ElephantIO\Engine;

/**
 * Represents packet.
 *
 * @property int $proto Protocol id
 * @property int $type Message type
 * @property string $nsp Namespace
 * @property string $event Event name
 * @property array $args Event arguments
 * @property mixed $data Packet data
 * @property int $count Binary attachment count
 * @property \ElephantIO\Engine\Packet[] $next Nested packets
 * @author Toha <tohenk@yahoo.com>
 */
class Packet extends Store
{
    protected function initialize()
    {
        $this->keys = ['+proto', 'type', 'nsp', 'event', '!args', '!data', '_next', '_count'];
    }

    /**
     * Flatten packet into array of packet.
     *
     * @return \ElephantIO\Engine\Packet[]
     */
    public function flatten()
    {
        $result = [];
        $result[] = $this;
        if (isset($this->next)) {
            foreach ($this->next as $p) {
                $result = array_merge($result, $p->flatten());
            }
        }

        return $result;
    }

    /**
     * Peek packet with matched protocol.
     *
     * @param int $proto
     * @return \ElephantIO\Engine\Packet
     */
    public function peek($proto)
    {
        foreach ($this->flatten() as $p) {
            if ($p->proto === $proto) {
                return $p;
            }
        }
    }

    /**
     * Add nested packet.
     *
     * @param \ElephantIO\Engine\Packet $packet
     * @return \ElephantIO\Engine\Packet
     */
    public function add($packet)
    {
        if (!isset($this->next)) {
            $this->next = [];
        }
        $this->next[] = $packet;

        return $this;
    }
}
