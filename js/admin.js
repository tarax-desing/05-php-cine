let botones_eliminar = document.querySelectorAll(".btn-eliminar");
let botones_modificar = document.querySelectorAll(".btn-modificar");


botones_eliminar.forEach((boton) => {
  boton.addEventListener("click", (event) => {
    let botonSeleccionado = event.currentTarget;
    let id = botonSeleccionado.getAttribute("data-id");
    console.log(id);
    fetch("includes/control_peliculas.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: "id=" + id + "&metodo=delete",
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.success) {
          alert("Registro eliminado");
        } else {
          alert("Error al eliminar: " + data.message);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
        alert("Ocurrió un error al eliminar");
      });
  });
});
botones_modificar.forEach(boton => {
  boton.addEventListener('click', event => {
      let botonSeleccionado = event.currentTarget;
      let id = botonSeleccionado.getAttribute('data-id');

      const form = document.createElement('form');
      form.method = 'post';
      form.action = 'includes/control_peliculas.php';

      const campoId = document.createElement('input');
      campoId.type = 'hidden';
      campoId.name = 'idPelicula';
      campoId.value = id;
      form.appendChild(campoId);

      const campoMetodo = document.createElement('input');
      campoMetodo.type = 'hidden';
      campoMetodo.name = 'metodo';
      campoMetodo.value = 'modificar';
      form.appendChild(campoMetodo);

      document.body.appendChild(form);
      form.submit();

  })
})