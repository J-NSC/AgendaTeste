<?php

namespace Tests\Feature;

use App\Models\Administrativo\Cargo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CargoTeste extends TestCase
{
    public function test_example(): void
    {
        $cargo = new Cargo();

        $this->assertEquals('administrativo', $cargo->getConnectionName());
        $this->assertEquals('rh.cargo', $cargo->getTable());
    }
}
