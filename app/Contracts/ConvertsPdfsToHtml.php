<?php

namespace App\Contracts;

use Gswits\PdfToHtml\Pdf;
use App\Http\Requests\ConvertFileRequest;

interface ConvertsPdfsToHtml
{

     /**
     * Store the file on the file system to be used by the pdf converter binary.
     *
     * @param Request $request
     * @return array
     */
    public function storeFile(ConvertFileRequest $request): array;
   /**
     * Create a new instance of the PDF to be used.
     *
     * @param string $fileNameIn
     * @param \Closure $callback
     * @return void
     */
    public function createPdf(string $fileNameIn, \Closure $callback);
    /**
     * Store the newly generated html file to be later downloaded by the requesting user.
     *
     * @param Pdf $pdf
     * @return void
     */
    public function storeHtml(Pdf $pdf, string $fileNameOut);
    /**
     * Broadcast an event over push to the user when the file has finished downloading.
     *
     * @param ConvertFileRequest $request
     * @param string $fileNameOut
     * @return void
     */
    public function notifyUserOfCompletion(ConvertFileRequest $request, string $fileNameOut);
}
