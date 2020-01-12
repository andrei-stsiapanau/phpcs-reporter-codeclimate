# phpcs-reporter-codeclimate
CodeClimate reporter for the PHP CodeSniffer

## Usage example

`.phpcs.xml`

```XML
<?xml version="1.0"?>
<ruleset namespace="PHP_CodeSniffer\Reports">
    <arg name="report" value="\PHP_CodeSniffer\Reports\Codeclimate"/>
    <autoload>vendor/autoload.php</autoload>
</ruleset>
```

Command-line interface

```BASH
phpcs \
    --bootstrap=vendor/autoload.php \
    --report="PHP_CodeSniffer\Reports\Codeclimate"
```
