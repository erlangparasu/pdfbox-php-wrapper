<?php

namespace ErlangParasu\PdfboxPhpWrapper;

use Exception;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class EpPdfboxPhpWrapper3 {

    const JARFILE_PATH = __DIR__.'/../lib/pdfbox/pdfbox-app-3.0.0-alpha2.jar';

    public $source_paths = [];

    public $output_path = null;

    public function __constructor()
    {
        $this->source_paths = [];
    }

    public function resetSourcePaths()
    {
        $this->source_paths = [];
    }

    public function resetOutputPath()
    {
        $this->output_path = null;
    }

    public function addSourcePath($path)
    {
        if ($this->isPathValid($path)) {
            $this->source_paths[] = $path;

            return true;
        }

        return false;
    }

    public function setOutputPath($path)
    {
        if (is_string($path)) {
            if (strlen($path) > 1) {
                $this->output_path = $path;

                return true;
            }
        }

        return false;
    }

    private function isPathValid($path) {
        if (is_string($path)) {
            if (file_exists($path)) {
                if (is_file($path)) {
                    if (is_readable($path)) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    public function merge()
    {
        if (null == $this->output_path) {
            return false;
        }

        if (0 == count($this->source_paths)) {
            return false;
        }

        $words = [];
        $words[] = 'java';
        $words[] = '-jar';
        $words[] = self::JARFILE_PATH;
        $words[] = 'merge';

        foreach ($this->source_paths as $i => $path) {
            if ($this->isPathValid($path)) {
                $words[] = '-i';
                $words[] = $path;
            } else {
                throw new Exception('ERR_INVALID_SOURCE_PATH_'.$i);
            }
        }

        $words[] = '-o';
        $words[] = $this->output_path;

        $process = new Process($words);
        $process->run();

        // executes after the command finishes
        if (! $process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        // echo $process->getOutput();

        if ($this->isPathValid($this->output_path)) {
            return true;
        }

        return false;
    }
}
