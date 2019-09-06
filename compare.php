<?php

use HydratorWorkshop\Benchmark;
use HydratorWorkshop\Comparer;
use HydratorWorkshop\Helper;
use HydratorWorkshop\HydratorTest;
use HydratorWorkshop\Profile;
use HydratorWorkshop\User;
use Zend\Hydrator\HydratorInterface;
use function Sauls\Component\Helper\define_object;

const ITERATIONS = 100000;
require 'vendor/autoload.php';

# DEFINE HYDRATABLE OBJECT

$profile = new Profile();
$profile->setName('Arnas Kazlauskas');
$profile->setEmail('iam@arn.as');
$profile->setCreatedAt(new DateTime());
$profile->setUpdatedAt(new DateTime());

$object = new User();
$data = [
    'id' => '11222',
    'username' => 'Prodiger',
    'acl' => ['can' => ['EDIT', 'CREATE'], 'cannot' => ['UPDATE', 'DELETE']],
    'profile' => $profile,
    'createdAt' => new DateTime('2018-05-16 12:22:34'),
    'updatedAt' => new DateTime('2019-09-06 14:00:00'),
];

# LOAD OCRAMIUS CONFIG

$config = new GeneratedHydrator\Configuration(get_class($object));
$hydratorClass = $config->createFactory()->getHydratorClass();

# DEFINE POSSIBLE HYDRATORS

$hydrators = array(
    'Ocramius' => new $hydratorClass(),
    'Zend Class Method' => new Zend\Hydrator\ClassMethods(),
    'Zend Reflection' => new Zend\Hydrator\Reflection(),
    'Zend Array Serializable' => new Zend\Hydrator\ArraySerializable(),
    'Sauls Define Object' => 'saulsHydration',
    'Manual Hydration' => 'manualHydration',
);

echo "Start hydrators test\n====================\n\n";

# RUN TESTS
$times = [];
$memories = [];

# Hydrators

foreach ($hydrators as $name => $hydrator) {
    printf("%s started...\n", $name);

    $callable = is_callable($hydrator) ? $hydrator : [HydratorTest::class, 'start'];

    ['memory' => $memory, 'time' => $time] = Benchmark::benchmarkMemory(
        $callable,
        [$object, $data, $hydrator],
        ITERATIONS
    );
    $memories[$name] = $memory;
    $times[$name] = $time;
    printf("%s done [%f ms]...\n", $name, $time);
}

echo "\n====================\nResults\n====================\n\n";

foreach($times as $name => $time) {
    [$memoryColor, $memoryDiff, $memoryPercentage] = Comparer::compare(min($memories), $memory = $memories[$name]);
    $memoryString = Helper::formatDiff($memoryDiff, $memoryPercentage, [Helper::class, 'formatBytes']);

    [$timeColor, $timeDiff, $timePercentage] = Comparer::compare(min($times), $time);
    $timeString = Helper::formatDiff($timeDiff, $timePercentage, static function (float $diff) {
        return sprintf('%.03f ms', $diff);
    });


    printf("%s hydrator\n", $name);
    printf("\e[%dmUsed %s of memory %s\e[0m\n", $memoryColor, Helper::formatBytes($memory), $memoryString);
    printf("\e[%dmIt took %s ms %s\e[0m\n", $timeColor, $time, $timeString);
    print("====================\n\n");
}

function saulsHydration ($object, $data, $hydrator) {
    $new_object = define_object($object, $data);
    assert($object instanceof User);
    $extracted = $object->getArrayCopy();
}

function manualHydration ($object, $data, $hydrator) {
    $profile = new User();
    $profile->setId($data['id']);
    $profile->setUsername($data['username']);
    $profile->setProfile($data['profile']);
    $profile->setAcl($data['acl']);
    $profile->setCreatedAt($data['createdAt']);
    $profile->setUpdatedAt($data['updatedAt']);

    [
        'id' => $profile->getId(),
        'username' => $profile->getUsername(),
        'profile' => $profile->getProfile(),
        'acl' => $profile->getAcl(),
        'createdAt' => $profile->getCreatedAt(),
        'updatedAt' => $profile->getUpdatedAt(),
    ];
}
