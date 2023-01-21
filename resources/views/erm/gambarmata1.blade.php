<input hidden type="text" id="gambarmata1">
<img id="gambarnya1" style="margin-top:50px" width="500px" src="{{ asset('klinik mata losari/bolamata.png') }}"
    onclick="showMarkerArea(this);" />
<canvas hidden id="myCanvas1" width="500px" height="450px" style="border:1px solid #d3d3d3;">
    Your browser does not support the HTML5 canvas tag.
</canvas>
<button class="btn btn-danger mt-2" onclick="batalgambar1()">batal</button>

<script src="{{ asset('vendor/marker/markerjs2.js') }}"></script>
<script>
    function showMarkerArea(target) {
        const markerArea = new markerjs2.MarkerArea(target);
        markerArea.addEventListener("render", (event) => (target.src = event.dataUrl));
        markerArea.show();
    }
    function batalgambar1() {
        ambilgambar1()
    }
    function ambilgambar1() {
            $.ajax({
                type: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                },
                url: '<?= route('gambarmata1') ?>',
                error: function(data) {
                    alert('ok')
                },
                success: function(response) {
                    spinner.hide()
                    $('.gambar1').html(response)
                }
            });
        }
</script>
