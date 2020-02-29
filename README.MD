# Tree file parser

## Installation

Just run:
`composer install`

## Testing

Just run:
`composer tests`

There is *PHPUnit*, *PHPStan*, *PHP-CS-FIX*

## Running parser

`bin/console parse [tree_path, [list_path [output_path]]]`

`tree_path` - path to tree.json file
`list_path` - path to list.json file
`output_path` - path to output file

If you run only `bin/console` operational directory will be `./resources` and outputed file will be in `./resources/output.json
`
