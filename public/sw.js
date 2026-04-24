const CACHE_NAME = 'agendei-v1';
const ASSETS_TO_CACHE = [
  'home.php',
  'index.php',
  'Styles/style.css',
  'Styles/home.css',
  'manifest.json',
  'icon-192.png',
  'icon-512.png'
];

// Instalação e Cache
self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => {
      return cache.addAll(ASSETS_TO_CACHE);
    })
  );
});

// Estratégia: Tenta Rede, se falhar (offline), tenta Cache
self.addEventListener('fetch', event => {
  event.respondWith(
    fetch(event.request).catch(() => {
      return caches.match(event.request);
    })
  );
});