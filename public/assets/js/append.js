$('.add').click(function() {
    var th = $(this).closest('.wrap').find('.count');
    th.val(+th.val() + 1);
});
$('.sub').click(function() {
    var th = $(this).closest('.wrap').find('.count');
    if (th.val() > 1) th.val(+th.val() - 1);
});
var d = new Date();

var month = d.getMonth() + 1;
var day = d.getDate();

var current_date = d.getFullYear() + '-' +
    (month < 10 ? '0' : '') + month + '-' +
    (day < 10 ? '0' : '') + day;
// alert(current_date);

//*****************
// code of appending div on counter click
//*****************
$(document).ready(function() {
    // let field = ;

    let fields = [1]
    var warn = 0;
    function renderFields() {
        warn++;
        $("#fields").append(`<div id='${warn}' class="append-section">
        <div class="row">
        <div class="col-md-12">
             <div class="input-bg-preview calendar">
                   <label class="lb-start-date w-100 m-0"> Start Date Event</label>
                   <div class="input-append date form_datetime" data-date="${current_date}">
                      <input size="16" type="text" value="" id="create_event_date" class="frt create_event_date" readonly name="start_dt[]" required>
                      <span class="add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                   </div>
          </div>
          <label id='start_date_warn${warn}' style='color:red;display:none'>Start date required*</label>
          </div>
          </div>
  
          </div>`);
        // document.getElementById('fields').innerHTML = fields.map(field => {
        //     return `<div class="append-section">
        //     <div class="row">
        //     <div class="col-md-12">
        //          <div class="input-bg-preview calendar">
        //                <label class="lb-start-date w-100 m-0"> Start Date Event</label>
        //                <div class="input-append date form_datetime" data-date="${current_date}">
        //                   <input size="16" type="text" value="" id="create_event_date" class="frt create_event_date" readonly name="start_dt[]" required>
        //                   <span class="add-on"><i class="fa fa-calendar" aria-hidden="true"></i></span>
        //                </div>
        //       </div>
        //       <label id='start_date_warn${warn}' style='color:red;display:none'>Start date required*</label>
        //       </div>
        //       </div>
      
        //       </div>`
        // }).join('')
    }

    //*****************
    // code to disable button when value is 1
    //*****************    
    if ($('#myInput').val() == 1) {
        $('#sub').attr('disabled', 'disabled')
    } else {
        $('#sub').removeAttr('disabled')
    }
    $(".addCF").click(function() {
        // $('#fields').empty();
        fields = [...fields, fields.length]
        // renderFields()
        if ($('#myInput').val() == 1) {
            $('#sub').attr('disabled', 'disabled')
        } else {
            $('#sub').removeAttr('disabled')
        }
    });
    $(".sub").on('click', function() {
        if ($('#myInput').val() == 1) {
            $('#sub').attr('disabled', 'disabled')
        } else {
            $('#sub').removeAttr('disabled')
        }
        // $("#"+warn).remove();
        warn--;
        // Displaying the value
        // alert($('#myInput').val());
        // fields.pop();
        // renderFields()

    });

});
// $('body').on('click', '.fa.fa-calendar', function() {
//     // alert(   "abc");
//     //*****************
//     // for datetime picker
//     //*****************
//     $(".form_datetime").datetimepicker({
//         pickTime: false,
//         minView:2,
//         format: "dd MM yyyy",
//         autoclose: true,
//         todayBtn: true,
//         startDate: new Date(),
//     });
// });
// $('.form_datetime').datetimepicker({
//     format: "HH:mm",
//     autoclose: true,
//     todayBtn: true,
//     // startDate: "2013-02-14",
//     minuteStep: 10,
//     opens: 'left',
//     startDate: new Date()
// });
//*****************
// hide and show divs on button clicks
//*****************
function handleChange(id, fieldID, show) {
    if (show == "true") {
        $("#" + fieldID).show();
    } else {
        $("#" + fieldID).hide();
    }
};

//*****************
// for simple counter
//*****************
$('body').on('click', '.add-1', function() {
    var th = $(this).closest('.wrap').find('.count');
    th.val(+th.val() + 1);
});
$('body').on('click', '.sub-1', function() {
    var th = $(this).closest('.wrap').find('.count');
    if (th.val() > 1) th.val(+th.val() - 1);
});