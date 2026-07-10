<?php
declare(strict_types=1);
session_start();

$data = require __DIR__ . '/config.php';
$site       = $data['site'];
$about      = $data['about'];
$skills     = $data['skills'];
$projects   = $data['projects'];
$experience = $data['experience'];
$contact    = $data['contact'];

$flashStatus  = $_SESSION['contact_status']  ?? null;
$flashMessage = $_SESSION['contact_message'] ?? null;
unset($_SESSION['contact_status'], $_SESSION['contact_message']);

function e(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($site['title']) ?></title>
<meta name="description" content="<?= e($site['tagline']) ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;500;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="editor">

  <!-- Fake editor titlebar -->
  <header class="titlebar">
    <div class="dots" aria-hidden="true"><span></span><span></span><span></span></div>
    <div class="filepath">~/portfolio/<span class="filepath-file">index.php</span></div>
    <div class="status-pill status-<?= e($site['status']) ?>">
      <span class="status-dot" aria-hidden="true"></span>
      <?= $site['status'] === 'available' ? 'Available for work' : 'Not currently available' ?>
    </div>
  </header>

  <div class="editor-body">

    <!-- Gutter: line numbers act as a visual thread down the whole page -->
    <div class="gutter" aria-hidden="true">
      <span style="--l:1">001</span>
      <span style="--l:2">014</span>
      <span style="--l:3">028</span>
      <span style="--l:4">041</span>
      <span style="--l:5">059</span>
      <span style="--l:6">077</span>
    </div>

    <main class="code">

      <!-- ============ HERO ============ -->
      <section class="line-block" id="top">
        <p class="comment">/**</p>
        <h1 class="hero-name"><?= e($site['name']) ?></h1>
        <p class="comment">&nbsp;* <span class="kw">const</span> role = <span class="str">"<?= e($site['role']) ?>"</span></p>
        <p class="tagline"><?= e($site['tagline']) ?></p>
        <p class="comment">&nbsp;*/</p>
        <nav class="hero-nav">
          <a href="#about">about</a>
          <a href="#skills">skills</a>
          <a href="#projects">projects</a>
          <a href="#experience">experience</a>
          <a href="#contact" class="hero-nav-cta">contact →</a>
        </nav>
      </section>

      <!-- ============ ABOUT ============ -->
      <section class="line-block" id="about">
        <h2 class="section-title"><span class="kw">function</span> about() {</h2>
        <div class="indent">
          <?php foreach ($about as $paragraph): ?>
            <p><?= e($paragraph) ?></p>
          <?php endforeach; ?>
        </div>
        <p class="brace">}</p>
      </section>

      <!-- ============ SKILLS ============ -->
      <section class="line-block" id="skills">
        <h2 class="section-title"><span class="kw">const</span> skills = {</h2>
        <div class="indent skills-grid">
          <?php foreach ($skills as $group => $items): ?>
            <div class="skill-group">
              <p class="skill-key"><?= e($group) ?>:</p>
              <ul class="skill-chips">
                <?php foreach ($items as $item): ?>
                  <li><?= e($item) ?></li>
                <?php endforeach; ?>
              </ul>
            </div>
          <?php endforeach; ?>
        </div>
        <p class="brace">}</p>
      </section>

      <!-- ============ PROJECTS ============ -->
      <section class="line-block" id="projects">
        <h2 class="section-title"><span class="kw">const</span> projects = [</h2>
        <div class="indent project-grid">
          <?php foreach ($projects as $project): ?>
            <article class="project-card">
              <div class="project-head">
                <h3><?= e($project['name']) ?>()</h3>
                <span class="project-status status-<?= e($project['status']) ?>">
                  <?= e($project['status']) ?>
                </span>
              </div>
              <p><?= e($project['description']) ?></p>
              <ul class="tag-list">
                <?php foreach ($project['tags'] as $tag): ?>
                  <li><?= e($tag) ?></li>
                <?php endforeach; ?>
              </ul>
              <a class="project-link" href="<?= e($project['link']) ?>" target="_blank" rel="noopener">
                view source →
              </a>
            </article>
          <?php endforeach; ?>
        </div>
        <p class="brace">]</p>
      </section>

      <!-- ============ EXPERIENCE — git log signature ============ -->
      <section class="line-block" id="experience">
        <h2 class="section-title">$ git log <span class="str">--experience</span></h2>
        <div class="indent">
          <ol class="git-log">
            <?php foreach ($experience as $commit): ?>
              <li class="commit">
                <span class="commit-hash"><?= e($commit['hash']) ?></span>
                <div class="commit-body">
                  <p class="commit-message"><?= e($commit['message']) ?></p>
                  <p class="commit-meta"><?= e($commit['role']) ?> · <?= e($commit['company']) ?> · <?= e($commit['dates']) ?></p>
                </div>
              </li>
            <?php endforeach; ?>
          </ol>
        </div>
      </section>

      <!-- ============ CONTACT — terminal ============ -->
      <section class="line-block" id="contact">
        <h2 class="section-title">$ ./contact --send</h2>
        <div class="indent">
          <div class="terminal">
            <?php if ($flashStatus): ?>
              <p class="flash flash-<?= e($flashStatus) ?>"><?= e($flashMessage) ?></p>
            <?php endif; ?>
            <form action="contact-handler.php" method="POST" class="terminal-form" novalidate>
              <label>
                <span class="prompt">name</span>
                <input type="text" name="name" maxlength="100" required>
              </label>
              <label>
                <span class="prompt">email</span>
                <input type="email" name="email" maxlength="150" required>
              </label>
              <label class="label-block">
                <span class="prompt">message</span>
                <textarea name="message" rows="4" maxlength="2000" required></textarea>
              </label>
              <!-- honeypot, hidden from real users via CSS -->
              <label class="honeypot" aria-hidden="true">
                <span>website</span>
                <input type="text" name="website" tabindex="-1" autocomplete="off">
              </label>
              <button type="submit">run send()</button>
            </form>
            <p class="terminal-alt">
              or reach me directly at
              <a href="mailto:<?= e($contact['email']) ?>"><?= e($contact['email']) ?></a>
            </p>
          </div>
        </div>
      </section>

    </main>
  </div>

  <footer class="editor-statusbar">
    <div class="statusbar-left">
      <a href="<?= e($contact['github']) ?>" target="_blank" rel="noopener">GitHub</a>
      <a href="<?= e($contact['linkedin']) ?>" target="_blank" rel="noopener">LinkedIn</a>
    </div>
    <div class="statusbar-right">UTF-8 · PHP <?= e(PHP_VERSION) ?> · © <?= date('Y') ?></div>
  </footer>

</div>

<script src="assets/script.js"></script>
</body>
</html>
