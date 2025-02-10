<div class="px-10 py-5">
    <h1 class="font-bold text-2xl mb-3">Upcoming classes</h1>
    <?php if (!empty($classes)): ?>
        <ul class="flex overflow-x-auto gap-5 pb-3">
            <?php foreach ($classes AS $class): ?>
                <li>
                    <div class="py-5 px-2 border border-gray-200 rounded min-w-40 w-40 md:min-w-56 md:w-56 flex items-center gap-2">
                        <p class="[writing-mode:vertical-rl] -rotate-180 text-sm md:text-base font-extrabold text-gray-500"><?php echo e($class['code']); ?></p>
                        <div class="overflow-hidden">
                            <p class="text-xs font-semibold"><?php echo e(format_time($class['start_time'])); ?> - <?php echo e(format_time($class['end_time'])); ?></p>
                            <p class="text-sm md:text-base overflow-hidden whitespace-nowrap text-ellipsis"><?php echo e($class['name']); ?></p>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p class="italic font-light">No more upcoming classes today.</p>
    <?php endif; ?>
</div>