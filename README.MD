# Tree file parser

## Environment

*PHP 7.3*

*Composer*

## Installation

Just run:
`composer install`

## Testing

Just run:
`composer tests`

There is *PHPUnit*, *PHPStan*, *PHP-CS-FIX*

## Running parser

`bin/command parse [list_path, [tree_path [output_path]]]`

`tree_path` - path to tree.json file
`list_path` - path to list.json file
`output_path` - path to output file

If you run only `bin/command parse` operational directory will be `./resources` and output file will be in `./resources/output.json
`
