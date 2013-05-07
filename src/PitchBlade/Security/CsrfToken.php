<?php
/**
 * Provides a csrf token to secure forms and links
 *
 * It uses pieces of ircmaxell's password_compat library to generate pseudo random token
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Security
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @author     Anthony Ferrara <ircmaxell@php.net>
 * @copyright  Copyright (c) 2013 The authors
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Security;

use PitchBlade\Security\CsrfToken\StorageMedium,
    PitchBlade\Security\Generator\Builder,
    PitchBlade\Security\Generator\UnsupportedAlgorithmException;

/**
 * Provides a csrf token to secure forms
 *
 * @category   PitchBlade
 * @package    Security
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class CsrfToken
{
    /**
     * @var \PitchBlade\Security\CsrfToken\StorageMedium
     */
    private $storageMedium;

    /**
     * @var \PitchBlade\Security\Generator\Builder Instance of a generator factory
     */
    private $generatorFactory;

    /**
     * @var array List of supported algorithms sorted by strength (strongest first)
     */
    private $algos = [
        '\\PitchBlade\\Security\\Generator\\Mcrypt',
        '\\PitchBlade\\Security\\Generator\\OpenSsl',
        '\\PitchBlade\\Security\\Generator\\Urandom',
        '\\PitchBlade\\Security\\Generator\\MtRand',
    ];

    /**
     * Creates instance
     *
     * @param \PitchBlade\Security\CsrfToken\StorageMedium $storageMedium    The storage medium
     * @param \PitchBlade\Security\Generator\Builder       $generatorFactory Generator factory
     */
    public function __construct(StorageMedium $storageMedium, Builder $generatorFactory, $algos = null)
    {
        $this->storageMedium    = $storageMedium;
        $this->generatorFactory = $generatorFactory;
        if ($algos === null) {
            $this->algos = $algos;
        }
    }

    /**
     * Gets the stored CSRF token
     *
     * @return string The stored CSRF token
     */
    public function getToken()
    {
        $csrfToken = $this->storageMedium->get();
        if ($csrfToken === null) {
            $csrfToken = $this->generateToken();
        }

        $this->storageMedium->set($csrfToken);

        return $csrfToken;
    }

    /**
     * Validates the supplied token against the stored token
     *
     * @return boolean True when the supplied token matches the stored token
     */
    public function validate($token)
    {
        return $token == $this->getToken();
    }

    /**
     * Regenerates a new token
     */
    public function regenerateToken()
    {
        $this->storageMedium->set($this->generateToken());
    }

    /**
     * Generates a new cryptographically secure CSRF token
     *
     * @param int $rawLength The (raw) length of the token to be generated
     *
     * @return string The generated CSRF token
     * @throws
     */
    private function generateToken($rawLength = 128)
    {
        $rawLength = (int) ($rawLength * 3 / 4 + 1);
        $buffer = '';

        foreach ($this->algos as $algo) {
            try {
                $generator = $this->generatorFactory->build($algo);
            } catch (UnsupportedAlgorithmException $e) {
                continue;
            }

            $buffer .= $generator->generate($rawLength);

            if (strlen($buffer) >= $rawLength) {
                break;
            }
        }

        if (strlen($buffer) < $rawLength) {
            throw new InvalidLengthException(
                'The generated token didn\'t met the required length (`' . $rawLength . '`). Actual length is: `' . strlen($buffer) . '`.'
            );
        }

        return str_replace(array('+', '"', '\'', '\\', '/', '=', '?', '&'), '', base64_encode($buffer));
    }
}
