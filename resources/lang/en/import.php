<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Pagination Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used by the paginator library to build
    | the simple pagination links. You are free to change them to anything
    | you want to customize your views to better match your application.
    |
    */

    'error' => [
        'time-report' => [
            // 'daily-hour-max' => 'Row :ROW is not imported due to maximum daily hours (8 hours a day)',
            'daily-hour-max' => 'Row :ROW is not imported',

            'overbudget-bulk-edit' => 'Error happen, please contact developer'
        ]
    ],
    'success' => [
        'time-report' => 'Time report upload success without any intervention',
        'overbudget-bulk-edit' => 'Overbudget edit success without any intervention'
    ]
];
