<?php

use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Route;

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

 Route::get('/', function () {
    return view('welcome');
 });

// test d'une route pour afficher le view sur le navigateur 

//  Route :: get ('/', function(){
//     return [
//         "Article " => "article 1"
//     ];
// });

Route :: prefix('/blog')->name('blog.')->group(function(){
    Route:: get('/',function(Request $request){

        // Crrer des enregistrements 
        $post = new \App\Models\post();
        $post->title = "Mon premier article";
        $post->slug = "mon-premier'article";
        $post->content = "Mon contenu";
        $post->save(); // permet d'enregitrer les données sur la base de données
        return $post;
        return[
            "link" =>\route('blog.show',['slug' => 'article', 'id' =>13]),
        ];


    }) ->name('index');

    Route:: get('/{slug}-{id}', function(string $slug, string $id, Request $request) {
        return [
            "slug" => $slug,
            "id" => $id,
            //'name' => $request->input('name'),
        ];


        
    })->where([
        'id' => '[0-9]+',
        'name'=>'[a-z0-9\-]+'
    ])->name('show');
});

