<?php

namespace AlexJoffroy\Localization\Tests\Http\Middlewares;

use AlexJoffroy\Localization\Tests\TestCase;
use AlexJoffroy\Localization\Http\Middlewares\SetLocaleFromCurrentRoute;

class SetLocaleFromCurrentRouteTest extends TestCase
{
    public function setUp()
    {
        parent::setup();

        $this->app->make('Illuminate\Contracts\Http\Kernel')->pushMiddleware(SetLocaleFromCurrentRoute::class);
    }
    /** @test */
    public function it_set_the_locale_from_the_current_url()
    {
        $this->get('/en/posts/123');
        $this->assertEquals('en', $this->app->getLocale());
    
        $this->get('/fr/articles/123');
        $this->assertEquals('fr', $this->app->getLocale());
    }

    /** @test */
    public function it_set_the_default_locale_when_unable_to_guess_a_valid_locale_from_url()
    {
        $this->get('/url-without-locale');

        $this->assertEquals('en', $this->app->getLocale());
    }
}
