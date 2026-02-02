<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verifikasi Email - {{ config('app.name') }}</title>
    
    <!-- Tailwind CDN untuk styling cepat -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Figtree', sans-serif; }
        .bg-gradient-auth { 
            background: linear-gradient(135deg, #064e3b 0%, #0d9488 50%, #047857 100%); 
        }
    </style>
</head>
<body class="bg-gradient-auth min-h-screen">
    <div class="flex min-h-screen flex-col items-center pt-6 sm:justify-center sm:pt-0">
        <!-- Logo -->
        <div class="mt-6">
            <a href="/">
                <div class="h-20 w-20 mx-auto">
                    <!-- Logo SVG -->
                    <svg class="text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                </div>
            </a>
        </div>
        
        <!-- Back to Home -->
        <div class="mt-6 w-full px-4 sm:max-w-md">
            <a href="/" class="flex items-center gap-2 text-white hover:text-gray-200 transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
        
        <!-- Verification Card -->
        <div class="mt-3 w-full overflow-hidden bg-white px-6 py-8 shadow-lg sm:max-w-md sm:rounded-xl">
            <!-- Title -->
            <div class="mb-6 text-center">
                <h2 class="text-2xl font-bold text-gray-800">Verifikasi Email</h2>
                <p class="mt-2 text-sm text-gray-600">Akses dashboard membutuhkan verifikasi email</p>
            </div>
            
            <!-- Role Badge -->
            <div class="mb-6 rounded-lg bg-blue-50 p-4 border border-blue-100">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        {{-- <h3 class="text-sm font-medium text-blue-800">
                            Akun {{ Auth::user()->role ?? 'Moderator/Admin' }}
                        </h3> --}}
                        <p class="mt-1 text-sm text-blue-700">
                            Akun Anda telah dibuat. Verifikasi email untuk melanjutkan.
                        </p>
                    </div>
                </div>
            </div>
            
            <!-- Messages -->
            @if (session('resent'))
            <div class="mb-6 rounded-lg bg-green-50 p-4 border border-green-100">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-green-800">
                            Link verifikasi baru telah dikirim!
                        </p>
                    </div>
                </div>
            </div>
            @endif
            
            <!-- Instructions -->
            <div class="mb-8">
                <p class="text-gray-600 mb-3">
                    Kami telah mengirim email verifikasi ke:
                </p>
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <p class="font-medium text-gray-800">{{ Auth::user()->email }}</p>
                </div>
                <p class="mt-4 text-gray-600 text-sm">
                    Klik link verifikasi di email Anda. Jika tidak menerima email dalam beberapa menit, periksa folder spam atau kirim ulang.
                </p>
            </div>
            
            <!-- Actions -->
            <div class="space-y-4">
                <!-- Resend Button -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition">
                        Kirim Ulang Email Verifikasi
                    </button>
                </form>
                
                <!-- Divider -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-200"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-white text-gray-500">Atau</span>
                    </div>
                </div>
                
                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex justify-center py-2.5 px-4 border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 transition">
                        Login dengan Akun Lain
                    </button>
                </form>
            </div>
            
            <!-- Help Section -->
            <div class="mt-8 pt-6 border-t border-gray-200">
                <p class="text-xs text-gray-500 text-center">
                    Butuh bantuan? Hubungi Admin di
                    <a href="mailto:salocellaa@gmail.com" class="font-medium text-emerald-600 hover:text-emerald-500">salocellaa@gmail.com</a>
                  
                </p>
            </div>
        </div>
    </div>
</body>
</html>