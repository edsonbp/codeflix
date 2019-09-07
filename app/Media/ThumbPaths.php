<?php
namespace CodeFlix\Media;


trait ThumbPaths
{
    use VideoStorages;

    public function getThumbRelativeAttribute(){
        return ($this->thumb)
            ? "{$this->thumb_folder_storage}/{$this->thumb}"
            : false;
    }

    public function getThumbPathAttribute()
    {
        return ($this->thumb_relative)
            ? $this->getAbsolutePath($this->getStorage(),$this->thumb_relative)
            : false;
    }

    public function getThumbSmallRelativeAttribute(){
        if($this->thumb) {
            list($name, $extension) = explode(".", $this->thumb);
            return "{$this->thumb_folder_storage}/{$name}_small.{$extension}";
        }
        return false;
    }

    public function getThumbSmallPathAttribute()
    {
        return ($this->thumb_small_relative)
            ? $this->getAbsolutePath($this->getStorage(), $this->thumb_small_relative)
            : false;
    }
}