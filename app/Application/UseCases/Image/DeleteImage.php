<?php

namespace App\Application\UseCases\Image;

use App\Application\Services\FileStorageInterface;
use App\Domain\Repositories\ImageRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;

class DeleteImage
{

  public function __construct(
    private ImageRepositoryInterface $imageRepository,
    private FileStorageInterface $fileStorage,
  ) {}

  public function execute(int $id): void
  {
    $image = $this->imageRepository->find($id);
    if (!$image) throw new EntityNotFoundException('Image');

    if ($this->fileStorage->delete($image->getPath())) {
        $this->imageRepository->delete($image->getId());
    }
  }

}