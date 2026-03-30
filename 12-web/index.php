<?php
$domain = '';
$output = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $domain = trim($_POST['domain'] ?? '');
    if ($domain !== '') {
        $output = shell_exec('whois ' . $domain . ' 2>&1');
        if ($output === null) {
            $output = 'No output returned.';
        }
    } else {
        $output = 'Please enter a domain.';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Whois Lookup</title>
  <style>
    :root {
      --wmui-base-100: #ffffff;
      --wmui-base-90: #f8f9fa;
      --wmui-base-80: #eaecf0;
      --wmui-base-30: #54595d;
      --wmui-base-20: #202122;
      --wmui-accent-50: #3366cc;
      --wmui-accent-60: #2a4b8d;
      --wmui-success-50: #14866d;
      --wmui-radius: 2px;
    }
    body {
      margin: 0;
      min-height: 100vh;
      font-family: "Helvetica Neue", "Helvetica", "Liberation Sans", sans-serif;
      color: var(--wmui-base-20);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 24px;
    }
    .panel {
      width: 100%;
      max-width: 760px;
      background: var(--wmui-base-100);
      border: 1px solid var(--wmui-base-80);
      border-radius: var(--wmui-radius);
      box-shadow: 0 8px 28px rgba(32, 33, 34, 0.08);
      overflow: hidden;
    }
    .header {
      padding: 18px 20px;
      border-bottom: 1px solid var(--wmui-base-80);
      background: linear-gradient(90deg, #f8f9fa 0%, #ffffff 100%);
    }
    h1 {
      margin: 0;
      font-size: 1.32rem;
      font-weight: 700;
      letter-spacing: 0.01em;
    }
    .subtitle {
      margin-top: 6px;
      color: var(--wmui-base-30);
      font-size: 0.96rem;
    }
    form {
      padding: 20px;
      display: grid;
      gap: 10px;
    }
    label {
      font-weight: 600;
      font-size: 0.95rem;
    }
    input[type="text"] {
      border: 1px solid #a2a9b1;
      border-radius: var(--wmui-radius);
      padding: 10px 12px;
      font-size: 1rem;
      background: var(--wmui-base-100);
      transition: border-color 160ms ease, box-shadow 160ms ease;
    }
    input[type="text"]:focus {
      outline: none;
      border-color: var(--wmui-accent-50);
      box-shadow: 0 0 0 1px var(--wmui-accent-50);
    }
    button {
      width: fit-content;
      border: 1px solid var(--wmui-accent-60);
      border-radius: var(--wmui-radius);
      background: var(--wmui-accent-50);
      color: #fff;
      padding: 10px 16px;
      font-weight: 600;
      font-size: 0.95rem;
      cursor: pointer;
      transition: background-color 160ms ease, transform 120ms ease;
    }
    button:hover {
      background: #2a4b8d;
    }
    button:active {
      transform: translateY(1px);
    }
    .result {
      margin: 0 20px 20px;
      border: 1px solid var(--wmui-base-80);
      border-radius: var(--wmui-radius);
      background: var(--wmui-base-90);
    }
    .result-title {
      margin: 0;
      padding: 10px 12px;
      border-bottom: 1px solid var(--wmui-base-80);
      font-size: 0.9rem;
      font-weight: 700;
      color: var(--wmui-success-50);
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }
    pre {
      margin: 0;
      padding: 14px;
      font-family: "Menlo", "Consolas", monospace;
      font-size: 0.86rem;
      white-space: pre-wrap;
      word-wrap: break-word;
      line-height: 1.35;
      max-height: 440px;
      overflow: auto;
      color: #1f2328;
    }
    @media (max-width: 640px) {
      body {
        padding: 10px;
      }
      .header,
      form {
        padding: 14px;
      }
      .result {
        margin: 0 14px 14px;
      }
      h1 {
        font-size: 1.15rem;
      }
    }
  </style>
</head>
<body>
  <main class="panel">
    <section class="header">
      <h1>Whois Service</h1>
      <div class="subtitle">Enter a domain to get raw whois output.</div>
    </section>
    <form method="post">
      <label for="domain">Domain</label>
      <input id="domain" name="domain" type="text" placeholder="example.com" value="<?= htmlspecialchars($domain, ENT_QUOTES, 'UTF-8') ?>" required>
      <button type="submit">Run Whois</button>
    </form>
    <?php if ($output !== ''): ?>
      <section class="result">
        <p class="result-title">Lookup Result</p>
        <pre><?= htmlspecialchars($output, ENT_QUOTES, 'UTF-8') ?></pre>
      </section>
    <?php endif; ?>
  </main>
</body>
</html>
