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

namespace ElephantIO;

use ElephantIO\Engine\SocketIO\Version0X;
use ElephantIO\Engine\SocketIO\Version1X;
use ElephantIO\Engine\SocketIO\Version2X;
use ElephantIO\Engine\SocketIO\Version3X;
use ElephantIO\Engine\SocketIO\Version4X;
use ElephantIO\Exception\SocketException;
use InvalidArgumentException;
use Psr\Log\NullLogger;
use Psr\Log\LoggerInterface;

/**
 * Represents socket.io client which will send and receive the requests to the
 * socket.io server.
 *
 * @author Baptiste Clavié <baptiste@wisembly.com>
 */
class Client
{
    public const CLIENT_0X = 0;
    public const CLIENT_1X = 1;
    public const CLIENT_2X = 2;
    public const CLIENT_3X = 3;
    public const CLIENT_4X = 4;

    /** @var \ElephantIO\EngineInterface */
    private $engine;

    /** @var \Psr\Log\LoggerInterface */
    private $logger;

    public function __construct(EngineInterface $engine, LoggerInterface $logger = null)
    {
        $this->engine = $engine;
        $this->logger = $logger ?: new NullLogger();
        $this->engine->setLogger($this->logger);
    }

    public function __destruct()
    {
        $this->disconnect();
    }

    /**
     * Connect to server.
     *
     * @deprecated Use connect() instead
     * @return \ElephantIO\Client
     */
    public function initialize()
    {
        return $this->connect();
    }

    /**
     * Connect to server.
     *
     * @return \ElephantIO\Client
     */
    public function connect()
    {
        try {
            $this->logger->info('Connecting to server');
            $this->engine->connect();
            $this->logger->info('Connected to server');
        } catch (SocketException $e) {
            $this->logger->error('Could not connect to server', ['exception' => $e]);

            throw $e;
        }

        return $this;
    }

    /**
     * Disconnect from server.
     *
     * @deprecated Use disconnect() instead
     * @return \ElephantIO\Client
     */
    public function close()
    {
        return $this->disconnect();
    }

    /**
     * Disconnect from server.
     *
     * @return \ElephantIO\Client
     */
    public function disconnect()
    {
        if ($this->engine->connected()) {
            $this->logger->info('Closing connection to server');
            $this->engine->disconnect();
        }

        return $this;
    }

    /**
     * Set socket namespace.
     *
     * @param string $namespace The namespace
     * @return \ElephantIO\Engine\Packet
     */
    public function of($namespace)
    {
        $this->logger->info('Setting namespace', ['namespace' => $namespace]);

        return $this->engine->of($namespace);
    }

    /**
     * Emit an event to server.
     *
     * @param string $event
     * @param array  $args
     * @return int Number of bytes written
     */
    public function emit($event, array $args)
    {
        $this->logger->info('Emitting a new event', ['event' => $event, 'args' => $args]);

        return $this->engine->emit($event, $args);
    }

    /**
     * Wait an event arrived from server.
     *
     * @param string $event
     * @param float $timeout Timeout in seconds
     * @return \ElephantIO\Engine\Packet
     */
    public function wait($event, $timeout = 0)
    {
        $this->logger->info('Waiting for event', ['event' => $event]);

        return $this->engine->wait($event, $timeout);
    }

    /**
     * Drain socket.
     *
     * @param float $timeout Timeout in seconds
     * @return \ElephantIO\Engine\Packet
     */
    public function drain($timeout = 0)
    {
        return $this->engine->drain($timeout);
    }

    /**
     * Gets the engine used, for more advanced functions.
     *
     * @return \ElephantIO\EngineInterface
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * Create socket.io engine.
     *
     * @param int $version
     * @param string $url
     * @param array $options
     * @throws \InvalidArgumentException
     * @return \ElephantIO\Engine\SocketIO
     */
    public static function engine($version, $url, $options = [])
    {
        switch ($version) {
            case static::CLIENT_0X:
                return new Version0X($url, $options);
            case static::CLIENT_1X:
                return new Version1X($url, $options);
            case static::CLIENT_2X:
                return new Version2X($url, $options);
            case static::CLIENT_3X:
                return new Version3X($url, $options);
            case static::CLIENT_4X:
                return new Version4X($url, $options);
            default:
                throw new InvalidArgumentException(sprintf('Unknown engine version %d!', $version));
        }
    }

    /**
     * Create socket client.
     *
     * Available options:
     * - client: client version
     * - logger: a Psr\Log\LoggerInterface instance
     *
     * Options not listed above will be passed to engine.
     *
     * @param string $url
     * @param array $options
     * @throws \InvalidArgumentException
     * @return \ElephantIO\Client
     */
    public static function create($url, $options = [])
    {
        $version = isset($options['client']) ? $options['client'] : static::CLIENT_4X;
        $logger = isset($options['logger']) ? $options['logger'] : null;
        unset($options['client'], $options['logger']);

        return new self(static::engine($version, $url, $options), $logger);
    }
}
