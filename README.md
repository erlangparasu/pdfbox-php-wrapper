# PDFBox PHP Wrapper

A simple PHP wrapper for [Apache PDFBox](https://pdfbox.apache.org/) that allows you to perform operations on PDF files. This library shells out to the Java-based PDFBox application.

## Features

*   Merge multiple PDF files into one.
*   Supports PDFBox v2 and v3.

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

This library provides a simple, fluent interface. By default, it uses PDFBox v2.

### Basic Example (Merge PDFs)

```php
<?php

require __DIR__."/vendor/autoload.php";

use ErlangParasu\PdfboxPhpWrapper\Pdfbox;

$file1 = 'path/to/your/1.pdf';
$file2 = 'path/to/your/2.pdf';
$outputFile = 'path/to/your/merged-output.pdf';

try {
    $pdfbox = new Pdfbox();

    $result = $pdfbox->addSourcePath($file1)
                     ->addSourcePath($file2)
                     ->setOutputPath($outputFile)
                     ->merge();

    if ($result) {
        echo "Success! Merged PDF created at: $outputFile\n";
    } else {
        echo "Error: Merge operation failed.\n";
    }

} catch (Exception $e) {
    echo "An exception occurred:\n";
    echo $e->getMessage()."\n";
}
```

### Switching PDFBox Version

You can easily switch between PDFBox v2 and v3.

```php
$pdfbox = new Pdfbox();

// Use PDFBox v3
$pdfbox->useVersion3();

// All subsequent calls will use the v3 engine
$pdfbox->addSourcePath(...)
       ->merge();

// Switch back to v2 if needed
$pdfbox->useVersion2();
```

### Specifying the Java Path

If the `java` executable is not in your system's default PATH, you can specify its location using the `setJavaPath()` method.

```php
$pdfbox = new Pdfbox();

// Example for Linux/macOS
$pdfbox->setJavaPath('/usr/bin/java');

// Example for Windows
// $pdfbox->setJavaPath('C:\\Program Files\\Java\\jdk-11\\bin\\java.exe');

$pdfbox->addSourcePath(...)
       ->merge();
```

## License

This library is licensed under the Apache-2.0 License.
