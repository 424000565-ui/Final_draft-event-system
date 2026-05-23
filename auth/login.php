<?php
session_start();
include "../includes/db.php";

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users 
            WHERE email='$email' 
            AND password='$password'";

    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) > 0){

        $row = mysqli_fetch_assoc($result);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['name'] = $row['name'];
        $_SESSION['role'] = $row['role'];

        if($row['role'] == 'admin'){

            header("Location: ../admin/events/admin_events.php");
            exit();

        }else{

            header("Location: ../student/dashboard.php");
            exit();

        }

    }else{

        echo "<script>alert('Invalid Email or Password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login - Event System</title>

    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
        }
    </style>
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-5xl min-h-[550px] bg-white rounded-2xl shadow-xl overflow-hidden flex flex-col md:flex-row text-left">
        
        <div class="w-full md:w-1/2 bg-gradient-to-br from-blue-700 via-blue-800 to-slate-900 p-10 flex flex-col justify-between text-white">
            <div>
                <a href="../index.php" class="inline-flex items-center text-xs font-medium bg-white/10 hover:bg-white/20 text-blue-200 hover:text-white px-3 py-1.5 rounded-full transition duration-200 mb-6">
                    ← Back to Home
                </a>
                <h1 class="text-3xl md:text-4xl font-bold leading-tight mt-4 tracking-tight">
                    Welcome Back!
                </h1>
                <p class="text-blue-100/80 mt-4 text-sm font-light leading-relaxed max-w-sm">
                    Log in to view your personalized student dashboard, check your registered events, and access your digital admission passes.
                </p>
            </div>
            
            <div class="mt-8 pt-6 border-t border-white/10 hidden md:block">
                <p class="text-xs text-blue-200/70">Secure Student Portal Access</p>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-12 flex flex-col justify-center bg-white">
            <div class="mb-8">
                <h2 class="text-2xl font-bold text-slate-800 tracking-tight">Student Sign In</h2>
                <p class="text-sm text-slate-500 mt-1">Please enter your credentials to access the system.</p>
            </div>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="space-y-5">
                
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider mb-2">Email Address</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           required 
                           placeholder="yourname@student.edu" 
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-700/20 transition duration-200 text-sm text-slate-800">
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label for="password" class="block text-xs font-semibold text-slate-600 uppercase tracking-wider">Password</label>
                        <a href="#" class="text-xs text-blue-700 hover:underline">Forgot Password?</a>
                    </div>
                    <input type="password" 
                           id="password" 
                           name="password" 
                           required 
                           placeholder="••••••••" 
                           class="w-full px-4 py-3 border border-slate-200 rounded-xl focus:outline-none focus:border-blue-700 focus:ring-2 focus:ring-blue-700/20 transition duration-200 text-sm text-slate-800">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="remember" name="remember" class="h-4 w-4 text-blue-700 focus:ring-blue-700 border-slate-300 rounded">
                    <label for="remember" class="ml-2 block text-xs text-slate-600 user-select-none">Remember this device</label>
                </div>

                <button type="submit" 
                        name="login"
                        class="w-full bg-blue-700 hover:bg-blue-800 text-white font-medium py-3.5 px-4 rounded-xl transition duration-200 shadow-lg shadow-blue-700/10 hover:shadow-blue-700/20 transform hover:-translate-y-0.5 mt-2 cursor-pointer">
                    Sign In
                </button>
            </form>

            <div class="mt-8 text-center border-t border-slate-100 pt-6">
                <p class="text-xs text-slate-500">
                    Don't have an account yet? 
                    <a href="register.php" class="text-blue-700 hover:underline font-semibold ml-1">
                        Create Account
                    </a>
                </p>
            </div>
        </div>

    </div>

</body>
</html>