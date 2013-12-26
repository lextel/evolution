<?php

namespace Helper;

class Timer {

    public function millitime() {
      $microtime = microtime();
      $comps = explode(' ', $microtime);

      return sprintf('%d.%03d', $comps[1], $comps[0] * 1000);
    }
}
