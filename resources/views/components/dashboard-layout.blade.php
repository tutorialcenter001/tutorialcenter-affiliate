@props(['title' => 'Dashboard'])

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
        }
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} | TC Affiliates</title>

    <script>
        tailwind.config = {
            darkMode: 'class'
        }
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="overflow-x-hidden bg-[#f2f2f2] text-gray-800 dark:bg-slate-950 dark:text-slate-100">

    <section class="min-h-screen bg-[#f2f2f2] dark:bg-slate-950">

        {{-- Mobile top navbar --}}
        <x-dashboard-mobile-navbar />

        <div class="min-h-screen lg:flex">
            {{-- Desktop sidebar --}}
            <x-dashboard-sidebar />

            {{-- Main content --}}
            <main class="min-w-0 w-full lg:ml-72">
                <div class="px-3 py-5 sm:px-6 lg:px-10 lg:py-8">
                    {{ $slot }}
                </div>
            </main>
        </div>

    </section>

</body>
</html>
