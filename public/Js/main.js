
if ('serviceWorker' in navigator) {
  navigator.serviceWorker.register('sw.js')
    .then(() => console.log("Service Worker registrado!"))
    .catch(err => console.log("Erro ao registrar:", err));
}


// Calendario
const daysContainer = document.getElementById('days');
const monthYear = document.getElementById('monthYear');


let currentDate = new Date();

function renderCalendar() {
    daysContainer.innerHTML = "";
    const year = currentDate.getFullYear();  //pega ano
    const month = currentDate.getMonth();   //pega mes

    monthYear.textContent = currentDate.toLocaleDateString("pt-BR", {
        month: "long", year: "numeric"
    });
    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month + 1, 0).getDate();

    for (let i = 0; i < firstDay; i++) {
        daysContainer.innerHTML += "<div></div>";
    }

    for (let day = 1; day <= lastDate; day++) {
        const div = document.createElement("div");
        div.textContent = day;
        daysContainer.appendChild(div)

          div.onclick = async () =>{
        //Formata data para armazenar no input
        const dataFormatada =`${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
        //Guarda data no input
        document.getElementById('input_data').value = dataFormatada;

        //Agora destaca o dia selecionado no click
        document.querySelectorAll('.days div').forEach(d => d.classList.remove('selected'));
        div.classList.add('selected');

        try {
            //Estou redirecionando o para a pagina que ira fazer a verificacao de horários
            const response = await fetch(`get_horarios_oculpados.php?data=${dataFormatada}`)
            const horariosOculpados = await response.json();
            //Pega os valores do input com os horários
            const selectHours = document.querySelector('select[name="hora"]');
            const options = selectHours.querySelectorAll('option');
            //Compara o valor da opcao com o horario do banco
            horariosOculpados.forEach(horario =>{
                options.forEach(opt =>{
                    if(horario.includes(opt.value)){
                        opt.disabled = true;
                        opt.style.color = 'red';
                        opt.inerText =opt.value + "(Oculpado)";
                    }else{
                        opt.disabled = false;
                        opt.style.color = 'black';
                        opt.inerText =opt.value;
                    }

                });
            });
            document.getElementById('hora_div').style.display='block';
        } catch (error) {
            console.error("Erro ao buscar horários:", error)
        }


    }
    }

  
}

document.getElementById("prev").onclick = () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar();
}
document.getElementById("next").onclick = () =>{
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar();
}

renderCalendar();
//CLICK MENU
    const links = document.querySelectorAll(".nav-bar a i");
const currentUrl = window.location.href;

links.forEach(link => {
  if (link.href === currentUrl) {   
    link.classList.add("active");
  }
});

// Aguarda o DOM carregar
document.addEventListener('DOMContentLoaded', () => {

    // Seleciona todos os botões de cancelar
    const botoesCancelar = document.querySelectorAll('.cancelarConsulta');

    botoesCancelar.forEach(botao => {
        botao.onclick = async function() {
            // Pega o ID que está no data-id do botão
            const idAgendamento = this.getAttribute('data-id');

            // Confirmação para evitar cliques acidentais
            if (confirm("Deseja realmente cancelar esta consulta?")) {
                try {
                    const response = await fetch(`cancelar_agendamento.php?id=${idAgendamento}`);
                    const resultado = await response.json();

                    if (resultado.sucesso) {
                        alert("Consulta cancelada!");
                        // Remove o card da tela visualmente ou recarrega a página
                        location.reload(); 
                    } else {
                        alert("Erro: " + resultado.erro);
                    }
                } catch (error) {
                    console.error("Erro na requisição:", error);
                    alert("Não foi possível conectar ao servidor.");
                }
            }
        };
    });
});

