<?php

namespace BrightComponents\Valid;

use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;

abstract class CustomRule implements Rule
{
    /**
     * The current validator instance.
     *
     * @var \Illuminate\Contracts\Validation\Validator
     */
    protected static $validator;

    /**
     * The current FormRequest instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected static $request;

    /**
     * Set the validator property.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     */
    public static function validator(?Validator $validator = null)
    {
        if (! isset(static::$validator) && $validator) {
            static::$validator = $validator;
        }

        return static::$validator;
    }

    /**
     * Set the request property.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public static function request(?Request $request = null)
    {
        if (! isset(static::$request) && $request) {
            static::$request = $request;
        }

        return static::$request;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     *
     * @return bool
     */
    abstract public function passes($attribute, $value);

    /**
     * Get the validation error message.
     *
     * @return string
     */
    abstract public function message();

    /**
     * Handle property accessibility for CustomRule.
     *
     * @param  string  $property
     *
     * @return mixed
     */
    public function __get($property)
    {
        if ('validator' === $property || 'request' === $property) {
            return static::$property ?? static::$property();
        }

        return $this->$property;
    }
}
