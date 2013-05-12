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
namespace PitchBlade\I18n\Language;

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
        if (!class_exists($recognizerName)) {
            throw new InvalidRecognizerException('Invalid language recognizer (`' . $recognizerName . '`).');
        }

        $reflectedRecognizer = new \ReflectionClass($recognizerName);
        $constructor = $reflectedRecognizer->getConstructor();

        switch ($constructor->getNumberOfParameters()) {
            case 1:
                return new $recognizerName($this->supportedLanguages);
                break;

            case 2:
                return $reflectedRecognizer->newInstanceArgs($this->buildClassConstructorArguments($constructor));
                break;

            default:
                throw new InvalidParameterNumberException(
                    'The number of supported parameters is either 1 or 2. The number of supplied parameters is `' . $constructor->getNumberOfParameters() . '`.'
                );
                break;
        }
    }

    /**
     * Builds the constructor arguments for the recognizer
     *
     * @param \ReflectionMethod $constructor The constructor
     *
     * @return array The arguments for the constructor
     * @throws \PitchBlade\I18n\Language\InvalidParameterTypeException When constructor expects an invalid parameter type
     */
    private function buildClassConstructorArguments(\ReflectionMethod $constructor)
    {
        $arguments = [$this->supportedLanguages];
        switch ($constructor->getParameters()[1]->getClass()->name) {
            case 'PitchBlade\\Http\\RequestData':
                $arguments[] = $this->request;
                break;

            default:
                throw new InvalidParameterTypeException(
                    'Invalid parameter type (`' . $constructor->getParameters()[1]->getClass()->name . '`) found in constructor of class (`' . $constructor->class . '`).'
                );
                break;
        }

        return $arguments;
    }
}
