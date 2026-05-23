<?php
include("../../includes/db.php");

if(isset($_POST['add_event'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $event_date = $_POST['event_date'];

    // Sanitizing parameters safely to prevent layout or text syntax breakages
    $title = mysqli_real_escape_string($conn, $title);
    $description = mysqli_real_escape_string($conn, $description);
    $event_date = mysqli_real_escape_string($conn, $event_date);

    $insert = "INSERT INTO events(title, description, event_date)
               VALUES('$title','$description','$event_date')";

    mysqli_query($conn, $insert);
    
    // Redirect cleanly to avoid form re-submission on page refreshes
    header("Location: admin_events.php");
    exit();
}

$events = mysqli_query($conn, "SELECT * FROM events ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events - Admin Control Panel</title>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen text-slate-800">

    <nav class="bg-gradient-to-r from-blue-900 to-slate-900 text-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-3">
                    <div class="bg-blue-600 p-2 rounded-lg text-white shadow-inner">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                        </svg>
                    </div>
                    <div>
                        <span class="font-bold text-base tracking-tight block leading-tight">Event Management</span>
                        <span class="text-[10px] text-blue-300 font-light tracking-wider uppercase block">System Admin Panel</span>
                    </div>
                </div>
                <div>
                    <a href="../dashboard.php" class="bg-white/10 hover:bg-white/20 text-xs font-medium px-4 py-2.5 rounded-xl transition duration-200 inline-flex items-center gap-1.5 border border-white/5">
                        ← Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">
            
            <div class="bg-white rounded-2xl shadow-xl border border-slate-200/60 overflow-hidden sticky top-6">
                <div class="bg-gradient-to-r from-blue-800 to-slate-900 p-5 text-white">
                    <h2 class="text-base font-bold tracking-tight inline-flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-blue-400">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>
                        Create New Event
                    </h2>
                    <p class="text-blue-200/60 text-xs mt-1 font-light">Add premium active workshop slots to the student campus index portal loops.</p>
                </div>
                
                <form method="POST" class="p-5 space-y-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Event Title</label>
                        <input type="text" name="title" placeholder="e.g., Cybersecurity Hackathon" required
                               class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition outline-none text-slate-800 font-normal">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Event Description</label>
                        <textarea name="description" placeholder="Provide event scope, requirements, timeline structures..." rows="4" required
                                  class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition outline-none text-slate-800 font-light resize-none leading-relaxed"></textarea>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-1.5">Schedule Date</label>
                        <input type="date" name="event_date" required
                               class="w-full text-sm bg-slate-50 border border-slate-200 rounded-xl px-3.5 py-2.5 focus:bg-white focus:ring-2 focus:ring-blue-600/20 focus:border-blue-600 transition outline-none text-slate-800 font-medium">
                    </div>

                    <button type="submit" name="add_event"
                            class="w-full mt-2 bg-blue-700 hover:bg-blue-800 text-white font-medium text-sm py-3 px-4 rounded-xl transition duration-200 shadow-lg shadow-blue-700/10 inline-flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Publish Event Session
                    </button>
                </form>
            </div>

            <div class="lg:col-span-2 bg-white rounded-2xl shadow-xl border border-slate-200/60 overflow-hidden">
                <div class="bg-gradient-to-r from-blue-700 via-blue-800 to-slate-900 p-5 text-white flex items-center justify-between">
                    <div>
                        <h1 class="text-base md:text-lg font-bold tracking-tight">Active Live Events Database</h1>
                        <p class="text-blue-100/70 text-xs mt-0.5 font-light">Monitor, update operational data settings, or instantly drop listings.</p>
                    </div>
                    <span class="bg-blue-500/20 text-blue-200 text-xs font-semibold px-3 py-1 rounded-full border border-blue-400/20 shadow-sm">
                        <?php echo mysqli_num_rows($events); ?> Total Records
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 border-b border-slate-200 text-slate-700 text-xs font-semibold uppercase tracking-wider">
                                <th class="py-4 px-4 text-center w-14">ID</th>
                                <th class="py-4 px-5">Event Details</th>
                                <th class="py-4 px-5 text-center w-36">Scheduled Date</th>
                                <th class="py-4 px-5 text-center w-32">Actions Interface</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 text-sm text-slate-600">
                            <?php if(mysqli_num_rows($events) > 0): ?>
                                <?php while($row = mysqli_fetch_assoc($events)){ ?>
                                    <tr class="hover:bg-slate-50/50 transition duration-150">
                                        
                                        <td class="py-4 px-4 text-center font-mono text-xs text-slate-400 font-semibold bg-slate-50/30">
                                            #<?php echo $row['id']; ?>
                                        </td>
                                        
                                        <td class="py-4 px-5">
                                            <div class="font-bold text-slate-800 text-sm tracking-tight mb-1">
                                                <?php echo htmlspecialchars($row['title']); ?>
                                            </div>
                                            <div class="text-xs text-slate-500 font-light leading-relaxed line-clamp-2 max-w-md">
                                                <?php echo htmlspecialchars($row['description']); ?>
                                            </div>
                                        </td>
                                        
                                        <td class="py-4 px-5 text-center whitespace-nowrap">
                                            <span class="inline-flex items-center font-mono text-xs bg-slate-100 text-slate-700 font-medium px-2.5 py-1.5 rounded-lg border border-slate-200/50">
                                                <?php echo htmlspecialchars($row['event_date']); ?>
                                            </span>
                                        </td>
                                        
                                        <td class="py-4 px-5 text-center whitespace-nowrap">
                                            <div class="inline-flex items-center gap-2">
                                                <a class="text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 px-3 py-2 rounded-xl transition duration-150 border border-blue-200/30"
                                                   href="admin_edit_event.php?id=<?php echo urlencode($row['id']); ?>">
                                                    Edit
                                                </a>
                                                <a class="text-xs font-medium bg-red-50 text-red-600 hover:bg-red-100 px-3 py-2 rounded-xl transition duration-150 border border-red-200/30"
                                                   href="admin_delete_event.php?id=<?php echo urlencode($row['id']); ?>"
                                                   onclick="return confirm('Are you completely sure you want to permanently delete this event listing? This action cannot be undone.')">
                                                    Delete
                                                </a>
                                            </div>
                                        </td>

                                    </tr>
                                <?php } ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center py-12 text-slate-400 font-light text-xs">
                                        No active system events found. Use the configuration console panel on the left to add your first record!
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>

</body>
</html>