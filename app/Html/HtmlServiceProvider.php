<?php

namespace App\Html;

class HtmlServiceProvider extends \Collective\Html\HtmlServiceProvider{

    protected function registerFormBuilder()
    {
        $this->app->singleton('form', function ($app) {
            $form = new FormBuilder($app['html'], $app['url'], $app['view'], $app['session.store']->token());

            return $form->setSessionStore($app['session.store']);
        });
    }
    
    protected function registerHtmlBuilder()
    {
        $this->app->singleton('html', function ($app) {
            return new HtmlBuilder($app['url'], $app['view']);
        });
    }
    
    public function provides()
    {
        return ['html', 'form', 'App\Html\HtmlBuilder', 'App\Html\FormBuilder'];
    }

    public function register()
    {
        $this->registerHtmlBuilder();

        $this->registerFormBuilder();

        $this->app->alias('html', 'App\Html\HtmlBuilder');
        $this->app->alias('form', 'App\Html\FormBuilder');
    }
    
    
}
