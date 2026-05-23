<?php
session_start();
include("../includes/db.php");

if(!isset($_SESSION['user_id'])){
    header("Location: ../auth/login.php");
    exit();
}

$query = "SELECT * FROM events";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Event Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', Arial, sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen text-slate-800">

    <nav class="bg-gradient-to-r from-blue-900 to-slate-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-600 p-2 rounded-lg text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                    <span class="font-bold text-lg tracking-tight hidden sm:block">Campus Event Hub</span>
                </div>

                <div class="flex items-center space-x-2 md:space-x-4 text-sm font-medium">
                    <a href="my_events.php" class="bg-white/10 hover:bg-white/20 px-3 py-2 rounded-lg transition duration-200">
                        My Events
                    </a>
                    <a href="history.php" class="bg-white/10 hover:bg-white/20 px-3 py-2 rounded-lg transition duration-200">
                        History
                    </a>
                    <a href="../auth/logout.php" class="bg-red-600 hover:bg-red-700 px-3 py-2 rounded-lg transition duration-200 shadow-md shadow-red-900/20 font-semibold">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="bg-gradient-to-br from-blue-700 via-blue-800 to-slate-900 text-white rounded-2xl p-6 md:p-8 shadow-xl mb-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold tracking-tight">
                    Welcome back, <?php echo htmlspecialchars($_SESSION['name']); ?>!
                </h1>
                <p class="text-blue-100/80 text-sm mt-1 font-light">
                    Explore available campus events, upgrade your skills, and reserve your seats today.
                </p>
            </div>
            <div class="bg-white/10 px-4 py-2 rounded-xl border border-white/10 backdrop-blur-sm text-xs text-blue-200">
                Logged in as <span class="text-white font-semibold capitalize"><?php echo htmlspecialchars($_SESSION['role'] ?? 'Student'); ?></span>
            </div>
        </div>

        <div class="space-y-6">
            <div class="flex items-center justify-between border-b border-slate-200 pb-3">
                <h2 class="text-xl font-bold text-slate-800 tracking-tight">Available Events</h2>
                <span class="text-xs font-semibold bg-blue-100 text-blue-800 px-2.5 py-1 rounded-full">
                    Active Passes
                </span>
            </div>

            <div class="grid grid-cols-1 gap-6">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <div class="bg-white border border-slate-200/80 rounded-2xl p-6 shadow-sm hover:shadow-md transition duration-200 flex flex-col justify-between items-start gap-4 md:flex-row md:items-center">
                            <div class="space-y-2 max-w-3xl">
                                <h3 class="text-lg font-bold text-slate-800 tracking-tight">
                                    <?php echo htmlspecialchars($row['title']); ?>
                                </h3>
                                <p class="text-sm text-slate-600 font-light leading-relaxed">
                                    <?php echo htmlspecialchars($row['description']); ?>
                                </p>
                                <div class="inline-flex items-center text-xs font-semibold bg-slate-100 text-slate-700 px-3 py-1.5 rounded-lg border border-slate-200/60">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4 mr-1.5 text-blue-700">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Date: <span class="ml-1 text-slate-900"><?php echo htmlspecialchars($row['event_date']); ?></span>
                                </div>
                            </div>
                            <div class="w-full md:w-auto flex-shrink-0">
                                <a href="register_event.php?id=<?php echo urlencode($row['id']); ?>" 
                                   class="block w-full md:w-auto text-center bg-blue-700 hover:bg-blue-800 text-white text-sm font-medium px-5 py-3 rounded-xl transition duration-200 shadow-md shadow-blue-700/10">
                                    Register Event
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                <?php else: ?>
                    <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-slate-300">
                        <p class="text-slate-500 text-sm">No campus events are currently scheduled. Check back soon!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
</body>
</html>