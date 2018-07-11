<?php

namespace BrightComponents\Valid\Tests\Integration;

use Artisan;

class FormRequestCommandTest extends IntegrationTestCase
{
    /** @test */
    public function bright_request_command_makes_request_with_correct_methods()
    {
        Artisan::call('bright:request', ['name' => 'MyRequest']);

        include_once base_path().'/app/Http/Requests/MyRequest.php';

        $this->assertInstanceOf(\BrightComponents\Valid\BaseRequest::class, $this->app[\App\Http\Requests\MyRequest::class]);
        $this->assertMethodExists(\App\Http\Requests\MyRequest::class, 'authorize');
        $this->assertMethodExists(\App\Http\Requests\MyRequest::class, 'rules');
        $this->assertMethodExists(\App\Http\Requests\MyRequest::class, 'filters');
    }

    public function assertMethodExists(string $className, string $methodName)
    {
        $this->assertTrue(method_exists($className, $methodName));
    }
}
