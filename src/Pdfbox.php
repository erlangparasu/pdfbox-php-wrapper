<?php

namespace ErlangParasu\PdfboxPhpWrapper;

class Pdfbox implements PdfboxInterface
{
    private $engine;

    public function __construct()
    {
        $this->useVersion2();
    }

    public function useVersion2()
    {
        $this->engine = new PdfboxV2();
        return $this;
    }

    public function useVersion3()
    {
        $this->engine = new PdfboxV3();
        return $this;
    }

    public function setJavaPath($path)
    {
        $this->engine->setJavaPath($path);
        return $this;
    }

    public function setTimeout($timeoutInSeconds)
    {
        $this->engine->setTimeout($timeoutInSeconds);
        return $this;
    }

    public function addSourcePath($path)
    {
        $this->engine->addSourcePath($path);
        return $this;
    }

    public function setOutputPath($path)
    {
        $this->engine->setOutputPath($path);
        return $this;
    }

    public function resetSourcePaths()
    {
        $this->engine->resetSourcePaths();
        return $this;
    }

    public function resetOutputPath()
    {
        $this->engine->resetOutputPath();
        return $this;
    }

    public function merge()
    {
        return $this->engine->merge();
    }
}
