<?php

namespace Tests\Feature;

use App\Project;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{

    use RefreshDatabase,WithFaker;


    /** @test */

    public function a_user_can_create_project()
    {
        $this->withoutExceptionHandling();

        $this->actingAs(factory('App\User')->create());
        $attributes=
         [
            'title'=> $this->faker->sentence,
            'description'=> $this->faker->paragraph,
        ];

        $this->post('/projects',$attributes)
//            ->assertRedirect('/projects')
        ;
        $this->assertDatabaseHas('projects',$attributes);
        $this->get('/projects')->assertSee($attributes['title']);
    }

    /** @test */

    public function a_user_can_view_their_project ()
    {
        $this->withoutExceptionHandling();
        $this->be(factory(User::class)->create());


        $project=factory('App\Project')->create(['owner_id'=>auth()->id()]);
        $this->get($project->path())
            ->assertSee($project->title)
            ->assertSee($project->desctiption);

    }
    /** @test */

    public function a_authenticated_user_cannot_view_the_projects_of_others()
    {

        $this->be(factory(User::class)->create());

        $project=factory('App\Project')->create();
        $this->get($project->path())
            ->assertStatus(403);

    }

    /** @test */

    public function a_project_requires_a_title ()
    {

        $this->actingAs(factory('App\User')->create());
        $attributes=factory('App\Project')->raw(['title'=>'']);
        $this->post('/projects',$attributes)->assertSessionHasErrors('title');
    }
    /** @test */

    public function a_project_requires_a_description ()
    {
        $this->actingAs(factory('App\User')->create());
        $attributes=factory('App\Project')->raw(['description'=>'']);
        $this->post('/projects',$attributes)->assertSessionHasErrors('description');
    }
    /** @test */

    public function guests_cannot_create_projects()
    {
        $attributes=factory('App\Project')->raw();

        $this->post('/projects',$attributes)->assertRedirect('login');
    }
   /** @test */

    public function guests_cannot_view_projects()
    {
        $this->get('/projects')->assertRedirect('login');
    }

    public function guests_cannot_view_a_single_project()
    {
        $project=factory(Project::class)->create();

        $this->get($project->path())->assertRedirect('login');
    }


}
