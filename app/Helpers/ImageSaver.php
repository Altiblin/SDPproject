<?php
namespace App\Helpers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageSaver {
    public function upload($item = null) {
        $dir = 'post';
        if ($item instanceof Category) {
            $dir = 'category';
        }
        $name = $item->image;
        if ($name && request()->remove) {
            $this->remove($item);
            $name = null;
        }
        $source = request()->file('image');
        if ($source) { 
            if ($item->image) {
                $this->remove($item);
                $name = null;
            }
            $src = $source->store($dir . '/source', 'public');
            $name = basename($src);
            $dst = str_replace('source', 'image', $src);
            $this->resize($src, $dst, 1000, 300);
        }
        return $name;
    }
    private function resize($src, $dst, $width, $height) {
        $path = Storage::disk('public')->path($src);
        $image = Image::make($path)
            ->heighten($height)
            ->resizeCanvas($width, $height, 'center', false, 'eeeeee')
            ->encode(pathinfo($path, PATHINFO_EXTENSION), 100);
        Storage::disk('public')->put($dst, $image);
        $image->destroy();
    }

    public function remove($item) {
        $dir = 'post';
        if ($item instanceof Category) {
            $dir = 'category';
        }
        $image = $item->image;
        if ($image) {
            Storage::disk('public')->delete($dir . '/source/' . $image);
            Storage::disk('public')->delete($dir . '/image/' . $image);
        }
    }
}