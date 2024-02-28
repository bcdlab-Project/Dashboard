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
 * Represents options.
 *
 * @property int $version Engine version (EIO)
 * @property array $auth Authentication handshake
 * @property array $headers Request headers
 * @property int $wait A wait delay applied after reading from stream (in ms)
 * @property int $timeout Stream connection timeout (in second)
 * @property bool $reuse_connection Enable or disable existing connection reuse
 * @property string[] $transports Enabled transports
 * @property string $transport Initial transport
 * @property bool $persistent Enable or disable persistent connection
 * @property int $max_payload Maximum allowable payload length
 * @property string $stream_factory A custom socket stream class name
 * @author Toha <tohenk@yahoo.com>
 */
class Option extends Store
{
    protected function initialize()
    {
        $this->keys = ['auth', 'headers', 'reuse_connection', 'timeout', 'transports', 'transport',
            'version', 'wait', 'persistent', '_max_payload', '_stream_factory'];
    }
}
