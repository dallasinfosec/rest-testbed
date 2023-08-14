<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Str;



class InputController extends Controller
{

	public function process(Request $request)
	{
		//.....
		Log::info("Processing input....");

		$clientIP = $request->ip();
		$uri = $request->path();
		$urlWithQueryString = $request->fullUrl();
		$method = $request->method();

		$token = $request->bearerToken();

		$bodyContent = $request->getContent();

		$randomUUID = (string)Str::uuid();

		Log::info("Client IP: ".print_r($clientIP,true));
		Log::info("Request URI: ".print_r($uri,true));
		Log::info("Request Method: ".print_r($method,true));
		//Log::info("Request Content: ".print_r($bodyContent,true));

		Log::info("Writing body content to ".$randomUUID.'.txt');
		Storage::put($randomUUID.'.txt', $bodyContent);


		return response()->json([
			'Request IP' => $clientIP,
			'Request URI' => $uri,
			'Request Method' => $method,
			'Rest Filename' => $randomUUID.'.txt'
		]);

	}
}

