<?php

namespace Tests\Unit;

use App\Task;
use App\User;
use Tests\TestCase;
use Illuminate\Support\Arr;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class TaskTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    /**
     * A basic unit test index.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->get(route('task.index'))
            ->assertOk();
    }

    /**
     * A basic unit test create.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->get(route('task.create'))
            ->assertOk();
    }

    /**
     * A basic unit test store.
     *
     * @return void
     */
    public function testStore()
    {
        $user = factory(User::class)->create();
        $task = factory(Task::class)->make();
        $data = [
            'name' => $task->name,
            'description' => $task->description,
            'status_id' => $task->status_id,
            'assigned_to_id' => $user->id,
        ];
        $check = array_merge($data, ['created_by_id' => $user->id]);
        $this->actingAs($user)
            ->post(route('task.store'), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('tasks', $check);
    }

    /**
     * A basic unit test edit.
     *
     * @return void
     */
    public function testEdit()
    {
        $task = factory(Task::class)->create();
        $this->get(route('task.edit', $task))
            ->assertOk();
    }

    /**
     * A basic unit test update.
     *
     * @return void
     */
    public function testUpdate()
    {
        $oldTask = factory(Task::class)->create();
        $newTask = factory(Task::class)->make();
        $data = [
            'name' => $newTask->name,
            'description' => $newTask->description,
            'status_id' => $newTask->status_id,
            'created_by_id' => $newTask->created_by_id,
            'assigned_to_id' => $newTask->assigned_to_id,
        ];
        $this->patch(route('task.update', $oldTask), $data)
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDatabaseHas('tasks', $data);
    }

    /**
     * A basic unit test delete.
     *
     * @return void
     */
    public function testDelete()
    {
        $response = $this->delete(route('task.destroy', $this->task))
            ->assertSessionHasNoErrors()
            ->assertRedirect();
        $this->assertDeleted('tasks', $this->data);
    }
}
