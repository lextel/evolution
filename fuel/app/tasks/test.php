<?php
namespace Fuel\Tasks;

class Test
{
    public static function run($speech = null)
    {
        if ( ! isset($speech))
        {
            $speech = 'KILL ALL HUMANS!';
        }

        return 1;

    }

    /**
     * An example method that is here just to show the various uses of tasks.
     *
     * Usage (from command line):
     *
     * php oil r robots:protect
     *
     * @return string
     */
    public static function test()
    {
        touch('test.touch');
        return 'test';
    }
}

