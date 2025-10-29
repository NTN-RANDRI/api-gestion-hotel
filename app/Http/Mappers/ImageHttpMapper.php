<?php

namespace App\Http\Mappers;

use App\Application\DTOs\Images\ImageInputDTO;

class ImageHttpMapper
{

  public static function toDTO(array $data): ImageInputDTO
  {
      return new ImageInputDTO(
        path: $data['pathImage'],
        imageableId: $data['imageable_id'],
        imageableType: $data['imageable_type']
      );
  }

}