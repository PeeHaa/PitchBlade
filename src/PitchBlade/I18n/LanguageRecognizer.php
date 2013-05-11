<?php
/**
 * Tries to find out the user's prefered language
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

use PitchBlade\I18n\Language\RecognizerBuilder;

/**
 * Tries to find out the user's prefered language
 *
 * @category   PitchBlade
 * @package    I18n
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class LanguageRecognizer
{
    /**
     * @var \PitchBlade\I18n\Language\RecognizerBuilder Factory which create language recognizers
     */
    private $recognizerFactory;

    /**
     * @var array List of default language recognizers
     */
    private $recognizers = [
        '\\PitchBlade\\I18n\\Language\\UrlRecognizer',
        '\\PitchBlade\\I18n\\Language\\CookieRecognizer',
        '\\PitchBlade\\I18n\\Language\\BrowserRecognizer',
        '\\PitchBlade\\I18n\\Language\\DefaultRecognizer',
    ];

    /**
     * Creates instance
     *
     * @param \PitchBlade\I18n\Language\RecognizerBuilder $recognizerFactory Factory which create language recognizers
     * @param array                                       $recognizers       Optional list of language recognizers
     */
    public function __construct(RecognizerBuilder $recognizerFactory, array $recognizers = [])
    {
        $this->recognizerFactory  = $recognizerFactory;

        if (!empty($recognizers)) {
            $this->recognizers = $recognizers;
        }
    }

    /**
     * Tries to get the user's prefered language
     *
     * The language is based on: the language code passed in the URL, the language cookie, the accept-language header
     * in the browsers headers or the default language as fallback by default.
     *
     * @return null|string The code of the prefered language or null when no language has been found
     */
    public function getLanguage()
    {
        foreach ($this->recognizers as $recognizerName) {
            $recognizer = $this->recognizerFactory->build($recognizerName);

            $language = $recognizer->getLanguage();

            if ($language !== null) {
                return $language;
            }
        }
    }
}
