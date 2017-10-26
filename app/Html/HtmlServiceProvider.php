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
    
    protected function registerChartBuilder(){
        $this->app->singleton('chart', function ($app) {
            return new Chart\ChartBuilder();
        });
    }
    
    public function provides()
    {
        return ['html', 'form', 'chart', 'App\Html\HtmlBuilder', 'App\Html\FormBuilder','App\Html\Chart\ChartBuilder'];
    }

    public function register()
    {
        $this->registerHtmlBuilder();

        $this->registerFormBuilder();
        
        $this->registerChartBuilder();

        $this->app->alias('html', 'App\Html\HtmlBuilder');
        $this->app->alias('form', 'App\Html\FormBuilder');
        $this->app->alias('chart', 'App\Html\Chart\ChartBuilder');
    }
    
    
}
