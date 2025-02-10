<script><?php echo 'const classes = ' . json_encode($classes) . ';'; ?></script>
<div class="px-10 py-5 mb-16">
    <div id="header-el" class="flex justify-between items-center mb-3 md:mb-0 lg:max-w-3xl">
        <h1 class="font-bold text-2xl">Your timetable</h1>
        <button id="edit-btn" class="hidden xl:block">
            <svg id="edit-icon" class="w-6 hover:text-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>
        </button>
        <div id="tt-btngroup-el" class="hidden">
            <button id="cancel-btn" class="text-red-500 border border-red-500 hover:bg-red-500 hover:text-white hover:cursor-pointer rounded-md py-2 px-6 text-center">
                Cancel
            </button>
            <button id="save-btn" type="submit" class="text-white bg-blue-700 hover:bg-blue-800 hover:cursor-pointer rounded-md py-2 px-6 text-center">
                Save
            </button>
        </div>
    </div>
    <div class="flex flex-col xl:flex-row gap-10">
        <div class="flex-1 md:max-w-3xl" id="calendar"></div>
        <div id="subjects-list" class="hidden mt-6 border justify-self-stretch">
            <p class="font-bold text-center py-0.5">Your Subjects</p>
            <div id='subjects-container' class="flex flex-wrap justify-stretch xl:flex-col gap-0.5">
                <?php foreach ($subjects as $subject): ?>
                    <div id="<?php echo e($subject['subject_id']); ?>" class='subject flex-1 flex flex-col items-center px-5 py-1 rounded-sm hover:cursor-pointer text-white bg-blue-500' draggable>
                        <div><?php echo e($subject['code']); ?></div>
                        <div class="w-36 truncate"><?php echo e($subject['name']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>