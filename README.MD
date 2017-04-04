# DOM Parsers Contest

This project tests such popular PHP DOM parsers as DiDOM, Dimple HTML DOM and SimpleXML on www.marinareservation.com source.

_Setup:_
* Run setup.sh
* Run `phpunit -c ./src/phpunit.xml ./src/DomContest/` or open project using PHPStorm and run tests via GUI.

## Current results

### Time (sec)

|Scale|DiDOM|PHP HTML Parser|QueryPath|Simple HTML DOM|SimpleXML|
|-----|-----|---------------|---------|---------------|---------|
|500 nodes|0.01847|2.2141|3.10106|0.43163|0.0128|
|1000 nodes|0.0352|3.76075|5.29447|0.81073|0.02508|
|1500 nodes|0.04571|5.48968|7.48724|1.08703|0.03597|
|2000 nodes|0.06175|7.22856|9.91832|1.36391|0.04366|

### Memory (MB)

|Scale|DiDOM|PHP HTML Parser|QueryPath|Simple HTML DOM|SimpleXML|
|-----|-----|---------------|---------|---------------|---------|
|500 nodes|0.00268|10.30258|0.00431|10.53497|0.00234|
|1000 nodes|0.00234|17.69135|0.00362|17.58523|0.00205|
|1500 nodes|0.00234|25.62506|0.00362|24.56098|0.00206|
|2000 nodes|0.00234|30.3613|0.00362|31.65607|0.00204|