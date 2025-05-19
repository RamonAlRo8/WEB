var graficoHabitos = null;

document.addEventListener("DOMContentLoaded", () => {
    fetch("../../home/progreso/datos.php?id_usuario=" + idUsuario).then(res => res.json()).then(data =>{
        const ctx = document.getElementById('graficoHabitos').getContext('2d');

        if(graficoHabitos !== null){
            graficoHabitos.destroy();
        }

        graficoHabitos = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: data.fechas,
                datasets: data.habitos.map(h => ({
                    label: h.nombre,
                    data: h.valores,
                    backgroundColor: '#9b59b6',
                }))
            },
            options: {
                responsive: true,
                scales: {
                    y: {beginAtZero: true, stepSize: 1}
                }
            }
        });

        //Se muestran los valores
        if(data.resumen){
            document.getElementById("totalCompletados").innerText = data.resumen.totalCompletados;
            document.getElementById("rachaMaxima").innerText = data.resumen.rachaMaxima + " 🔥";
            document.getElementById("habitoConstante").innerText = data.resumen.habitoConstante && data.resumen.habitoConstante !== "" ? `⭐ ${data.resumen.habitoConstante}`: "Sin Habitos";
        }
    });
});

