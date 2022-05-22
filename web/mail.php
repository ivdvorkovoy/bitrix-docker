#!/usr/bin/php
<?php
$mail_path = '';
$pwd = $_SERVER['PWD'];
$pwd = explode('/',$pwd);
foreach ($pwd as $dir){
    if ($dir) {
        if ($mail_path !== '/var/www/html') {
            $mail_path .= '/' . $dir;
        } else {
            $mail_path .= '/' . $dir.'/mail/';
            break;
        }
    }
}

$input = file_get_contents('php://stdin');
preg_match('|^To: (.*)|', $input, $matches);
$t = $mail_path . $matches[1] . '_' . time() . '.eml';
chmod($t, 0644);
file_put_contents($t, $input, FILE_APPEND);