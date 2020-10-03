<?php

namespace Tests\Unit;

use App\User;
use App\Label;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class LabelTest extends TestCase
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
        $this->get(route('label.index'))
            ->assertOk();
    }

    /**
     * A basic unit test create.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->get(route('label.create'))
            ->assertOk();
    }

    /**
     * A basic unit test store.
     *
     * @return void
     */
    public function testStore()
    {
        $label = factory(Label::class)->create();
        $data = ['name' => $label->name];
        $this->post(route('label.store'), $data)
            ->assertSee('label');
        $this->assertDatabaseHas('labels', $data);
    }

    /**
     * A basic unit test edit.
     *
     * @return void
     */
    public function testEdit()
    {
        $label = factory(Label::class)->create();
        $this->get(route('label.edit', $label))
            ->assertOk();
    }

    /**
     * A basic unit test update.
     *
     * @return void
     */
    public function testUpdate()
    {
        $label = factory(Label::class)->create();
        $data = ['name' => $label->name];
        $this->patch(route('label.update', $label), $data)
            ->assertSee('label');
        $this->assertDatabaseHas('labels', $data);
    }

    /**
     * A basic unit test delete.
     *
     * @return void
     */
    public function testDelete()
    {
        $label = factory(Label::class)->create();
        $data = ['name' => $label->id];
        $this->delete(route('label.destroy', $label))
            ->assertSee('label');
        $this->assertDeleted('labels', $data);
    }
}
