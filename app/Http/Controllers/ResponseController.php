<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResponseController extends Controller
{
    public function response(Request $request): Response
    {
        return response('Hello Response');
    }

    public function header(): Response
    {
        $body = [
            'firstname' => 'Udin',
            'lastname' => 'Salahudin'
        ];

        return response(json_encode($body), 200, [
            'Content-Type' => 'application/json'
        ])->withHeaders([
            'Author' => 'Programmer Zaman Now',
            'App' => 'Belajar Laravel'
        ]);
    }

    public function responseView(): Response
    {
        return response()->view('hello', ['name' => 'Udin']);
    }

    public function responseJson(): JsonResponse
    {
        $body = [
            'firstname' => 'Udin',
            'lastname' => 'Salahudin'
        ];

        return response()->json($body);
    }

    public function responseFile(): BinaryFileResponse
    {
        return response()->file(storage_path('app/public/pictures/gambar.jpg'));
    }

    public function responseDownload(): BinaryFileResponse
    {
        return response()->download(storage_path('app/public/pictures/gambar.jpg'));
    }
}
