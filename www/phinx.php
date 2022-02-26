    <?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'sqlite',
            'name' => './db',
            'suffix' => 'sqlite',
        ],
        'development' => [
            'adapter' => 'sqlite',
            'name' => './db',
            'suffix' => 'sqlite',
        ],
        'testing' => [
            'adapter' => 'sqlite',
            'name' => './db',
            'suffix' => 'sqlite',
        ]
    ],
    'version_order' => 'creation'
];
