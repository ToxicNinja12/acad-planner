<section class="bg-gray-200 px-10 py-16 lg:py-24 h-full flex justify-center items-center">
    <div class="bg-white flex flex-col items-stretch md:flex-row rounded-lg shadow-lg max-w-md md:max-w-3xl flex-1">
        <img class="h-24 md:max-w-48 md:h-auto object-cover rounded-t brightness-95" src="assets/images/bia-w-a-PO8Woh4YBD8-unsplash.jpg" alt="">
        <div class="p-10 flex-1">
            <?php if ($type === VIEW_LOGIN): ?>
                <!-- LOGIN FORM -->
                <h1 class="font-bold text-2xl mb-3">Sign in to your account</h1>
                <form method="post" class="text-md mb-6">
                    <p class="mb-4">
                        <label for="email" class="block mb-2 font-medium">Email:</label>
                        <input type="email" id="email" name="email" placeholder="name@company.com" value="<?php echo e($_POST['email'] ?? ''); ?>" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg w-full p-2.5 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    </p>
                    <p class="mb-4">
                        <label for="password" class="block mb-2 font-medium">Password:</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg w-full p-2.5 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        <span class="<?php if (!empty($passwordError)): ?>show-error <?php endif; ?>font-medium text-sm text-red-500 invisible">Invalid email or password!</span>
                    </p>
                    <p>
                        <input type="submit" value="Sign In" class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg p-2.5 w-full hover:cursor-pointer">
                    </p>
                </form>
                <p class="text-sm font-light text-gray-500">Don't have an account yet? <a href="signup.php" class="font-medium text-blue-600 hover:underline">Sign up</a></p>
            <?php elseif ($type === VIEW_SIGNUP): ?>
                <!-- SIGNUP FORM -->
                <h1 class="font-bold text-2xl mb-3">Create an account</h1>
                <form method="post" class="text-md mb-6">
                    <p class="mb-2">
                        <label for="email" class="block mb-2 font-medium">Email</label>
                        <input type="email" id="email" name="email" placeholder="name@company.com" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg w-full p-2.5 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        <span class="<?php if (!empty($emailError)): ?>show-error <?php endif; ?>font-medium text-sm text-red-500 invisible">Email already taken!</span>
                    </p>
                    <p class="mb-2">
                        <label for="password" class="block mb-2 font-medium">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg w-full p-2.5 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        <span class="<?php if (!empty($passwordError)): ?>show-error <?php endif; ?>font-medium text-sm text-red-500 invisible">Passwords must match!</span>
                    </p>
                    <p class="mb-4">
                        <label for="confirm" class="block mb-2 font-medium">Confirm password</label>
                        <input type="password" id="confirm" name="confirm" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg w-full p-2.5 focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                        <span class="<?php if (!empty($passwordError)): ?>show-error <?php endif; ?>font-medium text-sm text-red-500 invisible">Passwords must match!</span>
                    </p>
                    <p>
                        <input type="submit" value="Sign Up" class="text-white bg-blue-700 hover:bg-blue-800 rounded-lg p-2.5 w-full hover:cursor-pointer">
                    </p>
                </form>
                <p class="text-sm font-light text-gray-500">Already have an account? <a href="login.php" class="font-medium text-blue-600 hover:underline">Login</a></p>
            <?php endif; ?>
        </div>
    </div>
</section>