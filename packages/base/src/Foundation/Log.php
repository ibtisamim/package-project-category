<?php

/*
 * @author Anas almasri (anas.almasri@merwas.net)
 * @Description: This is class for logging
 */

namespace drafeef\base\Foundation;

final class Log {


    /**
     * @param bool $sendEmail
     * @param string $file
     * @param int $line
     * @param string $message
     * @return void
     * @author Anas almasri (anas.almasri@merwas.net)
     * @Description This is function for save error log
     */
    public static function errorLog(bool $sendEmail , string $file , int $line , string $message , string $event , array $extra = [])
    {

        if ($sendEmail)
        {
            //if true send notify to admin and owner
        }

        $data =  [
            'file' => $file,
            'line' => $line,
        ];

        if ($extra) {

            $data['extra'] = $extra;
        }

        activity()->setEvent($event)->withProperties($data)->log($message);

    }

 }
