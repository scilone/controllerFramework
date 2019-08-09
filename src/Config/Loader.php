<?php

namespace App\Config;

class Loader
{
    const SERVICES = [
        Service::CONTROLLER_TEST => [
            Service::APPLICATION_TWIG,
            Param::HELLO_WORLD,
        ],
    ];

    const NO_LAZY_LOADING = [
        Service::CONTROLLER_TEST
    ];

    /**
     * @var array
     */
    private static $services = [];

    /**
     * @param string $fqcn
     *
     * @throws \ReflectionException
     * @return object
     */
    public static function getService(string $fqcn)
    {
        if (isset(self::$services[$fqcn])) {
            return self::$services[$fqcn];
        }

        if (class_exists($fqcn) === false) {
            return null;
        }

        $objectReflection = new \ReflectionClass($fqcn);

        $args = [];

        if (isset(self::SERVICES[$fqcn])) {
            foreach (self::SERVICES[$fqcn] as $key => $argument) {
                if (class_exists($argument) === true) {
                    $args[$key] = self::initClass($argument);
                } else {
                    $args[$key] = $argument;
                }
            }
        }

        if (in_array($fqcn, self::NO_LAZY_LOADING) === false) {
            self::$services[$fqcn] = $objectReflection->newInstanceArgs($args);

            return self::$services[$fqcn];
        }

        return $objectReflection->newInstanceArgs($args);
    }

    /**
     * @param $class
     *
     * @throws \ReflectionException
     * @return object
     */
    private static function initClass($class)
    {
        $class = (string) $class;
        $args = [];

        if (isset(self::SERVICES[$class])) {
            foreach (self::SERVICES[$class] as $key => $argument) {
                if (class_exists($argument) === true) {
                    $args[$key] = self::initClass($argument);
                } else {
                    $args[$key] = $argument;
                }
            }
        }

        $objectReflection = new \ReflectionClass((string) $class);

        return $objectReflection->newInstanceArgs($args);
    }
}
