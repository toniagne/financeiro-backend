<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix'=>'v1','namespace'=>'API', 'middleware'=>['auth:api', 'cors']], function(){

    Route::group(['namespace'=>'V1'], function(){
        // CRUD CLIENTES
        route::resource('clients', 'ClientsController', ['except'=> 'create', 'edit']);

        // CRUD FORNECEDORES
        route::resource('providers', 'ProvidersController', ['except'=> 'create', 'edit']);

        // CRUD SERVIÇOS
        route::resource('services', 'ServicesController', ['except'=> 'create', 'edit']);

        // CRUD usuarios
        route::resource('users', 'UsersController', ['except'=> 'create', 'edit']);
        Route::get('users/{user}/permissions', 'UsersController@permissions');

        // CRUD usuarios
        route::resource('permissions', 'PermissionsController', ['except'=> 'create', 'edit']);

        // CRUD usuarios
        route::resource('employees', 'EmployeesController', ['except'=> 'create', 'edit']);

        // CRUD categorias
        route::resource('service_categories', 'ServiceCategoriesController', ['except'=> 'create', 'edit']);

        // CRUD tipos de categorias
        route::resource('service_types', 'ServiceTypesController', ['except'=> 'create', 'edit']);

        // CRUD RECORRENCIAS
        route::resource('recurrences', 'RecurrencesController', ['except'=> 'create', 'edit']);

        // CRUD PROFISSÕES
        route::resource('occupations', 'OccupationsController', ['except'=> 'create', 'edit']);

        // CRUD PROPOSTAS
        route::resource('proposals', 'ProposalsController', ['except'=> 'create', 'edit']);

        // CRUD CONTRATOS
        route::resource('contracts', 'ContractsController', ['except'=> 'create', 'edit']);

        // CRUD CONTAS À RECEBER
        route::resource('receives', 'ReceivesController', ['except'=> 'create', 'edit']);

        // CRUD PRODUTOS
        route::resource('products', 'ProductsController', ['except'=> 'create', 'edit']);
        route::get('product-categories', 'ProductsController@productCategories');
        route::get('product-margins', 'ProductsController@productMargins');

        // CRUD CATEGORIAS DE CONTAS
        route::get('payment-categories/{type}', 'PaymentCategoriesController@index');
        route::resource('payment-categories', 'PaymentCategoriesController', ['except'=> 'create', 'edit']);

        // CRUD TIPOS DE NEGOCIAÇÃO
        route::resource('negociation-types', 'NegociationTypesController', ['except'=> 'create', 'edit']);

        // CRUD COBRANÇAS
        route::get('chargings/{client}/client', 'ChargingsController@clientBills');
        route::resource('chargings', 'ChargingsController', ['except'=> 'create', 'edit']);


        // LISTA CIDADES
        route::group(['prefix'=>'cities'], function(){
            route::get('/', 'CitiesStatesController@cities');
            route::get('/byState/{state_id}', 'CitiesStatesController@byState');
        });

        // UPLOAD DE ARQUIVOS
        route::post('upload/{path}', 'UploadController@files');

        // BUSCA CEPS
        route::get('ceps/{cep}', 'CitiesStatesController@ceps');

        // LISTA ESTADOS
        route::get('states', 'CitiesStatesController@states');
    });

});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'], 404);
});
