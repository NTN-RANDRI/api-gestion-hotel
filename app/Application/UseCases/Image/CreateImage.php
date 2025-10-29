<?php

namespace App\Application\UseCases\Image;

use App\Application\DTOs\Images\ImageInputDTO;
use App\Application\DTOs\Images\ImageOutputDTO;
use App\Application\Mappers\ImageMapper;
use App\Domain\Repositories\ImageRepositoryInterface;

class CreateImage
{

  public function __construct(
    private ImageRepositoryInterface $imageRepository
  ) {}

  public function execute(array $imageInputs): array /* ImageOutputDTO[] */
  {
    $imageOutputs = [];

    foreach ($imageInputs as $imageInput) {
      $image = ImageMapper::toDomain($imageInput);
      $image = $this->imageRepository->save($image);
      $imageOutputs[] = ImageMapper::toDTO($image);
    }

    return $imageOutputs;
  }

}