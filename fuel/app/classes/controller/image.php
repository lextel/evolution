<?php

/**
 * 图片resize
 */
class Controller_Image extends Controller_Template {

    public function action_index() {

        $size = $this->param('size');
        $link = $this->param('link') . '.jpg';

        $image = new \Classes\Image();
        $link = $image->resize($link, $size);

        Response::redirect(Uri::create('/'.$link));
    }
}
