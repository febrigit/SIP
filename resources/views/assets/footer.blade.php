<!-- Bootstrap core JavaScript-->
<script src="{{asset('sbadmin/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{asset('sbadmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{asset('sbadmin/js/sb-admin-2.min.js')}}"></script>

<script src="https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('sbadmin/vendor/vue/vue.js') }}"></script>
<script src="{{ asset('sbadmin/vendor/sweetalert/sweetalert.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
<script>
    $('.text-editor').summernote({
        tabsize: 2,
        height: 200
    });
</script>
<script>
    $(function() {
        $('#datatable').DataTable({
            processing: true,
            processing: true,
        });
        $('#datatable2').DataTable({
            processing: true,
            processing: true,
        });
    });
</script>


