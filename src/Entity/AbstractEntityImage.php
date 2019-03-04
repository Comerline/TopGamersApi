<?php

namespace App\Entity;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Doctrine\ORM\Mapping as ORM;

abstract class AbstractEntityImage {

    const FOLDER_IMAGES = '/var/www/topgamersapi/public/images';

    /**
     * No linked with ORM
     * @var type 
     */
    protected $image;

    /**
     * @var string
     *
     * @ORM\Column(name="imagename", type="string", length=100, nullable=false)
     */
    protected $imageName;

    /**
     * Function execute in prePersist and preUpdate Entity.
     * Save the image in folder and set Image Name in Entity.
     * @return type
     */
    public function upload() {
        if (null === $this->getImage()) {
            return;
        }

        $this->getImage()->move(
                self::FOLDER_IMAGES, $this->getImage()->getClientOriginalName()
        );

        $this->setImageName($this->getImage()->getClientOriginalName());

        $this->setImage(null);
    }

    function getImage() {
        return $this->image;
    }

    function getImageName() {
        return $this->imageName;
    }

    /**
     * Get Relative Image Path only if exists file
     * @return string
     */
    function getImagePath() {
        $imagePath = '';
        if (file_exists(self::FOLDER_IMAGES . '/' . $this->getImageName()) && is_file(self::FOLDER_IMAGES . '/' . $this->getImageName())) {
            $imagePath = 'images/' . $this->getImageName();
        }
        return $imagePath;
    }

    function setImage(UploadedFile $image = null) {
        $this->image = $image;
    }

    function setImageName($imageName) {
        $this->imageName = $imageName;
    }

}
