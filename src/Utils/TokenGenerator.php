<?php

namespace App\Utils;

use Exception;

class TokenGenerator
{
    /**
     * Generates a random user token for the user authorization
     *
     * @return string The random user token
     * @throws Exception If the generation of random bytes failed
     */
    public function generateSecureLoginToken(): string
    {
        return bin2hex(random_bytes(32));
    }
}