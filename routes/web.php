<?php

use App\Post;
use App\Tag;
use App\Video;

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

Route::get('/create', function () {
  $post = Post::create(['name' => 'My first post']);
  $tag1 = Tag::find(1);
  $post->tags()->save($tag1);
  $video = Video::create(['name' => 'video.mov']);
  $tag2 = Tag::find(2);
  $video->tags()->save($tag2);
});

Route::get('/read/{id}', function ($id) {
  $post = Post::findOrFail($id);
  foreach($post->tags as $tag) {
    $tag->whereName('tag-one')->update(['name'=>'Updated']);
    echo $tag;
  }
});


Route::get('/update/{id}/{tag_id}', function ($id, $tag_id) {
  $post = Post::findOrFail($id);
  // foreach($post->tags as $tag) {
  //   $tag->whereName('tag-one')->update(['name'=>'Updated']);
  //   echo $tag;
  // }
  $tag = Tag::find($tag_id);
  // $post->tags()->save($tag);
  // $post->tags()->attach($tag);
  $post->tags()->sync($tag);
});

Route::get('/delete/{id}', function ($id) {
  $post = Post::findOrFail($id);
  foreach($post->tags as $tag) {
    $tag->whereId('1')->delete();
  }
});
