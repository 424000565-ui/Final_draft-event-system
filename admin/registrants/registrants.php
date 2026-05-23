<?php
// Secure our cookie path configuration before starting the session
session_set_cookie_params([
    'path' => '/',
    'secure' => false, 
    'httponly' => true,
    'samesite' => 'Lax'
]);

session_start();

// 1. Verify access with correct relative pathing back to root
include("../../includes/db.php");

if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin'){
    header("Location: ../../auth/login.php");
    exit();
}

// 2. Pull in your dedicated filtering logic and query logic
include("registrants_filter.php"); 
include("queries.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include("registrants_header.php"); ?>
    <?php include("registrants_style.php"); ?>
</head>
<body class="bg-[#f8fafc] min-h-screen text-slate-800 flex flex-col">

    <?php include("registrants_navbar.php"); ?>

    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-10">
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200/80 p-5 mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <h1 class="text-xl font-bold text-slate-800 tracking-tight">Student Event Registrations</h1>
                    <p class="text-xs text-slate-400 font-light mt-0.5">Monitoring live seat placements across the campus network.</p>
                </div>

                <form method="GET" class="flex items-center w-full md:max-w-md gap-2">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" placeholder="Search name, email, or workshop..."
                           class="w-full text-xs bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 outline-none">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-5 py-3 rounded-xl transition">
                        Filter
                    </button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-xl border border-slate-200/70 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200/80 text-slate-400 font-bold text-[11px] tracking-wider uppercase">
                        <th class="py-4 px-6">Student Name</th>
                        <th class="py-4 px-6">Email Address</th>
                        <th class="py-4 px-6">Assigned Event Workshop Slot</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                            <tr class="hover:bg-slate-50/70 transition">
                                <td class="py-4 px-6 font-semibold text-slate-800"><?php echo htmlspecialchars($row['name']); ?></td>
                                <td class="py-4 px-6 text-slate-500 text-xs"><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="py-4 px-6 font-medium text-blue-900 text-xs md:text-sm"><?php echo htmlspecialchars($row['title']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="py-12 text-center text-slate-400 font-light">No records found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>

    <?php include("registrants_script.php"); ?>
</body>
</html>