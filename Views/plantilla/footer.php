<!-- Footer -->
<footer class="footer mt-auto">
    <div class="copyright bg-white">
        <p>
            &copy; <span id="copy-year"></span> Copyright - Todos los Derechos Reservados - GymBro
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

<!-- Card Offcanvas -->
<div class="card card-offcanvas" id="contact-off">
    <div class="card-header">
        <h2>Contacts</h2>
        <a href="#" class="btn btn-primary btn-pill px-4">Add New</a>
    </div>
    <div class="card-body">

        <div class="mb-4">
            <input type="text" class="form-control form-control-lg form-control-secondary rounded-0"
                placeholder="Search contacts...">
        </div>

        <div class="media media-sm">
            <div class="media-sm-wrapper">
                <a href="user-profile.html">
                    <img src="images/user/user-sm-01.jpg" alt="User Image">
                    <span class="active bg-primary"></span>
                </a>
            </div>
            <div class="media-body">
                <a href="user-profile.html">
                    <span class="title">Selena Wagner</span>
                    <span class="discribe">Designer</span>
                </a>
            </div>
        </div>

        <div class="media media-sm">
            <div class="media-sm-wrapper">
                <a href="user-profile.html">
                    <img src="images/user/user-sm-02.jpg" alt="User Image">
                    <span class="active bg-primary"></span>
                </a>
            </div>
            <div class="media-body">
                <a href="user-profile.html">
                    <span class="title">Walter Reuter</span>
                    <span>Developer</span>
                </a>
            </div>
        </div>

        <div class="media media-sm">
            <div class="media-sm-wrapper">
                <a href="user-profile.html">
                    <img src="images/user/user-sm-03.jpg" alt="User Image">
                </a>
            </div>
            <div class="media-body">
                <a href="user-profile.html">
                    <span class="title">Larissa Gebhardt</span>
                    <span>Cyber Punk</span>
                </a>
            </div>
        </div>

        <div class="media media-sm">
            <div class="media-sm-wrapper">
                <a href="user-profile.html">
                    <img src="images/user/user-sm-04.jpg" alt="User Image">
                </a>

            </div>
            <div class="media-body">
                <a href="user-profile.html">
                    <span class="title">Albrecht Straub</span>
                    <span>Photographer</span>
                </a>
            </div>
        </div>

        <div class="media media-sm">
            <div class="media-sm-wrapper">
                <a href="user-profile.html">
                    <img src="images/user/user-sm-05.jpg" alt="User Image">
                    <span class="active bg-danger"></span>
                </a>
            </div>
            <div class="media-body">
                <a href="user-profile.html">
                    <span class="title">Leopold Ebert</span>
                    <span>Fashion Designer</span>
                </a>
            </div>
        </div>

        <div class="media media-sm">
            <div class="media-sm-wrapper">
                <a href="user-profile.html">
                    <img src="images/user/user-sm-06.jpg" alt="User Image">
                    <span class="active bg-primary"></span>
                </a>
            </div>
            <div class="media-body">
                <a href="user-profile.html">
                    <span class="title">Selena Wagner</span>
                    <span>Photographer</span>
                </a>
            </div>
        </div>

    </div>
</div>

</body>
<!--INCLUYENDO SCRIPTS-->
<!--If lt-IE-9-->
<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<!--nProgress-->
<script src="<?= PLANTILLA ?>plugins/nprogress/nprogress.js"></script>

<!--jQuery-->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<!--Bootstrap-->
<script src="<?=PLANTILLA?>plugins/bootstrap/js/bootstrap.js"></script>

<!--SimpleBar-->
<script src="<?= PLANTILLA ?>plugins/simplebar/simplebar.min.js"></script>

<!--HotKeys-->
<script src="https://unpkg.com/hotkeys-js/dist/hotkeys.min.js"></script>

<!--ApexCharts-->
<script src="<?= PLANTILLA ?>plugins/apexcharts/apexcharts.js"></script>

<!--DataTables-->
<script src="<?=PLANTILLA?>plugins/DataTables/datatables.min.js"></script>

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

<!--Toaster-->
<script src="<?= PLANTILLA ?>plugins/toaster/toastr.min.js"></script>

<!--Mono, Chart, Map & Custom-->
<script src="<?= PLANTILLA ?>js/mono.js"></script>
<script src="<?= PLANTILLA ?>js/chart.js"></script>
<script src="<?= PLANTILLA ?>js/map.js"></script>
<script src="<?= PLANTILLA ?>js/custom.js"></script>

<!--Funciones JS-->
<script src="<?= PLANTILLA ?>js/funciones.js"></script>

</html>