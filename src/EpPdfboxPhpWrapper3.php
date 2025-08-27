<?php

namespace ErlangParasu\PdfboxPhpWrapper;

use Exception;
use RuntimeException;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/// Created by: Erlang Parasu 2021

class EpPdfboxPhpWrapper3 {

    public $jarfile_path;

    public $source_paths = [];

    public $output_path = null;

    private $config_timeout = 60;

    public function setTimeout($timeoutInSeconds)
    {
        if (! is_int($timeoutInSeconds)) {
            throw new RuntimeException('Error: Timeout must be an integer. Example: 60');
        }

        if ($timeoutInSeconds < 5) {
            $timeoutInSeconds = 5;
        }

        $this->config_timeout = $timeoutInSeconds;
    }

    public function __construct()
    {
        $this->jarfile_path = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'pdfbox'.DIRECTORY_SEPARATOR.'pdfbox-app-3.0.0-alpha2.jar';
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
        $words[] = $this->jarfile_path;
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
        $process->setTimeout($this->config_timeout);
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
