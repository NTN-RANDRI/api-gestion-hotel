<?php

namespace App\Http\Mappers;

use App\Application\DTOs\Images\ImageInputDTO;

class ImageHttpMapper
{

  public static function toDTOs(array $data): array /* ImageInputDTO */
  {
    $inputDTOS = [];

    foreach ($data['pathImages'] as $image) {
      $inputDTOS[] = new ImageInputDTO(
        path: $image,
        imageableId: $data['imageable_id'],
        imageableType: $data['imageable_type']
      );
    }

    return $inputDTOS;
  }

}