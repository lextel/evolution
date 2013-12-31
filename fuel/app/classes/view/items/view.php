<?php

class View_Items_view extends Viewmodel {

    public function view() {

        $this->getZoom = function($link) {

            $rel = [
                'gallery'    => 'gal1',
                'smallimage' => str_replace(Uri::base(), '/', Uri::create('/image/80x80/' . $link)),
                'largeimage' => str_replace(Uri::base(), '/', Uri::create('/image/600x600/' . $link)),
            ];

            return json_encode($rel);
        };

        $this->getMember = function($memberId) {

            return Model_Member::find($memberId);
        };

        $this->friendlyDate = function($timestamp) {

            $timer = new \Helper\Timer();

            return $timer->friendlyDate($timestamp);
        };
    }
}
