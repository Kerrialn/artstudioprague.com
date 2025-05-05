<?php

declare(strict_types=1);

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $containerConfigurator->extension('vich_uploader', [
        'db_driver'           => 'orm',
        'storage'             => 'file_system',
        'mappings'            => [
            'artwork_images' => [
                'uri_prefix'         => '/uploads/artwork',
                'upload_destination' => '%kernel.project_dir%/public/uploads/artwork',
                'namer'              => 'vich_uploader.namer_uniqid',
                'delete_on_remove'   => true,
                'delete_on_update'   => true,
            ],
        ],
    ]);
};
