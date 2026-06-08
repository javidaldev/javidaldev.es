# javidaldev

Mi web personal: carta de presentación y portfolio. En vivo en **[javidaldev.es](https://javidaldev.es)**.

Este repositorio es su código —lo de detrás de la web: cómo está hecha y cómo se sostiene.

## Cómo está montada

Una sola página, hecha para leerse de un vistazo y mantenerse sin esfuerzo. El stack es el del tamaño del problema: lo justo para que funcione, se entienda y se pueda cambiar sin miedo.

### Estructura

```
public/                  → docroot: lo que se sirve, tal cual
  index.php              → home: ensambla la página y centraliza los datos repetidos
  sections/              → secciones de la HOME, cada una en su fichero
    hero.html · estandar.html · metodo.html · sobre-mi.html · trabajemos.html · contacto.html
  base.css               → capa COMÚN (tokens, reset, nav, botones, eyebrow, footer, grano, reveal)
  styles.css             → estilos ESPECÍFICOS de la home (counter, layout, sec-num…)
  assets/                → CV en PDF, imágenes, favicon y OG
  main.js                → nav, animaciones y formulario (común)
  enviar.php             → endpoint del formulario, parametrizado por origen
  .htaccess              → HTTPS, rutas cortas y servido del CV
.github/workflows/       → despliegue automático
README.md
```

### Stack

HTML, CSS y JavaScript plano, servido tal cual: sin compilar, sin dependencias. PHP pone la parte de servidor sobre el hosting (Apache) donde ya vive el dominio: ensambla la página desde sus piezas, centraliza los datos que se repiten (email, enlaces) y procesa el formulario. El `.htaccess` fuerza HTTPS y resuelve las rutas cortas sin tocar código: `/github` y `/linkedin` como redirects externos, y `/cv` como **rewrite interno** que sirve `assets/docs/cv-javier-vidal.pdf` inline (en el navegador, sin forzar descarga).

### Una página, piezas independientes

`index.php` no es la web: es el índice que la arma. Cada sección vive en su propio fichero dentro de `sections/`, con su HTML y, si lo necesita, su `<style>` al lado. Añadir, mover o quitar una sección es tocar una línea. El visitante recibe una página HTML completa y normal: el ensamblado ocurre en el servidor, no en el navegador.

El CSS se divide en dos capas: `base.css` tiene lo común a toda la web (tokens, reset, nav, botones, footer, animaciones); `styles.css` tiene lo específico de la home (counter de secciones, layout de columnas, tipografía de cabecera). Lo verdaderamente local a una sección viaja con ella en su `<style>`. Mientras cada sección use sus propias clases, no se pisan.

`main.js` es pequeño y de página entera: el menú en móvil, las animaciones de aparición y el envío del formulario.

### Formulario

El envío lo gestiona un endpoint PHP propio con el correo del hosting. El JavaScript se ocupa de la validación y de avisar si algo sale bien o mal —si falla, te da el email directo y no te deja colgado—. Lleva una trampa anti-spam discreta.

### SEO y marca (cabecera)

`index.php` centraliza también las etiquetas de cabecera: `<title>` y `meta description` orientados a marca (`javidaldev` primero), Open Graph, favicon (la `j` del wordmark) y `schema.org` (`ProfilePage` + `Person`).

## Verla en local

No hace falta instalar nada ni compilar. Con PHP basta, apuntando al docroot:

```
php -S localhost:8000 -t public
```

Y abrir `http://localhost:8000` en el navegador.

## Despliegue

Cada push a `main` dispara un GitHub Action que sube `public/` por FTPS al hosting. Las credenciales viven en los *secrets* del repositorio, nunca en el código.
