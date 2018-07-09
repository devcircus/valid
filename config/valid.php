<?php

return [
    'requests' => [
        /*
        |--------------------------------------------------------------------------
        | Namespace
        |--------------------------------------------------------------------------
        |
        | Set the namespace for the Form Requests.
        |
        */
        'namespace' => 'Http\\Requests',

        /*
        |--------------------------------------------------------------------------
        | Suffix
        |--------------------------------------------------------------------------
        |
        | Set the suffix to be used when generating Enhanced Form Requests.
        |
        */
        'suffix' => 'Request',

        /*
        |--------------------------------------------------------------------------
        | Duplicate Suffixes
        |--------------------------------------------------------------------------
        |
        | If you have a Request suffix set and try to generate a Request that also includes the suffix,
        | the package will recognize this duplication and rename the Request to remove the suffix.
        | This is the default behavior. To override and allow the duplication, change to false.
        |
        */
        'override_duplicate_suffix' => true,
    ],
    'rules' => [
        /*
        |--------------------------------------------------------------------------
        | Namespace
        |--------------------------------------------------------------------------
        |
        | Set the namespace for custom rules.
        |
        */
        'namespace' => 'Rules',

        /*
        |--------------------------------------------------------------------------
        | Suffix
        |--------------------------------------------------------------------------
        |
        | Set the suffix to be used when generating custom rules.
        |
        */
        'suffix' => 'Rule',

        /*
        |--------------------------------------------------------------------------
        | Duplicate Suffixes
        |--------------------------------------------------------------------------
        |
        | If you have a Rule suffix set and try to generate a Rule that also includes the suffix,
        | the package will recognize this duplication and rename the Rule to remove the suffix.
        | This is the default behavior. To override and allow the duplication, change to false.
        |
        */
        'override_duplicate_suffix' => true,
    ],
    'validation-services' => [
        /*
        |--------------------------------------------------------------------------
        | Namespace
        |--------------------------------------------------------------------------
        |
        | Set the namespace for the validation services.
        |
     */
        'namespace' => 'Services',

        /*
        |--------------------------------------------------------------------------
        | Suffix
        |--------------------------------------------------------------------------
        |
        | Set the suffix to be used when generating validation services.
        |
         */
        'suffix' => 'Validation',

        /*
        |--------------------------------------------------------------------------
        | Duplicate Suffixes
        |--------------------------------------------------------------------------
        |
        | If you have a Validation suffix set and try to generate a Validation that also includes the suffix,
        | the package will recognize this duplication and rename the Validation to remove the suffix.
        | This is the default behavior. To override and allow the duplication, change to false.
        |
        */
        'override_duplicate_suffix' => true,
    ],
];
