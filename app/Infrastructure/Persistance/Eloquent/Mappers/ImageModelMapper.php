<?php

namespace App\Infrastructure\Persistance\Eloquent\Mappers;

use App\Domain\Entities\Image;
use App\Models\Image as ImageModel;

class ImageModelMapper
{

  public static function toArray(Image $entity): array
  {
    return [
      'path' => $entity->getPath()
    ];
  }

  public static function toDomain(ImageModel $model): Image
  {
    return new Image(
      id: $model->id,
      path: $model->path
    );
  }

}