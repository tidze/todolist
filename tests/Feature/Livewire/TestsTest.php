<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Tests;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TestsTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Tests::class);

        $component->assertStatus(200);
    }
}
