<?php

/**
 * 图片resize
 */
class Controller_Image extends Controller_Template {

    public function action_index() {

        Config::load('upload');
        $size = $this->param('size');
        $link = $this->param('link') . '.jpg';

        if(preg_match_all('/^upload\/([a-zA-Z]+)\//', $link, $match)) {
            $type = $match[1][0];
            $uploadConfig = Config::get($type);
            $filename = str_replace('upload/'.$type. '/', '', $link);

            $file = $uploadConfig['path'].DS.$filename;
            if(!file_exists($file)) {
                $link = $this->param('link') . '.jpeg';
            }

            $image = new \Classes\Image();
            $link = $image->resize($link, $size);

            Response::redirect(Uri::create($link));
        } else {
            Response::redirect('error/404');
        }
    }
}
