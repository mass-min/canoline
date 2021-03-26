<?php

use App\Http\Controllers\Bot\QuestionController;
use App\Http\Controllers\BotController;
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
Route::resource('bots', BotController::class)->names('bot')
    ->only(['index', 'create', 'store', 'show', 'edit', 'update']);
Route::prefix('bots/{bot}')->as('bot.')->group(function(){
    Route::resource('questions', QuestionController::class)->names('question');
});
