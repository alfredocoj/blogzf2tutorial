<?php


return array(
    'controllers' => array( //add module controllers
        'invokables' => array(
            'Admin\Controller\Index'    => 'Admin\Controller\IndexController',
            'Admin\Controller\Auth'     => 'Admin\Controller\AuthController',
            'Admin\Controller\Posts'    => 'Admin\Controller\PostsController',
            'Admin\Controller\Comments' => 'Admin\Controller\CommentsController',
            'Admin\Controller\Users'    => 'Admin\Controller\UsersController',

        ),
    ),

    'router' => array(
        'routes' => array(
            'admin' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/admin',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Admin\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                        'module'        => 'Admin'
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action[/:id]]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                                'module'        => 'Admin'
                            ),
                        ),
                        'child_routes' => array( //permite mandar dados pela url 
                            'wildcard' => array(
                                'type' => 'Wildcard'
                            ),
                        ),
                    ),
                    
                ),
            ),
        ),
    ),
    'view_manager' => array( //the module can have a specific layout
        // 'template_map' => array(
        //     'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
        // ),
        'template_path_stack' => array(
            'application' => __DIR__ . '/../view',  //'admin' => __DIR__ . '/../view',
        ),
    ),
    /*'db' => array( //module can have a specific db configuration
        'driver' => 'PDO_SQLite',
        'dsn' => 'sqlite:' . __DIR__ .'/../data/admin.db',
        'driver_options' => array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        )
    ),*/
    'service_manager' => array(
        'factories' => array(
            'Session' => function($sm) {
                return new Zend\Session\Container('ZF2napratica');
            },
            'Admin\Service\Auth' => function($sm) {
                $dbAdapter = $sm->get('DbAdapter');
                return new Admin\Service\Auth($dbAdapter);
            },
        ),
        'invokables' => array(
            'Admin\Model\PostModel'             => 'Admin\Model\PostModel'
        ),
    ),
    'view_helpers' => array(
        'factories' => array(
            'flashMessage' => function ($serviceManager) {
                $flashmessenger = $serviceManager->getServiceLocator()->get('ControllerPluginManager')->get('flashmessenger');
                $message = new \Core\View\Helper\FlashMessages();
                $message->setFlashMessenger( $flashmessenger );

                return $message;
            }
        ),
        'invokables'=> array(
            'session' => 'Core\View\Helper\Session',
        ),
    ),
);
