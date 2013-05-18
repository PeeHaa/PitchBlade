<?php
/**
 * This class provides an easy API to translate texts
 *
 * The translations will be searched for in files based on the PHP array syntax:
 *
 * $translations = [
 *     'the.key' => 'The translation',
 * ];
 *
 * The filename format should always be: texts.{ISO 639-3 language code}.php, e.g. texts.eng.php
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
namespace PitchBladeTest\Mocks\I18n;

use PitchBlade\I18n\Translator as TranslatorInterface;

/**
 * This class provides an easy API to translate texts
 *
 * @category   PitchBlade
 * @package    I18n
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class Translator implements TranslatorInterface
{
    public function __construct()
    {
    }

    /**
     * Get a translated string or return the key when not found
     *
     * @param string $key The key to translate
     *
     * @return string The translation or the formatted key
     */
    public function get($key)
    {
        return $key;
    }
}
