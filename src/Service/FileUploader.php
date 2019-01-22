<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileUploader
 * @package App\Service
 */
class FileUploader
{
    /**
     * @var string
     */
    private $targetDirectory;

    /**
     * FileUploader constructor.
     * @param string $targetDirectory
     */
    public function __construct($targetDirectory)
    {
        $this->targetDirectory = $targetDirectory;
    }

    /**
     * @param UploadedFile $file
     * @param string       $prefix
     * @param string       $folder
     * @return string
     * @throws \Exception
     */
    public function upload(UploadedFile $file, string $prefix, string $folder): string
    {
        $fileName = $prefix . substr(md5(uniqid(random_int(1, 6), true)), 0, 5) .
            '_' . $file->getClientOriginalName();

        try {
            $file->move($this->getTargetDirectory() . $folder, $fileName);
        } catch (FileException $e) {
            throw $e;
        }

        return $fileName;
    }

    /**
     * @return string
     */
    public function getTargetDirectory(): string
    {
        return $this->targetDirectory;
    }
}