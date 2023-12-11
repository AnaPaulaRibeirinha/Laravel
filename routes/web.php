<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::resource('produtos', ProdutoController::class);




//exemplos
Route::get('/empresa', function() {
    return view('site/empresa');
});  
//ou
Route::view('/empresa', 'site/empresa'); 

Route::any('/any', function(){
    return "Permite todo tipo de acesso http(put, delete, get, post)";
});
Route::match(['get', 'post'],'/match', function(){
    return "Permite apenas acessos definidos";
});

//Route::get('/produto/{id}/{cat?}', function($id, $cat = ''){
 //   return "O id do produto é: " .$id. "<br>". "A categoria é: " .$cat;
//});
Route::get('/sobre', function(){
    return redirect('/empresa');
});
//ou
Route::redirect('/sobre', '/empresa');

Route::get('/news', function(){
    return view('/news');
})->name('noticias');

Route::get('/novidades', function(){
    return redirect()->route('noticias');
});
//agrupamento de rotas, tirando a necessidade de ficar repetindo o admin toda vez 
Route::prefix('admin')->group(function(){
    Route::get('dashboard', function(){
        return "dashboard";
    })->name('admin.dashboard');
       Route::get('users', function(){
        return "users";
    })->name('admin.users');
       Route::get('clientes', function(){
        return "clientes";
    })->name('admin.clientes');
});
//da pra fazer isso com o nome também, neste exemplo nao tem a necessidade de repetir o .admin:
Route::name('admin.')->group(function(){
    Route::get('admin/dashboard', function(){
        return "dashboard";
    })->name('dashboard');
       Route::get('admin/users', function(){
        return "users";
    })->name('users');
       Route::get('admin/clientes', function(){
        return "clientes";
    })->name('clientes');
});

//passando um array de agrupamento
//as é utilizado para puxar o name
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.'
], function(){
    Route::get('admin/dashboard', function(){
        return "dashboard";
    })->name('dashboard');
       Route::get('admin/users', function(){
        return "users";
    })->name('users');
       Route::get('admin/clientes', function(){
        return "clientes";
    })->name('clientes');
});
