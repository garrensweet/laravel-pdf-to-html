<?php
namespace App\Services;

use Gswits\PdfToHtml\Pdf;
use Illuminate\Support\Str;
use App\Events\DownloadReady;
use Illuminate\Support\Facades\File;
use App\Contracts\ConvertsPdfsToHtml;
use App\Http\Requests\ConvertFileRequest;

class PdfToHtmlService implements ConvertsPdfsToHtml
{

    /**
     * Handle a request to convert a PDF file to an HTML file.
     *
     * @param ConvertFileRequest $request
     * @return string
     */
    public function handle(ConvertFileRequest $request)
    {
        list($uuid, $fileNameIn, $fileNameOut) = $this->storeFile($request);

        $this->createPdf($fileNameIn, function(Pdf $pdf) use ($request, $fileNameOut) {
            $this->storeHtml($pdf, $fileNameOut)
                 ->notifyUserOfCompletion($request, $fileNameOut);
        });
    }

     /**
     * Store the file on the file system to be used by the pdf converter binary.
     *
     * @param Request $request
     * @return array
     */
    public function storeFile(ConvertFileRequest $request): array
    {
        $uuid = Str::uuid();
        $fileNameIn = $request->file('file')->storeAs(
            null, $uuid . '.pdf', 'processing'
        );
        $fileNameOut = $uuid. '.html';

        return [$uuid, $fileNameIn, $fileNameOut];
    }

    /**
     * Create a new instance of the PDF to be used.
     *
     * @param string $fileNameIn
     * @param \Closure $callback
     * @return void
     */
    public function createPdf(string $fileNameIn, \Closure $callback)
    {
        return $callback(new Pdf(storage_path('processing/' . $fileNameIn)));
    }

    /**
     * Store the newly generated html file to be later downloaded by the requesting user.
     *
     * @param Pdf $pdf
     * @return void
     */
    public function storeHtml(Pdf $pdf, string $fileNameOut)
    {
        $path = storage_path('processing/' . $fileNameOut);

        File::put($path, $pdf->html());

        return $this;
    }

    /**
     * Broadcast an event over push to the user when the file has finished downloading.
     *
     * @param ConvertFileRequest $request
     * @param string $fileNameOut
     * @return void
     */
    public function notifyUserOfCompletion(ConvertFileRequest $request, string $fileNameOut)
    {
        logger('we did notify you, breh');
        event(new DownloadReady($request->headers->get('x-csrf-token'), storage_path('processing/' . $fileNameOut)));

        return $this;
    }
}
