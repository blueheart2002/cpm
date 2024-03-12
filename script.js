// JavaScript code for dynamic functionalities
// Poți folosi AJAX sau fetch pentru a încărca conținut dinamic, cum ar fi calendarul și calculatorul

// Simulare a funcționalității de selectare a categoriei de întâlnire și calculare a costului
document.addEventListener("DOMContentLoaded", function() {
    // Simulare a selectării categoriei de întâlnire
    document.getElementById("meeting-category").addEventListener("change", function() {
        var selectedCategory = this.value;
        // Aici poți face ceva cu categoria selectată, de exemplu, actualizarea altor elemente în pagină
        console.log("Categorie selectată:", selectedCategory);
    });

    // Simulare a funcționalității de calculare a costului întâlnirii
    document.getElementById("calculate-btn").addEventListener("click", function() {
        // Obțineți datele introduse de utilizator pentru calcul
        var numParticipants = parseInt(document.getElementById("num-participants").value);
        var duration = parseInt(document.getElementById("duration").value);

        // Calculați costul întâlnirii (exemplu simplificat)
        var cost = numParticipants * duration * 10; // Pretul per unitate (valoare arbitrara)

        // Afișați costul într-un element HTML
        document.getElementById("meeting-cost").innerText = "Costul întâlnirii: " + cost + " lei";

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
          
            var calendar = new FullCalendar.Calendar(calendarEl, {
              initialView: 'timeGridWeek', // Afișează calendarul în modul săptămânal
              slotDuration: '00:30:00', // Durata fiecărui interval de timp (30 de minute)
              allDaySlot: false, // Nu afișa sloturi pentru întreaga zi
              nowIndicator: true, // Afișează o linie pentru ora curentă
              headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'timeGridWeek,timeGridDay' // Afișează butoane pentru comutarea între modul săptămânal și cel zilnic
              },
              height: 'auto', // Înălțimea calendarului se va ajusta automat
              events: [
                // Aici poți adăuga evenimente predefinite, dacă dorești
              ]
            });
          
            calendar.render(); // Desenează calendarul
          });

          
    });
});
