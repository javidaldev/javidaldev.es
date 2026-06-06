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