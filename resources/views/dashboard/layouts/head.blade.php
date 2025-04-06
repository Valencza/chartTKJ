<!DOCTYPE html>
<html lang="en">

<head>
    <title>ChartTKJ - Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{route ('dashboard') }}" />
    <link rel="shortcut icon" href="{{asset ('assets/admin/media/logo icon.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <link href="{{asset ('assets/admin/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('assets/admin/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('assets/admin/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset ('assets/admin/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{asset ('assets/admin/css/dasboard-custom.css') }}">

    <!-- Dropify CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

    <!-- CKeditor 5 -->
    <link rel="stylesheet" href="{{asset ('assets/admin/plugins/ckeditor5/ckeditor5.css') }}">

    <!-- link font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

</head>

<style>
    .chart-container {
        overflow-x: auto;
        width: 100%;
    }

    canvas {
        min-width: 600px;
        max-height: 300px;
    }

    @media (max-width: 480px) {
        canvas {
            height: 300px !important;
        }
    }

    @media (max-width: 420px) {
        .filter-container {
            flex-direction: column;
        }

        #customDate,
        #customDateServis,
        #customDateJasa {
            width: 100%;
            margin-left: 0;
            margin-top: 10px;
        }
    }
</style>