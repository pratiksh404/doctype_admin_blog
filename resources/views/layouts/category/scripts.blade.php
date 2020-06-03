<script>
    $(function () {
    $("#datatable").DataTable({
      "responsive": true,
      "autoWidth": true,
      "ordering": true,
      "info": true,
    });

    /* Slug Assign */
        $('#name').change(function(e) {
        $.get('{{ route('check_slug_category') }}',
        { 'name': $(this).val() },
        function( data ) {
        $('#slug').val(data.slug);
        }
        );
        });
        
  });
</script>