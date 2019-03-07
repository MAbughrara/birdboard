<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Throwable;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    /** @test */


    public function it_has_a_path()
    {
        $project= factory('App\Project')->create();

        $this->assertEquals('projects/'.$project->id,$project->path());
    }
    public function it_belongs_to_an_owner()
    {
        $project=factory('App\Project')->create();
        $this->assertInstanceOf(User::class,$project->onwer);
    }
}
