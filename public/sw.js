const CACHE_NAME = 'agendei-v1';
// Coloque APENAS arquivos que você tem CERTEZA que existem no servidor
const assets = [
  '/',
  'index.php' // Remova caminhos de imagens ou CSS que possam estar errados por enquanto
];

self.addEventListener('install', e => {
  e.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      return cache.addAll(assets);
    }).catch(err => console.log("Erro de cache ao instalar: ", err))
  );
});

self.addEventListener('fetch', e => {
  e.respondWith(
    caches.match(e.request).then(res => {
      return res || fetch(e.request);
    }).catch(() => {
        // Se falhar o fetch (ex: offline), não trava o app
    })
  );
});