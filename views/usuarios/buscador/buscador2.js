// JavaScript para el buscador y el botón de generar factura
(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        var searchBar = document.querySelector('.light-table-filter');
        var rows = document.querySelectorAll('.table-id tbody tr');
        var generarFacturaBtn = document.querySelector('#generarFacturaBtn');
        var buscarVentaForm = document.getElementById('buscarVentaForm');
        var idVentaInput = document.getElementById('idVentaInput');

        // Función para filtrar las filas de la tabla según el término de búsqueda en IdVenta
        searchBar.addEventListener('keyup', function(event) {
            var searchTerm = event.target.value.toLowerCase();

            rows.forEach(function(row) {
                var idVentaCell = row.querySelector('td:first-child'); // Asumimos que el IdVenta está en la primera celda
                var text = idVentaCell.textContent.toLowerCase();

                if (text.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Evento para seleccionar una fila y obtener el IdVenta
        rows.forEach(function(row) {
            row.addEventListener('click', function() {
                var idVenta = row.querySelector('td:first-child').textContent.trim(); // Primer hijo (primera celda)
                idVentaInput.value = idVenta;
            });
        });

        // Función para enviar el formulario de búsqueda al hacer clic en el botón de generar factura
        generarFacturaBtn.addEventListener('click', function(event) {
            event.preventDefault();
            buscarVentaForm.submit();
        });
        
    });
})();
