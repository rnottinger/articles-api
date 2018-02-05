<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleRelationshipController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('articles','ArticleController');
Route::resource('authors','AuthorController');
Route::resource('comments','CommentController');

//https://laravel.com/docs/5.1/routing#named-routes
Route::get(
    'articles/{article}/relationships/author',
    [
        'uses' => ArticleRelationshipController::class . '@author',
        // specify a Route Name for controller actions --> ArticleRelationshipController@author
        'as'   => 'articles.relationships.author',
        // specify a route name for this route--> articles.relationships.author

        // instead of specifying the route name in the route array definition
        //      you may chain the name() method onto the end of the route definition
        //      Route::get('user/profile', 'UserController@showProfile')->name('profile');
        //  Route::get('articles/{article}/relationships/author','ArticleRelationshipController@author')->name('articles.relationships.author');
    ]
);
Route::get(
    'articles/{article}/author',
    [
        'uses' => ArticleRelationshipController::class . '@author',
        'as'   => 'articles.author',
    ]
);
Route::get(
    'articles/{article}/relationships/comments',
    [
        'uses' => ArticleRelationshipController::class . '@comments',
        'as'   => 'articles.relationships.comments',
    ]
);
Route::get(
    'articles/{article}/comments',
    [
        'uses' => ArticleRelationshipController::class . '@comments',
        'as'   => 'articles.comments',
    ]
);