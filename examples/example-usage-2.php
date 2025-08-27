<?php

/**
 * This is an example of how to use the EpPdfboxPhpWrapper to merge PDF files.
 *
 * To run this example:
 * 1. Make sure you have run `composer install` in the root directory.
 * 2. Place two PDF files named `1.pdf` and `2.pdf` in this `examples` directory.
 * 3. Run this script from the command line: `php examples/example-usage-2.php`
 */

use ErlangParasu\PdfboxPhpWrapper\EpPdfboxPhpWrapper;

require __DIR__.'/../vendor/autoload.php';

$file_pdf1 = __DIR__.'/1.pdf';
$file_pdf2 = __DIR__.'/2.pdf';
$file_pdf_output = __DIR__.'/output-example-2.pdf';

// Check if source files exist
if (!file_exists($file_pdf1) || !file_exists($file_pdf2)) {
    echo "Error: Please make sure '1.pdf' and '2.pdf' exist in the 'examples' directory.\n";
    exit(1);
}

echo "Initializing PDFBox Wrapper...\n";
$pdfbox = new EpPdfboxPhpWrapper();

echo "Adding source PDF files:\n";
echo " - $file_pdf1\n";
$pdfbox->addSourcePath($file_pdf1);
echo " - $file_pdf2\n";
$pdfbox->addSourcePath($file_pdf2);

echo "Setting output path to: $file_pdf_output\n";
$pdfbox->setOutputPath($file_pdf_output);

echo "Merging files...\n";
try {
    $result = $pdfbox->merge();
    if ($result) {
        echo "Success! Merged PDF created at: $file_pdf_output\n";
    } else {
        echo "Error: Merge operation failed. The output file was not created.\n";
    }
} catch (Exception $e) {
    echo "An exception occurred during the merge process:\n";
    echo $e->getMessage()."\n";
}

exit(0);
