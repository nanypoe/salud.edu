<!-- Footer -->
<footer class="footer mt-auto">
    <div class="copyright bg-white">
        <p>
            &copy; <span id="copy-year"></span> Copyright - Todos los Derechos Reservados - Salud.Edu
        </p>
    </div>
    <script>
        var d = new Date();
        var year = d.getFullYear();
        document.getElementById("copy-year").innerHTML = year;
    </script>
</footer>

</div>
</div>

</body>
<!--INCLUYENDO SCRIPTS-->


<!--jQuery-->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!--Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!--SimpleBar-->
<script src="<?= PLANTILLA ?>plugins/simplebar/simplebar.min.js"></script>

<!--HotKeys-->
<script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>

<!--ApexCharts-->
<script src="<?= PLANTILLA ?>plugins/apexcharts/apexcharts.js"></script>

<!--DataTables-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script
    src="https://cdn.datatables.net/v/dt/jszip-3.10.1/dt-2.1.3/af-2.7.0/b-3.1.1/b-colvis-3.1.1/b-html5-3.1.1/b-print-3.1.1/cr-2.0.3/fc-5.0.1/fh-4.0.1/r-3.0.2/datatables.min.js"></script>

<!--jVectorMap-->
<script src="<?= PLANTILLA ?>plugins/jvectormap/jquery-jvectormap-2.0.3.min.js"></script>
<script src="<?= PLANTILLA ?>plugins/jvectormap/jquery-jvectormap-world-mill.js"></script>
<script src="<?= PLANTILLA ?>plugins/jvectormap/jquery-jvectormap-us-aea.js"></script>

<!--DateRangePicker-->
<script src="<?= PLANTILLA ?>plugins/daterangepicker/moment.min.js"></script>
<script src="<?= PLANTILLA ?>plugins/daterangepicker/daterangepicker.js"></script>
<script>
    jQuery(document).ready(function () {
        jQuery('input[name="dateRange"]').daterangepicker({
            autoUpdateInput: false,
            singleDatePicker: true,
            locale: {
                cancelLabel: 'Clear'
            }
        });
        jQuery('input[name="dateRange"]').on('apply.daterangepicker', function (ev, picker) {
            jQuery(this).val(picker.startDate.format('MM/DD/YYYY'));
        });
        jQuery('input[name="dateRange"]').on('cancel.daterangepicker', function (ev, picker) {
            jQuery(this).val('');
        });
    });
</script>

<!--Quill-->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- Toaster
<script src="<?= PLANTILLA ?>plugins/toaster/toastr.min.js"></script> -->

<!--Mono, Map & Custom-->
<script src="<?= PLANTILLA ?>js/mono.js"></script>

<script src="<?= PLANTILLA ?>js/map.js"></script>
<script src="<?= PLANTILLA ?>js/custom.js"></script>

<!--Sweet Alert2-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!--Complexify-->
<script src="<?= PLANTILLA ?>plugins/complexify/jquery.complexify.js"></script>

<!--Select2-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- nProgress -->
<script src="<?= PLANTILLA ?>plugins/nprogress/nprogress.js"></script>



<!--Funciones JS-->
<script src="<?= PLANTILLA ?>js/funciones.js"></script>

</html>