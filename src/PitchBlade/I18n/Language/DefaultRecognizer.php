<?php
/**
 * Language recognizer based on the default language
 *
 * The class always makes the first supported language the default
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
namespace PitchBlade\I18n\Language;

/**
 * Language recognizer based on the default language
 *
 * @category   PitchBlade
 * @package    I18n
 * @subpackage Language
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class DefaultRecognizer implements Recognizer
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

    /**
     * Tries to retrieve the language
     *
     * @return null|string The language
     */
    public function getLanguage()
    {
        if (!empty($this->supportedLanguages)) {
            return reset($this->supportedLanguages);
        }
    }
}
