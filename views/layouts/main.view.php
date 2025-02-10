<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <?php if (!empty($scripts)): ?>
        <?php foreach ($scripts AS $script): ?>
            <script src="scripts/<?php echo rawurlencode($script); ?>" defer></script>
        <?php endforeach; ?>
    <?php endif; ?>
    <title>Academic Scheduler</title>
</head>
<body class="flex flex-col justify-around h-screen">
    <nav class="bg-white border-b border-gray-200">
        <div class="flex justify-between items-center px-8 py-4 text-md">
            <a href="index.php" class="flex items-center">
                <img src="assets/images/logo.png" class="h-7 inline-block" alt="Academic planner logo">
                <span class="font-semibold">Academic Planner</span>
            </a>
            <?php if (!empty($landing)): ?>
                <ul class="flex flex-row gap-x-6 items-center font-medium">
                    <li>
                        <a class="border border-black rounded px-3 py-1.5 hover:text-blue-700 hover:border-blue-700" href="login.php">Login</a>
                    </li>
                </ul>
            <?php endif; ?>
        </div>
    </nav>
    <main class="flex-1">
        <?php echo $contents; ?>
    </main>
    <footer class="bg-slate-800 text-white p-10 pb-16 sm:pb-24 min-h-52 gap-4 flex flex-col">
        <a href="index.php" class="flex items-center">
            <img src="assets/images/logo-white.png" class="h-7 inline-block -ml-1" alt="Academic planner logo">
            <span class="font-semibold">Academic Planner</span>
        </a>
        <p class="text-gray-300 text-sm">© 2024 Academic Planner™. All Rights Reserved.</p>
    </footer>
</body>
</html>