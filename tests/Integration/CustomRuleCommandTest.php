<?php

namespace BrightComponents\Valid\Tests\Integration;

use Artisan;

class CustomRuleCommandTest extends IntegrationTestCase
{
    use TestsCommands;

    /** @test */
    public function bright_rule_command_makes_rule_with_correct_methods()
    {
        Artisan::call('bright:rule', ['name' => 'MyRule']);

        include_once base_path().'/app/Rules/MyRule.php';

        $this->assertMethodExists(\App\Rules\MyRule::class, 'passes');
        $this->assertMethodExists(\App\Rules\MyRule::class, 'message');
    }
}
