   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
   <script  src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('/public/assets/js/bootstrap-datetimepicker.min.js')}}"></script>
     <script src="{{ asset('/public/assets/js/custom.js')}}"></script>
     <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
     @stack('custom-script')
   <!--   <script type="text/javascript">
       function submenu() {
        $('.subMenuGuest').hide(500);
       
      };
     </script> -->
     <script>
       $(document).on('click','.datetime',function(){
         var id = $(this).attr('id'); 
        $("#"+id).timepicker({
            uiLibrary: 'bootstrap4',
            format: 'hh:MM tt'
        });
        });
        $('#endtimepicker').timepicker({
            uiLibrary: 'bootstrap4'
        });
        $(document).on('click','.startdate',function(){
         var id = $(this).attr('id'); 
          $("#"+id).datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-m-dd',
            disableDates:  function (date) {
            const currentDate = new Date();
            return date > currentDate ? true : false;
        }
          });
        });
    </script>
     <script>
$(document).ready(function(){
  $("#guestAccess").click(function(){
    $(".subMenuGuest").toggle(500);
  });
});
</script>
     <script type="text/javascript">
       //*****************
// for data tables
//*****************   
      $(document).ready(function() {
        $('#example').DataTable(
        
        {
        "aLengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "iDisplayLength": 5
        }
        );
      });
      function checkAll(bx) {
        
        var cbs = document.getElementsByTagName('input');
        for(var i=0; i < cbs.length; i++) {
          if(cbs[i].type == 'checkbox') {
          cbs[i].checked = bx.checked;
          }
        }
        $('#selected_events').attr('disabled', 'disabled');
         var selected_events = $(".checkboxes:checked").length;
        //  $("#selected_events").text("Delete ("+selected_events+" Events)");
         if(selected_events>0)
         {
            $("#selected_events").removeAttr('disabled');
         }
      }
     </script>
     <script type="text/javascript">
  $(document).ready(function (e) {
  $("#sortable").sortable();
  $("#sortable").disableSelection();

  $("#btn").on("click", function () {
    var x = "";
    $("#sortable li").each(function (index, element) {
      x = x + $(this).text() + " , ";
    });
    $(".show").text(x);
  });
});
</script>
  </body>
</html>