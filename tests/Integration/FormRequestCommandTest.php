<?php

namespace BrightComponents\Valid\Tests\Integration;

use Artisan;

class FormRequestCommandTest extends IntegrationTestCase
{
    use TestsCommands;

    /** @test */
    public function bright_request_command_makes_request_with_correct_methods()
    {
        Artisan::call('bright:request', ['name' => 'MyRequest']);

        include_once base_path().'/app/Http/Requests/MyRequest.php';

        $this->assertMethodExists(\App\Http\Requests\MyRequest::class, 'authorize');
        $this->assertMethodExists(\App\Http\Requests\MyRequest::class, 'rules');
        $this->assertMethodExists(\App\Http\Requests\MyRequest::class, 'filters');
    }
}
