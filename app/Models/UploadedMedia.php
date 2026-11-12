<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class UploadedMedia extends Model
{
    protected $table = 'uploaded_media';

    protected $fillable = [
        'uuid',
        'mime_type',
        'size',
        'data',
    ];

    /**
     * Store an uploaded image file permanently in the database and return its public URL path.
     * Compresses large raster images with GD when available to save database space.
     */
    public static function storeUploadedFile(UploadedFile $file): string
    {
        $raw = file_get_contents($file->getRealPath());
        $mimeType = $file->getMimeType() ?: 'image/jpeg';

        [$optimizedRaw, $optimizedMime] = self::optimizeImage($raw, $mimeType);

        $media = self::create([
            'uuid' => (string) Str::uuid(),
            'mime_type' => $optimizedMime,
            'size' => strlen($optimizedRaw),
            'data' => base64_encode($optimizedRaw),
        ]);

        return '/media/' . $media->uuid;
    }

    /**
     * Resize oversized JPEG/PNG/WebP images to max 1280px width and compress to JPEG/WebP
     * so they stay lightweight inside PostgreSQL free tier.
     */
    private static function optimizeImage(string $raw, string $mimeType): array
    {
        if (!function_exists('imagecreatefromstring') || !in_array($mimeType, ['image/jpeg', 'image/png', 'image/webp'], true)) {
            return [$raw, $mimeType];
        }

        $image = @imagecreatefromstring($raw);
        if (!$image) {
            return [$raw, $mimeType];
        }

        $width = imagesx($image);
        $height = imagesy($image);
        $maxWidth = 1280;

        if ($width > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = (int) round(($height / $width) * $newWidth);
            $resized = imagecreatetruecolor($newWidth, $newHeight);

            if ($mimeType === 'image/png') {
                imagealphablending($resized, false);
                imagesavealpha($resized, true);
            }

            imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
            imagedestroy($image);
            $image = $resized;
        }

        ob_start();
        if ($mimeType === 'image/png') {
            imagepng($image, null, 7);
        } else {
            imagejpeg($image, null, 82);
            $mimeType = 'image/jpeg';
        }
        $output = ob_get_clean();
        imagedestroy($image);

        if ($output && strlen($output) < strlen($raw)) {
            return [$output, $mimeType];
        }

        return [$raw, $mimeType];
    }
}
