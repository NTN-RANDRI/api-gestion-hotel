<?php

namespace App\Http\Controllers;

use App\Application\Services\FileStorageInterface;
use App\Application\UseCases\Image\CreateImage;
use App\Application\UseCases\Image\DeleteImage;
use App\Http\Mappers\ImageHttpMapper;
use App\Http\Requests\Image\StoreImageRequest;
use App\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;

class ImageController extends Controller
{
    private const RESOURCE = 'Images';

    public function __construct(
        private CreateImage $createImage,
        private DeleteImage $deleteImage
    ) {}
    
    public function store(StoreImageRequest $request, FileStorageInterface $fileStorage): JsonResponse
    {
        $validated = $request->validated();

        $storedImages = [];
        /** @var \Illuminate\Http\Request $request */
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $storedImages[] = $fileStorage->store($file, 'chambres');
            }
        }
        $validated['pathImages'] = $storedImages;

        $inputDTOS = ImageHttpMapper::toDTOs($validated);
        $outputDTOs = $this->createImage->execute($inputDTOS);

        return ApiResponse::crudSuccess('create', self::RESOURCE, $outputDTOs);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteImage->execute($id);

        return ApiResponse::crudSuccess('delete', self::RESOURCE);
    }

}
