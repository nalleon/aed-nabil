<?php

namespace App\Services;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Http;

class LibreOfficeService
{
    protected $url;

    public function __construct()
    {
        $this->url = env('LIBREOFFICE_URL');
    }

    public function openDocument($filePath)
    {
        $response = Http::withOptions([
            'verify' => false,
        ])->post("{$this->url}/lool/convert-to", [
            'file' => new File($filePath),
        ]);

        if ($response->successful()) {
            return $response->json();
        } else {
            return $response->failed();
        }
    }

}
