@props([
    'title'
])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo asset('css/common.css')?>" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/fontawesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="app-grid">
    <header class="header">
        <nav>
            <ul>
            @auth
                @can('admin-tags')
                    <li class="nav-item">
                        <a href="{{ route('tags.index') }}" class="nav-link link-dark">Теги</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" class="nav-link link-dark">Блог</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('videos.index') }}" class="nav-link link-dark">Видео</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('posts.create') }}" class="nav-link link-dark">Добавить пост</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('videos.create') }}" class="nav-link link-dark">Добавить видео</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('profile.password.edit') }}" class="nav-link link-dark">Смена пароля</a>
                </li>
                
                @if (auth()->user()->roles()->where('name', 'admin')->exists())
                    <li class="nav-item">
                        <a href="{{ route('address.form') }}" class="nav-link link-dark">Анализ адреса</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link link-dark">Пользователи</a>
                    </li>
                @endif
                @else
                    <li class="nav-item">
                        <a href="{{ '/' }}" class="nav-link link-dark">Блог</a>
                    </li>
                @endif
                <li class="nav-item">
                    @auth
                        <a href="{{ route('login.exit') }}" class="fancy-button pop-onhover bg-gradient3"><span>Logout</span></a>
                    @else
                        <a href="{{ route('login') }}" class="fancy-button pop-onhover bg-gradient3"><span>Login</span></a>
                    @endif
                </li>
            </ul>
        </nav>
    </header>
    <div class="container">
        <main class="main">
            @auth
                @if(!auth()->user()->email_verified_at)
                    <div class="alert alert-danger">Подтверди почту!!!!</div>
                @endif  
            @endif
            <x-notifications />
            {{ $slot }}
        </main>
    </div>
</body>
</html>