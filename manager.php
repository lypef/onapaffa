<?php include 'func/header.php' ?>
  swqdwdqwdwqdwq<br>
  swqdwdqwdwqdwq<br>
  dwq<br>swqdwdqwdwqdwq<br>swqdwdqwdwqdwq<br>swqdwdqwdwqdwq<br>swqdwdqwdwqdwq<br>
  Aqui va el contenido
  dwq<br>swqdwdqwdwqdwq<br>swqdwdqwdwqdwq<br>swqdwdqwdwqdwq<br>swqdwdqwdwqdwq<br>
  <br>
<?php include 'func/footer.php' ?>
<script>

    if (getUrlVars()["nopermitido"])
    {
        Metro.notify.create("Este usuario no cuenta con los permisos necesarios", "<span class='mif-cross'></span> SIN PERMISOS", {cls: "alert"});
    }

    function getUrlVars() {
      var vars = {};
      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
      vars[key] = value;
      });
      return vars;
    }
</script>
