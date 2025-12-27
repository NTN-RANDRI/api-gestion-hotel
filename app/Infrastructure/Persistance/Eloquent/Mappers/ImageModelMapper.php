<?php

namespace App\Infrastructure\Persistance\Eloquent\Mappers;

use App\Domain\Entities\Image;
use App\Models\Image as ImageModel;
use Illuminate\Database\Eloquent\Collection;

class ImageModelMapper
{

    public static function toArray(Image $entity): array
    {
        return [
        'path' => $entity->getPath(),
        'imageable_id' => $entity->getImageableId(),
        'imageable_type' => $entity->getImageableType()
        ];
    }

    public static function toDomain(ImageModel $model): Image
    {
        return new Image(
        id: $model->id,
        path: $model->path,
        imageableId: $model->imageable_id,
        imageableType: $model->imageable_type,
        );
    }

    public static function toDomains(Collection $models): array
    {
        return $models->map(function ($model) {
            return self::toDomain($model);
        })->all();
    }

}