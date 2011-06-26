<?php

namespace Udjat\Parser;

/**
 * 
 */
class Simple
{

    /**
     * @static
     * @return void
     */
    static function init()
    {
	$data = file_get_contents('php://input');

	$lines =explode("\n",$data);

	$data = array();
	foreach($lines as $line) {

		if (trim($line) == '') continue;

		list($key, $val) = explode(' ',$line);
		$data[$key]=$val;
	}
	if (!isset($data['host'])) {
	    die('[host] key is missing!');
	}

	$datetime = date('Y-m-d H:i:s');

	$host = $data['host'];
	unset($data['host']);
	$i=0;
	foreach ($data as $key => $value) {
	    $i++;
	    $doc = new DataItem();
	    $doc->datetime      = $datetime;
	    $doc->host      = $host;
	    $doc->service   = 'system';
	    $doc->metric    = $key;
	    $doc->value     =$value;
	    $ca->store($doc);
	}

	echo "OK: $i metrics imported.\n";
    }
}
