# PDFBox PHP Wrapper

A simple PHP wrapper for [Apache PDFBox](https://pdfbox.apache.org/) that allows you to perform operations on PDF files. This library shells out to the Java-based PDFBox application.

## Features

*   Merge multiple PDF files into one.

## Requirements

*   PHP 7.4 or higher
*   Java Runtime Environment (JRE)
*   [Composer](https://getcomposer.org/)

## Installation

You can install the package via Composer:

```bash
composer require erlangparasu/pdfbox-php-wrapper
```

## Usage

Here is an example of how to merge two PDF files.

First, ensure you have two PDF files you want to merge (e.g., `1.pdf` and `2.pdf`).

```php
<?php

// 1. Include the Composer autoloader
require __DIR__."/vendor/autoload.php";

use ErlangParasu\PdfboxPhpWrapper\EpPdfboxPhpWrapper;

$file_pdf1 = 'path/to/your/1.pdf';
$file_pdf2 = 'path/to/your/2.pdf';
$file_pdf_output = 'path/to/your/merged-output.pdf';

// 2. Check if source files exist
if (!file_exists($file_pdf1) || !file_exists($file_pdf2)) {
    echo "Error: Source PDF files not found.\n";
    exit(1);
}

try {
    // 3. Initialize the wrapper
    $pdfbox = new EpPdfboxPhpWrapper();

    // 4. Add the source PDF files
    $pdfbox->addSourcePath($file_pdf1);
    $pdfbox->addSourcePath($file_pdf2);

    // 5. Set the desired output path
    $pdfbox->setOutputPath($file_pdf_output);

    // 6. Call the merge method
    $result = $pdfbox->merge();

    if ($result) {
        echo "Success! Merged PDF created at: $file_pdf_output\n";
    } else {
        echo "Error: Merge operation failed.\n";
    }

} catch (Exception $e) {
    echo "An exception occurred:\n";
    echo $e->getMessage()."\n";
}
```

### Notes

*   The underlying PDFBox JAR included is version `2.0.24`.
*   The wrapper uses `symfony/process` to execute the `java -jar` command. Ensure your PHP environment has permission to execute shell commands.

## License

This library is licensed under the Apache-2.0 License.
