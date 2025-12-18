<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link rel="stylesheet" href="assets/css/global.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>

<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-left">
            <h2>Hello!</h2>
            <p class="subtitle">Sign in to your account</p>

            <form id="login-form">

                <div class="input-group">
                    <span class="icon">📧</span>
                    <!-- Added id="username" -->
                    <input type="text" id="username" placeholder="Email" required>
                </div>

                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" placeholder="Password" id="password" required>
                    <span class="toggle" id="togglePassword">👁</span>
                </div>

                <!-- Message display -->
                <p id="login-message"></p>

                <div class="options">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                    <a href="#">Forgot password?</a>
                </div>

                <button type="submit" class="btn-login">Sign In</button>
            </form>
        </div>

        <div class="auth-right">
            <h2>Welcome Back!</h2>
            <p>
                Login to access your dashboard and manage your products securely.
            </p>
        </div>

    </div>
</div>

<script src="assets/js/login.js"></script>

</body>
</html>
