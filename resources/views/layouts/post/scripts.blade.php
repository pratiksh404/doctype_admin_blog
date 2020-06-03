<script type="text/javascript">
    $(function () {
          //Initialize Select2 Elements
          $('.select2').select2()
          //Intialize Summernote Text Editor
          $('.textarea').summernote()
          //Initialize Bootstrap Switch
          $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch('state', $(this).prop('checked'));
          });
         $(document).ready(function(){
        $('#keywords').selectize({
            plugins: ['restore_on_backspace'],
            plugins: ['remove_button'],
            delimiter: ',',
            persist: false,
            valueField: 'keyword',
            labelField: 'keyword',
            searchField: 'keyword',
            options: keywords,
            items : keywords,
            create: function(input,callback) {
                return {
                    keyword: input
                },
                callback({ keyword: input });
            }
        });
    });

    $( document ).ready(function() {
    $('#tags').selectize({
    plugins: ['restore_on_backspace'],
    plugins: ['remove_button'],
    delimiter: ',',
    persist: false,
    valueField: 'tag',
    labelField: 'tag',
    searchField: 'tag',
    options: tags,
    items : tags,
    create: function(input,callback) {
    return {
    tag: input
    },
    callback({ tag: input });
    }
    });
    
    $('#keywords').selectize({
    plugins: ['restore_on_backspace'],
    plugins: ['remove_button'],
    delimiter: ',',
    persist: false,
    valueField: 'keyword',
    labelField: 'keyword',
    searchField: 'keyword',
    options: keywords,
    items : keywords,
    create: function(input,callback) {
    return {
    keyword: input
    },
    callback({ keyword: input });
    }
    });
    });

$('#title').change(function(e) {
  $.get('{{ route('check_slug') }}',
  { 'title': $(this).val() },
  function( data ) {
  $('#slug').val(data.slug);
  }
  ); 
  });

  /* Auto Fillup */
  $('#title').on('keyup',function(){
    $('#post_seo_title').val($('#title').val());
  });

  $('#post_excerpt').on('keyup',function(){
  $('#meta_description').val($('#post_excerpt').val());
  });
  
  });
</script>