<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All defaults demo</title>
  <script src="https://unpkg.com/markerjs2/markerjs2.js"></script>
  <script>
    function showMarkerArea(target) {
      const markerArea = new markerjs2.MarkerArea(target);
      markerArea.addEventListener("render", (event) => (target.src = event.dataUrl));
      markerArea.show();
    }
  </script>
</head>
<body>

  <img src="{{ asset('klinik mata losari/klinik mata losari.jpg }}" style="max-width: 600px;" onclick="showMarkerArea(this);" />

</body>
</html>
