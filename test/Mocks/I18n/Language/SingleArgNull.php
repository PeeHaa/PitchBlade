<?php
/**
 * Language recognizer based on the browser
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    I18n
 * @subpackage Language
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2013 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBladeTest\Mocks\I18n\Language;

use PitchBlade\I18n\Language\Recognizer,
    PitchBlade\Http\RequestData;

/**
 * Language recognizer based on the browser
 *
 * @category   PitchBlade
 * @package    I18n
 * @subpackage Language
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class SingleArgNull implements Recognizer
{
    /**
     * @var array List of supported languages in the system
     */
    private $supportedLanguages;

    /**
     * Creates instance
     *
     * @param array                        $supportedLanguages The list of supported languages
     */
    public function __construct(array $supportedLanguages)
    {
        $this->supportedLanguages = $supportedLanguages;
    }

    public function getSupportedLanguages()
    {
        return $this->supportedLanguages;
    }

    /**
     * Tries to retrieve the language
     *
     * @return null|string The language
     */
    public function getLanguage()
    {
        return null;
    }
}
