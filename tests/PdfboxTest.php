<?php

use ErlangParasu\PdfboxPhpWrapper\Pdfbox;
use PHPUnit\Framework\TestCase;

class PdfboxTest extends TestCase
{

    public function testSetJavaPath()
    {
        $pdfbox = new Pdfbox();
        $this->assertInstanceOf(Pdfbox::class, $pdfbox->setJavaPath('/usr/bin/java'));
    }

    public function testSetTimeout()
    {
        $pdfbox = new Pdfbox();
        $this->assertInstanceOf(Pdfbox::class, $pdfbox->setTimeout(120));
    }

    public function testAddSourcePath()
    {
        $pdfbox = new Pdfbox();
        $this->assertInstanceOf(Pdfbox::class, $pdfbox->addSourcePath(__FILE__));
    }

    public function testSetOutputPath()
    {
        $pdfbox = new Pdfbox();
        $this->assertInstanceOf(Pdfbox::class, $pdfbox->setOutputPath('/tmp/output.pdf'));
    }

    public function testResetSourcePaths()
    {
        $pdfbox = new Pdfbox();
        $this->assertInstanceOf(Pdfbox::class, $pdfbox->resetSourcePaths());
    }

    public function testResetOutputPath()
    {
        $pdfbox = new Pdfbox();
        $this->assertInstanceOf(Pdfbox::class, $pdfbox->resetOutputPath());
    }

    public function testMerge()
    {
        $pdfbox = new Pdfbox();
        $this->assertFalse($pdfbox->merge());
    }

    public function testMergeWithPdfs()
    {
        $pdfbox = new Pdfbox();

        $outputFilePath = '/tmp/output.pdf';

        // Create dummy PDF files for testing
        $pdf1 = '/tmp/file1.pdf';
        $pdf2 = '/tmp/file2.pdf';
        file_put_contents($pdf1, "%PDF-1.4\n1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj 2 0 obj<</Type/Pages/Count 1/Kids[3 0 R]>>endobj 3 0 obj<</Type/Page/MediaBox[0 0 612 792]>>endobj\nxref\n0 4\n0000000000 65535 f\n0000000010 00000 n\n0000000058 00000 n\n0000000111 00000 n\ntrailer<</Size 4/Root 1 0 R>>\nstartxre\n149\n%%EOF");
        file_put_contents($pdf2, "%PDF-1.4\n1 0 obj<</Type/Catalog/Pages 2 0 R>>endobj 2 0 obj<</Type/Pages/Count 1/Kids[3 0 R]>>endobj 3 0 obj<</Type/Page/MediaBox[0 0 612 792]>>endobj\nxref\n0 4\n0000000000 65535 f\n0000000010 00000 n\n0000000058 00000 n\n0000000111 00000 n\ntrailer<</Size 4/Root 1 0 R>>\nstartxre\n149\n%%EOF");

        $pdfbox->addSourcePath($pdf1);
        $pdfbox->addSourcePath($pdf2);
        $pdfbox->setOutputPath($outputFilePath);

        $this->assertTrue($pdfbox->merge());
        $this->assertFileExists($outputFilePath);

        // Clean up the dummy files
        unlink($pdf1);
        unlink($pdf2);
        unlink($outputFilePath);
    }
}