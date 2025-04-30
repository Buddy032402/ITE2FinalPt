<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #3f37c9;
            --success: #2ec4b6;
            --info: #4cc9f0;
            --warning: #f77f00;
            --danger: #d90429;
            --dark: #212529;
            --light: #f8f9fa;
            --gray: #6c757d;
            --gray-dark: #343a40;
            --gray-light: #e9ecef;
        }
        
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }
        
        .login-card {
            border-radius: 24px;
            border: none;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .login-sidebar {
            background: linear-gradient(145deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            padding: 3rem 2rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 100%;
        }
        
        .login-sidebar-header {
            margin-bottom: 2rem;
        }
        
        .login-sidebar-content {
            margin-bottom: 2rem;
        }
        
        .login-sidebar-footer {
            font-size: 0.85rem;
            opacity: 0.8;
        }
        
        .login-main {
            padding: 3rem 2rem;
            background: white;
        }
        
        .login-logo {
            margin-bottom: 2rem;
        }
        
        .login-logo i {
            font-size: 2.5rem;
            color: var(--primary);
            background: rgba(67, 97, 238, 0.1);
            width: 70px;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 20px;
        }
        
        .login-title {
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }
        
        .login-subtitle {
            color: var(--gray);
            margin-bottom: 2rem;
            font-size: 0.95rem;
        }
        
        .form-control {
            border-radius: 12px;
            padding: 0.75rem 1.25rem;
            border: 2px solid var(--gray-light);
            font-size: 0.95rem;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
            border-color: var(--primary);
        }
        
        .input-group-text {
            border-radius: 12px;
            border: 2px solid var(--gray-light);
            background: white;
        }
        
        .input-group:focus-within .input-group-text {
            border-color: var(--primary);
        }
        
        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .form-check-label {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .btn-primary {
            background: var(--primary);
            border: none;
            border-radius: 12px;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .forgot-password {
            color: var(--primary);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .forgot-password:hover {
            text-decoration: underline;
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            padding: 1rem;
        }
        
        .form-floating > .form-control {
            padding-top: 1.625rem;
            padding-bottom: 0.625rem;
            height: calc(3.5rem + 2px);
        }
        
        .form-floating > label {
            padding: 1rem 1.25rem;
        }
        
        /* Animation */
        .login-card {
            animation: fadeIn 0.5s ease-out;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive */
        @media (max-width: 992px) {
            .login-sidebar {
                padding: 2rem 1.5rem;
            }
            
            .login-main {
                padding: 2rem 1.5rem;
            }
        }
        
        @media (max-width: 768px) {
            .login-sidebar {
                display: none;
            }
        }
        
        /* Dark mode toggle */
        .theme-switch {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 100;
        }
        
        .theme-switch label {
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray);
            transition: all 0.3s ease;
        }
        
        .theme-switch label:hover {
            background: var(--gray-light);
            color: var(--dark);
        }
        
        .theme-switch input {
            display: none;
        }
        
        /* Loading button */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.15em;
            margin-right: 0.5rem;
            display: none;
        }
        
        .btn-loading .spinner-border-sm {
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="theme-switch">
        <label for="darkMode">
            <input type="checkbox" id="darkMode">
            <i class="fas fa-moon"></i>
        </label>
    </div>
    
    <div class="login-wrapper">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-8 col-md-7 mx-auto">
                    <div class="card login-card">
                        <div class="row g-0 h-100">
                            <div class="col-lg-5">
                                <div class="login-sidebar">
                                    <div class="login-sidebar-header">
                                        <h4 class="mb-1">Admin Portal</h4>
                                        <p class="mb-0">Secure Management System</p>
                                    </div>
                                    <div class="login-sidebar-content">
                                        <h3 class="mb-4">Welcome Back!</h3>
                                        <p>Access your dashboard with enhanced security and streamlined management tools.</p>
                                        <div class="mt-4">
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="me-3">
                                                    <i class="fas fa-shield-alt"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Advanced Security</h6>
                                                    <p class="mb-0 small">Enterprise-grade protection</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center mb-3">
                                                <div class="me-3">
                                                    <i class="fas fa-chart-line"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Real-time Analytics</h6>
                                                    <p class="mb-0 small">Monitor system performance</p>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <div class="me-3">
                                                    <i class="fas fa-users"></i>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">User Management</h6>
                                                    <p class="mb-0 small">Control access privileges</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="login-sidebar-footer">
                                        <p class="mb-0">&copy; 2025 Company Name. All rights reserved.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <div class="login-main">
                                    <div class="login-logo text-center">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                    <h4 class="login-title text-center">Administrator Login</h4>
                                    <p class="login-subtitle text-center">Enter your credentials to access the dashboard</p>
                                    
                                    <!-- Display error message if login fails -->

                                        <div class="alert alert-danger mb-4">
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-exclamation-circle me-2"></i>
                                                <div>{{ $errors->first() }}</div>
                                            </div>
                                        </div>

                                    
                                    <form method="POST" action="{{ route('admin.login') }}" id="loginForm">

                                        <div class="mb-4">
                                            <label for="email" class="form-label">Email Address</label>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-envelope"></i>
                                                </span>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="admin@example.com" required autofocus>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-1">
                                                <label for="password" class="form-label mb-0">Password</label>
                                                <a href="#" class="forgot-password">Forgot Password?</a>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fas fa-lock"></i>
                                                </span>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                                <span class="input-group-text cursor-pointer" id="togglePassword" style="cursor: pointer;">
                                                    <i class="fas fa-eye-slash"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="mb-4">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="" id="rememberMe" name="remember">
                                                <label class="form-check-label" for="rememberMe">
                                                    Remember me on this device
                                                </label>
                                            </div>
                                        </div>
                                        <div class="d-grid mb-4">
                                            <button type="submit" class="btn btn-primary" id="loginButton">
                                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                                <span>Sign In</span>
                                            </button>
                                        </div>
                                        <div class="text-center">
                                            <p class="text-muted mb-0">Protected by advanced security protocols</p>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show/hide password toggle
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });
        
        // Form submission loading state
        document.getElementById('loginForm').addEventListener('submit', function() {
            const button = document.getElementById('loginButton');
            button.classList.add('btn-loading');
            button.disabled = true;
        });
        
        // Dark mode toggle
        document.getElementById('darkMode').addEventListener('change', function() {
            document.body.classList.toggle('dark-mode');
            
            const icon = this.parentElement.querySelector('i');
            if (this.checked) {
                icon.classList.remove('fa-moon');
                icon.classList.add('fa-sun');
            } else {
                icon.classList.remove('fa-sun');
                icon.classList.add('fa-moon');
            }
        });
        
        // Add smooth entrance animations to elements
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.login-sidebar-content > *, .login-main > *');
            
            elements.forEach((element, index) => {
                element.style.opacity = '0';
                element.style.transform = 'translateY(20px)';
                element.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
                element.style.transitionDelay = `${index * 0.1}s`;
                
                setTimeout(() => {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }, 100);
            });
        });
    </script>
</body>
</html>