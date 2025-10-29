<?php

namespace App\Application\DTOs\Images;

class ImageInputDTO
{

  public function __construct(
    public string $path,
    public int $imageableId,
    public string $imageableType
  ) {}

}