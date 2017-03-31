# DOM Parsers Contest

This project tests such popular PHP DOM parsers as DiDOM, Dimple HTML DOM and SimpleXML on www.marinareservation.com source.

_Setup:_
* Run setup.sh
* Run `phpunit -c ./src/phpunit.xml ./src/DomContest/` or open project using PHPStorm and run tests via GUI.

## Current results

| Test           | DiDOM                          | SimpleHTMLDOM                      | SimpleXML (_best!_)            | PHP HTML Parser                    |
|----------------|--------------------------------|------------------------------------|--------------------------------|------------------------------------|
| Selectors      | CSS                            | CSS                                | XPath                          | CSS                                |
| Long selectors | CSS                            | Fail                               | XPath                          | Fail                               |
| 1000 nodes     | T: 1.348175sec., M: 0.298224MB | T: 2.511415sec., M: 10.808328MB    | T:1.009444sec., M: 0.297656MB  | T: 4.978288sec., M: 15.615152MB    |
| 10000 nodes    | T: 3.237641sec., M: 1.594040MB | T: 14.678734sec., M: 128.732224MB  | T: 2.046191sec., M: 1.593456MB | T: 50.329930sec., M: 142.173952MB  |
| 20000 nodes    | T: 2.469948sec., M: 3.073968MB | T: 39.609852sec., M: 144.390440MB  | T: 1.936410sec., M: 3.073656MB | T: 124.709549sec., M: 161.315248MB |
| 40000 nodes    | T: 3.135210sec., M: 6.033848MB | T: 123.322051sec., M: 288.858520MB | T: 3.185896sec., M: 6.033520MB | T: 356.978273sec., M: 322.467336MB |