<?php

/*
 * This file is part of Laravel Facebook.
 *
 * (c) Schimpanz Solutions AB <info@schimpanz.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Schimpanz\Facebook;

use Facebook\Facebook;
use InvalidArgumentException;

/**
 * This is the Facebook facade class.
 *
 * @author Vincent Klaiber <vincent@schimpanz.com>
 */
class FacebookFactory
{
    /**
     * Make a new Facebook client.
     *
     * @param array $config
     *
     * @return \Facebook\Facebook
     */
    public function make(array $config)
    {
        $config = $this->getConfig($config);

        return $this->getClient($config);
    }

    /**
     * Get the configuration data.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return array
     */
    protected function getConfig(array $config)
    {
        if (!array_key_exists('app_id', $config) || !array_key_exists('app_secret', $config)) {
            throw new InvalidArgumentException('The Facebook client requires configuration.');
        }

        $keys = ['app_id', 'app_secret', 'default_graph_version', 'default_access_token'];

        return array_only($config, $keys);
    }

    /**
     * Get the Facebook client.
     *
     * @param string[] $config
     *
     * @return \Facebook\Facebook
     */
    protected function getClient(array $config)
    {
        return new Facebook($config);
    }
}
