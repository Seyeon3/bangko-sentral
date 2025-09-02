<?php
session_start();

// Dummy user session (replace this with your login session)
$_SESSION['user'] = [
    'fullname' => 'Sean Michael Manaog',
    'username' => 'seanmanaog',
    'email' => 'seanmanaog@example.com',
    'role' => 'Admin',
    'created_at' => '2024-06-15'
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow h-screen px-6 py-4">
        <h2 class="text-lg font-bold text-blue-600 mb-6">Admin Panel</h2>
        <ul>
            <li class="mb-4"><a href="dashboard.php" class="text-gray-700 hover:text-blue-600 flex items-center"><span class="material-icons mr-2">dashboard</span> Dashboard</a></li>
            <li class="mb-4">
                <button onclick="toggleDetails()" class="text-gray-700 hover:text-blue-600 flex items-center focus:outline-none">
                    <span class="material-icons mr-2">account_circle</span> <?= $_SESSION['user']['username']; ?>
                </button>
            </li>
            <li class="mb-4"><a href="logout.php" class="text-red-500 hover:underline flex items-center"><span class="material-icons mr-2">logout</span> Logout</a></li>
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-8 relative">
        <h1 class="text-2xl font-semibold mb-4">Dashboard</h1>

        <!-- Account Detail Card -->
        <div id="accountCard" class="hidden absolute top-16 right-10 w-96 bg-white rounded-xl shadow-xl p-6 z-50 transition-all duration-300">
            <h2 class="text-xl font-semibold mb-2">Account Details</h2>
            <div class="border-t pt-4 space-y-2 text-gray-700">
                <p><strong>Full Name:</strong> <?= $_SESSION['user']['fullname']; ?></p>
                <p><strong>Username:</strong> <?= $_SESSION['user']['username']; ?></p>
                <p><strong>Email:</strong> <?= $_SESSION['user']['email']; ?></p>
                <p><strong>Role:</strong> <?= $_SESSION['user']['role']; ?></p>
                <p><strong>Created At:</strong> <?= date('F d, Y', strtotime($_SESSION['user']['created_at'])); ?></p>
            </div>
            <button onclick="toggleDetails()" class="mt-4 text-sm text-blue-600 hover:underline">Close</button>
        </div>
    </main>

    <script>
        function toggleDetails() {
            const card = document.getElementById('accountCard');
            card.classList.toggle('hidden');
        }
    </script>
</body>
</html>
