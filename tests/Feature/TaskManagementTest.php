<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Workspace;
use App\Models\Project;

class TaskManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_access_other_users_workspace()
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();

        $workspace = Workspace::create([
            'name' => 'User 1 Workspace',
            'owner_id' => $user1->id
        ]);

        $response = $this->actingAs($user2)->get(route('workspaces.show', $workspace->id));
        $response->assertStatus(403);
    }

    public function test_workspace_creation_requires_a_name()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('workspaces.store'), [
            'name' => ''
        ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_user_can_toggle_task_status()
    {
        $user = User::factory()->create();
        $workspace = Workspace::create(['name' => 'Test Workspace', 'owner_id' => $user->id]);
        $project = Project::create(['name' => 'Test Project', 'workspace_id' => $workspace->id]);
        
        $task = $project->tasks()->create([
            'title' => 'Test Task',
            'status' => 'todo',
            'priority' => 'medium',
            'assigned_to' => $user->id
        ]);

        $this->actingAs($user)->patch(route('tasks.toggle', $task->id));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'done'
        ]);
    }
}