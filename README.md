# javidaldev
 
Mi web personal: carta de presentación y portfolio. En vivo en **[javidaldev.es](https://javidaldev.es)**.
 
Este repositorio es su código, "lo de detrás de la web": cómo está hecha y cómo se sostiene.
 
## Cómo está montada
 
Una sola página, hecha para leerse de un vistazo y mantenerse sin esfuerzo. El stack es el del tamaño del problema: lo justo para que funcione, se entienda y se pueda cambiar fácilmente.
 
### Estructura
 
```
public/              → la web
  index.php          → estructura principal de la web, ensambla todas su partes
  sections/          → cada sección, en su propio fichero
    hero.html
    estandar.html
    metodo.html
    sobre-mi.html
    trabajemos.html
    contacto.html
  assets/            → CV en PDF e imágenes
  styles.css         → estilos principales y comunes
  main.js            → nav, animaciones y formulario
  enviar.php         → endpoint del formulario (SMTP vía PHPMailer)
  .htaccess          → HTTPS, redirecciones y descarga del CV
.github/workflows/   → despliegue automático
.gitignore           →
README.md            →
```
 
### Stack
 
HTML, CSS y JavaScript plano: sin compilar, sin dependencias. PHP pone la parte de servidor sobre el hosting (Apache) donde ya vive el dominio: ensambla la página desde sus piezas, centraliza los datos que se repiten (email, enlaces) y procesa el formulario. El `.htaccess` fuerza HTTPS y resuelve las rutas cortas (`/github`, `/linkedin`, `/cv`) sin tocar código.

## Verla en local
 
No hace falta instalar nada ni compilar. Con PHP basta, apuntando al docroot:
 
```
php -S localhost:8000 -t public
```
 
Y abrir `http://localhost:8000` en el navegador.
 
## Despliegue
 
Cada push a `main` dispara un GitHub Action que sube `public/` por FTPS al hosting. Las credenciales viven en los *secrets* del repositorio, nunca en el código.
 
