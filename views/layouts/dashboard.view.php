<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        const breakpoints = {
            sm: 640,
            md: 768,
            lg: 1024,
            xl: 1280,
            '2xl': 1536
        }
    </script>
    <?php if (!empty($apis)): ?>
        <?php foreach ($apis AS $api): ?>
            <script src="<?php echo $api; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php if (!empty($scripts)): ?>
        <?php foreach ($scripts AS $script): ?>
            <script src="scripts/<?php echo rawurlencode($script); ?>" defer></script>
        <?php endforeach; ?>
    <?php endif; ?>
    <link rel="stylesheet" href="styles/timetable.css">
    <title>Academic Scheduler</title>
</head>
<body class="flex flex-col justify-around h-screen">
    <nav class="fixed w-full z-50 top-0 left-0 bg-white">
        <div class="flex justify-between items-center px-8 py-4 text-md border-b border-gray-200">
            <a href="dashboard.php" class="flex items-center">
                <img src="assets/images/logo.png" class="h-7 inline-block" alt="Academic planner logo">
                <span class="font-semibold">Academic Planner</span>
            </a>
            <button id="hamburger-btn" class="hover:text-blue-700 hover:border-blue-700 hover:cursor-pointer focus:ring-4 focus:outline-none focus:ring-blue-300 rounded md:hidden">
                <svg id="hamburger-open-icon" class="w-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
                <svg id="hamburger-close-icon" class="w-7 hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
            <button id="dropdown-btn" class="hover:text-blue-700 hover:border-blue-700 hover:cursor-pointer hidden md:block font-medium">
                <span><?php echo e($username); ?></span>
                <svg class="w-4 inline-block" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>
        </div>
        <div id="hamburger-menu" class="hidden md:hidden shadow-sm bg-gray-50">
            <ul class="text-gray-800 flex flex-col justify-center items-stretch text-center text-lg font-medium border-b border-gray-200 p-4">
                <?php foreach ($pageNames AS $pageName): ?>
                    <li>
                        <a class="py-2 hover:bg-gray-100 rounded block" href="<?php echo rawurlencode($pageName . '.php'); ?>"><?php echo e(ucfirst($pageName)); ?></a>
                    </li>
                <?php endforeach; ?>
                <li>
                    <a class="py-2 hover:bg-gray-100 rounded block" href="profile.php">Profile</a>
                </li>
                <li>
                    <a class="text-red-500 py-2 hover:bg-gray-100 rounded block" href="logout.php">Sign Out</a>
                </li>
            </ul>
        </div>
        <div id="dropdown-menu" class="hidden bg-gray-50 shadow-sm w-56 rounded absolute right-8 z-10">
            <ul class="text-gray-800 flex flex-col justify-center items-stretch text-center font-medium border-x border-b border-gray-200 p-2">
                <li>
                    <a href="profile.php" class="block py-2 hover:bg-gray-100 rounded">Profile</a>
                </li>
                <li>
                    <a href="logout.php" class="block text-red-500 py-2 hover:bg-gray-100 rounded">Sign Out</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="flex-1 flex">
        <aside class="hidden md:block sticky z-40 top-0 left-0 md:min-w-32 lg:min-w-64 h-full bg-gray-50 border-r border-gray-200">
            <ul class="sticky top-0 left-0 py-20 px-5 font-medium md:text-xs lg:text-base flex flex-col">
                <?php foreach ($pageNames AS $pageName): ?>
                    <li>
                        <a href="<?php echo rawurlencode($pageName . '.php'); ?>" class="py-2 px-2 block hover:bg-gray-100 rounded text-center lg:text-left">
                            <?php readfile(__DIR__ . '/../../assets/icons/' . rawurldecode($pageName . '.svg')); ?>
                            <span class="align-middle"><?php echo e(ucfirst($pageName)); ?></span>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </aside>
        <main class="pt-14 w-full overflow-x-auto">
            <?php echo $contents; ?>
        </main>
    </div>

    <footer class="bg-slate-800 text-white p-10 pb-16 sm:pb-24 min-h-52 gap-4 flex flex-col">
        <a href="dashboard.php" class="flex items-center">
            <img src="assets/images/logo-white.png" class="h-7 inline-block -ml-1" alt="Academic planner logo">
            <span class="font-semibold">Academic Planner</span>
        </a>
        <p class="text-gray-300 text-sm">© 2024 Academic Planner™. All Rights Reserved.</p>
    </footer>
</body>
</html>