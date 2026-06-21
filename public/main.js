const navigation = document.querySelector('nav');
window.addEventListener('scroll', () => {
    navigation.classList.toggle('scrolled', window.scrollY > 20);
});

const navToggle = document.getElementById('navToggle');
const navLinks  = document.getElementById('navLinks');
if (navToggle && navLinks) {
    navToggle.addEventListener('click', () => {
        const open = navLinks.classList.toggle('open');
        navToggle.setAttribute('aria-expanded', String(open));
        navToggle.setAttribute('aria-label', open ? 'Cerrar menú' : 'Abrir menú');
    });
    navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', () => {
        navLinks.classList.remove('open');
        navToggle.setAttribute('aria-expanded', 'false');
        navToggle.setAttribute('aria-label', 'Abrir menú');
    }));
}

const observable = new IntersectionObserver(
    (entries) => entries.forEach(item => {
        if (item.isIntersecting) {
            item.target.classList.add('in');
            observable.unobserve(item.target);
        }
    }),
    {
        threshold: 0.12,
        rootMargin: '0px 0px -8% 0px'
    }
);
document.querySelectorAll('.reveal').forEach(item => observable.observe(item));

const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn  = document.getElementById('sendBtn');
        const msg  = document.getElementById('formMsg');
        const text = btn.textContent;

        btn.disabled = true;
        btn.textContent = 'Enviando…';
        msg.textContent = '';
        msg.className = 'form-msg';

        try {
            const res  = await fetch(contactForm.action, { method: 'POST', body: new FormData(contactForm) });
            const data = await res.json();

            if (data.ok) {
                msg.textContent = contactForm.elements.origen?.value === 'diseno-web'
                    ? 'Revisa tu correo: te acabo de escribir con los siguientes pasos. Si no lo ves, mira la carpeta de spam.'
                    : 'Mensaje recibido. Lo leo y te escribo en cuanto pueda — normalmente en menos de 24 horas.';
                msg.className = 'form-msg ok';
                contactForm.reset();
            } else if (res.status === 400) {
                msg.textContent = 'Échale un ojo: falta algún campo o el email no está bien.';
                msg.className = 'form-msg validation';
            } else {
                throw new Error();
            }
        } catch {
            msg.innerHTML = 'Algo ha fallado y no se ha podido enviar. Escríbeme directo a <a href="mailto:hola@javidaldev.es">hola@javidaldev.es</a> y así me aseguro de que me llega.';
            msg.className = 'form-msg error';
        } finally {
            btn.disabled = false;
            btn.textContent = text;
        }
    });
}