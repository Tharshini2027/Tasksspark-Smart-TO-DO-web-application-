<?php
session_start();
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$userEmail = $_SESSION['user_email'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>TaskSpark – Home</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white font-sans pt-20">

  <!-- ✅ TaskSpark Header -->
  <header class="fixed top-0 left-0 w-full bg-white border-b border-gray-200 shadow-sm z-50">
    <div class="flex items-center justify-between px-6 py-4">
      <!-- Logo + Title -->
      <div class="flex items-center space-x-3">
        <img src="img/OIP.jpg" alt="TaskSpark Logo" class="w-10 h-10" />
        <span class="text-3xl font-extrabold text-blue-700 tracking-wide">TaskSpark</span>
      </div>

      <!-- 🔐 User Auth Area -->
      <div>
        <?php if ($loggedIn): ?>
          <span class="text-sm text-gray-700 mr-4">👋 Welcome, <strong><?php echo htmlspecialchars($userEmail); ?></strong></span>
          <a href="logout.php" class="text-blue-600 font-semibold underline hover:text-blue-800">Logout</a>
        <?php else: ?>
          <a href="email.html" class="text-blue-600 font-semibold underline hover:text-blue-800">Login</a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <!-- ✅ Main Content -->
  <main class="max-w-3xl mx-auto mt-12 text-center px-4">
    <h1 class="text-4xl font-bold text-gray-800 mb-4">🚀 Welcome to TaskSpark</h1>
    <p class="text-lg text-gray-600 mb-8">
      Your smart to-do app that helps you stay organized and productive.
    </p>

    <?php if ($loggedIn): ?>
      <p class="text-green-600 font-semibold">You're signed in and ready to go! ✅</p>
    <?php else: ?>
      <p class="text-gray-500">Sign in to access your personalized dashboard and tasks.</p>
    <?php endif; ?>
  </main>

</body>
</html>
