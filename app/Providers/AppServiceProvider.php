<?php

namespace App\Providers;

use App\Services\PdfToHtmlService;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Gswits\PdfToHtml\Config as PdfConfig;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        PdfConfig::set('pdftohtml.bin', config('pdftohtml.paths.pdftohtml'));

        PdfConfig::set('pdfinfo.bin', config('pdftohtml.paths.pdfinfo'));

        $this->app->bind(PdfToHtmlService::class, function (Application $application) {
            return new PdfToHtmlService($application->make('request'));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
