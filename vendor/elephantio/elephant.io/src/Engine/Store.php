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

use InvalidArgumentException;

/**
 * A key-value store used to store key-value data such as
 * session or packet.
 *
 * @author Toha <tohenk@yahoo.com>
 */
class Store
{
    /**
     * Store keys, a key can be prefixed with flag:
     * - `+` to indicate an identifier,
     * - `_` to indicate a private key which will not be included when cast to string, or
     * - '!' to indicate mutually exclusive key (won't included if other was included)
     *
     * @var string[]
     */
    protected $keys = [];

    /**
     * Key flags.
     *
     * @var string[]
     */
    protected $flags = ['+', '_', '!'];

    /**
     * Values mapping.
     *
     * @var string[]
     */
    protected $maps = [];

    public function __construct()
    {
        $this->initialize();
    }

    protected function initialize()
    {
    }

    /**
     * Set values mapping.
     *
     * @param array $maps
     * @return \ElephantIO\Engine\Store
     */
    public function setMaps($maps)
    {
        $this->maps = $maps;

        return $this;
    }

    /**
     * Get key and check its validity.
     *
     * @param string $key
     * @throws \InvalidArgumentException
     */
    protected function getKey($key)
    {
        if (in_array($key, $this->keys)) {
            return $key;
        }
        foreach($this->flags as $flag) {
            if (in_array($flag . $key, $this->keys)) {
                return $key;
            }
        }

        $keys = array_map([$this, 'getNormalizedKey'], $this->keys);
        throw new InvalidArgumentException(sprintf('Unexpected key \'%s\' of [\'%s\']!',
            $key, implode('\', \'', $keys)));
    }

    /**
     * Get normalized key without flag.
     *
     * @param string $key
     * @return string
     */
    protected function getNormalizedKey($key)
    {
        return in_array(substr($key, 0, 1), $this->flags) ? substr($key, 1) : $key;
    }

    /**
     * Get mapped value.
     *
     * @param string $key
     * @param mixed $value
     * @return string
     */
    protected function getMappedValue($key, $value)
    {
        return isset($this->maps[$key]) ? $this->maps[$key][$value] : $value;
    }

    /**
     * Export key-value as array.
     *
     * @return array
     */
    public function toArray()
    {
        $result = [];
        foreach ($this->keys as $key) {
            $key = $this->getNormalizedKey($key);
            if (isset($this->$key)) {
                $result[$key] = $this->$key;
            }
        }

        return $result;
    }

    /**
     * Set key-value from array.
     *
     * @param array $array
     * @return \ElephantIO\Engine\Store
     */
    public function fromArray($array)
    {
        foreach ($array as $k => $v) {
            $this->$k = $v;
        }

        return $this;
    }

    /**
     * Get value.
     *
     * @param string $key
     * @return mixed
     */
    public function __get($key)
    {
        $key = $this->getKey($key);

        return isset($this->$key) ? $this->$key : null;
    }

    /**
     * Set value.
     *
     * @param string $key
     * @param mixed $value
     * @return \ElephantIO\Engine\Store
     */
    public function __set($key, $value)
    {
        $key = $this->getKey($key);
        $this->$key = $value;

        return $this;
    }

    public function __toString()
    {
        $title = null;
        $items = [];
        $xclusive = null;
        foreach ($this->keys as $key) {
            $flag = substr($key, 0, 1);
            $key = $this->getNormalizedKey($key);
            switch ($flag) {
                case '_':
                    break;
                case '+':
                    $title = $this->getMappedValue($key, $this->$key);
                    break;
                default:
                    if (isset($this->$key)) {
                        $value = $this->getMappedValue($key, $this->$key);
                        if (null !== $value && ($flag !== '!' || null === $xclusive)) {
                            $items[] = sprintf('%s:%s', $key, is_array($value) ? json_encode($value) : var_export($value, true));
                            if ($flag === '!') {
                                $xclusive = true;
                            }
                        }
                    }
                    break;
            }
        }
        if (null === $title) {
            $clazz = get_class($this);
            $title = substr($clazz, strrpos($clazz, '\\') + 1);
        }

        return sprintf('%s{%s}', strtoupper($title), implode(',', $items));
    }

    /**
     * Create a key value store.
     *
     * @param array $keyValuePair
     * @return \ElephantIO\Engine\Store
     */
    public static function create($keyValuePair)
    {
        $store = new static();
        $store->fromArray($keyValuePair);

        return $store;
    }
}
