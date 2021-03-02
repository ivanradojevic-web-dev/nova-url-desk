<?php

use Ivanradojevic\Urldesk\Http\Resources\RedirectResource;
use Ivanradojevic\Urldesk\Http\Requests\SaveRedirectRequest;
use Ivanradojevic\Urldesk\Http\Requests\UpdateRedirectRequest;
use Ivanradojevic\Urldesk\Models\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Redirect API Routes
|--------------------------------------------------------------------------
|
*/

//index
Route::get('/redirects', function (Request $request) {
    $redirects = Redirect::table($request->search)->paginate(10);

    return RedirectResource::collection($redirects);
});

//store
Route::post('/redirects', function (SaveRedirectRequest $request) {
	$data = Redirect::create($request->validated());

    return new RedirectResource($data);
});

//show
Route::get('/redirects/{id}', function (Request $request, $id) {
    $redirect = Redirect::find($id);

    return new RedirectResource($redirect);
});

//update
Route::put('/redirects/{id}', function (UpdateRedirectRequest $request, $id) {
    $redirect = Redirect::find($id);

    $redirect->update($request->validated());

    return new RedirectResource($redirect);
});

//delete
Route::delete('/redirects/{id}', function (Request $request, $id) {
    Redirect::destroy($id);

    return response()->json(['status' => 'deleted', 200]);
});