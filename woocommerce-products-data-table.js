jQuery(document).ready(function($) {

  // Setup - add a text input to each footer cell
    
  $('#product-data-table tfoot th').each( function () {
    var title = $(this).text();
    $(this).html( '<input type="text" placeholder="'+title+' Search" />' );
  } );

  // DataTable
  var table = $('#product-data-table').DataTable({
    "paging":   true,
    "info":     false,
    "scrollY": 380,
    "scrollX": true
  });

  //Apply the search
  table.columns().every( function () {
    var that = this;

    $( 'input', this.footer() ).on( 'keyup change', function () {
      if ( that.search() !== this.value ) {
        that
          .search( this.value )
          .draw();
      }
    } );
  } );
  

})
