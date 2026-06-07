<?php ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <!-- Básico -->
  <title>javidaldev — Javier Vidal · Desarrollador full-stack .NET y Angular</title>
  <meta name="description" content="Desarrollador full-stack en Sevilla (C#, .NET, Angular). Mi trabajo no es escribir cada línea, sino que cada línea merezca quedarse.">
  <link rel="canonical" href="https://javidaldev.es/">

  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="javidaldev">
  <meta property="og:locale" content="es_ES">
  <meta property="og:url" content="https://javidaldev.es/">
  <meta property="og:title" content="javidaldev — Artesanía automatizada">
  <meta property="og:description" content="Desarrollador full-stack. Mi trabajo no es escribir cada línea, sino que cada línea merezca quedarse. C# · .NET · Angular.">
  <meta property="og:image" content="https://javidaldev.es/assets/images/og-javidaldev.png">
  <meta property="og:image:secure_url" content="https://javidaldev.es/assets/images/og-javidaldev.png">
  <meta property="og:image:type" content="image/png">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">
  <meta property="og:image:alt" content="javidaldev — Artesanía automatizada. Javier Vidal, desarrollador full-stack.">

  <!-- Twitter / X -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="javidaldev — Artesanía automatizada">
  <meta name="twitter:description" content="Desarrollador full-stack. Mi trabajo no es escribir cada línea, sino que cada línea merezca quedarse. C# · .NET · Angular.">
  <meta name="twitter:image" content="https://javidaldev.es/assets/images/og-javidaldev.png">
  <meta name="twitter:image:alt" content="javidaldev — Artesanía automatizada.">

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@1,9..144,500&family=IBM+Plex+Mono:wght@400;500;600&family=IBM+Plex+Sans:wght@300&display=swap" rel="stylesheet">
  
  <!-- Style -->
  <link rel="stylesheet" href="styles.css">

  <!-- Favicon -->
  <link rel="icon" href="/assets/favicon/favicon.ico" sizes="any">
  <link rel="icon" href="/assets/favicon/favicon.svg" type="image/svg+xml">
  <link rel="apple-touch-icon" href="/assets/favicon/apple-touch-icon.png">

  <!-- Schema.org - ProfilePage / Person -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ProfilePage",
    "@id": "https://javidaldev.es/#profile",
    "url": "https://javidaldev.es/",
    "name": "javidaldev — Javier Vidal",
    "description": "Perfil profesional de Javier Vidal, desarrollador full-stack senior especializado en C#, .NET y Angular.",
    "inLanguage": "es-ES",
    "mainEntity": {
      "@type": "Person",
      "@id": "https://javidaldev.es/#javier-vidal",
      "name": "Javier Vidal",
      "alternateName": "javidaldev",
      "url": "https://javidaldev.es/",
      "image": "https://javidaldev.es/assets/images/javidaldev.png",
      "jobTitle": "Desarrollador full-stack senior",
      "description": "Desarrollador full-stack centrado en software que se entiende, se mantiene y dura. C#, .NET y Angular.",
      "address": {
        "@type": "PostalAddress",
        "addressLocality": "Sevilla",
        "addressRegion": "Andalucía",
        "addressCountry": "ES"
      },
      "knowsAbout": ["C#", ".NET", "Angular", "TypeScript", "Clean Architecture", "CQRS", "Domain-Driven Design", "SQL Server", "Software mantenible"],
      "sameAs": [
        "https://github.com/javidaldev",
        "https://www.linkedin.com/in/javidaldev"
      ]
    }
  }
  </script>
</head>
<body>
  <nav>
    <div class="nav-inner">
      <a href="/" class="brand">javidal<b>dev</b></a>
      <button class="nav-toggle" id="navToggle" aria-label="Abrir menú" aria-expanded="false">≡</button>
      <div class="nav-links" id="navLinks">
        <a href="#estandar">Estándar</a>
        <a href="#metodo">El método</a>
        <a href="#sobre-mi">Sobre mí</a>
        <a href="#trabajemos">Trabajemos</a>
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
      <div class="foot-links">
        <a href="/github" target="_blank" rel="noopener">GitHub</a>
        <a href="/linkedin" target="_blank" rel="noopener">LinkedIn</a>
        <a href="/cv" target="_blank" rel="noopener">Trayectoria</a>
      </div>
      <div class="foot-meta">Javier Vidal · javidaldev.es · © 2026</div>
    </div>
  </footer>

  <script src="main.js"></script>
</body>
</html>
 