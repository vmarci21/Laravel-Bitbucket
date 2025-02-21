<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Bitbucket.
 *
 * (c) Graham Campbell <hello@gjcampbell.co.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Bitbucket\Auth\Authenticator;

use Bitbucket\Client;
use InvalidArgumentException;

/**
 * This is the jwt authenticator class.
 *
 * @author Graham Campbell <hello@gjcampbell.co.uk>
 * @author Lucas Michot <lucas@semalead.com>
 */
final class JwtAuthenticator extends AbstractAuthenticator
{
    /**
     * Authenticate the client, and return it.
     *
     * @param string[] $config
     *
     * @throws \InvalidArgumentException
     *
     * @return \Bitbucket\Client
     */
    public function authenticate(array $config)
    {
        if (!$this->client) {
            throw new InvalidArgumentException('The client instance was not given to the jwt authenticator.');
        }

        if (!array_key_exists('token', $config)) {
            throw new InvalidArgumentException('The jwt authenticator requires a token.');
        }

        $this->client->authenticate($config['token'], Client::AUTH_JWT);

        return $this->client;
    }
}
