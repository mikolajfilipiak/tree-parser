<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . '/tests',
        __DIR__ . '/src',
    ]);

return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setCacheFile(__DIR__.'.php_cs.cache')
    ->setRules([
        '@PSR2' => true,
        'psr4' => true,
        'class_attributes_separation' => ['elements' => ['const', 'method', 'property']],
        'strict_param' => true,
        'array_syntax' => ['syntax' => 'short'],
        'blank_line_before_statement' => true,
        'trailing_comma_in_multiline_array' => true,
        'ordered_imports' => true,
        'return_type_declaration' => ['space_before' => 'one'],
        'declare_strict_types' => true,
        'blank_line_after_opening_tag' => true,
        'no_unused_imports' => true,
        'php_unit_test_case_static_method_calls' => ['call_type' => 'this'],
        'whitespace_after_comma_in_array' => true,
        'no_whitespace_before_comma_in_array' => true
    ])
    ->setFinder($finder);