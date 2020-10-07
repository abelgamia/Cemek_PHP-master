<?php

namespace src;

/**
 *
 * @author Edikowy
 *        
 */
class Util {
    public static function doHedera($url) {
        header("location: " . $url);
    }
	public static function self() {
		$wyraz = array('/Cemek_PHP/', '.php');
		return str_replace($wyraz, '', $_SERVER['PHP_SELF']);
	}
	public static function serverIdent2() {
	    $indicesServer = array('PHP_SELF',
	        'PHP_AUTH_DIGEST',
	        'PHP_AUTH_USER',
	        'PHP_AUTH_PW',
	        'SERVER_ADDR',
	        'SERVER_NAME',
	        'SERVER_SOFTWARE',
	        'SERVER_PROTOCOL',
	        'SERVER_ADMIN',
	        'SERVER_PORT',
	        'SERVER_SIGNATURE',
	        'REMOTE_ADDR',
	        'REMOTE_HOST',
	        'REMOTE_PORT',
	        'REMOTE_USER',
	        'REDIRECT_REMOTE_USER',
	        'REQUEST_URI',
	        'REQUEST_METHOD',
	        'REQUEST_TIME',
	        'REQUEST_TIME_FLOAT',
	        'HTTPS',
	        'HTTP_ACCEPT',
	        'HTTP_ACCEPT_CHARSET',
	        'HTTP_ACCEPT_ENCODING',
	        'HTTP_ACCEPT_LANGUAGE',
	        'HTTP_CONNECTION',
	        'HTTP_HOST',
	        'HTTP_REFERER',
	        'HTTP_USER_AGENT',
	        'SCRIPT_FILENAME',
	        'SCRIPT_NAME',
	        'PATH_TRANSLATED',
	        'PATH_INFO',
	        'argv',
	        'argc',
	        'QUERY_STRING',
	        'DOCUMENT_ROOT',
	        'GATEWAY_INTERFACE',
	        'AUTH_TYPE',
	        'ORIG_PATH_INFO') ;
	    echo '<table cellpadding="10">' ;
	    foreach ($indicesServer as $arg) {
	        if (isset($_SERVER[$arg])) {
	            echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
	        }
	        else {
	            echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
	        }
	    }
	    echo '</table>' ;
	}
}