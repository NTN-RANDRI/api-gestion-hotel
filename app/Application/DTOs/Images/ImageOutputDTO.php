<?php

namespace App\Application\DTOs\Images;

class ImageOutputDTO
{

  public function __construct(
    public int $id,
    public string $url
  )
  {}

}