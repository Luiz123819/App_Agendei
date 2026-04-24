
// Anime header
const btn = document.querySelectorAll('#menu_item');

btn.forEach(link => {
    link.addEventListener('click', function() {
        
        btn.forEach(l => l.classList.remove('active'));
    
        this.classList.add('active');
    });
});