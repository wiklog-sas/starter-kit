<?php

namespace Tests\Feature\Models;

use App\Models\Livre;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LivreTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @var string
     */
    private const MODEL = 'livre';

    public function test_index_need_login()
    {
        $response = $this->get(route(self::MODEL . '.index'));

        $response->assertRedirect('login');
    }

    public function test_create_need_login()
    {
        $response = $this->get(route(self::MODEL . '.create'));

        $response->assertRedirect('login');
    }

    public function test_show_need_login()
    {
        $livre = Livre::factory()
            ->create();

        $response = $this->get(route(self::MODEL . '.show', ['livre' => $livre->id]));

        $response->assertRedirect('login');
    }

    public function test_edit_need_login()
    {
        $livre = Livre::factory()
            ->create();

        $response = $this->get(route(self::MODEL . '.edit', ['livre' => $livre->id]));

        $response->assertRedirect('login');
    }

    public function test_index_need_admin()
    {
        $this->setUser();

        $response = $this->get(route(self::MODEL . '.index'));

        $response->assertUnauthorized();
    }

    public function test_create_need_admin()
    {
        $this->setUser();

        $response = $this->get(route(self::MODEL . '.create'));

        $response->assertUnauthorized();
    }

    public function test_store_need_admin()
    {
        $this->setUser();
        $livre = Livre::factory()
            ->make();
        $data = array_merge($livre->toArray());

        $response = $this->post(route(self::MODEL . '.store'), $data);
        $response->assertUnauthorized();
    }

    public function test_show_need_admin()
    {
        $this->setUser();
        $livre = Livre::factory()
            ->create();

        $response = $this->get(route(self::MODEL . '.show', ['livre' => $livre->id]));

        $response->assertUnauthorized();
    }

    public function test_edit_need_admin()
    {
        $this->setUser();
        $livre = Livre::factory()
            ->create();

        $response = $this->get(route(self::MODEL . '.edit', ['livre' => $livre->id]));

        $response->assertUnauthorized();
    }

    public function test_update_need_admin()
    {
        $this->setUser();
        $livre = Livre::factory()
            ->create();
        $data = array_merge($livre->toArray());
        $data['id'] = $livre->id;

        $response = $this->put(route(self::MODEL . '.update', ['livre' => $livre->id]), $data);

        $response->assertUnauthorized();
    }

    public function test_delete_need_admin()
    {
        $this->setUser();
        $livre = Livre::factory()
            ->create();

        $response = $this->delete(route(self::MODEL . '.destroy', ['livre' => $livre->id]));

        $response->assertUnauthorized();
    }

    public function test_undelete_need_admin()
    {
        $this->setUser();
        $livre = Livre::factory()
            ->create();

        $response = $this->get(route(self::MODEL . '.undelete', ['livre' => $livre->id]));

        $response->assertUnauthorized();
    }

    public function test_json_need_admin()
    {
        $this->setUser();

        $response = $this->get(route(self::MODEL . '.json'));

        $response->assertUnauthorized();
    }

    public function test_index()
    {
        $this->setUser('admin');

        $response = $this->get(route(self::MODEL . '.index'));

        $response->assertStatus(200);
    }

    public function test_create()
    {
        $this->setUser('admin');

        $response = $this->get(route(self::MODEL . '.create'));

        $response->assertStatus(200);
    }

    public function test_store()
    {
        $this->setUser('admin');

        $livre = Livre::factory()
            ->make();
        $data = array_merge($livre->toArray());

        $response = $this->post(route(self::MODEL . '.store'), $data);

        $response->assertSessionHas('ok');
    }

    public function test_edit()
    {
        $this->setUser('admin');

        $livre = Livre::factory()
            ->create();

        $response = $this->get(route(self::MODEL . '.edit', ['livre' => $livre->id]));

        $response->assertStatus(200);
    }

    public function test_update()
    {
        $this->setUser('admin');

        $livre = Livre::factory()
            ->create();
        $data = array_merge($livre->toArray());

        $response = $this->put(route(self::MODEL . '.update', ['livre' => $livre->id]), $data);
        $livre = Livre::find($livre->id);

        $this->assertNotNull($livre->user_id_modification);
        $response->assertSessionHas('ok');
    }

    public function test_delete()
    {
        $this->setUser('admin');

        $livre = Livre::factory()
            ->create();

        $response = $this->delete(route(self::MODEL . '.destroy', ['livre' => $livre->id]));

        $this->assertSoftDeleted(Livre::class);
        $response->assertSessionHas(['ok']);
    }

    public function test_undelete()
    {
        $this->setUser('admin');

        $livre = Livre::factory()
            ->create();

        $response = $this->delete(route(self::MODEL . '.destroy', ['livre' => $livre->id]));
        $this->assertSoftDeleted(Livre::class);
        $response->assertSessionHas(['ok']);

        $response = $this->get(route(self::MODEL . '.undelete', ['livre' => $livre->id]));

        $this->assertNull($livre->user_id_suppression);
        $response->assertSessionHas(['ok']);
    }

    public function test_json()
    {
        $this->setUser('admin');

        $response = $this->get(route(self::MODEL . '.json'));

        $response->assertJsonStructure();
    }
}
