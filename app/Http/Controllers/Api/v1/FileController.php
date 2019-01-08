<?php

namespace App\Http\Controllers\Api\v1;

use Gswits\PdfToHtml\Pdf;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\DownloadReady;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Traits\InteractsWithConverters;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ConvertFileRequest;
use Symfony\Component\HttpFoundation\JsonResponse;

class FileController extends Controller
{
    use InteractsWithConverters;

    /**
     * Handle a request to convert a pdf file to an HTML file.
     *
     * @param ConvertFileRequest $request
     * @return void
     */
    public function convert(ConvertFileRequest $request): JsonResponse
    {
        if ($request->file('file')) {
            $this->pdfToHtmlService()->handle($request);

            return response()->json([
                'success' => true,
                'mesage' => 'conversion in progress'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Could not convert the file. The file may have been corrupted or contains illegal characters.'
        ]);
    }
}
