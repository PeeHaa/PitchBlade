<?php
/**
 * Interface for translation classes
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    I18n
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\I18n;

/**
 * Interface for translation classes
 *
 * @category   PitchBlade
 * @package    I18n
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface Translator
{
    /**
     * Get a translated string or return the key when not found
     *
     * @param string $key The key to translate
     *
     * @return string The translation or the formatted key
     */
    public function get($key);
}
