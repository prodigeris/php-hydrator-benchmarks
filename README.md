# Hydrator Benchmarks

This benchmark will run various [Zend hydrators](https://github.com/zendframework/zend-hydrator),
[Ocramius hydrator](https://github.com/Ocramius/GeneratedHydrator),
[Sauls hydrator](https://github.com/sauls/helpers/blob/master/src/object.php#L23)
and [manual hydration](https://github.com/prodigeris/php-hydrator-benchmarks/blob/master/compare.php#L96-L113).

Object being hydrated and extract is [User](https://github.com/prodigeris/php-hydrator-benchmarks/blob/master/compare.php#L15-L31).

`100 000 iterations`

## How to run benchmark

```
php compare.php
```

**Example output:**
```
Start hydrators test
====================

Ocramius started...
Ocramius done [0.145119 ms]...
Zend Class Method started...
Zend Class Method done [14.730479 ms]...
Zend Reflection started...
Zend Reflection done [0.689693 ms]...
Zend Array Serializable started...
Zend Array Serializable done [0.608677 ms]...
Sauls Define Object started...
Sauls Define Object done [0.327850 ms]...
Manual Hydration started...
Manual Hydration done [0.124333 ms]...

====================
Results
====================

Ocramius hydrator
Used 208B of memory (+56B 137%)
It took 0.14511919021606 ms (+0.021 ms 117%)
====================

Zend Class Method hydrator
Used 339.4KB of memory (+339.3KB 228,658%)
It took 14.730479001999 ms (+14.606 ms 11,848%)
====================

Zend Reflection hydrator
Used 68.3KB of memory (+68.1KB 46,005%)
It took 0.68969297409058 ms (+0.565 ms 555%)
====================

Zend Array Serializable hydrator
Used 152B of memory 
It took 0.60867714881897 ms (+0.484 ms 490%)
====================

Sauls Define Object hydrator
Used 8.3KB of memory (+8.1KB 5,568%)
It took 0.3278501033783 ms (+0.204 ms 264%)
====================

Manual Hydration hydrator
Used 152B of memory 
It took 0.12433314323425 ms 
====================
```
## Compare table

| Hydator | Memory Usage | Speed | Features | Preparation |
|---|---|---|---|---|
| Ocramius  | Low | High | Low | Low |
| Zend Class Method |  Very High | Low | [x] High | Low |
| Zend Reflection |  Medium | Medium | [x] High | [x] None |
| Zend Array Serializable |  Low | Medium | [x] High | Low |
| Zend Object Property |  Low | Medium | [x] High | Medium |
| Sauls Define Object |  Medium | Medium | None | [x] None |
| Manual Hydration |  [x] Very Low | [x] Very High | None | High |

## Verdict:

`Manual Hydration` - When you need high performance

`Ocramius` - When you need performance and comfort but don't need custom strategies or naming.

`Zend *` - When you need comfort and customizations

`Zend Class Method` - Probably never (need more tests)
