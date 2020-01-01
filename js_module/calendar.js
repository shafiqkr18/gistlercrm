var currentId = 0;
var ecurrentId = 0;
$(document).ready(function() {
    user_numbers = new Array();
    $('#calendar tr td').each(function() {
        var ids = $(this).attr('id');
        status = '';
        if ($(".calendar-" + ids + " div").hasClass("on")) {
            user_numbers[ids] = ids;
            $(".calendar-" + ids + " div").addClass('on').removeClass('off');
            status = 'on';
            var userColor = $('#' + ids + ' div').css('color');
            $('#' + ids + ' div').css('background-color', userColor);
            settings_calendar(ids, 'on');

        } else if ($(".calendar-" + ids + " div").hasClass("off")) {
            $(".calendar-" + ids + " div").addClass('off').removeClass('on');
            status = 'off';
            $('#' + ids + ' div').css('background-color', '');
            //settings_calendar(ids, 'off');
        }
    });
    scheduler.templates.event_class = function(start, end, event) {

        if (event.assigned_to == user_numbers[event.assigned_to]) {
            if (event.access == 1) {
                return 'agent_bg_' + event.assigned_to + ' managerColor';
            } else if (event.access == 2) {
                return 'agent_bg_' + event.assigned_to + ' adminColor';
            } else if (event.access == 3) {
                return 'agent_bg_' + event.assigned_to + ' userColor';
            } else {
                return 'agent_bg_' + event.assigned_to;
            }
        } else {
            if (event.access == 1) {
                return 'agent_bg_' + event.assigned_to + ' managerColor';
            } else if (event.access == 2) {
                return 'agent_bg_' + event.assigned_to + ' adminColor';
            } else if (event.access == 3) {
                return 'agent_bg_' + event.assigned_to + ' userColor';
            } else {
                return 'agent_bg_' + event.assigned_to;
            }
        }
    };
//shafiq comments
    // $('#colorpickerHolder').ColorPicker({
        // flat: true
    // });

    var user_id = '';
    var userColor = $('.change_user_color').attr('name');

    $('.change_user_color').ColorPicker({
        color: userColor,
        onChange: function(hsb, hex, rgb) {
            $('.change_user_color').attr('name', '#' + hex);
        },
        onShow: function(colpkr) {
            $(colpkr).fadeIn(500);
            user_id = $(this).attr('id');
            return false;
        },
        onHide: function(colpkr) {
            $(colpkr).fadeOut(500);
            return false;
        }

    }).bind('click', function() {
        $(this).ColorPickerSetColor($(this).attr("name"));
    });

    $('.colorpicker_submit').live('click', function() {
        $('.colorpicker').fadeOut(500);
        var colorName = $('.change_user_color').attr('name');
        $.ajax({
            url: config.baseUrl + "calendar/insertUserColor",
            type: 'POST',
            data: {
                user_id: user_id,
                colorName: colorName
            },
            success: function(success) {
                location.reload();
            }
        });

    });
    //click on user to show/hide events
    $('#calendar tbody tr td').live("click", function(event) {
        var id = $(this).attr('id');
        var status = '';
        if ($(".calendar-" + id + " div").hasClass("off")) {
            $(".calendar-" + id + " div").addClass('on').removeClass('off');
            status = 'on';
            var userColor = $('#' + id + ' div').css('color');
            $('#' + id + ' div').css('background-color', userColor);
            settings_calendar(id, 'on');
            getSingleRow_calendar();
        } else {
            $(".calendar-" + id + " div").addClass('off').removeClass('on');
            status = 'off';
            $('#' + id + ' div').css('background-color', '');
            settings_calendar(id, 'off');
            getSingleRow_calendar();
        }
        return false;
    });
    $(window).keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
    /* Initial load */
    if ($('#staff-mode-show-users-calendars').hasClass("on")) {
        getSingle_calendar_show();
    } else {
        loadSchedulerInitLoad();
    }
    /* end Initial load */

    /************POPUPS************/

    /************Make popups movable************/
    $(".draggable").draggable();
    /************CREATE EVENT************/
    //Save new event
    $("#repstart_date").attr('readonly', true);
    $('#create_event').click(function() {

        if ($("#cstart_date").val() > $("#cend_date").val()) {
            alert("End date cannot be before start date");
            return false;
        }
        //alert("currentId="+currentId);
        var reminderValue = $("#ctime_" + currentId).val();
        if (reminderValue === '') {
            alert("Reminder cannot be empty");
            return false;
        }

        $.ajax({
            url: config.baseUrl + "calendar/insertEvent",
            type: 'POST',
            data: $('#ceventpopup, #crepeat_event_form, #myForm_viewings').serialize(),
            success: function(msg) {
                loadSchedulerInitLoad();
            }
        });
        unloadCreatePopupBox();
        $(".ui-widget-overlay").remove();
        $("#daily_div").hide();
        $("#weekly_div").hide();
        $("#monthly_div").hide();
        $("#yearly_div").hide();
        $("#day_ends_on").val('');
        $("#reminder_ul").html('');
        currentId = 0;
    });

    $('#cadd_viewing').live('click', function() {
        $('#listings_popup').attr('style', 'display:block');
    });
    $('#del_lead_edit').live('click', function() {
        $('#lead_ref_edit').val('');
        $('#hdn_leads_id_edit').val('');
    });
    $('#del_listing_edit').live('click', function() {
        $('#listing_ref_edit').val('');
        $('#hdn_listings_id_edit').val('');
    });
    $('#del_deal_edit').live('click', function() {
        $('#deal_ref_edit').val('');
        $('#hdn_deals_id_edit').val('');
    });
    $('#del_lead').live('click', function() {
        $('#lead_ref').val('');
        $('#hdn_leads_id').val('');
    });
    $('#del_listing').live('click', function() {
        $('#listing_ref').val('');
        $('#hdn_listings_id').val('');
    });
    $('#del_deal').live('click', function() {
        $('#deal_ref').val('');
        $('#hdn_deals_id').val('');
    });
    $('#ref_plus').live('click', function() {

        //$('#leads_viewings_select_popup').attr('style', 'display:block');
        //$('#leads_viewings_select_popup').load('http://crm.crmreal.com/listings/linktolistings_viewings/');
    });
    $('#clistingsBoxClose').live('click', function() {
        $('#listings_popup').attr('style', 'display:none;');
    });
    $('#save_viewing').live('click', function() {
        $('#listings_popup').hide();
    });
    $('#cancel_create_event_btn').click(function() {
        unloadCreatePopupBox();
        $(".ui-widget-overlay").remove();
        if ($('#staff-mode-show-users-calendars').hasClass("on")) {
            getSingle_calendar_show();
        } else {
            loadSchedulerInitLoad();
        }
    });
    $('#popupCreateBoxClose').click(function() {
        unloadCreatePopupBox();
        $(".ui-widget-overlay").remove();
        if ($('#staff-mode-show-users-calendars').hasClass("on")) {
            getSingle_calendar_show();
        } else {
            loadSchedulerInitLoad();
        }
    });
    //Popups repeat event popup
    $("#crepeat_event").live('click', function() {
        $("#crepeat_popup").show();
        var cstart_date = $("#cstart_date").val();
        $("input#repstart_date").val(cstart_date);
    });
    $("#cadd_guest").live('click', function() {

        $("#email_error").css('display', 'none');
        $.get(config.baseUrl + "calendar/setGuestEmails", 
        function(data) {
                $("#cemails_ul").html(data);
            });
        $('#cadd_guest_popup').attr('style', 'display:block');
        $(document).keydown(function(e) {
            if (e.keyCode === 27) {
                $('#cadd_guest_popup').fadeOut("fast");
                $(".ui-widget-overlay").hide('fast');
            }
        });
    });
    /************CREATE EVENT-REPEAT************/
    $("#repeat_type").change(function() {

        var str = "";
        str = $("#repeat_type option:selected").text();
        var repVal = $("#repeat_type option:selected").val();
        $("#daily_div").hide();
        $("#weekly_div").hide();
        $("#monthly_div").hide();
        $("#yearly_div").hide();
        if (str !== 'None') {
            str = str.toLowerCase();
            var firstLetter = str.substring(0, 1);
            $("#ends_on_" + firstLetter).attr('checked', 'checked');
            $("#" + repVal + "_ends_on").val($("#cend_date").val());
            $("#" + str + "_div").show();
        }
    });
    $("#crepeat_save").live('click', function() {
        $("#crepeat_popup").fadeOut('fast');
    });
    $("#crepeat_cancel").click(function() {
        $("#crepeat_popup").fadeOut('fast');
        document.crepeat_event_form.reset();
        $("#daily_div").hide();
        $("#weekly_div").hide();
        $("#monthly_div").hide();
        $("#yearly_div").hide();
    });
    $("#repeatpopupClose").click(function() {
        $("#crepeat_popup").fadeOut('fast');
        document.crepeat_event_form.reset();
        $("#daily_div").hide();
        $("#weekly_div").hide();
        $("#monthly_div").hide();
        $("#yearly_div").hide();
    });
    /************CREATE EVENT-ADD GUESTS************/
    //add free text email (not existing contact)
    $("#email_error").css('display', 'none');
    $("#email_error_edit").css('display', 'none');
    $('#cadd_other_email').click(function() {
        var cother_email_val = $("#cother_email").val();
        var atpos = cother_email_val.indexOf("@");
        var dotpos = cother_email_val.lastIndexOf(".");
        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= cother_email_val.length) {
            //alert("this is not good");
            $("#email_error").css('display', 'block');
            return false;
        } else {
            $("#email_error").css('display', 'none');
        }
        if (cother_email_val !== 0) {
            $("#cemail_list_ul").append('<li class="cfinalemails"><div class="cemailusers"><span value="' + cother_email_val +
                '" class="cemailid">' + cother_email_val +
                '</span><span class="remove_email_new" href="#"></span></div></li>');
            $("#cother_email").val('');
        }
    });
    //add email to selected list in add event popup, remove from available contacts
    $('.email_checkbox').live('click', function() {
        var id = $(this).attr('id');
        $("#cemail_list_ul").append('<li class="cfinalemails">' + $('#guest' + id).html() +
            '<span class="remove_email" href="#" id="' + id +
            '"></span></li>');
        $(this).parent().remove();
    });
    //add email to selected list in edit event popup, remove from available contacts
    $('.email_checkbox_e').live('click', function() {
        var id = $(this).attr('id');
        $("#eemail_list").append('<li class="efinalemails">' + $('#guest' + id).html() +
            '<span class="remove_email_edit" href="#" id="' + id + '"></span></li>');
        $(this).parent().remove();
    });
    //remove email from selected list(existing contact), add to available contacts
    $('.remove_email').live('click', function() {
        $("#cemails_ul").append('<li>' + $(this).parent().html() + '</li>');
        $(this).parent().remove();
    });
    //array of emails to be deleted from invited guests
    var emails_to_delete = [];
    $('.remove_email_edit').live('click', function() {
        var parentID = $(this).prev().attr("id");
        var removedEmailId = $("#" + parentID + " div span").attr("value");
        emails_to_delete.push(removedEmailId);
        $(this).parent().remove();
        $("#hdn_emails_delete").val(emails_to_delete);
        $("#eemail_list_ul").append('<li class=' + emails_to_delete + '>' + $(this).parent().html() + '</li>');
        $(this).parent().remove();
    });
    //remove email from selected list(new email), do not add to existing contacts box
    $('.remove_email_new').live('click', function() {
        //$("#cemails_ul").append($(this).parent().html());
        $(this).parent().remove();
    });
    $('#cpopupGuestBoxClose').click(function() {
        $("#cadd_guest_popup").fadeOut('fast');
        $('#cadd_guest_popup').attr('style', 'display:none !important');
        var id = $('#cemail_list_ul > li').text();
        $("#cemails_ul").append('<li class=' + id + '>' + id + '</li>');
        $('#cemail_list_ul li').remove();
    });
    $('#cadd_guest_cancel').live('click', function() {
        $("#cadd_guest_popup").fadeOut('fast');
        $('#cadd_guest_popup').attr('style', 'display:none !important');
        $('#cemail_list_ul li').remove();
    });
    $('#csend_invite_button').live('click', function() {
        $("#cadd_guest_popup").fadeOut('fast');
        var emails = guestsEmails();
        $("#hdn_emails2").val(emails);
    });
    /************EDIT EVENT************/
    //Save edited event
    $("#erepstart_date").attr('readonly', true);
    $('#edit_event').click(function() {

        if ($('#start_date').val() > $('#end_date').val()) {
            alert("End date cannot be before start date");
            return false;
        }
        var reminderValue = $("#ctime_" + ecurrentId).val();
        if (reminderValue === '') {
            alert("Reminder cannot be empty");
            return false;
        }
        $("#hdn_emails").val(guestsEemails());
        $.ajax({
            url: config.baseUrl + "calendar/updateEvent",
            type: 'POST',
            data: $('#eventpopup, #erepeat_event_form, #myForm_viewings2').serialize(),
            success: function(msg) {}
        });
        $(".ui-widget-overlay").remove();
        unloadPopupBox();
        getSingleRow_calendar();
        $('#reminder_ul_edit').html('');
        if ($('#staff-mode-show-users-calendars').hasClass("on")) {
            getSingle_calendar_show();
        } else {
            loadSchedulerInitLoad();
            //                  scheduler.load("<?= base_url() ?>calendar/initLoad/");
        }
        return false;
    });
    $("#eadd_guest").click(function() {

        var ev_id = $('#hdn_event_id').val();
        $("#email_error_edit").css('display', 'none');
        $.get(config.baseUrl + "calendar/setEditGuestEmails/" + ev_id, 
        function(data) {
                $("#eemail_list_ul").html(data);
            });
        $('#eadd_guest_popup').fadeIn("slow");
        $(document).keydown(function(e) {
            if (e.keyCode === 27) {
                $('#eadd_guest_popup').fadeOut("fast");
                $(".ui-widget-overlay").hide('fast');
            }
        });
    });
    $("#delete_event_btn").click(function() {
        var ev_id = $('#hdn_event_id').val();
        $.ajax({
            url: config.baseUrl + "calendar/delete_event/" + ev_id,
            type: 'GET',
            success: function(msg) {
                if ($('#staff-mode-show-users-calendars').hasClass("on")) {
                    getSingle_calendar_show();
                } else {
                    loadSchedulerInitLoad();
                }
            }
        });
        $("#edit_event_popup").fadeOut('fast');
        $(".ui-widget-overlay").remove();
    });
    $('#cancel_edit_event_btn').click(function() {
        $('#edit_event_popup').fadeOut("fast");
        $(".ui-widget-overlay").remove();
    });
    /************EDIT EVENT-REPEAT************/
    $("#day_ends_on").live('click', function() {
        $("#ends_on_d").attr('checked', 'checked');
    });
    $("#week_ends_on").live('click', function() {
        $("#ends_on_w").attr('checked', 'checked');
    });
    $("#month_ends_on").live('click', function() {

    });
    $("#year_ends_on").live('click', function() {
        $("#ends_on_y").attr('checked', 'checked');
    });
    $("#erepeat_type").live('change', function() {

        var erep_type = "";
        erep_type = $("#erepeat_type option:selected").text();
        var eRepVal = $("#erepeat_type option:selected").val();
        $("#edaily_div").hide();
        $("#eweekly_div").hide();
        $("#emonthly_div").hide();
        $("#eyearly_div").hide();
        if (erep_type !== 'None') {
            erep_type = erep_type.toLowerCase();
            var firstLetter = erep_type.substring(0, 1);
            $("#eends_on_" + firstLetter).attr('checked', 'checked');
            $("#e" + erep_type + "_ends_on").val($("#end_date").val());
            $("#e" + eRepVal + "_ends_on").val($("#end_date").val());
            $("#e" + erep_type + "_div").show();
        }
    });
    $("#erepeat_save").live('click', function() {
        $("#erepeat_popup").fadeOut('fast');
        //document.erepeat_event_form.reset();
        //                $("#edaily_div").hide();
        //                $("#eweekly_div").hide();
        //                $("#emonthly_div").hide();
        //                $("#eyearly_div").hide();
    });
    $("#erepeat_cancel").click(function() {
        $("#erepeat_popup").hide();
        document.erepeat_event_form.reset();
        $("#edaily_div").hide();
        $("#eweekly_div").hide();
        $("#emonthly_div").hide();
        $("#eyearly_div").hide();
        loadRepeatEvent();
    });
    $("#erepeatpopupClose").live('click', function() {
        $("#erepeat_popup").hide();
        document.erepeat_event_form.reset();
        $("#edaily_div").hide();
        $("#eweekly_div").hide();
        $("#emonthly_div").hide();
        $("#eyearly_div").hide();
        loadRepeatEvent();
    });
    /************EDIT EVENT-ADD GUESTS************/
    //add new email from input field
    $('#eadd_other_email').click(function() {
        var eother_email_val = $("#eother_email").val();
        var atpos = eother_email_val.indexOf("@");
        var dotpos = eother_email_val.lastIndexOf(".");
        if (atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= eother_email_val.length) {
            $("#email_error_edit").css('display', 'block');
            return false;
        } else {
            $("#email_error_edit").css('display', 'none');
        }
        
        if (eother_email_val !== 0) {
        	var html_eother_email_val = '<li class="efinalemails"><div id="" class="eemailusers"><span value="' +
                eother_email_val + '" class="eemailid">' + eother_email_val +
                '</span></div><span class="remove_email_new" href="#"></span></li>';
                var html_eother_email_val2 = '<ul id="eemail_list"><li class="efinalemails"><div id="" class="eemailusers"><span value="' +
                eother_email_val + '" class="eemailid">' + eother_email_val +
                '</span></div><span class="remove_email_new" href="#"></span></li></ul>';
              $("#eadded_list").append(html_eother_email_val2);
           // $("#eemail_list").append(html_eother_email_val);
            $("#eother_email").val('');
        }



    });
    //add email from contacts list
    $('.email_checkbox_edit').live('click', function() {
        var id = $(this).attr('id');
        $("#eemail_list").append('<li>' + $('#guest' + id).html() + '<span class="remove_email_ul" href="#" id="' + id + '"></span></li>');
        $(this).parent().remove();
    });
    //remove existing contact from selected list and move back to contacts list
    $('.remove_email_ul').live('click', function() {
        var id = $(this).attr('id');
        $("#eemail_list_ul").append('<li><span  id="' + id + '" class="email_checkbox_edit"></span><span id="guest' + id + '">' + $("#guest" + id).html() + '</span></li>');
        $(this).parent().remove();
    });
    //remove manually entered email from selected list, do not add to contacts list
    $('#eadd_guest_save').click(function() {
        var emails = guestsEemails();
        $("#eadd_guest_popup").fadeOut('fast');
        return emails;
        $('.email_checkbox').val('');
    });
    $('#epopupGuestBoxClose').click(function() {
        var ev_id = $('#hdn_event_id').val();
        var ev_id = $('#hdn_event_id').val();
        $("#eadd_guest_popup").fadeOut('fast');
        $('#eemail_list .efinalemails').remove();
        $.get(config.baseUrl + "calendar/getGuestEmails/" + ev_id, 
            function(data) {
                $("#eadded_list").html(data);
            });
    });
    $('#eadd_guest_cancel').click(function() {
        var ev_id = $('#hdn_event_id').val();
        $("#eadd_guest_popup").fadeOut('fast');
        $('#eemail_list .efinalemails').remove();
        $.get(config.baseUrl + "calendar/getGuestEmails/" + ev_id, 
            function(data) {
                $("#eadded_list").html(data);
            });
    });
    /****************END OF POPUPS*************************/

    $('input[name="change_response"]').click(function() {

    });
    $(function() {
        $('#select_event').click(function() {
            $('#export_code').select();
        });
    });
    $('#popupBoxClose').click(function() {
        unloadPopupBox();
        $(".ui-widget-overlay").remove();
        $('#load_deal_popup').hide('fast');
        $('#load_listing_popup').hide('fast');
        $('#load_lead_popup').hide('fast');
        $('#leads_viewings_select_popup').hide('fast');
        deleteReminders();
    });
    $('.ui-widget-overlay').click(function() {
        $(".ui-widget-overlay").remove();
    });
    $("#icalpopupBoxClose").click(function() {
        $("#icalpopup").fadeOut('fast');
        $(".ui-widget-overlay").remove();
    });
    $('.rem_remove').live('click', function() {
        $(this).parent().remove();
        currentId--;
        if (currentId == 0) {
            //                    $("#default").css('float', 'left');
        }
    });
    $("#ctime_0").live('keyup', function() {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });
    $("#ctime_1").live('keyup', function() {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });
    $("#ctime_2").live('keyup', function() {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });
    $("#ctime_3").live('keyup', function() {
        this.value = this.value.replace(/[^0-9\.]/g, '');
    });
    //when clicking + for reminders in create event
    $('.rem_add').live('click', function() {
        if (currentId < 3) {
            currentId++;
            var values = '<li id="rem_li_' + currentId + '"><input maxlength="2" type="text"  size="12"  name="ctime_' + currentId + '" id="ctime_' + currentId + '" class="form_fields1" style="width:20px;text-align:left;" />&nbsp;&nbsp;<select name="ctimeunit_' + currentId + '" id="ctimeunit_' + currentId + '" class="form_select_fields1  timer-class"><option value="minute">Minutes</option><option value="hour">Hours</option><option value="day">Days</option><option value="week">Weeks</option></select>&nbsp;&nbsp;<span class="rem_remove"><a style="text-decoration:none;font-size:16px;" href="#">-</a></span></li>';
            $("#reminder_ul").append(values);
            //                    $("li#rem_li_" + currentId).css('display', 'inline-block');
        }
        return false;
    });
    //when clicking + for reminders in edit event
    $('.rem_add_edit').live('click', function() {
        if (ecurrentId < 3) {
            ecurrentId++;
            var values = '<li id="rem_li_' + ecurrentId + '"><input maxlength="2" type="text" size="12" name="ctime_' + ecurrentId + '" id="ctime_' + ecurrentId + '" class="form_fields1" style="width:20px;text-align:left;"/>&nbsp;&nbsp;<select name="ctimeunit_' + ecurrentId + '" id="ctimeunit_' + ecurrentId + '" class="form_select_fields1  timer-class"><option value="minute">Minutes</option><option value="hour">Hours</option><option value="day">Days</option><option value="week">Weeks</option></select>&nbsp;&nbsp;<span class="rem_remove_edit"><a style="text-decoration:none;font-size:16px;" href="#">-</a></span></li>';
            $("#reminder_ul_edit").append(values);
            // $("li#rem_li_" + ecurrentId).css('display', 'inline-block');
        }
        return false;
    });
    $('.rem_remove_edit').live('click', function() {
        $(this).parent().remove();
        ecurrentId--;
        if (ecurrentId === 0) {
            //                    var plus = '<span class="rem_add_edit"><a style="text-decoration:none; font-size:16px;" href="#">+</a></span>';
            //                    $('#editTime').append(plus);
        }

    });
    $('.rem_remove_edit2').live('click', function() {
        $(this).parent().remove();
        if (ecurrentId === 0) {
            //                    var plus = '<span class="rem_add_edit"><a style="text-decoration:none; font-size:16px;" href="#">+</a></span>';
            //                    $('#editTime').append(plus);
        }


    });
    //Set repeat values when opening edit event

    $("#erepeat_event").live('click', function() {
        $("#erepeat_popup").fadeIn('fast');
        var start_date = $("#start_date").val();
        $("#erepstart_date").val(start_date);
        $("#eweekrepstart_date").val(start_date);
        $("#emonthrepstart_date").val(start_date);
        $("#eyearrepstart_date").val(start_date);
    });
}); //end of document ready

