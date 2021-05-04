<?php

use App\Jobs\MailNotifyJob;
// helper added into autoloader of composer.json


if (!function_exists('sendMySMTP')) {

    function sendMySMTP(array $data) {

        try {
            dispatch(new MailNotifyJob($data));

		} catch (\Exception $e) {
			throw $e;
		}
    }
}



if (!function_exists('trueFormat')) {

    function trueFormat($dateSatring)
    {
        $date = date_create($dateSatring);
        $newDate = date_format($date, 'd-m-Y');
        return $newDate;

    }
}



if (!function_exists('defaultFormat')) {

    function defaultFormat($dateSatring)
    {
        $date = date_create($dateSatring);
        $oldDate = date_format($date, 'Y-m-d');
        return $oldDate;
    }
}
