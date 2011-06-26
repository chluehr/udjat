<?php

namespace Udjat\Ctrl;

/**
 * 
 */
class Setup extends \Udjat\CtrlAclAbstract
{

    /**
     * @return void
     */
    public function indexAction()
    {

        $mongoDb = \Udjat\Registry::getInstance()->getMongoDb();
        $data = $mongoDb->selectCollection('data');

        $res = $mongoDb->command(
            array(
                "distinct" => "data",
                "key" => "host"
            )
        );

        $metrics = array();

        foreach ($res['values'] as $host) {

            $res2 = $mongoDb->command(
                array(
                    "distinct" => "data",
                    "key" => "metric"
                )
            );

            foreach ($res2['values'] as $metricType) {

                $metrics[] = array(
                    'host' => $host,
                    'metric' => $metricType
                );
            }

        }

        $view = new \Udjat\View();

        $view->metrics = $metrics;

        $view->render('header.php');
        $view->render('setup/index.php');
        $view->render('footer.php');
    }
}
