

           // Obtendo a data atual
           var dataAtual = new Date()

           // Convertendo a data para o formato 'ano-mes-dia'
           var ano = dataAtual.getFullYear();
           var mes = ('0' + (dataAtual.getMonth() + 1)).slice(-2);  // Adiciona um zero à esquerda se o mês for menor que 10
           var dia = ('0' + dataAtual.getDate()).slice(-2);  // Adiciona um zero à esquerda se o dia for menor que 10
     
           var dataFormatada = ano + '-' + mes + '-' + dia;


           document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'dayGridMonth',
              locale: 'pt',
              headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
              },
              locale: 'pt',
              initialDate: dataFormatada,
              navLinks: true,
              selectable: true,
              selectMirror: true,
              editable: true,
              dayMaxEvents: true,
              events: 'listar_eventos.php',
              eventClick: function (info) {
                console.log(info);
                const modal = new bootstrap.Modal(document.getElementById('modalTop'));
                modal.show();

            
            
                document.getElementById('vtitle').innerText = info.event.title;
                document.getElementById('vstart').innerText = info.event.start.toLocaleString();
                document.getElementById('vend').innerText = info.event.end.toLocaleString();
                
                document.getElementById('vescola').innerText = info.event.extendedProps.escola;
                document.getElementById('vturma').innerText = info.event.extendedProps.turma;
                document.getElementById('vdescricao').innerText = info.event.extendedProps.descricao;
              
                
              }
            });
          
            calendar.render();
            const btnEdit = document.getElementById('btnEdit');
            btnEdit.addEventListener('click', function () {
              document.getElementById("visualizar").style.display="none";
              document.getElementById("edit_event").style.display="block";
            })


            var myModal = new bootstrap.Modal(document.getElementById('modalTop'));
            myModal._element.addEventListener('hidden.bs.modal', function () {
              document.getElementById("edit_event").style.display="none";
              document.getElementById("visualizar").style.display="block";
                
            });

          });


       
        


          