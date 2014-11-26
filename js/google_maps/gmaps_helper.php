<script>
 
 function sendValue(value)
{
    var parentLat = <?php echo json_encode($_GET['info_la']); ?>;
    window.opener.updateMarkerPosition2(parentLat, value);
    window.close();
}
    </script>

