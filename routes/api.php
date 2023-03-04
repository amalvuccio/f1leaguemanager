<?php

use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\RaceController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\ConstructorController;
use App\Http\Controllers\TrackController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * leagues routes
 */
Route::get( '/leagues', [LeagueController::class, 'index']);
Route::get( '/leagues/{leagueId}', [LeagueController::class, 'details']);

/**
 * competition routes
 */
Route::get( '/competitions', [CompetitionController::class, 'index']);
/**todo: */ Route::post( '/competitions', [CompetitionController::class, 'create']);

Route::get( '/competitions/{competitionId}', [CompetitionController::class, 'details']);


/**
 * seasons routes
 */
Route::get( 'competitions/{competitionId}/seasons', [SeasonController::class, 'index']);

Route::get( 'seasons/{seasonId}', [SeasonController::class, 'details']);
Route::post( 'seasons', [SeasonController::class, 'create']);



/**
 * races routes
 */
Route::get( 'seasons/{seasonId}/races', [RaceController::class, 'index']);

/**
 * race results routes
 */
Route::get( 'races/{raceId}/race-results', [RaceController::class, 'index']);

/**
 * Drivers Routes
 */
Route::get( '/drivers', [DriverController::class, 'index']);
Route::post('/drivers', [DriverController::class, 'create']);

Route::get('/drivers/{id}', [DriverController::class, 'details']);
Route::put('/drivers/{id}', [DriverController::class, 'update']);
Route::delete('/drivers/{id}', [DriverController::class, 'delete']);

/**
 * teams routes
 */
Route::get( '/seasons/{seasonId}/teams', [TeamController::class, 'index']);
Route::post( '/teams', [TeamController::class, 'create']);

Route::get('seasons/{seasonId}/teams/{teamId}', [TeamController::class, 'details']);
Route::put( 'seasons/{seasonId}/teams/{teamId}', [TeamController::class, 'update']);
Route::delete( 'seasons/{seasonId}/teams/{teamId}', [TeamController::class, 'delete']);


/**
 * team data routes
 */
Route::get( '/team-data', [ConstructorController::class, 'index']);

/**
 * tracks routes
 */
Route::get( '/tracks', [TrackController::class, 'index']);



