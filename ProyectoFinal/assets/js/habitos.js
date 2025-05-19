document.addEventListener("DOMContentLoaded", () =>{
    const id_usuario = idUsuario;
    cargarHabitos();

    //Listener para agregar habito
    document.getElementById("formHabito").addEventListener("submit", function(e){
        e.preventDefault();

        const data = {
            id_usuario: id_usuario,
            nombre: this.nombre.value,
            frecuencia: this.frecuencia.value
        };

        fetch("../../home/habitos/registrar.php", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify(data)
        }).then(res => res.json()).then(resp => {
            if(resp.success){
                this.reset();
                bootstrap.Modal.getInstance(document.getElementById("modalHabitos")).hide();
                cargarHabitos();
            }
        });
    });

    //Listener para editar habitos
    document.getElementById("formEditarHabito").addEventListener("submit", function(e){
        e.preventDefault();

        const data = {
            id: this.edit_id.value,
            nombre: this.edit_nombre.value,
            frecuencia: this.edit_frecuencia.value
        };

        fetch("../../home/habitos/editar.php", {
            method: "POST",
            headers:{"Content-Type": "application/json"},
            body: JSON.stringify(data)
        }).then(res => res.json()).then(resp => {
            if(resp.success){
                bootstrap.Modal.getInstance(document.getElementById("modalEditarHabito")).hide();
                cargarHabitos();
            }else{
                console.log("Error al editar: ", resp.error);
            }
        });
    });
});

//funcion para cargar hábitos desde la base de datos
function cargarHabitos(){
    fetch(`../../home/habitos/listar.php?id_usuario=${idUsuario}`).then(res => res.json()).then(habitos => {
        console.log("Hábitos cargados:", habitos);
        const lista = document.getElementById("listadoHabitos");
        lista.innerHTML = "";

        if(habitos.length === 0){
            lista.innerHTML = "<p>No tienes hábitos registrados. </p>";
            return;
        }

    //Funcion for que crea tarjetas para cada hábito
        habitos.forEach(h => {
            console.log("Hábito:", h);
            const div = document.createElement("div");
            div.className = "col-md-4";
            div.innerHTML = `
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">${h.nombre}</h5>
                        <p class="card-text"><b>Frecuencia:</b> ${h.frecuencia}</p>
                        <button class="btn btn-outline-danger btn-sm" onclick="eliminarHabito(${h.id})">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                        <button class="btn btn-outline-primary btn-sm me-2" onclick="editarHabito(${h.id}, '${h.nombre}', '${h.frecuencia}')">
                            <i class="bi bi-pencil"></i> Editar
                        </button>
                        <button class="btn btn-outline-success btn-sm me-2" onclick="registrarProgreso(${h.id})">
                            <i class="bi bi-check-circle"></i> Hecho hoy
                        </button>
                    </div>
                </div>
            `;
                lista.appendChild(div);
        });
    });
}

//Funcion para eliminar habitos por su 'id'
eliminarHabito = function(id){
    console.log("Intentando eliminar el hábito con ID:", id);

    fetch("../../home/habitos/eliminar.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id_habito: id })
    }).then(res => res.json()).then(resp => {
        console.log("Respuesta del servidor:", resp);
        if (resp.success) {
            console.log("Hábito eliminado correctamente.");
            cargarHabitos();
        }else{
            console.error("Error al eliminar:", resp.error);
        }
    })
    .catch(err => {
        console.error("Error en la solicitud:", err);
    });
}

//Funcion para editar habitos
editarHabito = function(id, nombre, frecuencia){
    document.getElementById("edit_id").value = id;
    document.getElementById("edit_nombre").value = nombre;
    document.getElementById("edit_frecuencia").value =frecuencia;

    const modal = new bootstrap.Modal(document.getElementById("modalEditarHabito"));
    modal.show();
}

//Funcion para registrar progreso 
registrarProgreso = function(id){
    fetch("../../home/habitos/progreso.php", {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify({id:id})
    }).then(res => res.json()).then(resp => {
        if(resp.success){
            alert("¡Dias de Racha: " + resp.racha + " 🔥!");
            cargarHabitos();
        }else{
            alert(resp.mensaje || "Error al registrar el progreso.");
        }
    })
}