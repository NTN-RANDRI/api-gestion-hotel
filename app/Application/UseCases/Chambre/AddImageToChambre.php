<?php

namespace App\Application\UseCases\Chambre;

use App\Application\DTOs\Images\ImageOutputDTO;
use App\Application\Mappers\ImageMapper;
use App\Application\Services\FileStorageInterface;
use App\Domain\Repositories\ChambreRepositoryInterface;
use App\Exceptions\Entity\EntityNotFoundException;
use Illuminate\Http\UploadedFile;

class AddImageToChambre
{

    public function __construct(
        private ChambreRepositoryInterface $chambreRepository,
        private FileStorageInterface $fileStorage
    )
    {}

    public function execute(int $chambreId, UploadedFile $file): ImageOutputDTO
    {
        $chambre = $this->chambreRepository->find($chambreId);
        if (!$chambre) throw new EntityNotFoundException('Chambre');

        $filePath = $this->fileStorage->store($file, 'chambres');
        $image = $this->chambreRepository->createImage($chambre, $filePath);

        return ImageMapper::toDTO($image);
    }

}