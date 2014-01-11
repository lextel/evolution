<?php

/**
 * 图片resize
 */
class Controller_Image extends Controller_Template {

    public function action_index() {

        Config::load('upload');
        $size = $this->param('size');
        $uploadConfig = Config::get('item');
        $link = $this->param('link') . '.jpg';
        $file = str_replace('/upload/item/upload/item', '/upload/item', $uploadConfig['path'].DS.$link);
        if(!file_exists($file)) {
            $link = $this->param('link') . '.jpeg';
        }

        $image = new \Classes\Image();
        $link = $image->resize($link, $size);

        Response::redirect(Uri::create($link));
    }
}
