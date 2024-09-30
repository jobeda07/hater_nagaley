$(document).ready( function () {
  var table = $('#example').DataTable({
    drawCallback: function(){
      var api = this.api();
      var records = api.page.info().recordsDisplay;
      var pageMenu = $('div.dataTables_length');
      if (records === 0) {
        pageMenu.hide();
      } else if (pageMenu.css('display') == 'none') {
        pageMenu.show();
      }   
    }
  });
});
