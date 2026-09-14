<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Princess Winlyn M. Yu - Homepage</title>
    <style>
        :root{
            --ink:#202124;
            --muted:#6b7280;
            --line:#e5e7eb;
            --soft:#f8f9fa;
        }

        *{box-sizing:border-box}

        body{
            margin:0;
            min-height:100vh;
            display:grid;
            place-items:center;
            padding:32px 20px;
            background:#fff;
            color:var(--ink);
            font-family:Arial,sans-serif;
        }

        .container{
            width:min(760px,100%);
            padding:48px;
            border:1px solid var(--line);
            border-radius:6px;
        }

        .eyebrow{
            margin:0 0 14px;
            color:var(--muted);
            font-size:12px;
            font-weight:600;
            letter-spacing:1.5px;
            text-transform:uppercase;
        }

        h1{
            max-width:520px;
            margin:0;
            font-size:clamp(32px,6vw,56px);
            line-height:1.05;
            font-weight:600;
            letter-spacing:-1.5px;
        }

        .program{
            margin:14px 0 42px;
            color:var(--muted);
            font-size:16px;
        }

        .lab5{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:20px;
            padding:22px 24px;
            border-radius:5px;
            background:var(--ink);
            color:#fff;
            text-decoration:none;
        }

        .lab5 strong{font-size:18px;font-weight:600}

        .lab5 span{color:#d1d5db;font-size:13px}

        .arrow{font-size:24px;line-height:1}

        .secondary{
            display:grid;
            grid-template-columns:repeat(2,minmax(0,1fr));
            gap:1px;
            margin-top:36px;
            border:1px solid var(--line);
            background:var(--line);
        }

        .secondary a{
            padding:18px;
            background:#fff;
            color:var(--ink);
            text-decoration:none;
            font-size:14px;
        }

        .secondary a:hover,.lab5:hover{opacity:.84}

        @media (max-width:600px){
            .container{padding:32px 22px}
            .lab5{padding:18px}
            .secondary{grid-template-columns:1fr}
        }
    </style>
</head>
<body>

<div class="container">

    <p class="eyebrow">BSIT 3F6</p>
    <h1>Princess Winlyn M. Yu</h1>
    <p class="program">Coursework and project workspace</p>

    <a class="lab5" href="<?= site_url('lab5'); ?>">
        <span><strong>Lab 5</strong><br>Authentication and products</span>
        <span class="arrow" aria-hidden="true">&rarr;</span>
    </a>

    <nav class="secondary" aria-label="Other coursework">
        <a href="<?= site_url('student'); ?>">Student homepage</a>
        <a href="<?= site_url('student/profile'); ?>">Student profile</a>
        <a href="<?= site_url('users'); ?>">Users database</a>
        <a href="<?= site_url('crud'); ?>">Lab 4 CRUD system</a>
    </nav>

</div>

</body>
</html>