<?php

namespace App\Infrastructure\Persistance\Eloquent\Repositories;

use App\Domain\Entities\Chambre;
use App\Domain\Entities\Image;
use App\Domain\Repositories\ImageRepositoryInterface;
use App\Infrastructure\Persistance\Eloquent\Mappers\ImageModelMapper;
use App\Models\Image as ImageModel;
use App\Models\Chambre as ChambreModel;

class ImageRepository implements ImageRepositoryInterface
{

  public function find(int $id): ?Image
  {
    $imageModel = ImageModel::find($id);

    if (!$imageModel) {
      return null;
    }

    return ImageModelMapper::toDomain($imageModel);
  }

  public function save(Image $entity): Image
  {
    $imageableClass = $entity->getImageableType();
    $imageableId = $entity->getImageableId();

    $imageable = $imageableClass::findOrFail($imageableId);

    $imageModel = new ImageModel();
    $imageModel->path = $entity->getPath();

    $imageable->images()->save($imageModel);

    return ImageModelMapper::toDomain($imageModel);
  }

  public function delete(int $id): void
  {
    $imageModel = ImageModel::find($id);
    $imageModel->delete();
  }

}