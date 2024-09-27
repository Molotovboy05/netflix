<html>
  <head>
    <title>Custom Search JSON API Example</title>
  </head>
  <body>
    <div id="content"></div>
    <script>
      function hndlr(response) {
        for (var i = 0; i < response.items.length; i++) {
          var item = response.items[i];
          // Affiche le titre des résultats
          document.getElementById("content").append(
            document.createElement("br"),
            document.createTextNode(item.title)
          );
        }
      }
    </script>
    <!-- Requête pour le terme 'programmation' -->
    <script src="https://www.googleapis.com/customsearch/v1?key=AIzaSyDHw4EeQJQIF-LfXYvWxsX7qCPWSdvP6rw&cx=745799fabd2ae47e9&q=programmation&callback=hndlr">
    </script>
  </body>
</html>
