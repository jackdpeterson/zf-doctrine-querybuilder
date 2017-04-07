<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2016 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace jackdpetersonTest\Doctrine\QueryBuilder\Query\Provider;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\ServiceLocatorInterface;
use jackdpeterson\Doctrine\QueryBuilder\Query\Provider\DefaultOrm;
use jackdpeterson\Doctrine\QueryBuilder\Query\Provider\DefaultOrmFactory;

class DefaultOrmFactoryTest extends TestCase
{
    public function testInvokableFactoryReturnsDefaultOrmQueryProvider()
    {
        $serviceLocator = $this->prophesize(ServiceLocatorInterface::class)->reveal();

        $factory = new DefaultOrmFactory();
        $provider = $factory($serviceLocator);

        $this->assertInstanceOf(DefaultOrm::class, $provider);
        $this->assertAttributeSame($serviceLocator, 'serviceLocator', $provider);
    }

    public function testInvokableFactoryReturnsDefaultOrmQueryProviderWhenCreatedViaAbstractPluginManager()
    {
        $serviceLocator = $this->prophesize(ServiceLocatorInterface::class)->reveal();
        $abstractPluginManager = $this->prophesize(AbstractPluginManager::class);
        $abstractPluginManager->getServiceLocator()->willReturn($serviceLocator);

        $factory = new DefaultOrmFactory();
        $provider = $factory($abstractPluginManager->reveal());

        $this->assertInstanceOf(DefaultOrm::class, $provider);
        $this->assertAttributeSame($serviceLocator, 'serviceLocator', $provider);
    }
}
