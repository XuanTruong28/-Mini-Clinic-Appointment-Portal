<?php 
/** * Khai báo để VS Code hiểu các biến được truyền từ Controller sang
 * @var string $view 
 */
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Clinic Appointment Portal</title>
    <link rel="stylesheet" href="/assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php 
        // Lấy path hiện tại để xử lý menu active
        $current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 
    ?>
    <nav class="navbar">
        <strong>🏥 Mini Clinic Portal</strong>
        <div class="nav-links">
            <a href="/" class="<?= $current_path === '/' ? 'active' : '' ?>">Home</a>
            <a href="/appointments" class="<?= $current_path === '/appointments' ? 'active' : '' ?>">Appointments</a>
            <a href="/appointments/create" class="<?= $current_path === '/appointments/create' ? 'active' : '' ?>">Book Appointment</a>
            <a href="/dashboard" class="<?= $current_path === '/dashboard' ? 'active' : '' ?>">Dashboard</a>
        </div>
        <div class="nav-auth">
            <?php if (is_logged_in()): ?>
                <form method="post" action="/logout" class="inline-form">
                    <button type="submit" class="link-button logout-btn">Logout</button>
                </form>
            <?php else: ?>
                <a href="/login" class="<?= $current_path === '/login' ? 'active' : '' ?> login-btn">Login</a>
            <?php endif; ?>
        </div>
    </nav>
    <main class="container">
        <?php if ($success = flash_get('success')): ?>
            <div class="alert success"><?= h($success) ?></div>
        <?php endif; ?>
        <?php if ($error = flash_get('error')): ?>
            <div class="alert error"><?= h($error) ?></div>
        <?php endif; ?>
        
        <?php 
            // Thay vì dùng view_path($view), dùng luôn đường dẫn tương đối từ thư mục views hiện tại
            require __DIR__ . '/' . $view . '.php'; 
        ?>
    </main>
</body>
</html>