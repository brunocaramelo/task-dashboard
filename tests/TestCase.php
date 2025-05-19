<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        \Inertia\Testing\AssertableInertia::macro('component', function (string $component) {
            return $this->where('component', $component);
        });
    }

}
