<?php

use App\Http\Controllers\Controller;
use \App\Http\Models\Cadastros\Entidade;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;

function getController($request,$entidade,$modulo,$rotina){
    if(!$rotina){
        $controller_name = '\\App\\Http\\Controllers\\Modulos\\'.ucfirst($modulo).'Controller';
    } else {
        $controller_name = '\\App\\Http\\Controllers\\'. ucfirst($modulo).'\\'.ucfirst($rotina).'Controller';
    }
    try{    
        $controller = app()->make($controller_name);
        $controller->entidade = $entidade;
        $controller->request = $request;
        $controller->modulo = $modulo;
        $controller->rotina = $rotina;
    }  catch (Exception $e){
        return null;
    }    
    return $controller;
}

function moduloEntidadeAtivo($entidade,$modulo){
    $modelEntidade = Entidade::find($entidade);
    return $modelEntidade->moduloAtivo('/'.$modulo);
}

function processa(Request $request, int $entidade, string $modulo, string $rotina='', string $acao = 'index'){
    if(!Auth::check()){
        return Controller::view('login');
    }
    if(!Controller::entidadeAtiva($entidade)){
        $entidade = Controller::getEntidadePrincipal();
        return Redirect::to($entidade.'/home')->withErrors(['Empresa não disponível.']);
    }
    $controller = getController($request, $entidade, $modulo, $rotina);
    if(!$controller){
        return Controller::view('home')->withErrors(["Página [$modulo.$rotina] não encontrada."]);
    }
    if(!moduloEntidadeAtivo($entidade, $modulo)){
        return Redirect::to($entidade.'/home')->withErrors(['Módulo '. ucfirst($modulo).' não disponível para esta empresa.']);
    }
    if(!method_exists($controller, $acao)){
        return Controller::view('home')->withErrors(["Ação [$acao] não disponível."]);
    }
    return $controller->callAction($acao, $parameters = array('request'=>$request));
}
Route::get('/', function () {   
    $identidade = 1;
    return Controller::view('welcome',compact('identidade'));
});


Route::get('login', array('uses' => 'HomeController@formLogin'))->name('login');
Route::post('login', array('uses' => 'HomeController@login'));

Route::get('logout', array('uses' => 'HomeController@logout'));

Route::get('{entidade}/home' , array('uses' => 'HomeController@home'));


Route::get('{entidade}/modulo/{modulo}/rotina/{rotina}/{acao?}', 
    function(Request $request,$entidade,$modulo,$rotina,$acao = 'index'){
//        if(!in_array($acao, ['index','novo','data','alterar','visualizar'])){
//            return Controller::view('home')->withErrors(['Não editar url, utilize as rotinas do sistema.']);
//        }
        return processa($request,$entidade,$modulo,$rotina,$acao,'');
    });
    
Route::get('{entidade}/modulo/{modulo}', 
    function(Request $request,$entidade,$modulo){
        return processa($request,$entidade,$modulo);
    });

    
Route::post('{entidade}/modulo/{modulo}/rotina/{rotina}/{acao}',
    function(Request $request,$entidade,$modulo,$rotina,$acao){
        if(!$request->get('id')){
            if($acao === 'visualizar'){
                return Redirect::to($entidade.'/modulo/'.$modulo.'/rotina/'.$rotina)->withErrors(['Não é possível confirmar ao visualizar um registro.']);
            }
            $acao = 'processa'.ucfirst($acao);
        }
        return processa($request,$entidade,$modulo,$rotina,$acao);
    });
