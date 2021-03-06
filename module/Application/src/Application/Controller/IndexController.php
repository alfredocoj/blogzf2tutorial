<?php
namespace Application\Controller;

use Zend\View\Model\ViewModel;
use Core\Controller\ActionController;


/**
 * Controlador que gerencia os posts
 * 
 * @category Application
 * @package Controller
 */
class IndexController extends ActionController
{
    /**
     * Mostra os posts cadastrados
     * @return void
     */
    public function indexAction()
    {
        return new ViewModel(array(
            'posts' => $this->getTable('Application\Entity\Post')->fetchAll()->toArray()
        ));
    }
}