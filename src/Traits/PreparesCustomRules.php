<?php

namespace BrightComponents\Valid\Traits;

use BrightComponents\Valid\CustomRule;

trait PreparesCustomRules
{
    /**
     * Set the validator and request properties on Custom Rules.
     */
    public function prepareCustomRules()
    {
        collect($this->rules())->each(function ($rules, $attribute) {
            collect(array_wrap($rules))->whereInstanceOf(CustomRule::class)->each(function ($rule) {
                $rule::validator($this->getValidatorInstance());
                $rule::request($this);
            });
        });
    }
}
