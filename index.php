<?php
ini_set('display_errors', 1);
#################################################
#                                               #
#				ANSR Framework                  #
#	@author Ivan Yonkov <ivanynkv@gmail.com>    #
#                                               #
#	A very basic MVC framework which has        #
#	default router for routing schema           #
#	/controller/action/. It has two basic       #
#	wrappers for database (mysqli) -> object    #
#	oriented one, and procedural one.           #
#                                               #
#	If one needs additional configs, wrappers   #
#	or libraries, can follow the namespace      #
#	schema and level of abstraction which can   #
#	be found in each abstract class.            #																											#
#                                               #
#	The framework uses PHP 5.5.                 #
#                                               #
#	Some features might not work on	            #
#	lower versions                              #
#                                               #
#################################################
define('ROOT', __DIR__ . DIRECTORY_SEPARATOR);
include 'Autoload/DefaultLoader.php';
Autoload\DefaultLoader::registerAutoload();
require_once 'Propel/index.php';
$__router = '\ANSR\Routing\DefaultRouter';

/**
 * @var $__router \ANSR\Routing\IRouter|\ANSR\Routing\RouterAbstract
 *
 * The example routing here routes one request URI to different controller->actions() depending on the request method
 * For instance when POST or GET is sent to e.g. http://yourApp.com/user/3 the app will invoke Users::view();
 * If PUT is sent to the same address, the app will invoke Users::edit()
 * If DELETE is sent - Users::delete() will be invoked.
 *
 * All of these methods will have pushed in the request with key "id" the "3" from the url.
 * So it can be used in the controller as $this->getRequest()->getParam('id')
 */
$__router
    ::addRoute(
        (new \ANSR\Routing\Route("/importer/[a-zA-Z]+/[a-zA-Z]", "Importer", "doImport", \ANSR\Library\Request\Request::TYPE_POST))
            ->addRequestMapping(
                new \ANSR\Library\Request\RouteMap(1, 'database')
            )
            ->addRequestMapping(
                new \ANSR\Library\Request\RouteMap(2, 'dataType')
            )
    )
    ->addRoute(
        (new \ANSR\Routing\Route("/data/[a-zA-Z]+/[a-zA-Z]+", "Data", "get", \ANSR\Library\Request\Request::TYPE_GET))
            ->addRequestMapping(
                new \ANSR\Library\Request\RouteMap(1, 'database')
            )
            ->addRequestMapping(
                new \ANSR\Library\Request\RouteMap(2, 'table')
            )
    )
    ->addRoute(
        (new \ANSR\Routing\Route("/data/[a-zA-Z]+", "Data", "getAll", \ANSR\Library\Request\Request::TYPE_GET))
            ->addRequestMapping(
                new \ANSR\Library\Request\RouteMap(1, 'database')
            )
    );

\ANSR\Library\Registry\Registry::set('WEB_SERVICE', true);

\ANSR\Library\DependencyContainer\AppStarter::createApp('MySQLi_Procedural', 'DefaultRouter', 'development');