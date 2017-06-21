<?php
namespace Application\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Application\Controller\RegistrationController;


class RegistrationControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container,
                             $requestedName, array $options = null)
    {
        $sessionContainer = $container->get('UserRegistration');

        // Instantiate the controller and inject dependencies
        return new RegistrationController($sessionContainer);
    }
}
