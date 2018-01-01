<?php

declare(strict_types = 1);

namespace Oops\MorozkoDoctrineBridge\DI;

use Nette\DI\CompilerExtension;
use Oops\MorozkoDoctrineBridge\DoctrineMetadataCacheWarmer;


final class MorozkoDoctrineBridgeExtension extends CompilerExtension
{

	public function loadConfiguration()
	{
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('warmer'))
			->setType(DoctrineMetadataCacheWarmer::class)
			->setFactory(DoctrineMetadataCacheWarmer::class);
	}

}
