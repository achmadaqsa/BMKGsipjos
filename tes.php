<script src="js/jquery-3.5.1.js"></script>	
	<script src="js/jquery.autocomplete.min.js"></script>
	<script type="text/javascript">
    $(document).ready(function() {
        // Selector input yang akan menampilkan autocomplete.
        $( "#buah" ).autocomplete({
            serviceUrl: "source.php",   // Kode php untuk prosesing data
            dataType: "JSON",           // Tipe data JSON
            onSelect: function (suggestion) {
                $( "#buah" ).val("" + suggestion.buah);
            }
        });
    })
	</script>