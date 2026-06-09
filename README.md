# javidaldev

Mi web personal: carta de presentación y portfolio. En vivo en **[javidaldev.es](https://javidaldev.es)**.

Este repositorio es su código —lo de detrás de la web: cómo está hecha y cómo se sostiene.

## Cómo está montada

Multipágina sobre el mismo stack: HTML, CSS y JavaScript plano servido tal cual, sin compilar ni depender de nada. PHP ensambla cada página desde sus secciones, centraliza lo que se repite y procesa el formulario, sobre el Apache donde ya vive el dominio.

### Estructura

```
public/                  → docroot: lo que se sirve, tal cual
  index.php              → home: ensambla la página y centraliza los datos repetidos
  sections/              → secciones de la HOME (hero, estandar, metodo, sobre-mi, trabajemos, contacto)
  commons/              → fragmentos comunes incluidos desde cualquier index.php
    footer.html          → footer parametrizado ($foot_line, $foot_links, $foot_meta)
  diseno-web/            → landing /diseno-web
    index.php            → ensambla la landing (<head> y nav propios)
    sections/            → secciones de la landing (hero, problema, servicios, como-trabajo, contacto)
    diseno-web.css       → estilos específicos de la landing
  base.css               → capa común (tokens, reset, counter, nav, botones, eyebrow, footer, reveal)
  styles.css             → estilos específicos de la home (layout columnas, sec-num, sec-title…)
  assets/                → CV en PDF, imágenes, favicon y OG
  main.js                → nav, animaciones y formulario (común a todas las páginas)
  enviar.php             → endpoint del formulario, parametrizado por origen
  .htaccess              → HTTPS, redirecciones y descarga del CV
.github/workflows/       → despliegue automático
README.md
```

### Stack

HTML, CSS y JavaScript plano: sin compilar, sin dependencias. PHP ensambla cada página desde sus secciones, centraliza lo que se repite (email, enlaces) y procesa el formulario. El `.htaccess` fuerza HTTPS y resuelve las rutas cortas: `/github`, `/linkedin` como redirects externos; `/cv` como rewrite interno que sirve el PDF inline; `/diseno-web` con trailing slash canónico.

### Páginas y rutas

| Ruta | Descripción |
|---|---|
| `/` | Home de marca personal (desarrollador full-stack) |
| `/diseno-web` | Landing comercial de diseño web en Sevilla |
| `/cv` | CV en PDF (inline, sin forzar descarga) |
| `/github` | Redirect a GitHub |
| `/linkedin` | Redirect a LinkedIn |

### CSS: tres capas

- **`base.css`** — común a todas las páginas: tokens, reset, counter de secciones, nav, botones, eyebrow, footer, reveal, keyframes.
- **`<página>.css`** — específico de cada página: `styles.css` para la home, `diseno-web/diseno-web.css` para la landing.
- **`<style>` en cada sección** — solo lo verdaderamente local a ese bloque.

Cada página carga `base.css` + su propio CSS de página. Los CSS de página nunca colisionan entre sí; `body.page-home` / `body.page-diseno-web` da scope adicional.

### Formulario

Endpoint PHP propio (`enviar.php`) con el correo del hosting, parametrizado por `origen` (whitelist en servidor: `home`, `diseno-web`…). Honeypot anti-spam. Si el envío falla, muestra el email directo.

### SEO

Cada página tiene su propio `<head>`: title/description/OG orientados a su propósito (marca personal vs. servicio comercial). `schema.org` separado: `ProfilePage + Person` en la home, `ProfessionalService` en la landing.

## Verla en local

Sin instalar ni compilar nada, solo PHP apuntando al docroot:

```
php -S localhost:8000 -t public
```

Home → `http://localhost:8000` · Landing → `http://localhost:8000/diseno-web`

## Despliegue

Cada push a `main` dispara un GitHub Action que sube `public/` por FTPS al hosting. Las credenciales viven en los *secrets* del repositorio, nunca en el código.
