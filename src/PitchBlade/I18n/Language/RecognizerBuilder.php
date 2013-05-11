<?php
/**
 * Interface for language recognizer factories
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
 * Interface for language recognizer factories
 *
 * @category   PitchBlade
 * @package    I18n
 * @subpackage Language
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
interface RecognizerBuilder
{
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
    public function build($recognizerName);
}
