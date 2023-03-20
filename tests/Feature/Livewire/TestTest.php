<?php

namespace Tests\Feature\Livewire;

use App\Http\Livewire\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TestTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $component = Livewire::test(Test::class);

        $component->assertStatus(200);
    }
}