function loadRepeatEvent() {
    var ev_id = $('#hdn_event_id').val();
    $.get(config.baseUrl + "calendar/editRepeatEvent/" + ev_id, 
    function(data) {

            data = data.split("|");
            var length = data.length;
            for (var i = 0; i < length; i++) {
                data[i];
            }
            var repeat_type = data[0];
            var repeat_count = data[1];
            var repeat_day = data[2];
            var repeat_count2 = data[3];
            var repeat_days = data[4];
            var repeat_sdate = data[5];
            var repeat_edate = data[6];
            var repeat_edate_never = repeat_edate.substring(0, 4);
            var maxDate = '2100-12-31 00:00:00';
            var maxDate_never = maxDate.substring(0, 4);
            repeat_days = repeat_days.split(",");
            if (repeat_type) {
                repeat_type = repeat_type.replace(/^\s+|\s+$/g, '');
                if (repeat_type === 'day') {
                    $("#edaily_div").show();
                    $("#erepeat_type").val(repeat_type);
                    $(".select_daily").val(repeat_count);
                    $("#erepstart_date").val(repeat_sdate);
                    $("#eday_ends_on").val(repeat_edate);
                    if (repeat_edate_never != maxDate_never)
                        $('#eends_on_d').attr('checked', 'checked');
                    else
                        $('#eends_never_d').attr('checked', 'checked');
                } else if (repeat_type === 'week') {
                    $("#eweekly_div").show();
                    $("#erepeat_type").val(repeat_type);
                    $(".select_weekly").val(repeat_count);
                    $("#eweekrepstart_date").val(repeat_sdate);
                    $("#eweek_ends_on").val(repeat_edate);
                    $(".eweekdays").val(repeat_days);
                    if (repeat_edate_never != maxDate_never)
                        $('#eends_on_w').attr('checked', 'checked');
                    else
                        $('#eends_never_w').attr('checked', 'checked');
                } else if (repeat_type === 'month') {
                    $("#emonthly_div").show();
                    $("#erepeat_type").val(repeat_type);
                    $(".select_monthly").val(repeat_count);
                    $("#edate_of_week").val(repeat_count2);
                    $("#eday_of_week").val(repeat_day);
                    $("#emonthrepstart_date").val(repeat_sdate);
                    $("#emonth_ends_on").val(repeat_edate);
                    if (repeat_edate_never != maxDate_never)
                        $('#eends_on_m').attr('checked', 'checked');
                    else
                        $('#eends_never_m').attr('checked', 'checked');
                } else if (repeat_type === 'year') {
                    $("#eyearly_div").show();
                    $("#erepeat_type").val(repeat_type);
                    $(".select_yearly").val(repeat_count);
                    $("#eyearrepstart_date").val(repeat_sdate);
                    $("#eyear_ends_on").val(repeat_edate);
                    if (repeat_edate_never != maxDate_never)
                        $('#eends_on_y').attr('checked', 'checked');
                    else
                        $('#eends_never_y').attr('checked', 'checked');
                }
            }
        });
}

function unloadPopupBox() {
    $('#edit_event_popup').fadeOut("fast");
}

function unloadCreatePopupBox() {
    $('#create_event_popup').fadeOut("fast");
}

function guestsEmails() {
    var allVals = [];
    $('.cfinalemails .cemailusers .cemailid').each(function() {
        allVals.push($(this).text());
    });
    var arr = jQuery.makeArray(allVals);
    return arr;
}

function guestsEemails() {
    var allVals = [];
    $('.efinalemails .eemailusers .eemailid').each(function() {
        allVals.push($(this).text());
    });
    var arr = jQuery.makeArray(allVals);
    return arr;
}

function deleteReminders() {
    $("#ctime_" + currentId).after().remove();
    $("#ctimeunit_" + currentId).after().remove();
}