// JavaScript para el buscador y el botón de generar factura
(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        var searchBar = document.querySelector('.light-table-filter');
        var rows = document.querySelectorAll('.table-id tbody tr');
        var generarFacturaBtn = document.querySelector('#generarFacturaBtn');
        var generarFacturaSubmit = document.querySelector('#generarFacturaSubmit'); // Nuevo: Seleccionamos el botón oculto
        var buscarVentaForm = document.getElementById('buscarVentaForm');

        // Función para filtrar las filas de la tabla según el término de búsqueda
        searchBar.addEventListener('keyup', function(event) {
            var searchTerm = event.target.value.toLowerCase();

            rows.forEach(function(row) {
                var cells = row.querySelectorAll('td');
                var found = false;

                cells.forEach(function(cell) {
                    var text = cell.textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        found = true;
                    }
                });

                if (found) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Función para enviar el formulario de búsqueda al hacer clic en el botón de generar factura
        generarFacturaBtn.addEventListener('click', function() {
            buscarVentaForm.submit();
        });

    
    });
})();
