<?php include 'func/header.php' ?>
<script>

    if (getUrlVars()["nopermitido"])
    {}else {
        location.href = "gest_titulares.php?pagina=1";
    }

    function getUrlVars() {
      var vars = {};
      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
      vars[key] = value;
      });
      return vars;
    }
</script>
<p>Este usuario no cuenta con los permisos necesarios para realizar el proceso</p>
<?php include 'func/footer.php' ?>
<script>

    if (getUrlVars()["nopermitido"])
    {
        Metro.notify.create("Este usuario no cuenta con los permisos necesarios", "<span class='mif-cross'></span> SIN PERMISOS", {cls: "alert"});
        document.getElementById("txt").innerHTML = "Paragraph changed!";
    }

    function getUrlVars() {
      var vars = {};
      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
      vars[key] = value;
      });
      return vars;
    }
</script>
