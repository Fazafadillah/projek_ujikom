<?php

return [
    /*
    |--------------------------------------------------------------------------
    | PDF Generator
    |--------------------------------------------------------------------------
    |
    | Here you can specify which PDF generator to use.
    |
    | Available generators: dompdf, mpdf
    |
    */
    'generator' => 'dompdf',

    /*
    |--------------------------------------------------------------------------
    | PDF Orientation
    |--------------------------------------------------------------------------
    |
    | Here you can specify the default orientation of the generated PDFs.
    |
    | Available orientations: portrait, landscape
    |
    */
    'orientation' => 'portrait',

    /*
    |--------------------------------------------------------------------------
    | PDF Paper Size
    |--------------------------------------------------------------------------
    |
    | Here you can specify the default paper size of the generated PDFs.
    |
    | Available paper sizes: A4, A5, letter, legal
    |
    */
    'paper_size' => 'A4',

    /*
    |--------------------------------------------------------------------------
    | PDF Encoding
    |--------------------------------------------------------------------------
    |
    | Here you can specify the encoding of the generated PDF file.
    |
    | Available encodings: utf-8, iso-8859-1, iso-8859-2, cp1252, cp1251, cp1250
    |
    */
    'encoding' => 'utf-8',

    /*
    |--------------------------------------------------------------------------
    | PDF Font Path
    |--------------------------------------------------------------------------
    |
    | Here you can specify the font directory path.
    |
    */
    'font_path' => base_path('resources/fonts/'),

    /*
    |--------------------------------------------------------------------------
    | PDF Font Family
    |--------------------------------------------------------------------------
    |
    | Here you can specify the default font family.
    |
    */
    'font_family' => 'DejaVu Sans',

    /*
    |--------------------------------------------------------------------------
    | PDF Font Size
    |--------------------------------------------------------------------------
    |
    | Here you can specify the default font size.
    |
    */
    'font_size' => 12,
];
