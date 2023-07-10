<?php

namespace App\Helpers;

class ImageHelper {

    public static function getImageBySize(array $imageArray, string $size) {
        if (empty($imageArray))
            return null;

        self::orderImages($imageArray);

        switch ($size) {
            case 'small':
                $key = 0;
                break;

            case 'medium':
                $key = (count($imageArray)-1)/2;
                break;

            case 'large':
            default:
                $key = count($imageArray)-1;
                break;

            }

        return $imageArray[$key]['url'] ?? null;
    }

    private static function orderImages(array &$images) {
        $size = array_column($images, 'height');

        array_multisort($size, SORT_ASC, $images);
    }
}