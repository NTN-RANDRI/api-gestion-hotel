<?php

namespace App\Infrastructure\Services;

use App\Application\Services\FileStorageInterface;
use Illuminate\Http\UploadedFile;

class LaravelFileStorageService implements FileStorageInterface
{

  public function store(UploadedFile $file, string $directory): string
  {
    return $file->store($directory, 'public');
  }

}