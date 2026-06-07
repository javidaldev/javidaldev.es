# javidaldev

Mi web personal: carta de presentación y portfolio. En vivo en **[javidaldev.es](https://javidaldev.es)**.

Este repositorio es lo de detrás: cómo está hecha y cómo se sostiene.

## Cómo está montada

Una sola página, pensada para leerse de un vistazo y mantenerse sin esfuerzo. El stack es el del tamaño del problema: lo justo para que funcione, se entienda y se pueda cambiar sin miedo.

### Estructura

```
public/              → la web (docroot)
  index.php          → arma la página a partir de las secciones
  sections/          → una sección por fichero (hero, estandar, metodo, sobre-mi, trabajemos, contacto)
  assets/            → imágenes
  styles.css         → estilos comunes
  main.js            → nav, animaciones y formulario
  enviar.php         → endpoint del formulario (SMTP vía PHPMailer)
  .htaccess          → redirecciones HTTPS y rutas cortas
.github/workflows/   → despliegue
```

### Stack

HTML, CSS y JavaScript plano: sin compilar, sin dependencias. PHP ensambla la página desde sus secciones, centraliza lo que se repite (email, enlaces) y procesa el formulario, sobre el Apache donde ya vive el dominio. Cada sección es un fichero con su HTML y, si hace falta, su `<style>`; lo común vive en `styles.css` y `main.js`. Añadir o quitar una sección es una línea. El `.htaccess` fuerza HTTPS y resuelve las rutas cortas (`/github`, `/linkedin`, `/cv`).

### Formulario

Endpoint PHP propio con el correo del hosting y una trampa anti-spam discreta. Si el envío falla, te doy el email directo y no te dejo colgado.

## Verla en local

Sin instalar ni compilar nada, solo PHP apuntando al docroot:

```
php -S localhost:8000 -t public
```

## Despliegue

Cada push a `main` dispara un GitHub Action que sube `public/` por FTPS. Las credenciales viven en los *secrets* del repositorio, nunca en el código.