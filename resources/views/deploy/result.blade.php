<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ ucfirst($operation) }} Result</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <!-- Page Title -->
    <h1 class="mb-4">{{ ucfirst($operation) }} Result</h1>

    <!-- Flash message for Artisan output -->
    @if(isset($output))
        <div class="alert alert-info">
            <strong>{{ ucfirst($operation) }} Completed:</strong> The {{ $operation }} operation has been successfully completed.
        </div>
    @endif

    <!-- Display the Artisan output directly -->
    <div class="card mt-3">
        <div class="card-body">
            <h4>{{ ucfirst($operation) }} Output</h4>
            <p>The output for the {{ $operation }} operation is shown below:</p>
            <pre class="bg-light p-3 rounded">{{ $output }}</pre>
        </div>
    </div>

</div>

<!-- Bootstrap 5 JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
