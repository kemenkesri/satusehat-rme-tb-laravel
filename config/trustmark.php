<?php

return [
	// 'auth' => [
	// 	'dev' => [
	// 		'cons_id' => env('CONS_ID_TM_DEV', '21095'),
	// 		'secret_key' => env('SECRET_KEY_TM_DEV', 'rsud6778ws122mjkrt'),
	// 		'user_key' => [
	// 			'vclaim' => env('USER_KEY_VCLAIM_DEV', '21f330a3e8e9f281d845f6b545b23653'),
	// 			'jkn' => env('USER_KEY_JKN_DEV', '376f7794517ebe56d181d2c4e10350ae'),
	// 		],
	// 	],
	// 	'prod' => [
	// 		'cons_id' => env('CONS_ID_TM_PROD', '21095'),
	// 		'secret_key' => env('SECRET_KEY_TM_PROD', 'rsud6778ws122mjkrt'),
	// 		'user_key' => [
	// 			'vclaim' => env('USER_KEY_VCLAIM_PROD', '2079632035f01e757d81a8565b074768'),
	// 			'jkn' => env('USER_KEY_JKN_PROD', 'fabd7537231aab53b70947264c65c3e2'),
	// 		],
	// 	],
	// ],
	'host' => [
		'jkn' => [
			'dev' => env('HOST_JKN_DEV', 'https://apijkn-dev.bpjs-kesehatan.go.id/'),
			'prod' => env('HOST_JKN_PROD', 'https://apijkn.bpjs-kesehatan.go.id/')
		]
	],
	'service_name' => [
		'antrean_fktp' => [
			'dev' => env('SN_ANTREAN_FKTP_DEV','antreanfktp_dev/'),
			'prod' => env('SN_ANTREAN_FKTP_PROD','antreanrs/'),
		],
		'antrean_rs' => [
			'dev' => env('SN_ANTREAN_RS_DEV','antreanrs_dev/'),
			'prod' => env('SN_ANTREAN_RS_PROD','antreanrs/'),
		],
		'vclaim' => [
			'dev' => env('SN_VCLAIM_DEV','vclaim-rest-dev/'),
			'prod' => env('SN_VCLAIM_PROD','vclaim-rest/'),
		],
	],
];