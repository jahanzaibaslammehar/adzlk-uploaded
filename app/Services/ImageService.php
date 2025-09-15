<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    /**
     * Upload image and create thumbnail
     *
     * @param UploadedFile $image
     * @param string $path
     * @param int $thumbnailWidth
     * @param int $thumbnailHeight
     * @return array
     */
    public static function uploadImageWithThumbnail(UploadedFile $image, string $path = 'ads', int $thumbnailWidth = 300, int $thumbnailHeight = 300): array
    {
        // Generate unique filename
        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        
        // Store original image
        $imagePath = $image->storeAs($path, $filename, 'public');
        
        // Create thumbnail
        $thumbnailPath = self::createThumbnail($image, $path, $filename, $thumbnailWidth, $thumbnailHeight);
        
        return [
            'image' => $imagePath,
            'thumbnail' => $thumbnailPath
        ];
    }
    
    /**
     * Create thumbnail from uploaded image
     *
     * @param UploadedFile $image
     * @param string $path
     * @param string $filename
     * @param int $width
     * @param int $height
     * @return string
     */
    private static function createThumbnail(UploadedFile $image, string $path, string $filename, int $width, int $height): string
    {
        // Create thumbnail filename
        $thumbnailFilename = 'thumb_' . $filename;
        $thumbnailPath = $path . '/' . $thumbnailFilename;
        
        // Create ImageManager instance
        $manager = new ImageManager(new Driver());
        
        // Create thumbnail using Intervention Image
        $thumbnail = $manager->read($image)
            ->cover($width, $height)
            ->toJpeg(80);
        
        // Store thumbnail
        Storage::disk('public')->put($thumbnailPath, $thumbnail);
        
        return $thumbnailPath;
    }
    
    /**
     * Delete image and thumbnail
     *
     * @param string $imagePath
     * @param string $thumbnailPath
     * @return bool
     */
    public static function deleteImageWithThumbnail(string $imagePath, string $thumbnailPath = null): bool
    {
        try {
            // Delete original image
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            
            // Delete thumbnail if exists
            if ($thumbnailPath && Storage::disk('public')->exists($thumbnailPath)) {
                Storage::disk('public')->delete($thumbnailPath);
            }
            
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    
    /**
     * Update image and thumbnail
     *
     * @param UploadedFile $newImage
     * @param string $oldImagePath
     * @param string $oldThumbnailPath
     * @param string $path
     * @param int $thumbnailWidth
     * @param int $thumbnailHeight
     * @return array
     */
    public static function updateImageWithThumbnail(UploadedFile $newImage, string $oldImagePath, string $oldThumbnailPath = null, string $path = 'ads', int $thumbnailWidth = 300, int $thumbnailHeight = 300): array
    {
        // Delete old images
        self::deleteImageWithThumbnail($oldImagePath, $oldThumbnailPath);
        
        // Upload new image and create thumbnail
        return self::uploadImageWithThumbnail($newImage, $path, $thumbnailWidth, $thumbnailHeight);
    }
}
