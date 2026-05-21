<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Filkom Shop - Account')</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Material Style Custom Floating Label CSS -->
    <style>
        body {
            font-family: 'Instrument Sans', 'Roboto', sans-serif;
            background-color: #f8f9fa;
        }
        
        .google-card {
            background: #ffffff;
            border: 1px solid #dadce0;
            border-radius: 8px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @media (max-width: 640px) {
            .google-card {
                border: none;
                background: transparent;
            }
        }

        .google-input-group {
            position: relative;
            margin-bottom: 20px;
            width: 100%;
        }

        .google-input {
            width: 100%;
            padding: 14px 16px;
            font-size: 15px;
            border: 1px solid #dadce0;
            border-radius: 4px;
            outline: none;
            background: transparent;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
            color: #202124;
        }

        .google-input:focus {
            border-color: #1a73e8;
            box-shadow: 0 0 0 1px #1a73e8;
        }

        .google-label {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: #ffffff;
            padding: 0 6px;
            color: #5f6368;
            transition: 0.15s cubic-bezier(0.4, 0, 0.2, 1) all;
            pointer-events: none;
            font-size: 15px;
        }

        /* Float the label up on focus or when placeholder is NOT shown (value exists) */
        .google-input:focus ~ .google-label,
        .google-input:not(:placeholder-shown) ~ .google-label {
            top: 0;
            font-size: 12px;
            color: #1a73e8;
            font-weight: 500;
        }

        .google-input:not(:focus):not(:placeholder-shown) ~ .google-label {
            color: #5f6368;
        }

        /* Error States */
        .google-input.is-invalid {
            border-color: #d93025;
        }

        .google-input.is-invalid:focus {
            box-shadow: 0 0 0 1px #d93025;
        }

        .google-input.is-invalid ~ .google-label {
            color: #d93025;
        }

        /* Premium Google button */
        .google-btn-primary {
            background-color: #1a73e8;
            color: #ffffff;
            font-weight: 500;
            padding: 10px 24px;
            border-radius: 4px;
            transition: background-color 0.15s, box-shadow 0.15s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .google-btn-primary:hover {
            background-color: #1557b0;
            box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3), 0 1px 3px 1px rgba(60,64,67,0.15);
        }

        .google-btn-primary:active {
            background-color: #1b4b8f;
            box-shadow: 0 1px 2px 0 rgba(60,64,67,0.3);
        }

        .google-btn-text {
            color: #1a73e8;
            font-weight: 500;
            transition: color 0.15s, background-color 0.15s;
            padding: 9px 12px;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .google-btn-text:hover {
            color: #1557b0;
            background-color: rgba(26, 115, 232, 0.04);
        }

        /* Google Segment Selector */
        .google-segment-btn {
            border: 1px solid #dadce0;
            background-color: #ffffff;
            transition: all 0.2s ease;
        }
        
        .google-segment-btn.active {
            border-color: #1a73e8;
            background-color: rgba(26, 115, 232, 0.05);
            color: #1a73e8;
            font-weight: 500;
            box-shadow: 0 0 0 1px #1a73e8;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center py-10 px-4 md:px-0">
    @yield('content')
</body>
</html>
