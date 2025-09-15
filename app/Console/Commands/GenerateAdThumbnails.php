<?php

namespace App\Console\Commands;

use App\Models\Ad;
use App\Services\ImageService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateAdThumbnails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ads:generate-thumbnails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate thumbnails for existing ads that do not have thumbnails';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting thumbnail generation for existing ads...');

        // Get all ads that don't have thumbnails
        $ads = Ad::whereNull('thumbnail')->orWhere('thumbnail', '')->get();

        if ($ads->isEmpty()) {
            $this->info('No ads found without thumbnails.');
            return;
        }

        $this->info("Found {$ads->count()} ads without thumbnails.");

        $bar = $this->output->createProgressBar($ads->count());
        $bar->start();

        $successCount = 0;
        $errorCount = 0;

        foreach ($ads as $ad) {
            try {
                // Check if original image exists
                if (!$ad->image || !Storage::disk('public')->exists($ad->image)) {
                    $this->warn("Original image not found for ad ID: {$ad->id}");
                    $errorCount++;
                    $bar->advance();
                    continue;
                }

                // Get the original image file
                $imagePath = Storage::disk('public')->path($ad->image);
                
                // Create a temporary uploaded file object
                $uploadedFile = new \Illuminate\Http\UploadedFile(
                    $imagePath,
                    basename($ad->image),
                    mime_content_type($imagePath),
                    null,
                    true
                );

                // Generate thumbnail
                $uploadedImages = ImageService::uploadImageWithThumbnail($uploadedFile, 'ads', 300, 300);
                
                // Update the ad with thumbnail path
                $ad->update(['thumbnail' => $uploadedImages['thumbnail']]);
                
                $successCount++;
            } catch (\Exception $e) {
                $this->error("Error processing ad ID {$ad->id}: " . $e->getMessage());
                $errorCount++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine();

        $this->info("Thumbnail generation completed!");
        $this->info("Successfully processed: {$successCount} ads");
        $this->info("Errors: {$errorCount} ads");

        if ($errorCount > 0) {
            $this->warn("Some ads could not be processed. Check the error messages above.");
        }
    }
}
