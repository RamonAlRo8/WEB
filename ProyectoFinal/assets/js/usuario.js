document.addEventListener("DOMContentLoaded", () => {
    fetch("../../home/usuarios/datos.php?id_usuario=" + idUsuario).then(res => res.json()).then(data => {
        document.getElementById("rachaMax").innerText = data.rachaMaxima + " 🔥";
        document.getElementById("habitosCompletados").innerText = data.habitosCompletados + " ✅";
        document.getElementById("habitosActivos").innerText = data.habitosCompletados;
        document.getElementById("insigniaNombre").innerText = data.insignia;
    });

    //EDICION DE PERFIL
    document.getElementById("formEditarPerfil").addEventListener("submit", function(e){
        e.preventDefault();

        const data = {
            id_usuario: idUsuario,
            nombre: this.nombre.value,
            password: this.password.value
        };

        fetch("../../home/usuarios/editar.php", {
            method: "POST",
            headers: {"Content-Type": "application/json"},
            body: JSON.stringify(data)
        }).then(res => res.json()).then(data => {
            if(data.success){
                alert("✅ Perfil actualizado");
                location.reload()
            }else{
                alert("❌ Error al actualizar.");
            }
        });
    });
});

