<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Autentikasi') — SmartResident</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: radial-gradient(circle at top right, #d1fae5 0%, #f1f5f9 45%, #e2e8f0 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
        }
        .auth-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 20px 35px -10px rgba(15, 23, 42, 0.08);
        }
        .btn-sr-primary {
            background-color: #059669;
            border-color: #059669;
            color: #fff;
            font-weight: 600;
            border-radius: 10px;
            padding: 0.65rem 1.2rem;
        }
        .btn-sr-primary:hover { background-color: #047857; color: #fff; }
    </style>
</head>
<body>
    <div class="container py-5">
        @yield('content')
    </div>
</body>
</html>