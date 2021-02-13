<?php

return [
    'default_collection' => null,

    'collections' => [
        'posts' => [
            'path_parser' => Spatie\Sheets\PathParsers\SlugWithDateParser::class,
        ]

        /* An example collection. All keys are optional.
        'posts' => [
            'disk' => 'posts',
            'sheet_class' => App\Post::class,
            'path_parser' => Spatie\Sheets\PathParsers\SlugWithDateParser::class,
            'content_parser' => Spatie\Sheets\ContentParsers\MarkdownParser::class,
            'extension' => 'txt',
        ], */
    ],
];
