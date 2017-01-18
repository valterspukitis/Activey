
<script>

function updateBox() {
        var xmlhttp;
        <?php echo 'var turn = "'. $_SESSION['turn'].'";'; ?>

    if(window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.open("GET", "update.php?turn=" + turn, true);
    xmlhttp.send();
    xmlhttp.onreadystatechange = function() {
        if(xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if(xmlhttp.response==1){
                location.reload();
            }
        }
    }
}
</script>
