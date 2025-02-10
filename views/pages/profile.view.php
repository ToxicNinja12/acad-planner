<div class="px-10 py-5 mb-16">
    <h1 class="font-bold text-3xl mb-8">Profile</h1>
    <div class="border rounded py-2.5 px-5 mb-6">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl">Your Details</h2>
            <button>
                <svg class="w-6 hover:text-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <svg class="w-6 hover:text-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <table class="text-left text-gray-600">
            <tbody>
                <tr>
                    <th scope="row" class="px-6 py-3 text-gray-700">Name</th>
                    <td class="px-6 py-3"><?php echo e($name); ?></td>
                </tr>
                <tr>
                    <th scope="row" class="px-6 py-3 text-gray-700">Email</th>
                    <td class="px-6 py-3"><?php echo e($email); ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="border rounded py-2.5 px-5">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl">Your subjects</h2>
            <button id="edit-btn">
                <svg id="edit-on-icon" class="w-6 hover:text-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <svg id="edit-off-icon" class="w-6 hover:text-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded hidden" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div id="form-table">
            <table class="w-full text-sm text-left text-gray-600 my-5">
                <thead class="text-xs uppercase bg-gray-50 text-gray-700">
                    <tr>
                        <th scope="col" class="px-6 py-3">Subject Code</th>
                        <th scope="col" class="px-6 py-3">Subject Name</th>
                        <th scope="col" class="px-6 py-3">
                            <input id="form-checkbox-main" class="hidden align-baseline w-5 h-5 lg:w-4 lg:h-4" type="checkbox">
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($subjects)): ?>
                        <?php foreach ($subjects AS $subject): ?>
                            <tr class="form-row border-b border-gray-200">
                                <td class="px-6 py-3"><?php echo e($subject['code']); ?></td>
                                <td class="px-6 py-3"><?php echo e($subject['name']); ?></td>
                                <td class="px-6 py-3">
                                    <input class="hidden form-row-checkbox align-baseline w-5 h-5 lg:w-4 lg:h-4" type="checkbox" name="<?php echo e($subject['subject_id']); ?>">
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td class="italic px-6 py-3">No subjects added</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <div id="options-el" class="hidden justify-center md:justify-end gap-4 md:gap-2 mt-3 px-6 text-base lg:text-sm items-center border rounded">
                <p class="text-gray-700 italic hidden md:block">Options:</p>
                <button id="add-subject-btn" type="button" class="text-blue-500">
                    <span class="hover:underline">Add Subject</span>
                </button>
                <button id="remove-subjects-btn" type="button" class="text-red-500">
                    <span class="hover:underline">Remove Selected</span>
                </button>
            </div>
        </div>
        <div class="hidden" id="add-subjects-menu">
            <div class="flex justify-between items-center w-full text-xs bg-gray-50 text-gray-700 px-6 py-3 mt-5">
                <h3 class="uppercase font-bold">Add Subject(s)</h3>
                <div>
                    <label for="num-rows-input" class="me-2">Rows: </label>
                    <input min="1" max="10" value="1" class="px-2.5 py-1.5 w-20 border border-gray-300 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" type="number" id="num-rows-input">
                </div>
            </div>
            <form action="profile.php" method="post">
                <ul id="sub-rows-ul" class="mb-5">
                    <li class="sub-row-li flex gap-2 border-b border-gray-200 p-3">
                        <input placeholder="Code" type="text" class="p-2 w-32 border border-gray-300 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" name="code[]" required>
                        <input placeholder="Name" type="text" class="flex-1 p-2 border border-gray-300 text-gray-900 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none" name="name[]" required>
                    </li>
                </ul>
                <div class="flex justify-end gap-2.5">
                    <input id="cancel-sub-btn" type="button" value="Cancel" class="text-red-500 border border-red-500 hover:bg-red-500 hover:text-white hover:cursor-pointer rounded-md py-2 px-6 text-center">
                    <input type="submit" value="Submit" class="flex-initial text-white bg-blue-700 hover:bg-blue-800 hover:cursor-pointer rounded-md py-2 px-6 text-center">
                </div>
            </form>
        </div>
    </div>
    
</div>