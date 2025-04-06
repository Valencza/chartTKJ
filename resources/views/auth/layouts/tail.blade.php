<script src="{{ asset('/sw.js') }}"></script>
<script>
   if ("serviceWorker" in navigator) {
      navigator.serviceWorker.register("/sw.js").then(
         (registration) => {
            console.log("Service worker registration succeeded:", registration);
         },
         (error) => {
            console.error(`Service worker registration failed: ${error}`);
         },
      );
   } else {
      console.error("Service workers are not supported.");
   }
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.29/dist/sweetalert2.min.js"></script>

</body>

</html>