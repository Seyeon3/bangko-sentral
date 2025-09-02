<?php include 'AccountController.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Account</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="max-w-xl mx-auto bg-white shadow-lg p-8 rounded-lg">
        <h2 class="text-2xl font-bold mb-4">Edit Account Details</h2>

        <?php if (!empty($errors)): ?>
            <div class="bg-red-100 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc ml-6">
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                <?= htmlspecialchars($success); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="space-y-4">
            <div>
                <label class="block mb-1 font-semibold">Full Name</label>
                <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname']); ?>" class="w-full px-4 py-2 border rounded">
            </div>

            <div>
                <label class="block mb-1 font-semibold">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']); ?>" class="w-full px-4 py-2 border rounded">
            </div>

            <div>
                <label class="block mb-1 font-semibold">New Password (leave blank to keep current)</label>
                <input type="password" name="password" class="w-full px-4 py-2 border rounded">
            </div>

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Account</button>
        </form>
    </div>
</body>
</html>
