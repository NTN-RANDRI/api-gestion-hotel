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

  public function execute(ImageInputDTO $imageInput): ImageOutputDTO
  {
    $image = ImageMapper::toDomain($imageInput);
    $image = $this->imageRepository->save($image);

    return ImageMapper::toDTO($image);
  }

}