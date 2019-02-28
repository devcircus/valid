# Changelog

All notable changes to `bright-components/valid` will be documented in this file

## 0.1.0 - 2018-07-08

-   initial release

## 0.1.1 - 2018-07-11

-   Return validated data from the ValidationService validate method.
-   Replace the command $name property for each command with the $signature property.
-   Start adding tests for each of the generator commands.
-   Bump the waavi/sanitizer version due to directory structure changes between 1.0.5 and 1.0.6. This fixes travis failures.

## 0.1.2 - 2018-07-24

-   Fixed a couple of issues with Custom Rules and the Validation Service. First, the $request object that is set on CustomRules when used in FormRequests, is not available in the ValidationService. This property for Custom Rules in Validation Services, has been renamed $service and gives you access to the current ValidationService instance. Also, the ValidationService `getValidator()` method has been renamed `getValidatorInstance()` to match the method in FormRequests.

## 0.1.3 - 2018-07-26

-   With the introduction of the bright-components/adr package, we're renaming the command namespace to 'adr' for consistency.

## 0.1.3 - 2018-08-23

-   Only run "preparesCustomRules" if the pacakge base form request class is used.

## 1.0.0-beta.1 - 2018-09-01

-   First beta release. Features locked.

## 1.0.0-beta.1.1 - 2018-09-05

-   Bump PHP version.
-   Bump laravel/framework version.
-   Bump orchestra/testbench version.

## 1.0.0-beta.1.2 - 2019-02-28

-   Update for compatibility with Laravel 5.8
