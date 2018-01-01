<?php

declare(strict_types = 1);

namespace OopsTests\MorozkoDoctrineBridge;

use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\Common\Persistence\Mapping\ClassMetadataFactory;
use Doctrine\Common\Proxy\AbstractProxyFactory;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Proxy\ProxyFactory;
use Oops\MorozkoDoctrineBridge\DoctrineMetadataCacheWarmer;
use Tester\Environment;
use Tester\TestCase;


require_once __DIR__ . '/../bootstrap.php';


/**
 * @testCase
 */
final class DoctrineMetadataCacheWarmerTest extends TestCase
{

	public function testCacheWarmer(): void
	{
		$configuration = \Mockery::mock(Configuration::class);
		$configuration->shouldReceive('getProxyDir')->once()->andReturn(__DIR__ . '/proxies');
		$configuration->shouldReceive('getAutoGenerateProxyClasses')->once()->andReturn(AbstractProxyFactory::AUTOGENERATE_NEVER);

		$metadataFactory = \Mockery::mock(ClassMetadataFactory::class);
		$metadataFactory->shouldReceive('getAllMetadata')->once()->andReturn([42]);

		$proxyFactory = \Mockery::mock(ProxyFactory::class);
		$proxyFactory->shouldReceive('generateProxyClasses')->once()->with([42]);

		$manager = \Mockery::mock(EntityManager::class);
		$manager->shouldReceive('getConfiguration')->twice()->andReturn($configuration);
		$manager->shouldReceive('getMetadataFactory')->once()->andReturn($metadataFactory);
		$manager->shouldReceive('getProxyFactory')->once()->andReturn($proxyFactory);

		$registry = \Mockery::mock(ManagerRegistry::class);
		$registry->shouldReceive('getManagers')->once()->andReturn([$manager]);

		$cacheWarmer = new DoctrineMetadataCacheWarmer($registry);
		$cacheWarmer->warmup();

		Environment::$checkAssertions = FALSE;
		\Mockery::close();
	}

}


(new DoctrineMetadataCacheWarmerTest())->run();
