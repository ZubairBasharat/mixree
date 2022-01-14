//*****************
// code of appending div on counter click
//*****************
$(document).ready(function() {
$("#start_time_1").click();
$("#start_dt_1").click();
});
var counter = $("#myInput_count").val();
// $(document).ready(function() {
    $('.add-preview').click(function() {
        var th = $(this).closest('.wrap').find('.count');
        th.val(+th.val() + 1);

        addFields();
    });
    $('.sub-preview').click(function() {
        var th = $(this).closest('.wrap').find('.count');
        if ($('#myInput').val()==2) {
            $('#sub').attr('disabled', 'disabled')
        } else {
            $('#sub').removeAttr('disabled')
        }
        th.val(+th.val() - 1);
        $("#fields-1").children("div:last").remove()
    });

    // $('.add-preview').click()
        // let field = ;

    let fields = [1]
    // var counter = 1;
    function addFields() {
        counter = parseInt(counter)+1;
        let locationID = Math.random().toString(36).substring(7);
        $('#fields-1').append(`
                <div class="append-section">
                <div class="input-bg-preview">
                   <label class="lb-start-date w-100 m-0"> Name of Location</label>
                   <input class="name_of_location" onkeyup="addLocation('${locationID}')" id='${locationID}_name' type="" placeholder="" name="name[]" >
                </div>
                <label class="name_of_location_warn" style="color:red;display:none">Name of location required *</label>
                <div class="input-bg-preview mt-12px">
                   <label class="lb-start-date w-100 m-0">Address Location</label>
                   <input class="addresslocation" type="text"  id="pac-input_${counter}" data-id="${counter}" name="location[]" />
                           <input type="hidden" id="lat_1" name="lat_${counter}" >
                           <input type="hidden" id="lang_1" name="lang_${counter}">
                </div>
                <label class="address_location_warn" style="color:red;display:none">Address location required *</label>
                <div class="row mt-20px">
                <div class="col-md-6">
                     <div class="input-bg-preview calendar">
                           <label class="lb-start-date w-100 m-0">Date</label>
                           <div class="input-append date form_datetime" data-date="${current_date}">
                              <input size="16" type="text" style="font-size:13px" data-id="${counter}" value="" id="start_dt_${counter}" class="frt dates startdate" readonly name="start_dt_${counter}" >
                           </div>
                  </div>
                  <label id="select_date_warn_${counter}" style="color:red;display:none">Select date *</label>
                  </div>
      
         <div class="col-md-6">
                     <div class="input-bg-preview calendar">
                           <label class="lb-start-date w-100 m-0"> Start Time Event</label>
                           <div class="input-append date form_datetime-1" data-date="${current_date}">
                              <input size="16" type="text" style="font-size:13px" name="start_time_${counter}" value="" id="start_time_${counter}" class="frt times datetime" readonly name="start_dt_${counter}" required>
                           </div>
                  </div>
                  <label id="select_time_warn_${counter}" style="color:red;display:none">Select Time *</label>
                  </div>
       
         <div class="col-md-4">
                    
                  </div>
                  </div>
             </div>`)
             $("#start_time_"+counter).click();
             $("#start_dt_"+counter).click();
    }
    // renderFields()

    //*****************
    // code to disable button when value is 1
    //*****************
    if ($('#myInput').val() == 1) {
        $('#sub').attr('disabled', 'disabled')
    } else {
        $('#sub').removeAttr('disabled')
    }
    $(".addCF").click(function() {
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

        // Displaying the value
        // alert($('#myInput').val());
        fields.pop();
        renderFields()

    });

    //*****************
    // for datetime picker
    //*****************
    // $('body').on('click', '.fa.fa-calendar', function() {
    // $(".form_datetime").datetimepicker({
    //     pickTime: false,
    //     minView:2,
    //     format: "dd MM yyyy",
    //     autoclose: true,
    //     todayBtn: true,
    //     startDate: new Date(),
    // });
    // });
    //  $('body').on('click', '.fa.fa-clock-o', function() {
    // $(".form_datetime-1").datetimepicker({
    //     pickDate: false,
    // minuteStep: 5,
    // pickerPosition: 'bottom-right',
    // format: 'HH:ii p',
    // autoclose: true,
    // showMeridian: false,
    // startView: 1,
    // maxView: 1,
    // startDate: new Date(),
    // });
    //  });
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

    let locationsArray = [];

    function addLocation(locationID) {
        let name = $("#" + locationID + '_name').val();
        let address = $("#" + locationID + '_address').val();
        let loc = locationsArray.find(loc => loc.id === locationID);
        let location = {
            id: locationID,
        };
        if (loc === undefined) {
            location.name = name;
            location.address = address;
            locationsArray.push(location)
        } else {
            locationsArray.forEach(loc => {
                if (loc.id === locationID) {
                    loc.name = name;
                    loc.address = address
                }
            })
        }
    }

    //*****************
    // getting data to show in preview modal
    //*****************

    $(".btn_preview").click(function() {
        var g_f_name = $('#groom-first_name').val();
        var g_l_name = $('#groom-last_name').val();
        $('#groomName').empty().append(g_f_name + ' ' + g_l_name);

        var b_f_name = $('#bride-first_name').val();
        var b_l_name = $('#bride-last_name').val();
        $('#brideName').empty().append(b_f_name + ' ' + b_l_name);

        let guest_des = $('.guestDescription').val();
        $('#append_guestDescription').empty().append(guest_des);

        let event_name = $('#eventName').val();
        $('#appendTitle').empty().append(event_name);

        $('.div_location').empty()
        locationsArray.forEach(loc => {
            $('.div_location').append(` <
                div >
                <
                p class = "p_chruch_loc" > $ { loc.name } < /p> <
                p class = "p_crunnet_loc" > $ { loc.address } < /p> <
                img src = "/assets/imgs/map.png"
                class = "img_chruch_location" >
                <
                /div>
                `)
        })
    });
    $(document).on("click",".addresslocation",function() {
        var data_id = $(this).data('id');
        initAutocomplete(data_id);
        $("#pac-input_"+data_id).keypress(function (e) {
        var key = e.which;
        if(key == 13)  // the enter key code
        {
        return false;
        }
        });
    });
