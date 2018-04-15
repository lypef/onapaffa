<?php include 'func/header.php' ?>
<br>
<h2 id="inputs">Nuevo titular</h2>
<div class="example">
    <form  action="func/add_titular_action.php" method="POST" enctype="multipart/form-data">
        <input id="_nombre" name="_nombre" type="text" data-role="input" data-prepend="Nombre" placeholder="Escriba nombre completo" required>
        <input id="domicilio" name="domicilio" type="text" data-role="input" data-prepend="Domicilio" placeholder="Domicilio del titular" >
        <input id="cp" name="cp" type="text" data-role="input" data-prepend="Codigo postal" placeholder="Codigo" >
        <input id="telefono" name="telefono" type="text" data-role="input" data-prepend="Telefono" placeholder="Ingrese Telefono" >
        <input id="foto" name="foto" type="file" data-role="file" placeholder="Buscar fotografia" class="mt-2" accept="image/jpeg,image/jpg">
        <div class="p-4 d-flex flex-justify-between border bd-default bg-scheme-secondary">
            <button class="button" style="background-color: #1979ca" ><span class='mif-floppy-disk'></span> Guardar</button>
        </div>
</form>
</div>
<br><br>
<?php include 'func/footer.php' ?>
<script>
      //location.href = "href/welcome.php"
      var error = getUrlVars()["error"];
      if (error)
      {
          Metro.notify.create("Titular NO agregado", "<span class='mif-cross'></span>", {cls: "alert"});
      }

      var success = getUrlVars()["success"];
      if (success)
      {
          Metro.notify.create("Titular agregado", "<span class='mif-checkmark'></span>", {cls: "success"});
      }

      var image = getUrlVars()["error_image"];
      if (image)
      {
          Metro.notify.create("Error al cargar imagen", "<span class='mif-cross'></span>", {cls: "alert"});
      }
        var nombre = getUrlVars()["nombre"].replace("%", " ");
        var domicilio = getUrlVars()["domicilio"].replace("%", " ");
        var cp = getUrlVars()["cp"].replace("%", " ");
        var telefono = getUrlVars()["telefono"].replace("%", " ");

        document.getElementById("_nombre").value = nombre;
        document.getElementById("domicilio").value = domicilio;
        document.getElementById("cp").value = cp;
        document.getElementById("telefono").value = telefono;

      function getUrlVars() {
        var vars = {};
        var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
        });
        return vars;
      }
  </script>
