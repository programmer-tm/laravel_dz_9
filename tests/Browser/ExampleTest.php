<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ExampleTest extends DuskTestCase
{
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Start Bootstrap');
        });
    }
    public function AdminNewsFormBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                    ->assertSee('Добавить новость');
        });
    }
    public function AdminCategoryFormBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/categories/create')
                    ->assertSee('Добавить категорию');
        });
    }
    public function AdminFeedBackFormBasicExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/feedback/create')
                    ->assertSee('Добавить отзыв');
        });
    }
    public function AdminNewsFormBasic()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/news/create')
                    ->assertSee('Категория');
        });
    }
    public function AdminCategoryFormBasic()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/categories/create')
                    ->assertSee('Описание категории');
        });
    }
    public function AdminFeedBackFormBasic()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/feedback/create')
                    ->assertSee('Новость');
        });
    }
}
