<!DOCTYPE html>
<html lang="en">
<head>
    <script>
        const savedTheme = localStorage.getItem('theme');

        if (
            savedTheme === 'dark' ||
            (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)
        ) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'TC Affiliates' }} | TC Affiliates</title>

    <script>
        tailwind = {
            config: {
                darkMode: 'class'
            }
        }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#f2f2f2] text-gray-800 dark:bg-slate-950 dark:text-slate-100">

    @include('components.header', ['title' => $title ?? 'TC Affiliates'])

    <main>
        @yield('content')
    </main>

    @include('components.footer')

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('themeToggle');

            if (toggle) {
                toggle.addEventListener('click', function () {
                    const html = document.documentElement;
                    const isDark = html.classList.toggle('dark');

                    localStorage.setItem('theme', isDark ? 'dark' : 'light');
                });
            }

            const mobileButton = document.getElementById('mobileMenuButton');
            const mobileMenu = document.getElementById('mobileMenu');

            if (mobileButton && mobileMenu) {
                mobileButton.addEventListener('click', function () {
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>