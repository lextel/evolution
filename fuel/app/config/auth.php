<?php
return array(
    // The drivers
    //'driver' => array('Simpleauth', 'Memberauth'),
    'driver' => ['Simpleauth','Memberauth'],
    // Set to true to allow multiple logins
    'verify_multiple_logins' => false,

    // Use your own salt for security reasons
    'salt' => 'Th1s=mYcdf3_$@|+',
);
