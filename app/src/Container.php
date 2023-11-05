<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\ContainerException;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionNamedType;
use ReflectionParameter;
use ReflectionUnionType;

class Container implements ContainerInterface
{
    private array $entries = [];
    
	/**
	 * Finds an entry of the container by its identifier and returns it.
	 *
	 * @param string $id Identifier of the entry to look for.
	 * @return mixed Entry.
	 */
	public function get(string $id) 
    {
        if ($this->has($id)) {
			$entry = $this->entries[$id];

			if (is_callable($entry)) {
				return $entry($this);
			}

			$id = $entry;
        }

		return $this->resolve($id);
	}

	/**
	 * Returns true if the container can return an entry for the given identifier.
	 * Returns false otherwise.
	 *
	 * `has($id)` returning true does not mean that `get($id)` will not throw an exception.
	 * It does however mean that `get($id)` will not throw a `NotFoundExceptionInterface`.
	 *
	 * @param string $id Identifier of the entry to look for.
	 * @return bool
	 */
	public function has(string $id): bool
    {
        return isset($this->entries[$id]);
    }

    public function set(string $id, callable|string $concrete): void
    {
        $this->entries[$id] = $concrete;
    }

	public function resolve(string $id)
	{
		$reflectionClass = new ReflectionClass($id);
		if (!$reflectionClass->isInstantiable()) {
			throw new ContainerException("Class '$id' is not instantiable");
		}

		$constructor = $reflectionClass->getConstructor();
		if (is_null($constructor)) {
			return new $id;	
		}

		$parameters = $constructor->getParameters();
		if (is_null($parameters)) {
			return new $id;
        }

		$dependencies = array_map(function (ReflectionParameter $param) use ($id) {
			$name = $param->getName();
			$type = $param->getType();

			if (is_null($type)) {
				throw new ContainerException("Failed to resolve class '$id' because parameter '$name' is missing type hint.");
			}

			if ($type instanceof ReflectionUnionType) {
				throw new ContainerException("Failed to resolve class '$id' because of union type for parameter '$name'.");
			}

			if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
				return $this->get($type->getName());
			}

			throw new ContainerException("Failed to resolve class '$id' because of invalid parameter '$name'.");

		}, $parameters);

		return $reflectionClass->newInstanceArgs($dependencies);
	}
}