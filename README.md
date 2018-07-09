# Bright Components - Valid
### Custom Form Requests for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/bright-components/valid.svg)](https://packagist.org/packages/bright-components/valid)
[![Build Status](https://img.shields.io/travis/bright-components/valid/master.svg)](https://travis-ci.org/bright-components/valid)
[![Quality Score](https://img.shields.io/scrutinizer/g/bright-components/valid.svg)](https://scrutinizer-ci.com/g/bright-components/valid)
[![Total Downloads](https://img.shields.io/packagist/dt/bright-components/valid.svg)](https://packagist.org/packages/bright-components/formrequests)

![Bright Components](https://s3.us-east-2.amazonaws.com/bright-components/bc_large.png "Bright Components")

### Disclaimer
The packages under the BrightComponents namespace are basically a way for me to avoid copy/pasting simple functionality that I like in all of my projects. There's nothing groundbreaking here, just a little extra functionality for form requests, controllers, custom rules, services, etc.

## Package Objectives

### Form Requests
[waavi/sanitizer](https://github.com/Waavi/Sanitizer) has been added to Form Requests. To use, a public 'filters' method has been added to your FormRequest class. Here, just like with the 'rules' method, return an array of filters that you want to run on your data. See [available filters](https://github.com/Waavi/Sanitizer#available-filters) on the repo, for a list of filters you can use out-of-the-box. You can also create your own [custom filters](https://github.com/Waavi/Sanitizer#adding-custom-filters) to use.

### Custom Rules
I often use custom rules in Laravel. From time to time, I want access to the current FormRequest and/or the current validator, from within the custom rule. Anything can be passed through the construct of the custom rule, however, it can get ugly passing the FormRequest, Validator and other data like this. See below:
```php
    public function rules()
    {
        return [
            'name' => ['required', 'min:2', new NotSpamRule($this, $this->getValidator())],
        ];
    }
```
With this package, the following will accomplish the same:
```php
    public function rules()
    {
        return [
            'name' => ['required', 'min:2', new NotSpamRule()],
        ];
    }
```
It may not seem like much of an improvement, but I prefer my rules to be as clean and readable as possible.
> These custom rules can be used in your Form Requests or in a ValidationService class. See below.

### ValidationService
In my day-to-day development, I utilize a pattern similar to [Paul Jones']() [ADR pattern](). Using this pattern, validating at the 'controller' level is discouraged. This is a function of the domain. It is recommended to perform any authorization as soon as possible (I prefer to authorize via middleware, using Laravel's built-in Gates/Policies). Data can be retrieved from the request and passed to a service to be used for further data retrieval, manipulation, etc. This is the domain layer. Using a ValidationService, you can validate the data before the service starts working on it.

The ValidationService draws HEAVILY from Laravel's Form Requests and operates in a similar way, without the Authorization component. More is explained below in the 'Usage' section.

## Installation
You can install the package via composer. From your project directory, in your terminal, enter:

```bash
composer require bright-components/valid
```
> Note: Until version 1.0 is released, major features and bug fixes may be added between minor versions. To maintain stability, I recommend a restraint in the form of "0.1.*". This would take the form of:
```bash
composer require "bright-components/valid:0.1.*"
```

In Laravel > 5.6.0, the ServiceProvider will be automtically detected and registered.
If you are using an older version of Laravel, add the package service provider to your config/app.php file, in the 'providers' array:
```php
'providers' => [
    //...
    BrightComponents\Valid\ValidServiceProvider::class,
    //...
];
```

Then, if you would like to change any of the configuration options, run:
```bash
php artisan vendor:publish
```
and choose the BrightComponents/Valid option.

This will copy the package configuration (valid.php) to your 'config' folder.
Here, you can set the namespace and suffix for your FormRequests, ServiceValidation classes custom rules:

```php
<?php

return [
    'requests' => [
        /*
        |--------------------------------------------------------------------------
        | Namespace
        |--------------------------------------------------------------------------
        |
        | Set the namespace for the Custom Form Requests.
        |
        */
        'namespace' => 'Http\\Requests',

        /*
        |--------------------------------------------------------------------------
        | Suffix
        |--------------------------------------------------------------------------
        |
        | Set the suffix to be used when generating Custom Form Requests.
        |
        */
        'suffix' => 'Request',
    ],
    'rules' => [
        /*
        |--------------------------------------------------------------------------
        | Namespace
        |--------------------------------------------------------------------------
        |
        | Set the namespace for the custom rules.
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
    ],
];

```

## Usage

### Form Requests
To generate a FormRequest class, run the following command:
```bash
php artisan bright:request CreateComment
```

Using the default suffix option of "Request" and the default namespace option of "Http\\Requests", this command will generate a "CreateCommentRequest" class.
> Note: If you have a suffix set in the config, for example: "Request", and you run the following command:
```bash
php artisan bright:request CreateCommentRequest
```
> The suffix will NOT be duplicated.

Below is an example Custom Form Request class:
```php
<?php

namespace App\Http\Requests;

use Waavi\Sanitizer\Laravel\SanitizesInput;
use BrightComponents\Valid\BaseRequest;

class CustomClass extends BaseRequest
{
    use SanitizesInput;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
        ];
    }

    /**
     * Get the sanitization filters that apply to the request.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'name' => 'uppercase',
        ];
    }
}
```
As with the out-of-the-box Laravel Form Requests, you have access to a ```prepareForValidation()``` method, that can handle any pre-validation logic necessary, as well as a ```transform()``` method that can be used to manipulate the data before validation. Check out BrightComponents\Valid\BaseRequest for more details.

### Custom Rules
To generate a custom Rule, run the following command:
```bash
php artisan bright:rule CustomRule
```

Using the default suffix option of "Rule" and the default namespace option of "Rules", this command will generate a "CustomRule" class.
> Note: If you have a suffix set in the config, for example: "Rule", and you run the following command:
```bash
php artisan bright:rule CustomRule
```
> The suffix will NOT be duplicated.

From time to time, you may need to access information from the current request and/or validator inside your Custom Rule classes. All custom rules come with the current form request object and the current validator object attached. These can be referenced inside the Custom Rule class via their properties. See below:
```php
<?php

namespace App\Rules;

use BrightComponents\Valid\CustomRule;

class NotSpamRule extends CustomRule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // if needed, access the current Validator with $this->validator and the current FormRequest with $this->request
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}

```

### Validation Service
> If you are using Form Requests, it is not necessary to also use a Validation Service. Form Requests are designed to be used by your controllers, retrieving the data to be validated directly from the current request. A Validation Service is used to validate data from other classes within your domain.

To generate a validation service, run the following command:
```bash
php artisan bright:validation StoreCommentValidation
```

Using the default suffix option of "Validation" and the default namespace option of "Services", this command will generate a "StoreCommentValidation" class.
> Note: If you have a suffix set in the config, for example: "Validation", and you run the following command:
```bash
php artisan bright:validation StoreCommentValidation
```
> The suffix will NOT be duplicated.

Currently, the Validation Service must be resolved from the container. Then you call the ```validate()``` method, passing in an array of data to be validated. Using any class in Laravel that automatically resolved classes from the container, you can use a Validation Service as outlined below. Here, I am using a Service class from [BrightComponents\Services](https://github.com/bright-components/services), however, it will work within any of Laravel's components that auto-resolves classes, such as Events, Jobs, etc.:
```php
<?php

namespace App\Services;

use App\Comment;
use BrightComponents\Services\Traits\SelfCallingService;

class StoreCommentService
{
    use SelfCallingService;

    protected $params;

    /**
     * Construct a new StoreCommentService.
     */
    public function __construct($params)
    {
        $this->params = $params;
    }

    /**
     * Handle the call to the service.
     *
     * @return mixed
     */
    public function run(StoreCommentValidator $validator) // here, the class is resolved from the container
    {
        $validator->validate($this->params); // we call the validate method, passing the array of parameters

        return Comment::create([
            'content' => $validator->validated()['content'], // the validated method returns the key/value pairs of data that was validaated
            'user_id' => auth()->user()->id,
        ]);
    }
}
```
> Just as with Laravel's Form Requests, if the data, doesn't pass validation, you are redirected back to the form with the errors. The validation exception logic and redirect logic is customizable just like it is within Form Requests.

Below is a sample Validation Service class:
```php
<?php

namespace App\Services;

use BrightComponents\Services\Validation\ValidationService;

class StoreCommentValidator extends ValidationService
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', new NotSpamRule()],
        ];
    }

    /**
     * Get the filters to apply to the data.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'name' => 'uppercase',
        ];
    }
}
```
> The sanitization and custom rules are available within the ValidationService, like they are within custom Form Requests.

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email clay@phpstage.com instead of using the issue tracker.

## Roadmap

We plan to work on flexibility/configuration soon, as well as release a framework agnostic version of the package.

## Credits

- [Clayton Stone](https://github.com/devcircus)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
