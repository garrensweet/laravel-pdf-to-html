<?php

namespace App\Traits;

use App\Services\PdfToHtmlService;

trait InteractsWithConverters
{

    /**
     * Undocumented function
     *
     * @return void
     */
    public function pdfToHtmlService()
    {
        return app()->makeWith(PdfToHtmlService::class, [
            'request' => app('request')
        ]);
    }
}
