<!DOCTYPE html>
<html>
<head>
    <title>Laravel - Implement Flash Messages with example</title>
</head>
<body>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h1>Flash Message Example</h1>
    <a href="/flash-message">Show Flash Message</a>
</body>
</html>
