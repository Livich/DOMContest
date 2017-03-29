#DOM Parsers Contest
This project tests such popular PHP DOM parsers as DiDOM, Dimple HTML DOM and SimpleXML on www.marinareservation.com source.

_Setup:_
* Run setup.sh
* Open project using PHPStorm and run tests or run PHPUnit with custom configuration from `/DomContest/phpunit.xml`

## Current results

| Test           | DiDOM                  | SimpleHTMLDOM              | SimpleXML (_best!_)    |
|----------------|------------------------|----------------------------|------------------------|
| Selectors      | CSS                    | CSS                        | XPath                  |
| Long selectors | CSS                    | Fail                       | XPath                  |
| 1000 nodes     | 1.128935sec 0.298328MB | 2.802148sec 11.602192MB    | 0.818300sec 0.297824MB |
| 10000 nodes    | 1.029951sec 1.594304MB | 15.408526sec 135.579944MB  | 1.340651sec 1.593728MB |
| 20000 nodes    | 1.949763sec 3.074000MB | 39.761479sec 152.379952MB  | 1.329299sec 3.073824MB |
| 40000 nodes    | 3.919204sec 6.034240MB | 145.536089sec 304.646808MB | 2.262833sec 6.033600MB |