<?php

namespace BrightComponents\Valid;

use Illuminate\Foundation\Http\FormRequest;
use BrightComponents\Valid\Traits\SanitizesInput;
use BrightComponents\Valid\Traits\PreparesCustomRules;

class BaseRequest extends FormRequest
{
    use SanitizesInput, PreparesCustomRules;

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->sanitizeData();

        $this->beforeValidation();

        return $this->validationData();
    }

    /**
     * Run any logic needed prior to validation running.
     */
    protected function beforeValidation()
    {
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        return $this->all();
    }

    /**
     * Transform the request data if necessary.
     *
     * @param  array  $data
     *
     * @return array
     */
    protected function transform($data)
    {
        return $data;
    }
}
