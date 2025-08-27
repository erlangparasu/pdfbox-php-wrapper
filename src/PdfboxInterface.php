<?php

namespace ErlangParasu\PdfboxPhpWrapper;

interface PdfboxInterface
{
    public function setJavaPath($path);
    public function setTimeout($timeoutInSeconds);
    public function addSourcePath($path);
    public function setOutputPath($path);
    public function merge();
    public function resetSourcePaths();
    public function resetOutputPath();
}
