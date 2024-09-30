<?php


namespace App\Helpers\FileUpload;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileUploader
{
    private $disk;
    private $file;
    private $path;
    private $fileName;
    private $image;

    public function __construct(UploadedFile $file, string $disk = 'public')
    {
        $this->disk = $disk;

        $this->file = $file;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    public function getFileName()
    {
        return $this->fileName;
    }

    public function setFileName($fileName): self
    {
        $this->fileName = rtrim($fileName, '.' . $this->file->getClientOriginalExtension()) . '.' . $this->file->getClientOriginalExtension();

        return $this;
    }

    public function getUrl(): string
    {
        return Storage::disk($this->disk)->url(trim($this->path, '/') . '/' . $this->fileName);
    }

    public function upload(): self
    {
        if ($this->image instanceof \Intervention\Image\Image) {
            Storage::disk($this->disk)->put(path_join($this->path, $this->fileName), $this->image);
        } else {
            Storage::disk($this->disk)->putFileAs($this->path, $this->file, $this->fileName);
        }

        return $this;
    }

    public function resize(int $width, int $height): self
    {
        $this->image = Image::make($this->file->getRealPath());

        $this->image->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $this->image->stream(); // <-- Key point

        return $this;
    }
}
