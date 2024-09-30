<?php

use App\Http\Controllers\Backend\Api\AttributeController;
use Illuminate\Support\Facades\Route;

Route::apiResource('/attributes', AttributeController::class);
