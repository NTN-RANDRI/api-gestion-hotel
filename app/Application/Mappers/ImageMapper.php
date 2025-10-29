<?php

namespace App\Application\Mappers;

use App\Application\DTOs\Images\ImageInputDTO;
use App\Application\DTOs\Images\ImageOutputDTO;
use App\Domain\Entities\Image;

class ImageMapper
{

  public static function toDomain(ImageInputDTO $imageInput): Image
  {
    return new Image(
      id: null,
      path: $imageInput->path,
      imageableId: $imageInput->imageableId,
      imageableType: $imageInput->imageableType
    );
  }

  public static function toDTO(Image $image): ImageOutputDTO
  {
    return new ImageOutputDTO(
      id: $image->getId(),
      url: $image->getUrl()
    );
  }

}