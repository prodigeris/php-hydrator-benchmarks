# Hydrator Test

| Hydator | Memory Usage | Speed | Features | Preparation |
|---|---|---|---|---|
| Ocramius  | Low | High | Low | Low |
| Zend Class Method |  Very High | Low | [x] High | Low |
| Zend Reflection |  Medium | Medium | [x] High | [x] None |
| Zend Array Serializable |  Low | Medium | [x] High | Low |
| Zend Object Property |  Low | Medium | [x] High | Medium |
| Sauls Define Object |  Medium | Medium | None | [x] None |
| Manual Hydration |  [x] Very Low | [x] Very High | None | High |

-----

Verdict:

`Manual Hydration` - When you need high performance

`Ocramius` - When you need performance and comfort but don't need custom strategies or naming.

`Zend *` - When you need comfort and customizations

`Zend Class Method` - Probably never (need more tests)
