<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route::get('/', function()
// {
// 	return View::make('hello');
// });

Route::get('/', function(){

	return '<h1>Hello World!</h1>';

});

Route::get('users',function()
	{
		$users = User::all();

		return View::make('users')->with('users',$users);

	});


Route::get('index','IndexController@showIndex');

Route::get('route.name','SomeController@someAction');
Route::post('route.name','SomeController@someAction');

/* Model Bindings */
Route::model('post','Post');
Route::model('comment','Comment');
/* User routes */
Route::get('/post/{post}/show',['as' => 'post.show','uses' => 'PostController@showPost']);
Route::post('/post/{post}/comment',['as' => 'comment.new','uses' =>'CommentController@newComment']);
/* Admin routes */
Route::group(['prefix' => 'admin','before' => 'auth'],function()
{
    /*get routes*/
    Route::get('dash-board',function()
    {
        $layout = View::make('master');
        $layout->title = 'DashBoard';
        $layout->main = View::make('dash')->with('content','Hi admin, Welcome to Dashboard!');
        return $layout;
    });
    Route::get('/post/list',['as' => 'post.list','uses' => 'PostController@listPost']);
    Route::get('/post/new',['as' => 'post.new','uses' => 'PostController@newPost']);
    Route::get('/post/{post}/edit',['as' => 'post.edit','uses' => 'PostController@editPost']);
    Route::get('/post/{post}/delete',['as' => 'post.delete','uses' => 'PostController@deletePost']);
    Route::get('/comment/list',['as' => 'comment.list','uses' => 'CommentController@listComment']);
    Route::get('/comment/{comment}/show',['as' => 'comment.show','uses' => 'CommentController@showComment']);
    Route::get('/comment/{comment}/delete',['as' => 'comment.delete','uses' => 'CommentController@deleteComment']);
    /*post routes*/
    Route::post('/post/save',['as' => 'post.save','uses' => 'PostController@savePost']);
    Route::post('/post/{post}/update',['as' => 'post.update','uses' => 'PostController@updatePost']);
    Route::post('/comment/{comment}/update',['as' => 'comment.update','uses' => 'CommentController@updateComment']);
});
/* Home routes */
Route::controller('/','BlogController');

?>