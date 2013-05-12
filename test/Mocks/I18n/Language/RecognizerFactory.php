<?php
/**
 * Builds instances of language recognizers
 *
 * This factory uses reflection to inject possible extra argument the recognizer to build need
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

use PitchBlade\I18n\Language\RecognizerBuilder,
    PitchBlade\Http\RequestData,
    PitchBlade\I18n\Language\InvalidRecognizerException,
    PitchBlade\I18n\Language\InvalidParameterNumberException,
    PitchBlade\I18n\Language\InvalidParameterTypeException;

/**
 * Builds instances of language recognizers
 *
 * @category   PitchBlade
 * @package    I18n
 * @subpackage Language
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class RecognizerFactory implements RecognizerBuilder
{
    /**
     * Creates instance
     *
     * @param array                        $supportedLanguages The list of supported languages
     * @param \PitchBlade\Http\RequestData $request            The request data
     */
    public function __construct()
    {
    }

    /**
     * Builds a language recognizer
     *
     * @param string $recognizerName The fully qualified class name of the recognizer
     *
     * @return \PitchBlade\I18n\Language\Recognizer The language recognizer
     * @throws \PitchBlade\I18n\Language\InvalidRecognizerException If the recognizer can not be loaded
     * @throws \PitchBlade\I18n\Language\InvalidParameterNumberException If the recognizer needs an invalid number of
     *                                                                   parameters
     */
    public function build($recognizerName)
    {
        require_once __DIR__ . '/SingleArgNull.php';
        require_once __DIR__ . '/SingleArgTrue.php';

        return new $recognizerName([]);
    }
}
