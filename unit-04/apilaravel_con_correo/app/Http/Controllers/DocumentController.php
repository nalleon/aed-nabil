<?php

namespace App\Http\Controllers;

use App\Services\LibreOfficeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{

    protected $libreOfficeService;

    protected $CONTAINER_ID = "ed784f190503";

    public function __construct(LibreOfficeService $libreOfficeService)
    {
        $this->libreOfficeService = $libreOfficeService;
    }

    public function create()
    {
        return view('create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $fileName = preg_replace('/[^A-Za-z0-9]/', '_', $request->title);
        $directory = "example/" . $fileName;

        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory, 750, true);
        }

        $filePath = storage_path("app/" . $directory . "/" . $fileName . ".odt");
        $content = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<office:document xmlns:office=\"urn:oasis:names:tc:opendocument:xmlns:office:1.0\" xmlns:text=\"urn:oasis:names:tc:opendocument:xmlns:text:1.0\"><office:body><office:text></office:text></office:body></office:document>";
        file_put_contents($filePath, $content);



        return redirect()->route('documents.edit', ['fileName' => $fileName]);
    }


    public function edit($fileName)
    {
        $filePath = storage_path("app/example/" . $fileName . "/" . $fileName . ".odt");

        if (!file_exists($filePath)) {
            return redirect()->route('documents.create')->with('error', 'El documento no existe.');
        }

        // $filePath = "/opt/lool/files/example/{$fileName}/{$fileName}.odt";
        //$url = "https://localhost:9980/lool/convert-to?format=pdf&file=" . urlencode($filePath);


        $url = "https://localhost:9980/lool/loolfiles/opt/lool/data/{$fileName}/{$fileName}.odt";

        return view('editor', ['url' => $url]);
    }

    //TODO: aniadir copy al docker

}
