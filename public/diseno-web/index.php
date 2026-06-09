<?php ?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Básico -->
  <title>Diseño web en Sevilla — páginas y tiendas online · javidaldev</title>
  <meta name="description" content="Diseño web para negocios y autónomos en Sevilla: páginas y tiendas online que cargan rápido, se encuentran y no te dejan atado. La hace, de principio a fin, quien responde de ella.">
  <link rel="canonical" href="https://javidaldev.es/diseno-web">
  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:site_name" content="javidaldev">
  <meta property="og:locale" content="es_ES">
  <meta property="og:url" content="https://javidaldev.es/diseno-web">
  <meta property="og:title" content="Diseño web en Sevilla — páginas y tiendas online · javidaldev">
  <meta property="og:description" content="Diseño web para negocios y autónomos en Sevilla: páginas y tiendas online que cargan rápido, se encuentran y no te dejan atado.">
  <!-- TODO: og:image — assets/images/og-diseno-web.png (pendiente de crear) -->

  <!-- Twitter / X -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Diseño web en Sevilla — páginas y tiendas online · javidaldev">
  <meta name="twitter:description" content="Diseño web para negocios y autónomos en Sevilla: páginas y tiendas online que cargan rápido, se encuentran y no te dejan atado.">
  <!-- TODO: twitter:image — pendiente de crear -->

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;1,9..144,400;1,9..144,500&family=IBM+Plex+Mono:wght@400;500;600&family=IBM+Plex+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

  <!-- Style -->
  <link rel="stylesheet" href="/base.css">
  <link rel="stylesheet" href="/diseno-web/diseno-web.css">

  <!-- Favicon -->
  <link rel="icon" href="/assets/favicon/favicon.ico" sizes="any">
  <link rel="icon" href="/assets/favicon/favicon.svg" type="image/svg+xml">
  <link rel="apple-touch-icon" href="/assets/favicon/apple-touch-icon.png">

  <!-- Schema.org - ProfessionalService -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "ProfessionalService",
    "@id": "https://javidaldev.es/diseno-web#service",
    "name": "Diseño web en Sevilla · javidaldev",
    "description": "Diseño web para negocios y autónomos en Sevilla: páginas y tiendas online que cargan rápido, se encuentran y no te dejan atado. La hace, de principio a fin, quien responde de ella.",
    "url": "https://javidaldev.es/diseno-web",
    "provider": {
      "@type": "Organization",
      "@id": "https://javidaldev.es/#javidaldev",
      "name": "javidaldev",
      "url": "https://javidaldev.es"
    },
    "areaServed": [
      { "@type": "Country",             "name": "España" },
      { "@type": "State",               "name": "Andalucía",                  "addressCountry": "ES" },
      { "@type": "AdministrativeArea",  "name": "Provincia de Sevilla",       "addressCountry": "ES" },
      { "@type": "City",                "name": "Sevilla",                    "addressCountry": "ES" },
      { "@type": "City",                "name": "Los Palacios y Villafranca", "addressCountry": "ES" },
      { "@type": "City",                "name": "Dos Hermanas",               "addressCountry": "ES" },
      { "@type": "City",                "name": "Utrera",                     "addressCountry": "ES" },
      { "@type": "City",                "name": "Alcalá de Guadaíra",         "addressCountry": "ES" },
      { "@type": "City",                "name": "Las Cabezas de San Juan",    "addressCountry": "ES" },
      { "@type": "City",                "name": "Lebrija",                    "addressCountry": "ES" }
    ],
    "serviceType": ["Diseño web", "Tiendas online", "WordPress", "WooCommerce", "Mantenimiento web"],
    "inLanguage": "es-ES"
  }
  </script>
</head>
<body class="page-diseno-web">

<nav id="nav">
  <div class="nav-inner">
    <a href="https://javidaldev.es" class="brand">javidal<b>dev</b></a>
    <button class="nav-toggle" id="navToggle" aria-label="Abrir menú" aria-expanded="false">≡</button>
    <div class="nav-links" id="navLinks">
      <a href="#servicios">Qué hago</a>
      <a href="#como-trabajo">Cómo trabajo</a>
      <a href="#contacto" class="nav-cta">Hablemos</a>
    </div>
  </div>
</nav>

<?php include __DIR__ . '/sections/hero.html'; ?>
<?php include __DIR__ . '/sections/problema.html'; ?>
<?php include __DIR__ . '/sections/servicios.html'; ?>
<?php include __DIR__ . '/sections/como-trabajo.html'; ?>
<?php include __DIR__ . '/sections/contacto.html'; ?>

<?php
$foot_line = 'No solo que funcione. Que aguante.';
include __DIR__ . '/../commons/footer.html';
?>

<script src="/main.js"></script>
</body>
</html>
