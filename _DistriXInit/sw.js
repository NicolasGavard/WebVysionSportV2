self.addEventListener('fetch', function (event) {
  console.log("Hello I'm in the SW !");
  event.respondWith(
      fetch(event.request).then(function(networkResponse) {
          return networkResponse;
      })
  );
});