<?php

namespace App\Application\UseCases\Image;

use App\Domain\Repositories\ImageRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class DeleteImage
{

  public function __construct(
    private ImageRepositoryInterface $imageRepository
  ) {}

  public function execute(int $id): void
  {
    $image = $this->imageRepository->find($id);

    if (!$image) {
        throw new EntityNotFoundException('Image');
    }

    $this->imageRepository->delete($image->getId());
  }

}