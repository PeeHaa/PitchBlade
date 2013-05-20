<?php
/**
 * Form class
 *
 * PHP version 5.4
 *
 * @category   PitchBlade
 * @package    Form
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 * @copyright  Copyright (c) 2012 Pieter Hordijk
 * @license    http://www.opensource.org/licenses/mit-license.html  MIT License
 * @version    1.0.0
 */
namespace PitchBlade\Form;

use PitchBlade\Form\Validatable,
    PitchBlade\Form\Field\Builder,
    PitchBlade\Security\TokenGenerator,
    PitchBlade\Http\RequestData,
    PitchBlade\Form\InvalidFieldException;

/**
 * Form class
 *
 * @category   PitchBlade
 * @package    Form
 * @author     Pieter Hordijk <info@pieterhordijk.com>
 */
abstract class Form implements Validatable, \Iterator
{
    /**
     * @var \PitchBlade\Form\Field\Builder The field factory
     */
    private $fieldFactory;

    /**
     * @var \PitchBlade\Security\TokenGenerator The CSRF token instance
     */
    private $csrfToken;

    /**
     * @var array The field of the form
     */
    private $fields = [];

    /**
     * @var int The current index used in the iterator
     */
    private $currentIteration = 0;

    /**
     * Creates instance
     *
     * @param \PitchBlade\Form\Field\Builder      $fieldFactory The field factory
     * @param \PitchBlade\Security\TokenGenerator $csrfToken    The csrf token
     */
    public function __construct(Builder $fieldFactory, TokenGenerator $csrfToken)
    {
        $this->fieldFactory = $fieldFactory;
        $this->csrfToken    = $csrfToken;

        $this->addField('csrf-token', [
            'type'    => 'csrf',
            'options' => [$csrfToken->getToken() => $csrfToken->getToken()],
            'default' => $csrfToken->getToken(),
        ]);
    }

    /**
     * Binds the request to the form
     *
     * @param \PitchBlade\Http\RequestData $request The request
     */
    public function bind(RequestData $request)
    {
        foreach ($request->getPostVariables() as $name => $variable) {
            if (!array_key_exists($name, $this->fields)) {
                continue;
            }

            $this->fields[$name]->setRawValue($variable);
        }
    }

    /**
     * Adds a field to the form
     *
     * @param string $name The name of the field
     * @param array  $data The data to build the field
     */
    public function addField($name, array $data = [])
    {
        $this->fields[$name] = $this->fieldFactory->build($name, $data);
    }

    /**
     * Gets a field by its name
     *
     * @param string $name The name of the field to get
     *
     * @return \PitchBlade\Form\Field\Generic The field
     * @throws \PitchBlade\Form\InvalidFieldException When there is no field with the supplied name
     */
    public function getField($name)
    {
        if (!array_key_exists($name, $this->fields)) {
            throw new InvalidFieldException('Trying to access a undefined field (`' . $name . '`).');
        }

        return $this->fields[$name];
    }

    /**
     * Validates all the fields in the form
     *
     * @return boolean True when the form is valid
     */
    public function isValid()
    {
        $isValid = true;
        foreach ($this->fields as $field) {
            if ($field->isValid() !== true) {
                $isValid = false;
            }
        }

        return $isValid;
    }

    /**
     * Gets the current field
     *
     * @return \PitchBlade\Form\Field\Generic The current field
     */
    public function current()
    {
        return $this->fields[array_keys($this->fields)[$this->current]];
    }

    /**
     * Gets the current key
     *
     * @return string The current key
     */
    public function key()
    {
        return array_keys($this->fields)[$this->current];
    }

    /**
     * Gets the next field
     *
     * @return string The next field
     */
    public function next()
    {
        $this->current++;
    }

    /**
     * Resets the pointer
     */
    public function rewind()
    {
        $this->current = 0;
    }

    /**
     * Checks whether the current pointer is valid
     *
     * @return boolean True when the current pointer is valid
     */
    public function valid()
    {
        if ($this->current < count($this->fields)) {
            return true;
        }

        return false;
    }
}
