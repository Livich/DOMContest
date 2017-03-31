# DOM Parsers Contest

This project tests such popular PHP DOM parsers as DiDOM, Dimple HTML DOM and SimpleXML on www.marinareservation.com source.

_Setup:_
* Run setup.sh
* Run `phpunit -c ./src/phpunit.xml ./src/DomContest/` or open project using PHPStorm and run tests via GUI.

## Current results

### Time (sec.)

| Scale      | DiDOM   | PHP HTML Parser | Simple HTML DOM | SimpleXML |
|------------|---------|-----------------|-----------------|-----------|
| 500 nodes  | 0.02144 | 2.40697         | 0.45252         | 0.01697   |
| 1000 nodes | 0.05093 | 3.66189         | 0.79714         | 0.04049   |
| 1500 nodes | 0.06057 | 5.957           | 1.05962         | 0.03538   |
| 2000 nodes | 0.08255 | 8.12164         | 1.4789          | 0.06436   |

### Memory (MB)

| Scale      | DiDOM   | PHP HTML Parser | Simple HTML DOM | SimpleXML |
|------------|---------|-----------------|-----------------|-----------|
| 500 nodes  | 0.00268 | 10.3027         | 10.53535        | 0.00214   |
| 1000 nodes | 0.00234 | 17.69182        | 17.60194        | 0.00206   |
| 1500 nodes | 0.00234 | 25.62503        | 24.56158        | 0.00206   |
| 2000 nodes | 0.00234 | 30.36336        | 31.67052        | 0.00207   |