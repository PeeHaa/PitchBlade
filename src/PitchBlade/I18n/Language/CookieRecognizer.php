<?php
/**
 * Language recognizer based on the URL of the current request
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

use PitchBlade\Network\Http\RequestData;

/**
 * Language recognizer based on the URL of the current request
 *
 * @category   PitchBlade
 * @package    I18n
 * @subpackage Language
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class CookieRecognizer implements Recognizer
{
    /**
     * @var array List of supported languages in the system
     */
    private $supportedLanguages;

    /**
     * @var \PitchBlade\Http\RequestData The request data
     */
    private $request;

    /**
     * Creates instance
     *
     * @param array                        $supportedLanguages The list of supported languages
     * @param \PitchBlade\Http\RequestData $request            The request data
     */
    public function __construct(array $supportedLanguages, RequestData $request)
    {
        $this->supportedLanguages = $supportedLanguages;
        $this->request            = $request;
    }

    /**
     * Tries to retrieve the language
     *
     * @return null|string The language
     */
    public function getLanguage()
    {
        $language = null;
        if (in_array($this->request->cookie('language'), $this->supportedLanguages)) {
            $language = $this->request->cookie('language');
        }

        return $language;
    }
}
