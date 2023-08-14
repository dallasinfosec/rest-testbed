<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class InputController extends Controller
{

	public function __invoke(Request $request)
	{
		//.....
		Log::info("Processing input....");

		$inputCollection = $request->collect();
		$clientIP = $request->ip();
		$uri = $request->path();
		$urlWithQueryString = $request->fullUrl();
		$httpHost = $request->httpHost();
		$method = $request->method();

		$token = $request->bearerToken();

		$bodyContent = $request->getContent();

		Log::debug("Input Collection: ".print_r($inputCollection,true));

		return response()->json([
			'Request IP' => $clientIP,
			'Request URI' => $uri,
			'Request Method' => $method
		]);

	}
}

