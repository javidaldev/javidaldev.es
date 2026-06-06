const navigation = document.querySelector('nav');
window.addEventListener('scroll', () => {
    navigation.classList.toggle('scrolled', window.scrollY > 20);
});

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
            const res  = await fetch('enviar.php', { method: 'POST', body: new FormData(contactForm) });
            const data = await res.json();
            if (!data.ok) throw new Error();
            msg.textContent = 'Mensaje enviado. Te respondo pronto.';
            msg.className = 'form-msg ok';
            contactForm.reset();
        } catch {
            msg.innerHTML = 'Algo ha fallado. Escríbeme a <a href="mailto:hola@javidaldev.es">hola@javidaldev.es</a>.';
            msg.className = 'form-msg error';
        } finally {
            btn.disabled = false;
            btn.textContent = text;
        }
    });
}