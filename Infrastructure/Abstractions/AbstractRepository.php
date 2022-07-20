<?php

namespace Infrastructure\Abstractions;

use Doctrine\DBAL\Connection as DoctrineConnection;
use Infrastructure\Interfaces\RepositoryInterface;
use RuntimeException;
use ReflectionClass;

abstract class AbstractRepository implements RepositoryInterface
{
    protected string $entity = '';

    private ?string $entityOverride = null;

    public function __construct(
        protected DoctrineConnection $connection
    ) {
    }

    public function hydrate(
        array $data = [],
        ?string $entityOverride = null,
    ): mixed {
        if (empty($data) === true) {
            throw new RuntimeException('No data to hydrate');
        }

        if (empty($entityOverride) === false) {
            $this->entityOverride = $entityOverride;
        }

        if (isset($data[0]) === true) {
            // probably multiple rows have been given
            // maybe just 1 in that format
            return $this->hydrateMultipleRows($data);
        } else {
            // Most likley just 1 row
            return $this->hydrateSingleRow($data);
        }
    }

    private function hydrateMultipleRows(array $rows): array
    {
        $entities = [];

        foreach ($rows as $row) {
            $entities[] = $this->hydrateSingleRow($row);
        }

        return $entities;
    }

    private function hydrateSingleRow(array $row): ?AbstractEntity
    {
        if (
            empty($this->entity) === true
            && empty($this->entityOverride) === true
        ) {
            throw new RuntimeException('Entity not set in repository, and no override specified');
        }

        if (empty($this->entityOverride) === false) {
            $class = $this->entityOverride;
        } else {
            $class = $this->entity;
        }

        $properties = [];
        foreach ($row as $key => $val) {
            $shouldAddProperty = false;
            if (str_contains($key, $class::ALIAS . '.') === true) {
                $key = str_replace($class::ALIAS . '.', '', $key);
                $shouldAddProperty = true;
            }

            if (str_contains($key, '.') === false) {
                $shouldAddProperty = true;
            }

            if ($shouldAddProperty === true) {
                $camelCasePropertyName = $this->toCamelCase($key);
                $properties[$camelCasePropertyName] = $val;
            }
        }

        if (empty($properties) === true) {
            return null;
        }

        $hydratedObject = new $class($properties);

        $reflectionClass = new ReflectionClass($class);
        $properties = $reflectionClass->getProperties();

        foreach($properties as $property) {
            $propertyType = $property->getType()->getName();
            if (str_contains($propertyType, 'Database\\Entities')) {
                // This is an entity inside the entity we should probably hydrate that
                $propertyName = $property->getName();
                $hydratedObject->$propertyName = $this->hydrate($row, $propertyType);
            }
        }

        return $hydratedObject;
    }

    protected function toCamelCase(string $val): string
    {
        $val = str_replace('_', ' ', $val);
        $val = ucwords($val);
        $val = str_replace(' ', '', $val);
        $val = lcfirst($val);

        return $val;
    }

    protected function toSnakeCase(string $val): string
    {
        return strtolower(preg_replace('/([A-Z])/', '_$1', $val));
    }

    protected function buildSelectFromEntities(
        array $entities = []
    ): string {
        if (empty($entities) === true) {
            throw new RuntimeException('Unable to build select, no entities defined');
        }

        $columns = [];
        foreach ($entities as $entity => $alias) {
            $columns = array_merge(
                $columns,
                $this->convertEntityVariableNamesToDatabaseColumnNames($entity, $alias),
            );
        }

        array_walk($columns, function (&$val, $key) {
            $val = $key . ' AS ' . $val;
        });

        return implode(",\n", $columns);
    }

    private function convertEntityVariableNamesToDatabaseColumnNames(
        string $entity,
        ?string $tableAlias = null
    ): array {
        $columnAliasPairs = [];

        $entityVars = get_class_vars($entity);

        $reflectionClass = new ReflectionClass($entity);
        $properties = $reflectionClass->getProperties();

        foreach($properties as $property) {
            if (str_contains($property->getType()->getName(), 'Database\\Entities')) {
                unset($entityVars[$property->getName()]);
            }
        }

        foreach ($entityVars as $var => $val) {
            $alias = '';

            if ($tableAlias !== null) {
                $alias .= $tableAlias . '.';
            }

            $column = $this->toSnakeCase($var);
            $alias .= $column;

            $columnAliasPairs[$alias] = "'" . $alias . "'";
        }

        return $columnAliasPairs;
    }
}