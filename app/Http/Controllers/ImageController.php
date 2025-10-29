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

        /** @var \Illuminate\Http\Request $request */
        $storedImage = $fileStorage->store($request->file('image'), 'chambres');
        $validated['pathImage'] = $storedImage;

        $inputDTO = ImageHttpMapper::toDTO($validated);
        $outputDTO = $this->createImage->execute($inputDTO);

        return ApiResponse::crudSuccess('create', self::RESOURCE, $outputDTO);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->deleteImage->execute($id);

        return ApiResponse::crudSuccess('delete', self::RESOURCE);
    }

}
