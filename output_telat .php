<?php
include_once('Hitungterlambat.php'); 

$jadwal=[
    'cm'=>'07:30',
    'cp'=>'16:00'
];
$telat=[
    [
        'm' => '08:00',
        'p' => '16:00'
    ],
    [
        'm' => '09:52',
        'p' => '07:00'
    ],[
        'm' => '07:30',
        'p' => '07:00'
    ]
];

$jam=new Hitungterlambat();

echo $jam->Hitung($telat,$jadwal);

echo ' ' .date('Y-m-d H:i', 8400);