<?php

namespace Udjat\Ctrl;

use \Udjat;

/**
 * 
 */
class Data
{

    /**
     * @return void
     */
    public function postAction()
    {

        /**
         * data format:
         * hostname web3.exitb.de
         * load1 0.15
         * load5 0.14
         * load15 0.10
         * MemTotal 7985
         * MemUsed 5389
         */

        $mongoDb = \Udjat\Registry::getInstance()->getMongoDb();

        $collection = $mongoDb->selectCollection('data');

        $data = file_get_contents('php://input');

        $lines =explode("\n",$data);

        if (array_shift($lines) != 'UDJAT/1.0') {
            die('ERROR Illegal format, need UDJAT/1.0');
        }

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
            $doc = new \Udjat\Document\MetricValue();
            $doc->datetime  = $datetime;
            $doc->host      = $host;
            $doc->service   = 'system';
            $doc->metric    = $key;
            $doc->value     =$value;

            $collection->insert($doc);
        }

        echo "OK: $i metrics imported.\n";
    }
}
