<?php

namespace Tests\Unit;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TaskTest extends TestCase
{
    use WithoutMiddleware;
    use DatabaseMigrations;

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
        $task = factory(Task::class)->create();
        $data = [
            'name' => $task->name,
            'description' => $task->description,
            'status_id' => $task->status_id,
            'created_by_id' => $task->created_by_id,
            'assigned_to_id' => $task->assigned_to_id,
        ];
        $this->post(route('task.store'), $data);
        $this->assertDatabaseHas('tasks', $data);
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
        $task = factory(Task::class)->create();
        $data = [
            'name' => $task->name,
            'description' => $task->description,
            'status_id' => $task->status_id,
            'created_by_id' => $task->created_by_id,
            'assigned_to_id' => $task->assigned_to_id,
        ];
        $task = factory(Task::class)->create();
        $this->patch(route('task.update', $task), $data);
        $this->assertDatabaseHas('tasks', $data);
    }

    /**
     * A basic unit test delete.
     *
     * @return void
     */
    public function testDelete()
    {
        $task = factory(Task::class)->create();
        $task->creator()->associate(auth()->user());
        $task->save();
        $this->delete(route('task.destroy', $task));
        $this->assertDeleted('tasks', ['id' => $task->id]);
    }
}
