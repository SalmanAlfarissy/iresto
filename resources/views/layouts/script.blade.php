<!-- Required vendors -->
<script src="{{ asset('admin/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('admin/vendor/chart.js/Chart.bundle.min.js') }}"></script>
<!-- Apex Chart -->
<script src="{{ asset('admin/vendor/apexchart/apexchart.js') }}"></script>

<!-- Datatable -->
<script src="{{ asset('admin/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/js/plugins-init/datatables.init.js') }}"></script>

<script src="{{ asset('admin/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>

<script src="{{ asset('admin/vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>

<script src="{{ asset('admin/js/custom.min.js') }}"></script>
<script src="{{ asset('admin/js/dlabnav-init.js') }}"></script>
{{-- <script src="admin/js/demo.js"></script>
<script src="admin/js/styleSwitcher.js"></script> --}}
@stack('custom-script')
