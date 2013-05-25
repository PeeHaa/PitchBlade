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
namespace PitchBlade\I18n;

use PitchBlade\I18n\Translator,
    PitchBlade\I18n\InvalidTranslationFileException;

/**
 * This class provides an easy API to translate texts
 *
 * @category   PitchBlade
 * @package    I18n
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
class TranslatorByFile implements Translator
{
    /**
     * @var array List of all the translations
     */
    private $translations = [];

    /**
     * Creates instance
     *
     * @param string $path     The location of the translation file(s)
     * @param string $language The ISO code of the language to get the translations for
     *
     * @throws \PitchBlade\I18n\InvalidTranslationFileException When the file could not be found
     */
    public function __construct($path, $language)
    {
        $translationFile = rtrim($path, '/') . '/texts.' . $language . '.php';

        if (!file_exists($translationFile)) {
            throw new InvalidTranslationFileException('The translation file (`' . $translationFile . '`) could not be found.');
        }

        require $translationFile;

        $this->translations = $translations;
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
        if (array_key_exists($key, $this->translations)) {
            return $this->translations[$key];
        }

        return '{{' . $key . '}}';
    }
}
