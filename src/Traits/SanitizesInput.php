<?php

namespace BrightComponents\Valid\Traits;

use Waavi\Sanitizer\Sanitizer;
use Waavi\Sanitizer\Laravel\SanitizesInput;

trait SanitizesInput
{
    use SanitizesInput;

    public function sanitizeData()
    {
        if ($this->filters()) {
            $sanitizer = new Sanitizer($this->all(), $this->filters());
            $this->replace($sanitizer->sanitize());
        }
    }
}
