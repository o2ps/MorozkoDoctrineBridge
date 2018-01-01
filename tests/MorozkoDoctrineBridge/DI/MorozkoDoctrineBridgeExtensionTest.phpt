<?php

declare(strict_types = 1);

namespace OopsTests\MorozkoDoctrineBridge\DI;

use Nette\Configurator;
use Nette\DI\Container;
use Oops\MorozkoDoctrineBridge\DoctrineMetadataCacheWarmer;
use Tester\Assert;
use Tester\TestCase;


require_once __DIR__ . '/../../bootstrap.php';


/**
 * @testCase
 */
final class MorozkoDoctrineBridgeExtensionTest extends TestCase
{

	public function testExtension(): void
	{
		$container = $this->createContainer('default');

		/** @var DoctrineMetadataCacheWarmer $doctrineWarmer */
		$doctrineWarmer = $container->getByType(DoctrineMetadataCacheWarmer::class);
		Assert::notSame(NULL, $doctrineWarmer);

		$cacheWarmers = $container->getService('morozko.configuration')->getCacheWarmers();
		Assert::contains($doctrineWarmer, $cacheWarmers);
	}


	private function createContainer(string $configFile): Container
	{
		$configurator = new Configurator();
		$configurator->setTempDirectory(\TEMP_DIR);
		$configurator->addConfig(__DIR__ . '/fixtures/' . $configFile . '.neon');
		$configurator->addParameters([
			'appDir' => __DIR__ . '/..',
		]);

		return $configurator->createContainer();
	}

}


(new MorozkoDoctrineBridgeExtensionTest())->run();
