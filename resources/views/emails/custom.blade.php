<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>{{ $subjectText ?? config('app.name') }}</title>
  <style>
    body{font-family:Arial,sans-serif;background:#f5f7fb;padding:20px}
    .card{max-width:600px;margin:0 auto;background:#fff;padding:20px;border-radius:8px}
    .footer{font-size:12px;color:#777;text-align:center;margin-top:14px}
  </style>
</head>
<body>
  <div class="card">
    {!! nl2br(e($bodyContent)) !!}
  </div>
  <div class="footer">Sent from {{ config('app.name') }}</div>
</body>
</html>
