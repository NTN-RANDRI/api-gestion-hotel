<?php

namespace App\Domain\Entities;

class Image
{

  public function __construct(
    private ?int $id,
    private string $path
  )
  {}

  /**
   * Getters
   */
  public function getId(): ?int { return $this->id; }
  public function getPath(): string { return $this->path; }
  public function getUrl(): string { return asset('storage/' . $this->path); }

}