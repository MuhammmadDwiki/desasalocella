<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .email-container {
            background-color: #ffffff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 30px;
        }
        .email-header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 2px solid #4f46e5;
            margin-bottom: 25px;
        }
        .email-title {
            color: #4f46e5;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }
        .email-body {
            font-size: 16px;
            color: #555;
        }
        .action-button {
            display: inline-block;
            background-color: #4f46e5;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
            font-size: 14px;
            color: #888;
            text-align: center;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #4f46e5;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .credentials {
            background-color: #f0f9ff;
            border: 1px dashed #4f46e5;
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1 class="email-title">{{ config('app.name') }}</h1>
        </div>

        <div class="email-body">
            @if(isset($greeting))
                <h2>{{ $greeting }}</h2>
            @endif

            {!! nl2br(e($body)) !!}

            @if(isset($credentials))
                <div class="credentials">
                    <h3>Detail Akun:</h3>
                    <p><strong>Email:</strong> {{ $credentials['email'] ?? '' }}</p>
                    <p><strong>Password:</strong> {{ $credentials['password'] ?? '' }}</p>
                </div>
            @endif

            @if($actionUrl && $actionText)
                <div style="text-align: center; margin: 25px 0;">
                    <a href="{{ $actionUrl }}" class="action-button">
                        {{ $actionText }}
                    </a>
                </div>
            @endif

            @if(isset($additionalInfo))
                <div class="info-box">
                    <strong>Informasi Penting:</strong>
                    <p>{{ $additionalInfo }}</p>
                </div>
            @endif

            @if(isset($steps))
                <ol style="padding-left: 20px;">
                    @foreach($steps as $step)
                        <li>{{ $step }}</li>
                    @endforeach
                </ol>
            @endif
        </div>

        <div class="footer">
            <p>Email ini dikirim secara otomatis oleh sistem {{ config('app.name') }}.</p>
            <p>Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini.</p>
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>