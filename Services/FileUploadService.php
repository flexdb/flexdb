<?php
namespace Modules\Flexwb\Services;

use Illuminate\Http\Request;

class FileUploadService{
    
    public $imageSizes = [
        [
            'width' => 280,
            'height' => 190,
            'prefix' => "th"
        ],
        [
            'width' => 320,
            'height' => 280,
            'prefix' => "sm"
        ],
        [
            'width' => 480,
            'height' => 320,
            'prefix' => "md"
        ],
        [
            'width' => null,
            'height' => 480,
            'prefix' => "lg"
        ],
        [
            'width' => null,
            'height' => 720,
            'prefix' => "lghd"
        ],
        [
            'width' => null,
            'height' => 1080,
            'prefix' => "hd"
        ]
    ];

    public $imageCropSizes = [
        "width" => 0,
        "height" => 0
    ];
    public $imageCrop = false;
    public $imageResize = false;

    
    /**
     *
     * @param UploadedFile $file
     * @param array [
     *               'name'		=>	$name,
     *               'caption'		=>	$cover_photo['caption'],
     *               'destination'	=>	'uploads',
     *               'type'		=>	'cover'
     *       ] $option
     * @return boolean|array
     */
    public function uploadAndGetInformation(UploadedFile $file, array $option = array()){
            if(is_null($this->path)){
                $this->setDefaultPath();
            }

            $name = $option['name'] . '.' . $file->getClientOriginalExtension();

            if (!$file->isValid()) return false;
            try {
                    $file->move($this->path.DIRECTORY_SEPARATOR.$option['destination'], $name);

                    $uploadedFilePath = $this->path.DIRECTORY_SEPARATOR.$option['destination'].DIRECTORY_SEPARATOR.$name;
                    
                    $filePath = $uploadedFilePath;
                    if($this->imageCrop)
                    {
                        $filePath = $this->cropFile($uploadedFilePath, $option);
                    }
                    if($this->imageResize){
                        $this->resizeFile($filePath, $name, $option);
                    }
                    $file = [ 'name' => $name, 'caption' => $option['caption'],
                        'file' => $option['destination'] . '/' . $name,
                        'type' => (isset($option['type']) ? $option['type'] : null) ];
                    return $file;
            } catch (Exception $e) {

                    return false;
            }
    }
    
    public function cropFile($uploadedFilePath, $option)
    {
        $name = $option['name'] . '.' . $file->getClientOriginalExtension();
        $cropedFilePath = $this->path.DIRECTORY_SEPARATOR.$option['destination'].DIRECTORY_SEPARATOR."croped".DIRECTORY_SEPARATOR.$name;
                        Image::make($uploadedFilePath)->sharpen(4)
                                ->fit($this->imageCropSizes['width'], $this->imageCropSizes['height'])
                                ->save($cropedFilePath);
                        return $cropedFilePath;
    }
    
    public function crop($width = 480, $height = 360)
    {
        $this->imageCrop = true;
        $imageCropSizes = [
            "width" => $width,
            "height" => $height
        ];
        return this;
    }
    
    public function resize()
    {
        $this->imageResize = true;
        return this;
    }
    
    public function resizeFile($filePath, $fileName, $option)
    {
        foreach ($this->imageSizes as $size) {
                    Image::make(
                            $filePath
                    )->sharpen(4)->resize($size['width'], $size['height'], function($constraint){
                        $constraint->aspectRatio();
                    })->save($this->path.DIRECTORY_SEPARATOR.$option['destination'].DIRECTORY_SEPARATOR.$size['prefix'].DIRECTORY_SEPARATOR.$fileName);
                }
    }
}