<?php

namespace App\Application\Services;

use Illuminate\Http\UploadedFile;

interface FileStorageInterface
{
  public function store(UploadedFile $file, string $directory): string;
  public function delete(string $path): bool;
}