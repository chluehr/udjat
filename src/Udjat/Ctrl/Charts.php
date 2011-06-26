<?php

namespace Udjat\Ctrl;

/**
 * 
 */
class Charts extends \Udjat\CtrlAbstract
{

    /**
     * @return void
     */
    public function indexAction()
    {

        $mongo = \Udjat\Registry::getInstance()->getMongoDb();
        $collection = $mongo->selectCollection('data');

        $view = new \Udjat\ViewAcl();

        $view->menu = array(
            array(
                'label' => 'Dashboard',
                'url' => '/dashboard',
            ),
            array(
                'label' => 'Charts',
                'url' => '/charts',
                'selected' => true
            ),
        );

        $view->sidebar = '<h3>Sample Sidebar</h3>';

        $view->render('header.php');

        echo '<h2>Chart overview</h2>';

        $metrics = $mongo->command(array("distinct" => "data", "key" => "metric"));

        foreach ($metrics['values'] as $metric) {

            $graphData = array();

            $cursor = $collection
                ->find(
                    array("metric" => $metric),
                    array("value" => 1, 'datetime' => 1)
                )
                ->sort(array("datetime" => 1));


            foreach ($cursor as $doc) {

                $graphData[] = array($doc['datetime'], (float)$doc['value']);
            }

            $view->metric = $metric;
            $view->title = $metric;
            $view->data = array($graphData);

            $view->render('graph.php');
        }

        $view->render('footer.php');
    }
}
