<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. A "local" driver, as well as a variety of cloud
    | based drivers are available for your choosing. Just store away!
    |
    | Supported: "local", "ftp", "s3", "rackspace"
    |
    */

    'default' => 'local',

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => 's3',

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'visibility' => 'public',
        ],

        'avatar_uploads' => [
            'driver' => 'local',
            'root' => storage_path('uploads/avatars'),
            'visibility' => 'public',
        ],

        'new_task_upload' => [
            'driver' => 'local',
            'root' => storage_path('uploads/new_tasks'),
            'visibility' => 'public',
        ],

        'task_solution_upload' => [
            'driver' => 'local',
            'root' => storage_path('uploads/solved_tasks'),
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => 'AKIAIHHKKFUDDAUDVY5A',
            'secret' => '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',
            'region' => 'us-east-1',
            'bucket' => 'kbk300test',
        ],

    ],

];
