<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Image;

interface ImageRepositoryInterface
{
  public function find(int $id): ?Image;
  public function save(Image $entity): Image;
  public function delete(int $id): void;
}