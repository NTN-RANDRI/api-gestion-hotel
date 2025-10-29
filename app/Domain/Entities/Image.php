<?php

namespace App\Domain\Entities;

class Image
{

  public function __construct(
    private ?int $id,
    private string $path,
    private int $imageableId,
    private string $imageableType
  ) {}

  // GETTERS
  public function getId(): ?int { return $this->id; }
  public function getPath(): string { return $this->path; }
  public function getUrl(): string { return asset('storage/' . $this->path); }
  public function getImageableId(): ?int { return $this->imageableId; }
  public function getImageableType(): string { return 'App\Models\\' . $this->imageableType; }

}