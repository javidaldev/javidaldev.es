<?php ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>javidaldev — Desarrollador full-stack (.NET y Angular)</title>
  <meta name="description" content="Artesanía automatizada: mi trabajo no es escribir cada línea, sino que cada línea merezca quedarse. Desarrollador full-stack - C#, .NET, Angular.">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@1,9..144,500&family=IBM+Plex+Mono:wght@400;500;600&family=IBM+Plex+Sans:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <nav>
    <div class="nav-inner">
      <a href="/" class="brand">javidal<b>dev</b></a>
      <div class="nav-links">
        <a href="#estandar">Estándar</a>
        <a href="#metodo">El método</a>
        <a href="#sobre-mi">Sobre mí</a>
        <a href="#trabajemos">Trabajemos</a>
        <a href="/github" target="_blank" rel="noopener">GitHub</a>
        <a href="/linkedin" target="_blank" rel="noopener">LinkedIn</a>
        <a href="#contacto" class="nav-cta">Hablemos</a>
      </div>
    </div>
  </nav>
 
  <?php include __DIR__ . '/sections/hero.html'; ?>
  <?php include __DIR__ . '/sections/estandar.html'; ?>
  <?php include __DIR__ . '/sections/metodo.html'; ?>
  <?php include __DIR__ . '/sections/sobre-mi.html'; ?>
  <?php include __DIR__ . '/sections/trabajemos.html'; ?>
  <?php include __DIR__ . '/sections/contacto.html'; ?>

  <footer>
    <div class="wrap foot-inner">
      <div class="foot-line">Que no dé miedo tocarlo.</div>
      <div class="foot-meta">Javier Vidal · javidaldev.es · © 2026</div>
    </div>
  </footer>

  <script src="main.js"></script>
</body>
</html>
 