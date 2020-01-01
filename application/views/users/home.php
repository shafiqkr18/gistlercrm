<script type="text/javascript">
    /* Check for value change in form */
    var screenname = 'users';
    var formDataChange = false;
    var CheckPasswordexsit = '';
    $(document.body).on('change', "#myForm", function(event) {
        formDataChange = true;
    });
    window.onbeforeunload = function() {
        if (formDataChange) {
            return 'Data not saved!';
        }
    }
    var statusTemp = '';
    var currentContext = '';
    var screenData = '';
    /* Datatable initilization */
    $(document).ready(function() {
        $("#ddCompany").change(function() {
            $("#client_id").val(this.id);
        });
        var oTable = $('#listings_row').dataTable({
            "bProcessing": true,
            "bServerSide": true,
            "sDom": 'R<>rt<ilp><"clear">',
            "aoColumnDefs": [{
                'render': function(data, type, full, meta) {
                    return '<div style="text-align:center;" id="item_action"><label class=""><input type=\"radio\" name="user_datatable_ids" value="' +
                        data + '"><span class="lbl padding"></span> </label></div>';
                },
                "aTargets": [0]
            }, {
                "bSortable": false,
                "aTargets": [0]
            }],
            "aoColumns": [{
                "mDataProp": "id"
            }, {
                "mDataProp": "client_id"
            }, {
                "mDataProp": "first_name"
            }, {
                "mDataProp": "last_name"
            }, {
                "mDataProp": "id"
            }, {
                "mDataProp": "client_id"
            }, {
                "mDataProp": "first_name"
            }, {
                "mDataProp": "last_name"
            }],
            "aaSorting": [
                [0, 'desc']
            ],
            "bRegex": true,
            "sAjaxSource": "<?php echo base_url();?>index.php/users/datatable",
            "iDisplayStart": 0,
            "sPaginationType": "full_numbers",
            "oLanguage": {
                "sSearch": "Search all columns:"
            },
            'fnServerData': function(url, data, callback) {
                /* Add some extra data to the sender */
                $.ajax({
                    "dataType": 'json',
                    "type": "POST",
                    "url": url,
                    "data": data,
                    "success": function(json) {
                        callback(json);
                    }
                });
            },
            "rowCallback": function(row, data) {
                $(row).attr("id", data.id);
                return row;
            }
        });
        $("thead input").keyup(function() {
            /* Filter on the column (the index) of this element */
            oTable.fnFilter(this.value, $(this).attr('id'));
            $('#reset_filter').css('display', '');
        });
        $("thead select").change(function() {
            /* Filter on the column (the index) of this element */
            oTable.fnFilter(this.value, $(this).attr('id'));
            $('#reset_filter').css('display', '');
        });
        //reset filter and drawtable
        $("#reset_filter").click(function() {
            $("#myForm2")[0].reset();
            oTable.fnDraw(false);
            oTable.fnFilterClear(true);
            $('#reset_filter').css('display', 'none');
        });
        //change css of selected row    
        $(document.body).on("click", "#listings_row tbody tr, .overflow", function(event) {
            if (formDataChange == false) {
                $("td.yellowCSS", oTable.fnGetNodes()).removeClass("yellowCSS");
                $('#listings_row tbody #' + $(this).attr('rel')).find("td").addClass("yellowCSS");
                $(event.target).parent().find("td").addClass("yellowCSS");
            }
        });
        // check box delete
        $(document.body).on("click", '.dbstatus', function() {
            //alert($('#listings_row input:checked').val());
            if ($('#listings_row input').is(':checked')) {
                var listing_selecetd = false;
                var new_user_selected = false;
                var diffrent_new_user = false;
                if ($('#transferToNewUser').val() == 0) {
                    alert("Please select a new user to transfer data!");
                } else if ($('#transferToNewUser').val() == $('#listings_row input:checked').val()) {
                    alert("You cannot select the same user!");
                    new_user_selected = true;
                } else if (confirm("Are you sure you want to " + $(this).attr('id') + "?")) {
                    diffrent_new_user = true;
                    new_user_selected = true;
                    listing_selecetd = true;
                }

                if (listing_selecetd == true && new_user_selected == true && diffrent_new_user == true) {
                    //alert('sss');
                    var allVals = [];
                    type = $(this).attr('id');
                    $('input[type="radio"]:checked').each(function() {
                        allVals.push($(this).val());
                        name = $(this).attr('id');
                    });
                    $.post('<?php echo base_url();?>users/status/', {
                            ids: allVals,
                            type: $(this).attr('id'),
                            new_user: $('#transferToNewUser').val()
                        },
                        function(data) {
                            $('#transferToNewUser').val('0')
                            $('a.close').click();
                            oTable.fnDeleteRow(47);
                        }
                    );
                }
            } else {
                $('#checkbox_error').show(400);
                //alert('Please check atleast one entry!');
            }
        });
        disable_popup();
    });;
    //datatable initilization
    //the update / insert query
    function GetCompanies(){
        $.ajax({
            type: "POST",
            "dataType": 'json',
            url: mainurl + "Users/GetCompanies",
            success: function(res) {

                // res = JSON.parse(res);

                $("#client_id").html("").append($('<option></option>').val(0).html("Select"));

                $.each(res, function(key, data){
                    $("#client_id").append(
                    $('<option></option>').val(this.id).html(this.name).attr("profile_logo", this.logo_path)
                    );
                });
            }
        });        
    }



    $(document).ready(function() {

        GetCompanies();

        $('#myForm').ajaxForm({
            beforeSubmit: function() {

                var checkpass = '';
                var lookup = true;
                var validate = false;
                var duplicate_users = false;
                var stat = '';
                var users_quota = 5;
                // if ($('#id').val() == 0 || (statusTemp != $('#status').val() && $('#status').val() ==
                //         1)) {
                //     $.ajax({
                //         async: false,
                //         url: '<?php echo base_url();?>users/lookup/',
                //         success: function(data) {
                //             if (data >= users_quota) {
                //                 lookup = false;
                //                 alert('You have reached the licenses limit (' +
                //                     users_quota +
                //                     ' users), please contact support@gistler.com for further information.'
                //                 )
                //             } else {
                //                 lookup = true;
                //             }
                //         }
                //     })
                // } else {
                //     lookup = true;
                // }
                /* code to check duplicate user START */
                /*only for new users*/
                if ($('#id').val() < 1) {
                    $.ajax({
                        async: false,
                        url: '<?php echo base_url();?>users/lookup_duplicate_users/' + $(
                            '#username').val() + '/' + $('#id').val() + '/',
                        success: function(data) {
                            if (data >= 1) {
                                duplicate_users = false;
                                alert('Username ' + $('#username').val() +
                                    ' is already assigned to another user!')
                            } else {
                                duplicate_users = true;
                            }
                        }
                    })
                } else {
                    duplicate_users = true;
                }
                /* code to check duplicate user END*/
                validate = $("#myForm").validate({
                    rules: {
                        price: {
                            number: true
                        },
                        size: {
                            number: true
                        },
                        email: {
                            email: true
                        }
                    },
                    errorClass: 'form_fields_error',
                    errorPlacement: function(error, element) {
                        //$(element).attr({"title": error.text('asdasd')});
                        $('#showdata').animate({
                            'color': 'red'
                        }, "slow");
                        $('#showdata').fadeIn("slow");
                        $('#showdata').html('Please complete all required fields');
                        setTimeout(function() {
                            $('#showdata').fadeOut("slow");
                            $('#showdata').animate({
                                'color': 'red'
                            }, "slow");
                        }, 5000);
                        //alert('Please fill the required fields')
                    }
                }).form();

                if ($("#email1").val() != '' && !isValidEmailAddress($("#email1").val())) {
                    alert("Invalid email 2 address");
                    console.log("error here-->> email 2")
                    return false;
                }

                if ($("#email2").val() != '' && !isValidEmailAddress($("#email2").val())) {
                    alert("Invalid email 3 address");
                    console.log("error here-->> email 3")
                    return false;
                }

                if ($('#password').val() != '') {
                    $.ajax({
                        async: false,
                        url: '<?php echo base_url();?>users/CheckPassword/?newpass=' + $(
                            '#password').val() + '&id=' + $('#id').val(),
                        success: function(data) {
                            CheckPasswordexsit = data;
                        }
                    })
                    if (($('#status_p').val() == 3) || ($('#status_p').val() == 5) || ($(
                            '#status_p').val() == 7)) {
                        if ($('#password').val() == $('#username').val()) {
                            $('#password').removeClass('valid');
                            $('#password').addClass('form_fields_error');
                            $('#password').val('');
                            $('#password').focus();
                            $('#status_p').val('');
                            password_strength(0, 0);
                            alert('password cant be same as username');
                            checkpass = false;
                        } else if (CheckPasswordexsit == 1) {
                            $('#password').removeClass('valid');
                            $('#password').addClass('form_fields_error');
                            $('#password').val('');
                            $('#password').focus();
                            $('#status_p').val('');
                            password_strength(0, 0);
                            alert('password should be different from your last password');
                            checkpass = false;
                        } else {
                            checkpass = true;
                            $('#password').removeClass('form_fields_error');
                        }
                    } else {
                        checkpass = false;
                        alert('Password is too ' + $('#grad').text() + '!')
                        $('#password').addClass('form_fields_error');
                        $('#password').focus();
                    }
                } else {
                    checkpass = true;
                }

                /* check for auto import leads */
                // if ($("#Active").is(':checked')) {
                //     $('#resultTest2').css('display', 'none');
                //     $('#resultTest1').css('display', 'none');
                //     $('#resultTest3').css('display', 'none');
                //     $("#download_animation_2").css('display', '');
                //     if (($('input#emailsLeads').val() != '' && $('input#passwordemail').val() != '' &&
                //             $('input#imap').val() != '' && $("#port").val() != 'other') || ($(
                //                 'input#emailsLeads').val() != '' && $('input#passwordemail').val() !=
                //             '' && $('input#imap').val() != '' && $("#port").val() == 'other' && $(
                //                 "#port_extra").val() != '')) {
                //         //                      
                //         $("#download_animation_2").css('display', '');
                //         $.ajax({
                //             async: false,
                //             url: '<?php echo base_url();?>users/test_imap2/?emailsLeads=' +
                //                 encodeURIComponent($('input#emailsLeads').val()) +
                //                 '&passwordemail=' + encodeURIComponent($(
                //                     'input#passwordemail').val()) + '&imap=' +
                //                 encodeURIComponent($('input#imap').val()) +
                //                 '&email_client_id=' + $('input#email_client_id').val() +
                //                 '&email_user_id=' + $('input#email_user_id').val() +
                //                 '&port=' + encodeURIComponent($('#port').val()) +
                //                 '&port_extra=' + encodeURIComponent($('#port_extra').val()),
                //             success: function(data) {
                //                 if (data > 0) {
                //                     stat = true;
                //                     $('#connect_status').val(data);
                //                     $('#resultTest2').css('display', 'none');
                //                     $('#resultTest3').css('display', 'none');
                //                     $('#resultTest1').css('display', '');
                //                     $("#download_animation_2").css('display', 'none');
                //                     $("#imap").removeClass(
                //                         "form_fields form_fields_error").addClass(
                //                         "form_fields");
                //                     $("#passwordemail").removeClass(
                //                         "form_fields form_fields_error").addClass(
                //                         "form_fields");
                //                     $("#emailsLeads").removeClass(
                //                         "form_fields form_fields_error").addClass(
                //                         "form_fields");
                //                     if (($("#port").val() != 'other') && ($(
                //                             "#port_extra").val() != '')) {
                //                         $("#port_extra").removeClass(
                //                             "form_fields form_fields_error").addClass(
                //                             "form_fields");
                //                     }
                //                 } else if (data <= 0) {
                //                     stat = false;
                //                     $('#connect_status').val(data);
                //                     $('#passwordemail').val("");
                //                     $('#imap').val("");
                //                     $('#passwordemail').focus();
                //                     $("#download_animation_2").css('display', 'none');
                //                     $('#resultTest3').css('display', 'none');
                //                     $('#resultTest1').css('display', 'none');
                //                     $('#resultTest2').css('display', '');
                //                     $("#download_animation_2").css('display', 'none');
                //                     $("#imap").removeClass("form_fields").addClass(
                //                         "form_fields form_fields_error");
                //                     $("#passwordemail").removeClass("form_fields").addClass(
                //                         "form_fields form_fields_error");
                //                     if (($("#port").val() != 'other') && ($(
                //                             "#port_extra").val() != '')) {
                //                         $("#port_extra").removeClass("form_fields").addClass(
                //                             "form_fields form_fields_error");
                //                     }
                //                 } else if (data == 'yes') {
                //                     stat = false;
                //                     $('#connect_status').val('0');
                //                     $('#passwordemail').val("");
                //                     $('#imap').val("");
                //                     $('#passwordemail').focus();
                //                     $("#download_animation_2").css('display', 'none');
                //                     $('#resultTest1').css('display', 'none');
                //                     $('#resultTest2').css('display', 'none');
                //                     $('#resultTest3').css('display', '');
                //                     $("#download_animation_2").css('display', 'none');
                //                     $("#imap").removeClass("form_fields").addClass(
                //                         "form_fields form_fields_error");
                //                     $("#passwordemail").removeClass("form_fields").addClass(
                //                         "form_fields form_fields_error");
                //                     $("#emailsLeads").removeClass("form_fields").addClass(
                //                         "form_fields form_fields_error");
                //                     if (($("#port").val() != 'other') && ($(
                //                             "#port_extra").val() != '')) {
                //                         $("#port_extra").removeClass("form_fields").addClass(
                //                             "form_fields form_fields_error");
                //                     }
                //                 }
                //             }
                //         })
                //     } else {
                //         alert('Please fill all the fields');
                //         $("#download_animation_2").css('display', 'none');
                //         if ($('input#emailsLeads').val() == '' && $('input#passwordemail').val() ==
                //             '' && $('input#imap').val() == '') {
                //             $("#imap").removeClass("form_fields").addClass(
                //                 "form_fields form_fields_error");
                //             $("#passwordemail").removeClass("form_fields").addClass(
                //                 "form_fields form_fields_error");
                //             $("#emailsLeads").removeClass("form_fields").addClass(
                //                 "form_fields form_fields_error");
                //         } else if ($('input#emailsLeads').val() == '' && $('input#passwordemail').val() ==
                //             '' && $('input#imap').val() != '') {
                //             $("#passwordemail").removeClass("form_fields").addClass(
                //                 "form_fields form_fields_error");
                //             $("#emailsLeads").removeClass("form_fields").addClass(
                //                 "form_fields form_fields_error");
                //         } else if ($('input#emailsLeads').val() == '' && $('input#passwordemail').val() !=
                //             '' && $('input#imap').val() != '') {
                //             $("#emailsLeads").removeClass("form_fields").addClass(
                //                 "form_fields form_fields_error");
                //         } else if ($('input#emailsLeads').val() != '' && $('input#passwordemail').val() ==
                //             '' && $('input#imap').val() != '') {
                //             $("#passwordemail").removeClass("form_fields").addClass(
                //                 "form_fields form_fields_error");
                //         } else if ($('input#emailsLeads').val() == '' && $('input#passwordemail').val() !=
                //             '' && $('input#imap').val() == '') {
                //             $("#imap").removeClass("form_fields").addClass(
                //                 "form_fields form_fields_error");
                //             $("#emailsLeads").removeClass("form_fields").addClass(
                //                 "form_fields form_fields_error");
                //         }
                //         if (($("#port").val() == 'other') && ($("#port_extra").val() == '')) {
                //             $("#port_extra").removeClass("form_fields").addClass(
                //                 "form_fields form_fields_error");
                //         }
                //     }
                //     setTimeout(function() {
                //         $("#resultTest1, #resultTest2, #resultTest3").fadeOut('slow');
                //     }, 10000);
                // } else {
                //     $("#download_animation_2").css('display', 'none');
                    stat = true;
                // }

                // console.log("lookup-->>" + lookup);
                // console.log("validate-->>" + validate);
                // console.log("duplicate_users-->>" + duplicate_users);
                // console.log("checkpass-->>" + checkpass);
                // console.log("stat-->>" + stat);

                // console.log((lookup && validate && duplicate_users && checkpass && stat));

                /* END CHECK FOR AUTO IMPORT*/
                if (lookup && validate && duplicate_users && checkpass && stat) {
                    return true;
                } else {
                    return false;
                }

            },
            target: '#successMsg',
            success: function(data) {

                $("#listings_row").DataTable().draw();

                if (data == 2) {
                    $('#successMsg').html('Successfully Updated!');
                } else if (data == 1) {
                    alert('Permission denied!');
                }
                // fnClickAddRow(),
                    formDataChange = false;
                if ($(".checkonoff a").hasClass("on")) {
                    $(".checkonoff a").addClass('off').removeClass('on');
                };
                // if ($("#id").val() == 0) {
                //     $.ajax({
                //         async: false,
                //         url: mainurl + 'users/getlastid/',
                //         success: function(data) {
                //             last_id = data;
                //         }
                //     })
                // }
                $("#cancel").click(),
                    $('#successMsg').animate({
                        'color': '#49AC44'
                    }, "slow"),
                    $('#successMsg').fadeIn("slow"),
                    setTimeout(function() {
                        $('#successMsg').fadeOut("slow")
                    }, 5000);
            }
        });
    });

    function fnClickAddRow() {
        $('#listings_row').dataTable().fnAddData([
            '',
            $('input#first_name').val(),
            $('input#last_name').val(),
            $('input#rera').val(),
            $('input#email').val(),
            $('input#office_no').val(),
            $('input#job_title').val(),
            $('input#mobile_no_new').val(),
            ''
        ]);
    }
    //end update
    function delete_permissions(value, disabled) {
        var dropdown_status = '';
        if (disabled == 1) dropdown_status = 'disabled';
        else if (disabled == 0) dropdown_status = false;
        if (value == 3) {
            $('#delete_permissions').attr('disabled', 'disabled');
            $('.delete_permissions').css('color', 'grey');
            $("#delete_permissions").val(1);
        } else {
            $('#delete_permissions').attr('disabled', dropdown_status);
            $('.delete_permissions').css('color', 'black');
        }
        if (value == 1) {
            $('#disable_publish').attr('disabled', 'disabled');
            $('.permissions').css('color', 'grey');
            $("#disable_publish").val(0);
        } else {
            $('#disable_publish').attr('disabled', dropdown_status);
            $('.permissions').css('color', 'black');
        }
    }

    function disable_sharing(value) {
        if (value == 1 || value == 3) {
            $('#disable_sharing option[value=2]').attr('disabled', 'disabled');
        } else {
            $('#disable_sharing option[value=2]').attr('disabled', false);
        }
        if (value >= 2) {
            $(".access_popup").css("display", "");
        } else {
            $("#access_timings_details").val("Not applicable for managers, managers will have access all the time.");
            $(".access_popup").css("display", "none");
        }
    }

    function edit_listings(value, disabled) {
        var dropdown_status = '';
        if (disabled == 1) dropdown_status = 'disabled';
        else if (disabled == 0) dropdown_status = false;
        if (value == 1 || value == 2) {
            $('#edit_listings').attr('disabled', 'disabled');
            $('.edit_listings').css('color', 'grey');
            $("#edit_listings").val(0);
        } else {
            $('#edit_listings').attr('disabled', dropdown_status);
            $('.edit_listings').css('color', 'black');
        }
    }

    function display_access_timings() {
        var checkedDays = [];
        $('.access_timings_days:checked').each(function() {
            checkedDays.push($(this).attr("day").toUpperCase());
        });
        var start_time = $("#access_timings_from option:selected").text();
        var end_time = $("#access_timings_to option:selected").text();
        var access_timings_details;
        if (start_time == "Select" || end_time == "Select") {
            start_time = "";
            end_time = "";
        } else {
            $('#access_timings').val($("#access_timings_from option:selected").val() + '-' + $(
                "#access_timings_to option:selected").val());
        }
        if (start_time != "" && end_time != "" && checkedDays != "")
            access_timings_details = start_time + "-" + end_time + " | " + checkedDays;
        else if ((start_time == "" || end_time == "") && checkedDays != "")
            access_timings_details = checkedDays;
        else if (checkedDays == "")
            access_timings_details = "No crm access";
        $("#access_timings_details").val(access_timings_details);
        //alert(checkedDays+start_time+end_time);
    }
    //        for test imap function 
    function myTestConnection() {
        if (formEnabled == false) {
            return false;
        }
        $('#resultTest2').css('display', 'none');
        $('#resultTest1').css('display', 'none');
        $('#resultTest3').css('display', 'none');
        if (($('input#emailsLeads').val() != '' && $('input#passwordemail').val() != '' && $('input#imap').val() != '' &&
                $("#port").val() != 'other') || ($('input#emailsLeads').val() != '' && $('input#passwordemail').val() !=
                '' && $('input#imap').val() != '' && $("#port").val() == 'other' && $("#port_extra").val() != '')) {
            //                        && ( ( $("#port").val() != 'other') && ($("#port_extra").val() != '') )
            $("#download_animation_2").css('display', '');
            $.post('<?php echo base_url();?>users/test_imap/', {
                    emailsLeads: $('input#emailsLeads').val(),
                    passwordemail: $('input#passwordemail').val(),
                    imap: $('input#imap').val(),
                    email_client_id: $('input#email_client_id').val(),
                    email_user_id: $('input#email_user_id').val(),
                    port: $('#port').val(),
                    port_extra: $('#port_extra').val()
                },
                function(data) {
                    if (data > 0) {
                        stat = true;
                        $('#connect_status').val(data);
                        $('#resultTest2').css('display', 'none');
                        $('#resultTest3').css('display', 'none');
                        $('#resultTest1').css('display', '');
                        $("#download_animation_2").css('display', 'none');
                        $("#imap").removeClass("form_fields form_fields_error").addClass("form_fields");
                        $("#passwordemail").removeClass("form_fields form_fields_error").addClass("form_fields");
                        $("#emailsLeads").removeClass("form_fields form_fields_error").addClass("form_fields");
                        if (($("#port").val() != 'other') && ($("#port_extra").val() != '')) {
                            $("#port_extra").removeClass("form_fields form_fields_error").addClass("form_fields");
                        }
                    } else if (data <= 0) {
                        stat = false;
                        $('#connect_status').val(data);
                        $('#passwordemail').val("");
                        $('#imap').val("");
                        $('#passwordemail').focus();
                        $("#download_animation_2").css('display', 'none');
                        $('#resultTest3').css('display', 'none');
                        $('#resultTest1').css('display', 'none');
                        $('#resultTest2').css('display', '');
                        $("#download_animation_2").css('display', 'none');
                        $("#imap").removeClass("form_fields").addClass("form_fields form_fields_error");
                        $("#passwordemail").removeClass("form_fields").addClass("form_fields form_fields_error");
                        if (($("#port").val() != 'other') && ($("#port_extra").val() != '')) {
                            $("#port_extra").removeClass("form_fields").addClass("form_fields form_fields_error");
                        }
                    } else if (data == 'yes') {
                        stat = false;
                        $('#connect_status').val('0');
                        $('#passwordemail').val("");
                        $('#imap').val("");
                        $('#passwordemail').focus();
                        $("#download_animation_2").css('display', 'none');
                        $('#resultTest1').css('display', 'none');
                        $('#resultTest2').css('display', 'none');
                        $('#resultTest3').css('display', '');
                        $("#download_animation_2").css('display', 'none');
                        $("#imap").removeClass("form_fields").addClass("form_fields form_fields_error");
                        $("#passwordemail").removeClass("form_fields").addClass("form_fields form_fields_error");
                        $("#emailsLeads").removeClass("form_fields").addClass("form_fields form_fields_error");
                        if (($("#port").val() != 'other') && ($("#port_extra").val() != '')) {
                            $("#port_extra").removeClass("form_fields").addClass("form_fields form_fields_error");
                        }
                    }
                }
            );
        } else {
            alert('Please fill all the fields');
            $("#download_animation_2").css('display', 'none');
            if ($('input#emailsLeads').val() == '' && $('input#passwordemail').val() == '' && $('input#imap').val() ==
                '') {
                $("#imap").removeClass("form_fields").addClass("form_fields form_fields_error");
                $("#passwordemail").removeClass("form_fields").addClass("form_fields form_fields_error");
                $("#emailsLeads").removeClass("form_fields").addClass("form_fields form_fields_error");
            } else if ($('input#emailsLeads').val() == '' && $('input#passwordemail').val() == '' && $('input#imap').val() !=
                '') {
                $("#passwordemail").removeClass("form_fields").addClass("form_fields form_fields_error");
                $("#emailsLeads").removeClass("form_fields").addClass("form_fields form_fields_error");
            } else if ($('input#emailsLeads').val() == '' && $('input#passwordemail').val() != '' && $('input#imap').val() !=
                '') {
                $("#emailsLeads").removeClass("form_fields").addClass("form_fields form_fields_error");
            } else if ($('input#emailsLeads').val() != '' && $('input#passwordemail').val() == '' && $('input#imap').val() !=
                '') {
                $("#passwordemail").removeClass("form_fields").addClass("form_fields form_fields_error");
            } else if ($('input#emailsLeads').val() == '' && $('input#passwordemail').val() != '' && $('input#imap').val() ==
                '') {
                $("#imap").removeClass("form_fields").addClass("form_fields form_fields_error");
                $("#emailsLeads").removeClass("form_fields").addClass("form_fields form_fields_error");
            }
            if (($("#port").val() == 'other') && ($("#port_extra").val() == '')) {
                $("#port_extra").removeClass("form_fields").addClass("form_fields form_fields_error");
            }
        }
        setTimeout(function() {
            $("#resultTest1, #resultTest2, #resultTest3").fadeOut('slow');
        }, 10000);
    };
    //        end for test imap function
    /* Fetch single item details */
    var last_id = '';

    function getSingleRow(id) {
        $(".circles").css("display", "");
        $("#defaultE").trigger("click");
        $("#defaultM").trigger("click");
        $('#update').css('display', 'none'); /* This shows the update button when a filed is selected */
        $('#update, #Save, #cancel').css('display', 'none');
        $('#new').css('display', 'inline');
        $('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');
        $('#importLeadsDiv input').attr('disabled', 'disabled');
        $('#TestConnection').attr('disabled', 'disabled');
        $(".current_User").val('');
        $('#password').removeClass('required');
        animate_the_form_table_on_click();
        $.getJSON("<?php echo base_url();?>index.php/users/single/" + id, function(json) {

                                // '<?php echo base_url();?>uploads/user/profile/' + $("#current_User_client_id").val() + '/' + json.photo_agent

            $("#imgCompanyLogo").attr("src", '<?php echo base_url();?>uploads/profile/logo/' + json.logo_path);
            $("#client_id").val(json.client_id);
            $("#id").val(json.id);
            $(".current_User").val(json.id);
            $("#first_name").val(json.first_name);
            $("#last_name").val(json.last_name);
            $("#username").val(json.username);
            $("#mobile_no").val(json.mobile_no_new);
            $("#mobile_no_new").val(json.mobile_no_new);
            $("#mobile_no_new_ccode").val(json.mobile_no_new_ccode);
            $("#mobile_no_new_default").val(json.mobile_no_new);
            $("#mobile_no_new_ccode_default").val(json.mobile_no_new_ccode);
            $("#mobile_no_new1").val(json.mobile_no_new1);
            $("#mobile_no_new_ccode1").val(json.mobile_no_new_ccode1);
            $("#mobile_no_new2").val(json.mobile_no_new2);
            $("#mobile_no_new_ccode2").val(json.mobile_no_new_ccode2);
            $("#sms_mobile_no").val(json.sms_mobile_no);
            if (json.sms_mobile_ccode != "" && json.sms_mobile_ccode != 0) {
            
                $("#sms_mobile_ccode").val(json.sms_mobile_ccode);
            } else {
                $("#sms_mobile_ccode").val("205");
            }
            $("#rand_key").val(json.rand_key);
            $("#current_User_randkey").val(json.rand_key);
            $("#current_User_client_id").val(json.client_id);
            $("#office_no").val(json.office_no);
            $("#password").val('');
            $("#act_pw").val(json.act_pw);
            $("input[name='defaultemail'][value=" + json.defaultemail + "]").prop('checked', true);
            $("input[name='defaultmobile'][value=" + json.defaultmobile + "]").prop('checked', true);
            $("#access").val(json.access);
            $("#job_title").val(json.job_title);
            $("#email,#email_default").val(json.email);
            $("#email1").val(json.email1);
            $("#email2").val(json.email2);
            $("#notes").val(json.notes);
            $("#status").val(json.status);
            $("#deals_this_month").val();
            $("#commission_this_month").val();
            $("#leads_this_month").val();
            $("#disable_excel").val(json.disable_excel);
            $("#delete_permissions").val(json.delete_permissions);
            if (json.access == 3) {
                $("#delete_permissions").val(1);
            }
            $("#edit_listings").val(json.edit_listings);
            $("#access_timings_from").val(json.access_timings_from);
            $("#access_timings_to").val(json.access_timings_to);
            $("#access_days").val(json.access_days);
            $("#access_timings").val(json.access_timings);
            $("#no_of_listings").val();
            $("#disable_publish").val(json.disable_publish);
            $("#disable_sharing").val(json.disable_sharing);
            $("#landlord_details").val(json.landlord_details);
            $("#receiving_emails").val(json.receiving_emails);
            $("#rera").val(json.rera);
            $("#is_sms").val(json.is_sms);
            $("#photo_agent").val(json.photo_agent);
            $("#photo_agent2").val(json.photo_agent2);
            /* for check emails */
            $("#email_user_id").val(json.id);
            $("#email_client_id").val(json.client_id);
            /* end check emails */
            //            if($("#sms_mobile_ccode option:selected").attr('rel') != '' || $("#sms_mobile_ccode option:selected").attr('rel') != undefined){
            //            }else{
            //                 $('#sms_mobile_ccode_field').val('971');
            //            }
            $('#sms_mobile_ccode_field').val($("#sms_mobile_ccode option:selected").attr('rel'));
            $('#mobile_no_new_ccode_field,mobile_no_new_ccode_default_field').val($(
                "#mobile_no_new_ccode option:selected").attr('rel'));
            $('#mobile_no_new_ccode1_field').val($("#mobile_no_new_ccode1 option:selected").attr('rel'));
            $('#mobile_no_new_ccode2_field').val($("#mobile_no_new_ccode2 option:selected").attr('rel'));
            $("#emailsLeads").val(json.emailsLeads);
            $("#passwordemail").val(json.passwordemail);
            $("#imap").val(json.imap);
            $("#port").val(json.port);
            $("#port_extra").val(json.port_extra);
            $("#connect_status").val(json.connect_status);
            $("#target").val(json.target);
            if (json.connect_status == 1) {
                $('#Active').attr('checked', 'checked');
            } else {
                $('#Active').removeAttr('checked');
            }
            if (json.port == 'other') {
                $("#port_extra").css('display', '');
            } else {
                $("#port_extra").css('display', 'none');
            }
            //            check if the mobile verified
            var number_verified = '+' + $("#sms_mobile_ccode option:selected").attr('rel') + '-' + json.sms_mobile_no;
            if (json.sms_verified == "support_verified") {
                $('#sms-box').html('<span class="sms-box-title">' + number_verified +
                    '<img src="<?php echo base_url();?>application/views/images/sms-small-icon.png" width="14" \n\
height="14" style="margin:0px 5px;"><span class="sms-box-msg">Number Verified</span></span>'
                );
                $('#info-sms').css('display', 'none');
                $('.Verify').html('Change');
            } else if (json.sms_verified == "user_verified") {
                $('#sms-box').html('<span class="sms-box-title">' + number_verified +
                    '<img src="<?php echo base_url();?>application/views/images/sms-small-pending.png" width="14" \n\
height="14" style="margin:0px 5px;"><span class="sms-box-msg-red">Number Pending</span></span>'
                );
                $('#info-sms').css('display', 'none');
                $('.Verify').html('Change');
            } else {
                $('#sms-box').html('');
                $('#info-sms').css('display', '');
                $('.Verify').html('Verify');
            }
            //            END check if the mobile verified
            /* SIP details */

            $("#sip_ip").val(json.sip_ip);
            $("#sip_extension").val(json.sip_extension);
            $("#sip_user").val(json.sip_user);
            $("#sip_password").val(json.sip_password);
            if (json.photo_agent != '') {
                $('#photopreview').attr('src',
                    '<?php echo base_url();?>uploads/user/profile/' + $("#current_User_client_id").val() + '/' + json.photo_agent
                );
                $('#photopreviewAvatar').css('background', '#CCCCCC url(' + json.photo_agent +
                    ') no-repeat  center');
                $('#photopreviewAvatar').addClass('photopreviewAvatar')
                $('#photopreviewAvatar1').css('background-image', 'url(' + json.photo_agent + ')');
            } else {
                $('#photopreview').attr('src', '<?php echo base_url();?>images/no-user-image-square.jpg');
                $('#photopreviewAvatar1').removeAttr("style")
                $('#photopreviewAvatar').removeAttr("style")
                $('#photopreviewAvatar').addClass('photopreviewAvatar');
                $('#photopreviewAvatar1').addClass('photopreviewAvatar1');
            }
            if (json.photo_agent2 != '') {
                $('#photopreview2').attr('height', '');
                $('#photopreview2').attr('src', json.photo_agent2);
                $('#photopreviewAvatar3').css('background', '#C6CDE0 url(' + json.photo_agent2 +
                    ') no-repeat  center');
                $('#photopreviewAvatar3').addClass('photopreviewAvatar')
                $('#photopreviewAvatar4').css('background-image', 'url(' + json.photo_agent2 + ')');
            } else {
                $('#photopreview2').attr('height', '160');
                $('#photopreview2').attr('src', '<?php echo base_url();?>images/no-user-image-square.jpg');
                $('#photopreviewAvatar3').removeAttr("style")
                $('#photopreviewAvatar4').removeAttr("style")
                $('#photopreviewAvatar3').addClass('photopreviewAvatar');
                $('#photopreviewAvatar4').addClass('photopreviewAvatar1');
            }
            statusTemp = $("#status").val();
            $("#title").text(json.first_name + " " + json.last_name)
            last_id = json.id;
            if (json.id != '1448804') {
                $('#popup-verify-sms').attr('disabled', true);
                $("#info-sms_2").html('You can only verify your account.');
            } else {
                $('#popup-verify-sms').attr('disabled', false);
                $("#info-sms_2").html('');
            }
            $('#edit').css('display', 'inline');
            if (json.access == 1) {
                $("#access_field, #access_label").css("display", "none");
                $("#manager_info").css("display", "");
                $('#manager_info').html('This user is a manager');
                if (json.id != '1448804') {
                    $('#edit').css('display', 'none');
                }
            } else if (json.access == 2 && '1' != 1) {
                $("#access_field, #access_label").css("display", "none");
                $("#manager_info").css("display", "");
                $('#manager_info').html('This user is an admin');
                if (json.id != '1448804') {
                    $('#edit').css('display', 'none');
                }
            } else {
                $("#accessEmailDiv").css("display", "none");
                $("#manager_info").css("display", "none");
                $("#access_field, #access_label").css("display", "");
                $('#manager_info').html('');
            }
            if ($('input#id').val() == 1448804) {
                $('#disable_publish').attr('disabled', 'disabled');
                $('.permissions').css('color', 'grey');
            } else {
                $('#disable_publish').attr('disabled', false);
                $('.permissions').css('color', 'black');
            }
            if (json.access <= 2) {
                //$('#user_info').text('Selected user can view and edit all the listings for your company.');
                $("#accessEmailDiv").css("display", "");
            } else {
                $('#user_info').text('');
                $("#accessEmailDiv").css("display", "none");
            }
            //plot days access
            $(".access_timings_days").attr("checked", false);
            var access_days = json.access_days.split(',');
            for (i = 0; i < access_days.length; i = i + 1) {
                $("#access_timings_" + access_days[i]).attr("checked", "checked");
                //alert(access_days[i]);
            }
            display_access_timings();
            delete_permissions(json.access, 1);
            disable_sharing(json.access);
            edit_listings(json.access, 1);
            //select1
            $("#select1").text('')
            $("#select1values").val(json.blocked);
            var select1 = json.blocked.split(",");
            var i;
            for (i = 0; i < select1.length; ++i) {
                if (select1[i] != '') {
                    code = '<option value="' + select1[i] + '">' + ucfirst(select1[i]) + '</option>';
                    $("#select1").append(code);
                }
            }
            //select2
            $("#select2").text('')
            $("#select2values").val(json.readonly);
            var select2 = json.readonly.split(",");
            var i;
            for (i = 0; i < select2.length; ++i) {
                if (select2[i] != '') {
                    code = '<option value="' + select2[i] + '">' + ucfirst(select2[i]) + '</option>';
                    $("#select2").append(code);
                }
            }
            //select3
            $("#select3").text('')
            $("#select3values").val(json.editable);
            var select3 = json.editable.split(",");
            var i;
            for (i = 0; i < select3.length; ++i) {
                if (select3[i] != '') {
                    code = '<option value="' + select3[i] + '">' + ucfirst(select3[i]) + '</option>';
                    $("#select3").append(code);
                }
            }
            //user share data
            //commented out
            // //select2user
            // $("#select2user").text('')
            // $("#select2user").text('')
            // $("#select2uservalues").val(json.co_user_id);
            // var select2userID = json.co_user_id.split(",");
            // var select2user = json.co_users_name.split(",");
            // var i;
            // for(i = 0; i < select2user.length; i=i+1) {
            //     //alert(select2userID[i]);
            //     if(select2user[i]!=''){
            //         code='<option value="'+select2userID[i]+'">'+select2user[i]+'</option>';
            //         $("#select2user").append(code);
            //     }
            // }
            //select1user
            // $("#select1user").text('')
            // $("#select1user").text('')
            // $("#select1uservalues").val(json.co_not_user_id);
            // var select1userID = json.co_not_user_id.split(",");
            // var select1user   = json.co_users_name_not.split(",");
            // var i;
            // for(i = 0; i < select1user.length; i=i+1) {
            //     if(select1user[i]!=''){
            //         code='<option value="'+select1userID[i]+'">'+select1user[i]+'</option>';
            //         $("#select1user").append(code);
            //     }
            // }
            $('#showdata').css('color', '#49AC44');
            $('#showdata').html('Record selected')
            $('#showdata').fadeIn("slow");
            setTimeout(function() {
                $('#showdata').fadeOut("slow");
            }, 5000);
        }); //End json 
        formDataChange = false;
        disable_popup();
    }
    $(document.body).on("click", '#listings_row tbody tr', function() {
        if (formDataChange == true) {
            var result = confirm("You have not saved the data, all changes will be lost!")
        }
        if (result == true || formDataChange == false) {
            var id = $(this).attr('id');
            //#k set radio button on clicked tr to checked.
            $(this).find("input").prop("checked", true);
            getSingleRow(id);
        }
    }); //End click 
    $(document).ready(function() {
        $('.mana').click(function(e) {
            if ($('.email_popup').hasClass("on")) {
                e.preventDefault();
            } else {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
            }
        });
        $("input").tooltip({
            extraClass: "tooltip",
            showURL: false
        });
        $('#myForm input, #myForm select, #myForm textarea').attr('disabled', 'disabled');
        $('#importLeadsDiv input').attr('disabled', 'disabled');
        formDataChange = false;
        $("#price").keyup(function() {
            $('#frequency').attr('required', 'required');
        });
        $('#access_timings_from, #access_timings_to').change(function() {
            display_access_timings();
        });
        $('#access').change(function() {
            var sts = $(this).val();
            if (sts == 3) {
                $("#accessEmailDiv").css("display", "none");
            } else {
                $("#accessEmailDiv").css("display", "");
            }
        });
        $('.testtest').click(function() {
            var time_start = $('#access_timings_from').val();
            var time_end = $('#access_timings_to').val();
            if ((time_start != '' && time_end == '') || (time_start == '' && time_end != '')) {
                alert("Please specify access timings 'From' and access timings 'To'.")
                return false;
            }
        });

        function plot_week_days() {
            var checkedDays = [];
            $('.access_timings_days:checked').each(function() {
                checkedDays.push($(this).attr("day"));
            });
            $("#access_days").val(checkedDays);
            display_access_timings();
        }
        $('.access_timings_days').change(function() {
            plot_week_days();
        });
        $('#access').change(function() {
            if (currentContext === 'new') {
                updateAccessibleScreens();
            }
            delete_permissions(this.value, 0);
            disable_sharing(this.value);
            edit_listings(this.value, 0);
        });

        function updateAccessibleScreens() {
            var accessibleScreensArray = [];
            screens = screenData.split(',');
            $('#select3 option').remove();
            arrayIndex = 0;
            for (i = 0; i < screens.length; i = i + 1) {
                if (screens[i] != 'accounts') {
                    code = '<option value="' + screens[i] + '">' + ucfirst(screens[i]) + '</option>';
                    $("#select3").append(code);
                    accessibleScreensArray[arrayIndex] = screens[i];
                    arrayIndex++;
                } else {
                    if ($('#access').val() == 1) {
                        code = '<option value="' + screens[i] + '">' + ucfirst(screens[i]) + '</option>';
                        $("#select3").append(code);
                        accessibleScreensArray[arrayIndex] = screens[i];
                        arrayIndex++;
                    }
                }
            }
            var accessibleScreens = accessibleScreensArray.join();
            $('#select3values').val(accessibleScreens);
            // Accounts will be a blocked option by default
            $('#select1 option').remove();
            $('#select1values').val("");
            for (i = 0; i < screens.length; i = i + 1) {
                if (screens[i] == 'accounts' && $('#access').val() != 1) {
                    code = '<option value="' + screens[i] + '">' + ucfirst(screens[i]) + '</option>';
                    $("#select1").append(code);
                    $('#select1values').val(screens[i]);
                }
            }
        }
        $('#new, #edit').click(function() {
            $(".circles").css("display", "none");
            $("#defaultE").trigger("click");
            $("#defaultM").trigger("click");
            delete_permissions($('#access').val(), 0);
            disable_sharing($('#access').val());
            edit_listings($('#access').val(), 0);
            if ($('#access').val() == 3) {
                $("#accessEmailDiv").css("display", "none");
            } else {
                $("#accessEmailDiv").css("display", "");
            }
            if (this.id == 'new') {
                $("#manager_info").css("display", "none");
                $("#access_field, #access_label").css("display", "");
                $('#manager_info').html('');
            }
        });
        $(document.body).on("click", '#edit', function() {
            currentContext = 'edit';
            $('#importLeadsDiv input').removeAttr('disabled');
            $('#TestConnection').removeAttr('disabled');
        });
        $(document.body).on("click", '#new', function() {
            currentContext = 'new';
            CheckPasswordexsit = "";
            $('#photopreviewAvatar1').removeAttr("style")
            $('#photopreviewAvatar1').addClass('photopreviewAvatar1');
            $('#photopreviewAvatar4').removeAttr("style")
            $('#photopreviewAvatar4').addClass('photopreviewAvatar4');
            $('#photopreviewAvatar3').removeAttr("style")
            $('#photopreviewAvatar').removeAttr("style")
            $('#photopreview').attr('src', '<?php echo base_url();?>images/no-user-image-square.jpg');
            $('#photopreview2').attr('height', '160');
            $('#photopreview2').attr('src', '<?php echo base_url();?>images/no-user-image-square.jpg');
            $('#grad').remove();
            $('#score').removeAttr("style")
            $('#password').addClass('required');
            $('#importLeadsDiv input').removeAttr('disabled');
            $('#TestConnection').removeAttr('disabled');
            $.post("<?php echo base_url();?>users/get_screens", {
                    nothing: $('#nothing').val()
                },
                function(data) {
                    screenData = data;
                    updateAccessibleScreens();
                });
            if ($(".checkonoff a").hasClass("off")) {
                $(".checkonoff a").addClass('on').removeClass('off');
            }
            /* check all days and plot the values */
            $('.access_timings_days').attr('checked', 'checked');
            plot_week_days();
            $('#sms-box').html('');
            $('#info-sms').css('display', '');
            $('.Verify').html('Verify');
        });
        /////////Manage screens Popup///////////////////////////          
        $(document.body).on("click", '.managescreens_popup', function(event) {
            $('#users_managescreens_popup').fadeIn("slow");
            $('#users_managescreens_popup').each(function() {
                $(this).css('left', ($(window).width() - $(this).outerWidth()) / 2 + 'px');
                $(this).css('top', ($(window).height() - $(this).outerHeight()) / 3 + 'px');
            });
            $("body").append('<div class="managescreens-overlay" style="z-index: 1001;"></div>');
            $(document).keydown(function(e) {
                if (e.keyCode === 27) {
                    $('#users_managescreens_popup').fadeOut("fast");
                    $(".managescreens-overlay").fadeOut('fast');
                }
            });
        });
        $('#manageScreensBoxClose').click(function() {
            $("#users_managescreens_popup").fadeOut('fast');
            $(".managescreens-overlay").fadeOut('fast');
        });
        $('#manageScreensBoxOKClose').click(function() {
            $("#users_managescreens_popup").fadeOut('fast');
            $(".managescreens-overlay").fadeOut('fast');
        });
        $(document.body).on("click", '.managescreens-overlay', function(event) {
            $("#users_managescreens_popup").fadeOut('fast');
            $(".managescreens-overlay").fadeOut('fast');
        });
        $("#users_managescreens_popup").draggable();
        $('.managescreens_popup').click(function(e) {
            if ($('.managescreens_popup').hasClass("on")) {
                e.preventDefault();
            } else {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
            }
        });
        /////////Share Options Popup///////////////////////////
        $(document.body).on("click", '.shareoptions_popup', function(event) {
            $('#users_shareoptions_popup').fadeIn("slow");
            $('#users_shareoptions_popup').each(function() {
                $(this).css('left', ($(window).width() - $(this).outerWidth()) / 2 + 'px');
                $(this).css('top', ($(window).height() - $(this).outerHeight()) / 3 + 'px');
            });
            $("body").append('<div class="shareoptions-overlay" style="z-index: 1001;"></div>');
            $(document).keydown(function(e) {
                if (e.keyCode === 27) {
                    $('#users_shareoptions_popup').fadeOut("fast");
                    $(".shareoptions-overlay").fadeOut('fast');
                }
            });
        });
        $('#shareOptionsBoxClose').click(function() {
            $("#users_shareoptions_popup").fadeOut('fast');
            $(".shareoptions-overlay").fadeOut('fast');
        });
        $('#shareOptionsBoxOKClose').click(function() {
            $("#users_shareoptions_popup").fadeOut('fast');
            $(".shareoptions-overlay").fadeOut('fast');
        });
        $(document.body).on("click", '.shareoptions-overlay', function(event) {
            $("#users_shareoptions_popup").fadeOut('fast');
            $(".shareoptions-overlay").fadeOut('fast');
        });
        $("#users_shareoptions_popup").draggable();
        $('.shareoptions_popup').click(function(e) {
            if ($('.shareoptions_popup').hasClass("on")) {
                e.preventDefault();
            } else {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
            }
        });
    });

    function password_strength(password, strlen) {
        //SEARCHES FOR EACH OF THESE PATTERNS FOR VARIETY
        var lo = /[a-z]+/g;
        var up = /[A-Z]+/g;
        var num = /[0-9]+/g;
        var sym = /[^A-Za-z0-9]+/g;
        //BLANK UNTIL COUNTS VARIETY AND SYMBOLS (DO NOT REMOVE)
        var variety = 0;
        var symbols = 0;
        var lettre = 0;
        var chifre = 0;
        if (strlen >= 8 && strlen <= 25) {
            if (password.match(lo)) {
                variety++;
            }
            if (password.match(up)) {
                variety++;
            }
            if (password.match(num)) {
                variety++;
            }
            if (password.match(sym)) {
                variety++;
            }
            //COUNTS SYMBOLS, USED FOR EXTRA POINTS
            for (i = 0; i < strlen; i++) {
                if (password.substr(i, 1).match(sym)) {
                    symbols++;
                }
            }
            var score = strlen; //POINT GIVEN FOR EVERY CHARACTER
            //IF THERE ARE 3 VARIETIES, 1.5 FOR EACH & 2 FOR EACH SYMBOL
            //IF THERE ARE >=3 VARIETIES, 1.5 FOR EACH & 3 FOR EACH SYMBOL
            //BUT, IF <= 8 CHARS, ONLY 2 GIVEN FOR EACH SYMBOL
            if (variety >= 3) {
                if (strlen >= 8) {
                    score += (variety * 1.5) + (symbols * 3);
                } else {
                    score += (variety * 1.5) + (symbols * 2);
                }
            }
            var scale = 25; //MEASURES OUT OF 25 PTS, MAY BE MORE FOR SUPERSTRONG PASSWORDS
            var percent = (score / scale) * 100; //GETS PERCENT OF THE SCALE
            //MAY BE > 100%, THEREFORE SCALES BACK TO 100 FOR CSS PURPOSES
            if (percent > 100) {
                percent = 100;
            }
            //WIDTH OF THE BAR
            var bar = $("#bar").width();
            //WIDTH OF SHADED AREA
            var shade = (percent * bar) / 100;
            if (variety == 1) {
                percent = 20;
                shade = (percent * bar) / 100;
            }
            if (variety == 2) {
                percent = 30;
                shade = (percent * bar) / 100;
            }
            //GRADING JUDGMENTS & SHADE BG COLOR
            if (percent < 50) {
                var grade = "<span id='grad' value='Weak' style='color:red'>Weak</span>";
                $('#status_p').val('1');
                var bg = "#e8f9ff";
            }
            if (percent >= 50 && percent < 70) {
                var grade = "Fair";
                $('#status_p').val('3');
                var bg = "#e8f9ff";
            }
            if (percent >= 70 && percent < 85) {
                var grade = "<span id='grad'>Good</span>";
                var bg = "#32baed";
                $('#status_p').val('5');
            }
            if (percent >= 85) {
                var grade = "<span id='grad'>Strong</span>";
                var bg = "#12495d";
                $('#status_p').val('7');
            }
            //CHANGES COLOR & WIDTH OF SHADED AREA
            $("#score").css({
                "background": bg,
                "width": shade + "px"
            });
        } else {
            $("#score").css({
                "background": "#ffffff",
                "width": "0px"
            });
            var grade = "<span id='grad' value='Weak' style='color:red'>Weak</span>";
            $('#status_p').val('1');
        }
        $("#grade").html(grade); //DISPLAY JUDGMENT IN HTML
    }

</script>
<style>
    #bar {
        background: #ffffff;
        border: 1px solid #D3D3D3;
        height: 12px;
        width: 80px;
        margin-bottom: 3px;
        margin-right: 12px;
        margin-top: 1px;
        float: right;
    }
    
    #score {
        height: 10px;
        width: 0;
    }

</style>
<div id="wrapper">

    <div class="container">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <div class="page_head_area">
                    <h1><i class="fa fa-group"></i> Users</h1></div>
            </div>
        </div>
        <div id="showdata"></div>
        <!-- Error Message Alert -->
        <div role="alert" class="alert alert-danger alert-dismissible fade in" id="errorMsg" style="display:none;">
            <button aria-label="Close" data-dismiss="alert" class="close" type="button">
              <span aria-hidden="true">×</span></button>
            <strong>Error!</strong> <span id="errortxt">here is error text</span>
        </div>
        <!-- Success Message Alert -->
        <div role="alert" class="alert alert-success alert-dismissible fade in" id="successMsg" style="display:none;">
            <button aria-label="Close" data-dismiss="alert" class="close" type="button">
              <span aria-hidden="true">×</span></button>
            <strong>Success!</strong> <span id="successtxt">here is success text</span>
        </div>
        <!-- Info Message Alert -->
        <div role="alert" class="alert alert-info alert-dismissible fade in" id="infoMsg" style="display:none;">
            <button aria-label="Close" data-dismiss="alert" class="close" type="button">
              <span aria-hidden="true">×</span></button>
            <strong>Info!</strong> <span id="infotxt">here is error text</span>
        </div>
        <div id="inner_tab">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Nav tabs -->
                    <div class="inner_tab_nav">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="<?php echo site_url('users');?>">Manage Users</a></li>
                            <li><a href="<?php echo site_url('users/groups');?>">Manage Groups</a></li>
                            <li><a href="<?php echo site_url('users/questions');?>">Manage Security Questions</a></li>
                        </ul>
                    </div>
                    <!-- Tab content -->
                    <div class="tab-content">
                        <?php
         $attributes = array('data-toggle' => 'validator', 'id' => 'myForm', 'role' => 'form');
        echo form_open_multipart('users/submit', $attributes);
        ?>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="button" id="new" class="btn btn-lg btn-primary"><i class="fa fa-plus-circle"></i>New User</button>
                                    <button style="display:none;" type="submit" id="update" class="btn btn-lg btn-success" name="Update" value="Update Listing">
            <i class="fa fa-plus-circle"></i> Save User</button>
                                    <button style="display:none;" type="submit" id="Save" class="btn btn-lg btn-success" name="Save" value="Save Listing">
            <i class="fa fa-plus-circle"></i> Save User</button>
                                    <button style="display:none;" type="button" id="edit" class="btn btn-lg btn-warning"><i class="fa fa-plus-circle"></i>Edit User</button>
                                    <a href="javascript:void(0)" id="cancel" class="btn btn-lg btn-default" style="display:none;"><i class="fa fa-times"></i> Cancel</a>
                                </div>
                            </div>
                            <h4 class="add_new_rental">Add New Record</h4>
                            <!--hidden fields-->
                            <input type="hidden" id="status_p" name="status_p" value="" />
                            <input name="id" class="form-control" id="id" style="display:none;" value="0" readonly>
                            <input name="rand_key" type="text" style="display:none;" id="rand_key" readonly value="">
                            <input name="act_pw" type="text" style="display:none;" id="act_pw" readonly value="">
                            <input name="photo_agent" style="display:none;" class="form_fields" id="photo_agent" value="">
                            <input name="photo_agent2" style="display:none;" class="form_fields" id="photo_agent2" value="">
                            <input name="select1values" id="select1values" value="" size="100" type="hidden">
                            <input name="select2values" id="select2values" value="" size="100" type="hidden">
                            <input name="select3values" id="select3values" value="" size="100" type="hidden">
                            <input name="select1uservalues" id="select1uservalues" value="" size="100" type="hidden">
                            <input name="select2uservalues" id="select2uservalues" value="" size="100" type="hidden">
                            <div class="row fadeInUp">
                                <div class="col-md-3">
                                    <h5 class="text-primary">Login Details</h5>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control input-sm required" name="username" id="username">
                                    </div>
                                    <div class="form-group">
                                        <label>Password <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-original-title="Password Requirements" data-content="
                   Your password must follow these rules:<br /> 
                   1.   Must be between 8 and 25 characters long.<br />
                   2.   Must contain at least one letter in upper case.<br />                   
                   3.   Must contain at least one number.<br /> 
                   4.   Cannot be same as your username.<br />                                                            
                   You will need to change your password once every 60 days, for which you will receive an auto-reminder.">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                                        <div id="bar">
                                            <div id="score"></div>
                                        </div> <span id="grade" style="display: inline-block;"></span>
                                        <input type="password" class="form-control input-sm" id="password" name="password" onKeyUp="password_strength(this.value, this.value.length)">
                                    </div>
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control input-sm" name="status" id="status">
                                        <option value="1" selected="selected">Active</option>
                                        <option value="0" >Inactive</option>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <span id="access_label"><label>User Type</label></span>
                                        <div id="manager_info" style="display: none;" class="field-disabled-text"></div>
                                        <span id="access_field">
                   <!--manage is team lead for sales team...its not like general manager-->
                     <select class="form-control input-sm" name="access" id="access">
                       <option value="1">Super Admin</option>
                        <option value="2" >Admin</option>
                         <option value="3" selected>Agent</option>
                         <option value="4">Manager</option>
                    </select>
                                     </span>
                                    </div>
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <select class="form-control input-sm" name="client_id" id="client_id">
                                        <!-- <option value="1000000" selected="selected">Individual</option> -->
                                         <?php foreach($AllCompanies as $listing):?>
                                           <option value="<?php echo $listing['id'];?>"> <?php echo $listing['name'];?> </option>
                                        <?php endforeach;?>
                                    </select>
                                    </div>
                                    <h5 class="text-primary">Contact Details</h5>
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input name="first_name" type="text" class="form-control input-sm required" id="first_name">
                                    </div>
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input name="last_name" type="text" class="form-control input-sm required" id="last_name">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                  <a id='popup-view-landlord_email' href="" rel='popup_email'  class="popup_a popup_email" data-toggle="modal" data-target="#email_popup">
                  <i class="fa fa-plus-circle"></i></a>
                  </span>
                                            <input type="text" class="form-control input-sm" id="email" name="email">
                                        </div>
                                        <span class="right circles" style="display: none;">
                                            <div class="contact-circle" id="defaultE"></div>
                                            <div class="contact-circle contact-hollow-circle" id="E1" ></div>
                                            <div class="contact-circle contact-hollow-circle" id="E2"></div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <span class="right circles" style="display: none;">
                                                <div class="contact-circle" id="defaultM"></div>
                                                <div class="contact-circle contact-hollow-circle" id="M1" ></div>
                                                <div class="contact-circle contact-hollow-circle" id="M2"></div>
                                            </span>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                  <a class="popup_a" id='popup-view-landlord_phone' href="" rel='popup_mobile' data-toggle="modal" data-target="#mobile" ><i class="fa fa-plus-circle"></i></a></span>
                                            <select name="mobile_no_new_ccode" id="mobile_no_new_ccode" class="form-control  input-sm">
 <option value="1">USA (+1)</option> 
 <option value="213">Algeria (+213)</option> 
 <option value="376">Andorra (+376)</option> 
 <option value="244">Angola (+244)</option> 
 <option value="1264">Anguilla (+1264)</option> 
 <option value="1268">Antigua &amp; Barbuda (+1268)</option> 
 <option value="599">Antilles (Dutch) (+599)</option> 
 <option value="54">Argentina (+54)</option> 
 <option value="374">Armenia (+374)</option> 
 <option value="297">Aruba (+297)</option> 
 <option value="247">Ascension Island (+247)</option> 
 <option value="61">Australia (+61)</option> 
 <option value="43">Austria (+43)</option> 
 <option value="994">Azerbaijan (+994)</option> 
 <option value="1242">Bahamas (+1242)</option> 
 <option value="973">Bahrain (+973)</option> 
 <option value="880">Bangladesh (+880)</option> 
 <option value="1246">Barbados (+1246)</option> 
 <option value="375">Belarus (+375)</option> 
 <option value="32">Belgium (+32)</option> 
 <option value="501">Belize (+501)</option> 
 <option value="229">Benin (+229)</option> 
 <option value="1441">Bermuda (+1441)</option> 
 <option value="975">Bhutan (+975)</option> 
 <option value="591">Bolivia (+591)</option> 
 <option value="387">Bosnia Herzegovina (+387)</option> 
 <option value="267">Botswana (+267)</option> 
 <option value="55">Brazil (+55)</option> 
 <option value="673">Brunei (+673)</option> 
 <option value="359">Bulgaria (+359)</option> 
 <option value="226">Burkina Faso (+226)</option> 
 <option value="257">Burundi (+257)</option> 
 <option value="855">Cambodia (+855)</option> 
 <option value="237">Cameroon (+237)</option> 
 <option value="1">Canada (+1)</option> 
 <option value="238">Cape Verde Islands (+238)</option> 
 <option value="1345">Cayman Islands (+1345)</option> 
 <option value="236">Central African Republic (+236)</option> 
 <option value="56">Chile (+56)</option> 
 <option value="86">China (+86)</option> 
 <option value="57">Colombia (+57)</option> 
 <option value="269">Comoros (+269)</option> 
 <option value="242">Congo (+242)</option> 
 <option value="682">Cook Islands (+682)</option> 
 <option value="506">Costa Rica (+506)</option> 
 <option value="385">Croatia (+385)</option> 
 <option value="53">Cuba (+53)</option> 
 <option value="90392">Cyprus North (+90392)</option> 
 <option value="357">Cyprus South (+357)</option> 
 <option value="42">Czech Republic (+42)</option> 
 <option value="45">Denmark (+45)</option> 
 <option value="2463">Diego Garcia (+2463)</option> 
 <option value="253">Djibouti (+253)</option> 
 <option value="1809">Dominica (+1809)</option> 
 <option value="1809">Dominican Republic (+1809)</option> 
 <option value="593">Ecuador (+593)</option> 
 <option value="20">Egypt (+20)</option> 
 <option value="353">Eire (+353)</option> 
 <option value="503">El Salvador (+503)</option> 
 <option value="240">Equatorial Guinea (+240)</option> 
 <option value="291">Eritrea (+291)</option> 
 <option value="372">Estonia (+372)</option> 
 <option value="251">Ethiopia (+251)</option> 
 <option value="500">Falkland Islands (+500)</option> 
 <option value="298">Faroe Islands (+298)</option> 
 <option value="679">Fiji (+679)</option> 
 <option value="358">Finland (+358)</option> 
 <option value="33">France (+33)</option> 
 <option value="594">French Guiana (+594)</option> 
 <option value="689">French Polynesia (+689)</option> 
 <option value="241">Gabon (+241)</option> 
 <option value="220">Gambia (+220)</option> 
 <option value="7880">Georgia (+7880)</option> 
 <option value="49">Germany (+49)</option> 
 <option value="233">Ghana (+233)</option> 
 <option value="350">Gibraltar (+350)</option> 
 <option value="30">Greece (+30)</option> 
 <option value="299">Greenland (+299)</option> 
 <option value="1473">Grenada (+1473)</option> 
 <option value="590">Guadeloupe (+590)</option> 
 <option value="671">Guam (+671)</option> 
 <option value="502">Guatemala (+502)</option> 
 <option value="224">Guinea (+224)</option> 
 <option value="245">Guinea - Bissau (+245)</option> 
 <option value="592">Guyana (+592)</option> 
 <option value="509">Haiti (+509)</option> 
 <option value="504">Honduras (+504)</option> 
 <option value="852">Hong Kong (+852)</option> 
 <option value="36">Hungary (+36)</option> 
 <option value="354">Iceland (+354)</option> 
 <option value="91">India (+91)</option> 
 <option value="62">Indonesia (+62)</option> 
 <option value="98">Iran (+98)</option> 
 <option value="964">Iraq (+964)</option> 
 <option value="972">Israel (+972)</option> 
 <option value="39">Italy (+39)</option> 
 <option value="225">Ivory Coast (+225)</option> 
 <option value="1876">Jamaica (+1876)</option> 
 <option value="81">Japan (+81)</option> 
 <option value="962">Jordan (+962)</option> 
 <option value="7">Kazakhstan (+7)</option> 
 <option value="254">Kenya (+254)</option> 
 <option value="686">Kiribati (+686)</option> 
 <option value="850">Korea North (+850)</option> 
 <option value="82">Korea South (+82)</option> 
 <option value="965">Kuwait (+965)</option> 
 <option value="996">Kyrgyzstan (+996)</option> 
 <option value="856">Laos (+856)</option> 
 <option value="371">Latvia (+371)</option> 
 <option value="961">Lebanon (+961)</option> 
 <option value="266">Lesotho (+266)</option> 
 <option value="231">Liberia (+231)</option> 
 <option value="218">Libya (+218)</option> 
 <option value="417">Liechtenstein (+417)</option> 
 <option value="370">Lithuania (+370)</option> 
 <option value="352">Luxembourg (+352)</option> 
 <option value="853">Macao (+853)</option> 
 <option value="389">Macedonia (+389)</option> 
 <option value="261">Madagascar (+261)</option> 
 <option value="265">Malawi (+265)</option> 
 <option value="60">Malaysia (+60)</option> 
 <option value="960">Maldives (+960)</option> 
 <option value="223">Mali (+223)</option> 
 <option value="356">Malta (+356)</option> 
 <option value="692">Marshall Islands (+692)</option> 
 <option value="596">Martinique (+596)</option> 
 <option value="222">Mauritania (+222)</option> 
 <option value="269">Mayotte (+269)</option> 
 <option value="52">Mexico (+52)</option> 
 <option value="691">Micronesia (+691)</option> 
 <option value="373">Moldova (+373)</option> 
 <option value="377">Monaco (+377)</option> 
 <option value="976">Mongolia (+976)</option> 
 <option value="1664">Montserrat (+1664)</option> 
 <option value="212">Morocco (+212)</option> 
 <option value="258">Mozambique (+258)</option> 
 <option value="95">Myanmar (+95)</option> 
 <option value="264">Namibia (+264)</option> 
 <option value="674">Nauru (+674)</option> 
 <option value="977">Nepal (+977)</option> 
 <option value="31">Netherlands (+31)</option> 
 <option value="687">New Caledonia (+687)</option> 
 <option value="64">New Zealand (+64)</option> 
 <option value="505">Nicaragua (+505)</option> 
 <option value="227">Niger (+227)</option> 
 <option value="234">Nigeria (+234)</option> 
 <option value="683">Niue (+683)</option> 
 <option value="672">Norfolk Islands (+672)</option> 
 <option value="670">Northern Marianas (+670)</option> 
 <option value="47">Norway (+47)</option> 
 <option value="968">Oman (+968)</option> 
 <option value="92">Pakistan (+92)</option> 
 <option value="680">Palau (+680)</option> 
 <option value="507">Panama (+507)</option> 
 <option value="675">Papua New Guinea (+675)</option> 
 <option value="595">Paraguay (+595)</option> 
 <option value="51">Peru (+51)</option> 
 <option value="63">Philippines (+63)</option> 
 <option value="48">Poland (+48)</option> 
 <option value="351">Portugal (+351)</option> 
 <option value="1787">Puerto Rico (+1787)</option> 
 <option value="974">Qatar (+974)</option> 
 <option value="262">Reunion (+262)</option> 
 <option value="40">Romania (+40)</option> 
 <option value="7">Russia (+7)</option> 
 <option value="250">Rwanda (+250)</option> 
 <option value="378">San Marino (+378)</option> 
 <option value="239">Sao Tome &amp; Principe (+239)</option> 
 <option value="966">Saudi Arabia (+966)</option> 
 <option value="221">Senegal (+221)</option> 
 <option value="381">Serbia (+381)</option> 
 <option value="248">Seychelles (+248)</option> 
 <option value="232">Sierra Leone (+232)</option> 
 <option value="65">Singapore (+65)</option> 
 <option value="421">Slovak Republic (+421)</option> 
 <option value="386">Slovenia (+386)</option> 
 <option value="677">Solomon Islands (+677)</option> 
 <option value="252">Somalia (+252)</option> 
 <option value="27">South Africa (+27)</option> 
 <option value="34">Spain (+34)</option> 
 <option value="94">Sri Lanka (+94)</option> 
 <option value="290">St. Helena (+290)</option> 
 <option value="1869">St. Kitts (+1869)</option> 
 <option value="1758">St. Lucia (+1758)</option> 
 <option value="249">Sudan (+249)</option> 
 <option value="597">Suriname (+597)</option> 
 <option value="268">Swaziland (+268)</option> 
 <option value="46">Sweden (+46)</option> 
 <option value="41">Switzerland (+41)</option> 
 <option value="963">Syria (+963)</option> 
 <option value="886">Taiwan (+886)</option> 
 <option value="7">Tajikstan (+7)</option> 
 <option value="66">Thailand (+66)</option> 
 <option value="228">Togo (+228)</option> 
 <option value="676">Tonga (+676)</option> 
 <option value="1868">Trinidad &amp; Tobago (+1868)</option> 
 <option value="216">Tunisia (+216)</option> 
 <option value="90">Turkey (+90)</option> 
 <option value="7">Turkmenistan (+7)</option> 
 <option value="993">Turkmenistan (+993)</option> 
 <option value="1649">Turks &amp; Caicos Islands (+1649)</option> 
 <option value="688">Tuvalu (+688)</option> 
 <option value="256">Uganda (+256)</option> 
 <option value="44" >UK (+44)</option> 
 <option value="380">Ukraine (+380)</option> 
 <option value="971" selected="selected">United Arab Emirates (+971)</option> 
 <option value="598">Uruguay (+598)</option> 
 <option value="1">USA (+1)</option> 
 <option value="7">Uzbekistan (+7)</option> 
 <option value="678">Vanuatu (+678)</option> 
 <option value="379">Vatican City (+379)</option> 
 <option value="58">Venezuela (+58)</option> 
 <option value="84">Vietnam (+84)</option> 
 <option value="84">Virgin Islands - British (+1284)</option> 
 <option value="84">Virgin Islands - US (+1340)</option> 
 <option value="681">Wallis &amp; Futuna (+681)</option> 
 <option value="969">Yemen (North)(+969)</option> 
 <option value="967">Yemen (South)(+967)</option> 
 <option value="381">Yugoslavia (+381)</option> 
 <option value="243">Zaire (+243)</option> 
 <option value="260">Zambia (+260)</option> 
 <option value="263">Zimbabwe (+263)</option>
  </select>
                                            <input id="mobile_no_new" name="mobile_no_new" type="text" class="ltrim required form-control input-sm" value="" maxlength="10">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Job Title</label>
                                        <input name="job_title" type="text" id="job_title" class="form-control input-sm">
                                    </div>
                                    <div class="form-group">
                                        <label>Office Tel</label>
                                        <input name="office_no" type="text" id="office_no" class="form-control input-sm">
                                    </div>
                                    <div class="form-group">
                                        <label>RERA BRN</label>
                                        <input name="rera" type="text" class="form-control input-sm" id="rera" value="">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="text-primary">User Marketing Photos</h5>
                                    <div class="form-group">
                                        <label>User Profile Photo <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-original-title="User Profile Photo" data-content="
                  Upload the user's profile photo here. The photo will be displayed on PDF brochures and the listing web preview. The image should in JPG or PNG file format, with dimensions as 160 px width by 160 px height" class="popover-link-sup">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                                        <div class="form-group">
                                            <a href="" data-toggle="modal" data-target="#popup3" class="cn-nav-prev popup_a" rel="popup3" id="popup-agent-head-shot">
                   <img src="<?php echo base_url();?>images/no-user-image-square.jpg" alt="" class="img-circle user_marketing_img"></a>
                                            <a href="" class="popup_a" rel="popup3" id="popup-avatar" data-toggle="modal" data-target="#popup3"><i class="fa fa-plus-circle"></i></a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Contact Image <a href="#" rel="popup3"  id="popup-agent-footer-image" class="cn-nav-prev popup_a" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-original-title="Contact Image" data-content="
                  Upload the agent's contact image here. It can be used to display the company branding and agent's contact details on photos uploaded to listings. On the listings photos page, just ensure the Contact Image option is selected for either one or all uploaded photos. The image should in PNG file format. The ideal dimensions should be 800 px width, while the height can vary between 100 px - 160 px."><i class="fa fa-info-circle"></i>
                   </a></label>
                                        <div class="form-group">
                                            <a href="#"><img id="imgCompanyLogo" src="<?php echo base_url();?>images/company_logo.jpg" alt="" style="max-width: 150px;max-height: 60px" class="user_marketing_img"></a>
                                            <!-- <a href="" rel="popup3" id="popup-agent-footer-image-2" class="    popup_a inline-block" data-toggle="modal" data-target="#popup3"><i class="fa fa-plus-circle"></i></a> -->
                                        </div>
                                    </div>
                                    <h5 class="text-primary">User Access Settings</h5>
                                    <div class="form-group">
                                        <label>Permissions <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-original-title="Permissions" data-content="
                   Select which publishing permissions you would like to set for your agents and admins.<br /><br /> 
                   1.<b> No approval required:</b> This setting will allow the user to freely publish all listings.<br />                                                       
                   2.<b> Approval required for new and edit listings:</b> This setting will prevent the user from publishing new listings or publishing any edits to existing listings.<br />                                                       
                   3.<b> Approval required for new listings:</b> This settings will prevent the users from publishing new listings only.<br />">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                                        <select name="disable_publish" class="form-control input-sm " id="disable_publish">
                                            <option value="0">No approval required</option>
                                            <option value="1">Approval required for new and edit listings</option>
                                            <option value="2" selected>Approval required for new listings</option>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Excel Export  <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-original-title="Excel Export" data-content="
                   This option determines whether the user can export data from various screens to Excel.<br /><br />                                                   
                   1.<b> Yes:</b> This will allow your user to download their visible listings to Excel from the listings screens (this applies to all accounts - agents, admins and managers).<br />                                                   
                   2.<b> No:</b> This will prevent the user from downloading anything to Excel (this applies to all accounts - agents, admins and managers).">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                                        <select name="disable_excel" class="form-control input-sm" id="disable_excel">
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label> SMS Allowed <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-original-title="SMS Allowed" data-content="
                   This option determines whether the user can see and use the send sms options across various screens. <br /><br />                                                
                   1.<b> Yes:</b> This will allow the user to view and use sms options across various screens.<br />                                                
                   2.<b> No:</b> This will prevent the user from viewing and using sms options across various screens.">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                                        <select disabled="disable" name="is_sms" class="form-control input-sm" id="is_sms" tabindex="30">
                                            <option value="0">No</option>
                                            <option value="1">Yes</option>
                                     </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Listing Detail <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-original-title="Listing Detail" data-content="
                   This setting applies for shared listings (listings assigned to other users). <br /><br />                   This option allows you to control whether the user can view the unit number and owner details across various screens.<br /><br />                                                    
                   1.<b> Yes:</b> This will allow the user to view the unit number and owner contact information for all visible listings for that user (this applies to all accounts - agents, admins and managers). <br />                                                    
                   2.<b> No:</b> This will prevent the user from viewing the unit number and owner contact information for all visible listings. <br />                                                     
                   3.<b> Read-only for admins:</b> This will allow admins to view the unit number and owner contact information for shared listing however they cannot edit the details.">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                                        <select name="disable_sharing" class="form-control input-sm" id="disable_sharing">
                                            <option value="1">Yes</option>
                                            <option value="0" selected>No</option>
                                            <option value="2" >Read-only for admins</option>
                                     </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Show Owner  <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-original-title="Show Owner" data-content="
                  This setting applies for users own listings and shared listings (listings assigned to other users). <br /><br />                  This option allows you to control  whether the user can view owner details across various screens for all listings (this applies to all accounts - agents, admins and managers).<br /><br />                                                    
                  1.<b> Yes:</b>  This will allow the user to view owner contact information for listings<br />                                                     
                  2.<b> No:</b>  This will prevent the user from viewing owner contact information for all listings, even if the listing is their own<br />">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                                        <select class="form-control input-sm" name="landlord_details" id="landlord_details">
                                        <option value="0" selected="selected">Yes</option>
                                        <option value="1" >No</option>
                                    </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Delete Data? <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-original-title="Delete Data?" data-content="
                  This option allows you to control whether the user can delete any data across various screens. This field can only be set by managers.<br /><br />                                                        
                  1.<b> Yes:</b> This will allow the user to delete data across various screens.<br />                                                      
                  2.<b> No:</b> This will prevent the user from deleting data across various screens.">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                                        <select class="form-control input-sm" name="delete_permissions" id="delete_permissions">
                     <option value="0">Yes</option>
                      <option value="1" selected="selected">No</option>
                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Edit Published Listings? <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-original-title="Edit Published Listings?" data-content="
                  This option allows you to control whether the user can edit Published listings. This field can only be set by managers.<br /><br />                                                       
                  1.<b> Yes:</b> This will allow the user to edit Published listings.<br />                                                         
                  2.<b> No:</b> This will prevent the user from editing Published listings.">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                                        <select class="form-control input-sm" name="edit_listings" id="edit_listings">
                     <option value="0" selected="selected">Yes</option>
                       <option value="1">No</option>
                       </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Access Time <a href="#" data-container="body" data-trigger="hover" data-toggle="popover" 
                   data-placement="right" data-original-title="Access Time" data-content="
                  This option allows you to control when the user can login to CRM. For example you can prevent access after certain hours or on certain days (e.g. at weekends).">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                                        <div class="input-group">
                                            <span class="input-group-addon"><a href="" data-toggle="modal" data-target="#access_time" rel="popup_access_timings"  id="popup-access-time"><i class="fa fa-plus-circle"></i></a></span>
                                            <input type="text" class="form-control input-sm" readonly="readonly" id="access_timings_details" name="access_timings_details">
                                            <input name="access_days" style="display: none;" type="text" class="form-control" id="access_days" value="" readonly>
                                            <input name="access_timings" style="display: none;" type="text" class="form-control" id="access_timings" value="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Monthly Target</label>
                                        <input type="text" name="target" id="target" class="form-control input-sm">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="text-primary">User Listing Sharing <a href="#" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-original-title="User Listing Sharing" data-content="
                 Select whether the user's listings will be visible to other users in the company. The unit numbers and owner details will not be shared even if the listing is shared.">
                   <i class="fa fa-info-circle"></i>
            </a>
            </h5>
                                    <div class="user_listing_sharing_row">
                                        <div class="share_with">
                                            <label>Share with</label>
                                            <select multiple id="select2user" class="form-control input-sm">
                                                    </select>
                                        </div>
                                        <div class="user_listing_sharing_arrows">
                                            <a href="javascript:void(0)" id="add_to_one_user"><i class="fa fa-chevron-circle-right"></i></a>
                                            <a href="javascript:void(0)" id="add_to_two_user"><i class="fa fa-chevron-circle-left"></i></a>
                                        </div>
                                        <div class="share_with">
                                            <label>Do not share with</label>
                                            <select id="select1user" class="form-control input-sm" multiple>
                        <?php foreach($AllUsers as $listing):?>
                       <option value="<?php echo $listing['id'];?>"> <?php echo $listing['name'];?> </option>
                        <?php endforeach;?>
                        </select>
                                        </div>
                                    </div>
                                    <h5 class="text-primary">User Screen Settings</h5>
                                    <div id="users_managescreens_popup_changed" name="users_managescreens_popup">
                                        <div id='useraccess' style="text-align:center;">
                                            <div class="form-group">
                                                <label>Unlocked Screens</label>
                                                <select multiple id="select3" class="form-control" input-sm>
                  </select>
                                            </div>
                                            <div class="text-center">
                                                <a href="javascript:void(0)" id="back_to_two"><i class="fa fa-lg fa-angle-down"></i></a>
                                                <a href="javascript:void(0)" id="add_to_three"><i class="fa fa-lg fa-angle-up"></i></a>
                                                <a href="javascript:void(0)" id="three_to_one"><i class="fa fa-lg fa-angle-double-down"></i></a>
                                            </div>
                                            <div class="form-group">
                                                <label>Read-only Screens</label>
                                                <select multiple id="select2" class="form-control input-sm">
                                                </select>
                                            </div>
                                            <div class="text-center">
                                                <a href="javascript:void(0)" id="back_to_one"><i class="fa fa-lg fa-angle-down"></i></a>
                                                <a href="javascript:void(0)" id="add_to_two"><i class="fa fa-lg fa-angle-up"></i></a>
                                                <a href="javascript:void(0)" id="one_to_three"><i class="fa fa-lg fa-angle-double-up"></i></a>
                                            </div>
                                            <div class="form-group">
                                                <label>Locked Screens</label>
                                                <select multiple id="select1" name="select1[]" class="form-control input-sm">
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <h5 class="text-primary">Import Email Leads <a href="#" data-trigger="hover" data-toggle="popover" data-placement="bottom" data-original-title="Import Email Leads" data-content="
                  This is a new feature to allow auto-importing of email enquiries into the leads screen from the following property portals in the UAE: JustRentals.com, JustProperty.com, Dubizzle.com, PropertyFinder.ae and Bayut.com.                                              If activated, email enquiries from the above portals will be auto-imported into the leads screen, assigned to the appropriate agent and pre-populated with the full lead details and source of lead.                                            For further assistance on how to use this feature contact support@royalhome.ae">
                   <i class="fa fa-info-circle"></i>
                   </a></h5>
                                    <div class="form-group">
                                        <label>Imap</label>
                                        <input type="text" class="form-control input-sm" id="imap" name="imap" placeholder="imap.example.com">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control input-sm" id="emailsLeads" name="emailsLeads" placeholder="Your email">
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input name="passwordemail" type="password" class="form-control input-sm" id="passwordemail" value="" placeholder="Your password">
                                        <input name="connect_status" type="hidden" class="form_fields" id="connect_status" value="0">
                                        <input name="email_user_id" type="hidden" class="form_fields" id="email_user_id" value="0">
                                        <input name="email_client_id" type="hidden" class="form_fields" id="email_client_id" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label>Port <a href="#" data-trigger="hover" data-toggle="popover" data-placement="right" data-original-title="Port" data-content="
                   Imap port , IMAP usually works on port 993 , but for some services it runs on different port , using this option you can change the port .<br />">
                   <i class="fa fa-info-circle"></i>
                   </a></label>
                                        <select id="port" name="port" class="form-control input-sm">
                                                <option value="993" selected>993</option>
                                                <option value="143">143</option>
                                                <option value="other">Other</option>
                                            </select>
                                        <input type="text" name="port_extra" id="port_extra" class="form-control input-sm" style="display:none;">
                                    </div>
                                    <div class="form-group">
                                        <label class="">
                        <input type="checkbox" id="Active" name="Active" value="1"/>
                        <span class="lbl padding">Active </span>
                    </label>
                                    </div>
                                    <a href="" class="btn btn-primary margin-bottom-15"><i class="fa fa-inbox"></i> Test Connection</a>
                                    <h5 class="text-primary">SMS Verification Number</h5>
                                    <div class="form-group">
                                        <p>SMS Verification Number
                                            <a href="#" data-trigger="hover" data-toggle="popover" data-placement="left" data-original-title="SMS Verification Number" data-content="
                  Input your mobile number here for SMS verification. SMS verification is required for all users who have Excel Download enabled. Once your mobile number has been verified by our system you will be requested to enter an SMS verification code each time you request an Excel download.                                                 
                   <br><br> Please note you must use your own personal mobile number which you have access to at all times. <br>">
                                                <i class="fa fa-info-circle"></i>
                                            </a>
                                        </p>
                                        <a href="" rel="popup_verification_sms" id="popup-verify-sms" class="btn btn-primary margin-bottom-15" data-toggle="modal" data-target="#verify_number">Verify</a>
                                        <p>Please use this to verify your mobile number. This is only necessary for some restricted actions. </p>
                                        <div style="color:#a6a6a6;margin: 12px 0px;" id='info-sms_2'></div>
                                    </div>
                                </div>
                            </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-content fadeInUp">
            <table class="table table-striped table-bordered table-hover datatables" id="listings_row">
                <thead>
                    <tr>
                        <th></th>
                        <th>Company</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Job Title</th>
                        <th>Office No</th>
                        <th>Country Dialing Code</th>
                        <th>Mobile No</th>
                        <th>Email</th>
                    </tr>
                    <tr class="highlighted">
                        <form id="myForm2">
                            <td style="text-align:center;"><a style="display:none;" id="reset_filter" href="# Reset"><img src="<?php echo base_url();?>mydata/images/swap.png?ts=10" title="Reset filter"></a></td>
                            <td><input type="text" class="form-control input-sm" id="1"></td>
                            <td><input type="text" class="form-control input-sm" id="2"></td>
                            <td><input type="text" class="form-control input-sm" id="3"></td>
                            <td><input type="text" class="form-control input-sm" id="4"></td>
                            <td><input type="text" class="form-control input-sm" id="5"></td>
                            <td><input type="text" class="form-control input-sm" id="6"></td>
                            <td><input type="text" class="form-control input-sm" id="7"></td>
                            <td><input type="text" class="form-control input-sm" id="8"></td>
                        </form>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" class="dataTables_empty">Loading data from server</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--popups start here-->
<!-- Verify Modal -->
<div class="modal fade" id="verify_number" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">A vefication code will b sent to your mobile.</h4>
            </div>
            <div class="modal-body">
                <div id="sendsms_scr">
                    <form id="send_sms">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="sms_mobile_ccode" id="sms_mobile_ccode" class="selectpicker show-tick form-control input-sm">
 <option value="1">USA (+1)</option> 
 <option value="213">Algeria (+213)</option> 
 <option value="376">Andorra (+376)</option> 
 <option value="244">Angola (+244)</option> 
 <option value="1264">Anguilla (+1264)</option> 
 <option value="1268">Antigua &amp; Barbuda (+1268)</option> 
 <option value="599">Antilles (Dutch) (+599)</option> 
 <option value="54">Argentina (+54)</option> 
 <option value="374">Armenia (+374)</option> 
 <option value="297">Aruba (+297)</option> 
 <option value="247">Ascension Island (+247)</option> 
 <option value="61">Australia (+61)</option> 
 <option value="43">Austria (+43)</option> 
 <option value="994">Azerbaijan (+994)</option> 
 <option value="1242">Bahamas (+1242)</option> 
 <option value="973">Bahrain (+973)</option> 
 <option value="880">Bangladesh (+880)</option> 
 <option value="1246">Barbados (+1246)</option> 
 <option value="375">Belarus (+375)</option> 
 <option value="32">Belgium (+32)</option> 
 <option value="501">Belize (+501)</option> 
 <option value="229">Benin (+229)</option> 
 <option value="1441">Bermuda (+1441)</option> 
 <option value="975">Bhutan (+975)</option> 
 <option value="591">Bolivia (+591)</option> 
 <option value="387">Bosnia Herzegovina (+387)</option> 
 <option value="267">Botswana (+267)</option> 
 <option value="55">Brazil (+55)</option> 
 <option value="673">Brunei (+673)</option> 
 <option value="359">Bulgaria (+359)</option> 
 <option value="226">Burkina Faso (+226)</option> 
 <option value="257">Burundi (+257)</option> 
 <option value="855">Cambodia (+855)</option> 
 <option value="237">Cameroon (+237)</option> 
 <option value="1">Canada (+1)</option> 
 <option value="238">Cape Verde Islands (+238)</option> 
 <option value="1345">Cayman Islands (+1345)</option> 
 <option value="236">Central African Republic (+236)</option> 
 <option value="56">Chile (+56)</option> 
 <option value="86">China (+86)</option> 
 <option value="57">Colombia (+57)</option> 
 <option value="269">Comoros (+269)</option> 
 <option value="242">Congo (+242)</option> 
 <option value="682">Cook Islands (+682)</option> 
 <option value="506">Costa Rica (+506)</option> 
 <option value="385">Croatia (+385)</option> 
 <option value="53">Cuba (+53)</option> 
 <option value="90392">Cyprus North (+90392)</option> 
 <option value="357">Cyprus South (+357)</option> 
 <option value="42">Czech Republic (+42)</option> 
 <option value="45">Denmark (+45)</option> 
 <option value="2463">Diego Garcia (+2463)</option> 
 <option value="253">Djibouti (+253)</option> 
 <option value="1809">Dominica (+1809)</option> 
 <option value="1809">Dominican Republic (+1809)</option> 
 <option value="593">Ecuador (+593)</option> 
 <option value="20">Egypt (+20)</option> 
 <option value="353">Eire (+353)</option> 
 <option value="503">El Salvador (+503)</option> 
 <option value="240">Equatorial Guinea (+240)</option> 
 <option value="291">Eritrea (+291)</option> 
 <option value="372">Estonia (+372)</option> 
 <option value="251">Ethiopia (+251)</option> 
 <option value="500">Falkland Islands (+500)</option> 
 <option value="298">Faroe Islands (+298)</option> 
 <option value="679">Fiji (+679)</option> 
 <option value="358">Finland (+358)</option> 
 <option value="33">France (+33)</option> 
 <option value="594">French Guiana (+594)</option> 
 <option value="689">French Polynesia (+689)</option> 
 <option value="241">Gabon (+241)</option> 
 <option value="220">Gambia (+220)</option> 
 <option value="7880">Georgia (+7880)</option> 
 <option value="49">Germany (+49)</option> 
 <option value="233">Ghana (+233)</option> 
 <option value="350">Gibraltar (+350)</option> 
 <option value="30">Greece (+30)</option> 
 <option value="299">Greenland (+299)</option> 
 <option value="1473">Grenada (+1473)</option> 
 <option value="590">Guadeloupe (+590)</option> 
 <option value="671">Guam (+671)</option> 
 <option value="502">Guatemala (+502)</option> 
 <option value="224">Guinea (+224)</option> 
 <option value="245">Guinea - Bissau (+245)</option> 
 <option value="592">Guyana (+592)</option> 
 <option value="509">Haiti (+509)</option> 
 <option value="504">Honduras (+504)</option> 
 <option value="852">Hong Kong (+852)</option> 
 <option value="36">Hungary (+36)</option> 
 <option value="354">Iceland (+354)</option> 
 <option value="91">India (+91)</option> 
 <option value="62">Indonesia (+62)</option> 
 <option value="98">Iran (+98)</option> 
 <option value="964">Iraq (+964)</option> 
 <option value="972">Israel (+972)</option> 
 <option value="39">Italy (+39)</option> 
 <option value="225">Ivory Coast (+225)</option> 
 <option value="1876">Jamaica (+1876)</option> 
 <option value="81">Japan (+81)</option> 
 <option value="962">Jordan (+962)</option> 
 <option value="7">Kazakhstan (+7)</option> 
 <option value="254">Kenya (+254)</option> 
 <option value="686">Kiribati (+686)</option> 
 <option value="850">Korea North (+850)</option> 
 <option value="82">Korea South (+82)</option> 
 <option value="965">Kuwait (+965)</option> 
 <option value="996">Kyrgyzstan (+996)</option> 
 <option value="856">Laos (+856)</option> 
 <option value="371">Latvia (+371)</option> 
 <option value="961">Lebanon (+961)</option> 
 <option value="266">Lesotho (+266)</option> 
 <option value="231">Liberia (+231)</option> 
 <option value="218">Libya (+218)</option> 
 <option value="417">Liechtenstein (+417)</option> 
 <option value="370">Lithuania (+370)</option> 
 <option value="352">Luxembourg (+352)</option> 
 <option value="853">Macao (+853)</option> 
 <option value="389">Macedonia (+389)</option> 
 <option value="261">Madagascar (+261)</option> 
 <option value="265">Malawi (+265)</option> 
 <option value="60">Malaysia (+60)</option> 
 <option value="960">Maldives (+960)</option> 
 <option value="223">Mali (+223)</option> 
 <option value="356">Malta (+356)</option> 
 <option value="692">Marshall Islands (+692)</option> 
 <option value="596">Martinique (+596)</option> 
 <option value="222">Mauritania (+222)</option> 
 <option value="269">Mayotte (+269)</option> 
 <option value="52">Mexico (+52)</option> 
 <option value="691">Micronesia (+691)</option> 
 <option value="373">Moldova (+373)</option> 
 <option value="377">Monaco (+377)</option> 
 <option value="976">Mongolia (+976)</option> 
 <option value="1664">Montserrat (+1664)</option> 
 <option value="212">Morocco (+212)</option> 
 <option value="258">Mozambique (+258)</option> 
 <option value="95">Myanmar (+95)</option> 
 <option value="264">Namibia (+264)</option> 
 <option value="674">Nauru (+674)</option> 
 <option value="977">Nepal (+977)</option> 
 <option value="31">Netherlands (+31)</option> 
 <option value="687">New Caledonia (+687)</option> 
 <option value="64">New Zealand (+64)</option> 
 <option value="505">Nicaragua (+505)</option> 
 <option value="227">Niger (+227)</option> 
 <option value="234">Nigeria (+234)</option> 
 <option value="683">Niue (+683)</option> 
 <option value="672">Norfolk Islands (+672)</option> 
 <option value="670">Northern Marianas (+670)</option> 
 <option value="47">Norway (+47)</option> 
 <option value="968">Oman (+968)</option> 
 <option value="92">Pakistan (+92)</option> 
 <option value="680">Palau (+680)</option> 
 <option value="507">Panama (+507)</option> 
 <option value="675">Papua New Guinea (+675)</option> 
 <option value="595">Paraguay (+595)</option> 
 <option value="51">Peru (+51)</option> 
 <option value="63">Philippines (+63)</option> 
 <option value="48">Poland (+48)</option> 
 <option value="351">Portugal (+351)</option> 
 <option value="1787">Puerto Rico (+1787)</option> 
 <option value="974">Qatar (+974)</option> 
 <option value="262">Reunion (+262)</option> 
 <option value="40">Romania (+40)</option> 
 <option value="7">Russia (+7)</option> 
 <option value="250">Rwanda (+250)</option> 
 <option value="378">San Marino (+378)</option> 
 <option value="239">Sao Tome &amp; Principe (+239)</option> 
 <option value="966">Saudi Arabia (+966)</option> 
 <option value="221">Senegal (+221)</option> 
 <option value="381">Serbia (+381)</option> 
 <option value="248">Seychelles (+248)</option> 
 <option value="232">Sierra Leone (+232)</option> 
 <option value="65">Singapore (+65)</option> 
 <option value="421">Slovak Republic (+421)</option> 
 <option value="386">Slovenia (+386)</option> 
 <option value="677">Solomon Islands (+677)</option> 
 <option value="252">Somalia (+252)</option> 
 <option value="27">South Africa (+27)</option> 
 <option value="34">Spain (+34)</option> 
 <option value="94">Sri Lanka (+94)</option> 
 <option value="290">St. Helena (+290)</option> 
 <option value="1869">St. Kitts (+1869)</option> 
 <option value="1758">St. Lucia (+1758)</option> 
 <option value="249">Sudan (+249)</option> 
 <option value="597">Suriname (+597)</option> 
 <option value="268">Swaziland (+268)</option> 
 <option value="46">Sweden (+46)</option> 
 <option value="41">Switzerland (+41)</option> 
 <option value="963">Syria (+963)</option> 
 <option value="886">Taiwan (+886)</option> 
 <option value="7">Tajikstan (+7)</option> 
 <option value="66">Thailand (+66)</option> 
 <option value="228">Togo (+228)</option> 
 <option value="676">Tonga (+676)</option> 
 <option value="1868">Trinidad &amp; Tobago (+1868)</option> 
 <option value="216">Tunisia (+216)</option> 
 <option value="90">Turkey (+90)</option> 
 <option value="7">Turkmenistan (+7)</option> 
 <option value="993">Turkmenistan (+993)</option> 
 <option value="1649">Turks &amp; Caicos Islands (+1649)</option> 
 <option value="688">Tuvalu (+688)</option> 
 <option value="256">Uganda (+256)</option> 
 <option value="44" >UK (+44)</option> 
 <option value="380">Ukraine (+380)</option> 
 <option value="971" selected="selected">United Arab Emirates (+971)</option> 
 <option value="598">Uruguay (+598)</option> 
 <option value="1">USA (+1)</option> 
 <option value="7">Uzbekistan (+7)</option> 
 <option value="678">Vanuatu (+678)</option> 
 <option value="379">Vatican City (+379)</option> 
 <option value="58">Venezuela (+58)</option> 
 <option value="84">Vietnam (+84)</option> 
 <option value="84">Virgin Islands - British (+1284)</option> 
 <option value="84">Virgin Islands - US (+1340)</option> 
 <option value="681">Wallis &amp; Futuna (+681)</option> 
 <option value="969">Yemen (North)(+969)</option> 
 <option value="967">Yemen (South)(+967)</option> 
 <option value="381">Yugoslavia (+381)</option> 
 <option value="243">Zaire (+243)</option> 
 <option value="260">Zambia (+260)</option> 
 <option value="263">Zimbabwe (+263)</option>
  </select>
                            </div>
                            <div class="col-md-8">
                                <input id="sms_mobile_no" name="sms_mobile_no" type="text" class="ltrim required form-control input-sm form-control-sms phone-number-field-2" value="" maxlength="10">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row  col-md-12 col-xs-12 space-padding2" id="verify_scr" style="display:none;">
                    <form id="verify_code">
                        <div class="form-group ">
                            <div class="col-md-7 col-md-offset-3">
                                <p style="color:red; font-size:13px;">The sms code has been sent. Please enter the correct code here. After 3 wrong attempts, you will be blocked for 30 minutes.</p>
                            </div>
                            <div class="col-md-7 col-md-offset-3">
                                <input id="rand_code" name="rand_code" type="text" class="required form-control form-control-sms" value="" style="text-align: center;" maxlength="6" placeholder="Enter 6 digit Verification code">
                                <label class="code_error"></label>
                            </div>
                            <div class="col-md-7 col-md-offset-3 btn-enter">
                                <button type="submit" id="btn-success" class="btn btn-lg blue btn-enter-input" name="Test">Enter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row  col-md-12 col-xs-12 space-padding" id="success_scr" style="display:none;">
                    <div class="row row-centered">
                        <div class="col-md-7 col-md-offset-3 space-padding">
                            <img src="<?php echo base_url();?>mydata/images/sms-success-icon.png" width="78px" height="80px" title="success">
                            <p class="pop-title" style="margin-top: 25px;">Thank you. Your number has been verified.</p>
                            <p class="pop-title" style="margin-top: 25px;">Please wait for Support verification. Once they verify you, you will be able to download csv files.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btn-enter-input" data-dismiss="modal"><i class="fa fa-check"></i> Enter Number</button>
            </div>
        </div>
    </div>
</div>
<!-- Email Modal -->
<div class="modal fade" id="email_popup" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Email</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="well">
                        <h5 class="text-primary">Email List</h5>
                        <p>Select an Email to be displayed on Portals
                            <a href="#" data-trigger="hover" data-toggle="popover" data-placement="right" data-original-title="Default Email" data-content="
                  The Email ID that you select will be used in the listings published on the portals">
                                <i class="fa fa-info-circle"></i>
                            </a>
                        </p>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Email 1</label>
                        <div class="col-md-8">
                            <input name="email_default" type="text" class="form-control " id="email_default" value="" tabindex="">
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="">
                                   <input type="radio" name="defaultemail" class="form-control no-marginInput" value="1" checked="checked">
                                    <span class="lbl"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Email 2</label>
                        <div class="col-md-8">
                            <input name="email1" type="text" class="form-control email_1" id="email1" value="" tabindex="">
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="">
                                   <input type="radio" name="defaultemail" class="form-control no-marginInput" value="2">
                                    <span class="lbl"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Email 3</label>
                        <div class="col-md-8">
                            <input name="email2" type="text" class="form-control email2" id="email2" value="" tabindex="">
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="">
                                    <input type="radio" name="defaultemail" class="form-control no-marginInput" value="3">
                                    <span class="lbl"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success save-email" id="btn-close-notes" data-dismiss="modal"><i class="fa fa-check"></i> Save and Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Mobile Modal -->
<div class="modal fade" id="mobile" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title">Mobile Number</h5>
            </div>
            <div class="modal-body">
                <form class="form-horizontal">
                    <div class="well">
                        <h4 class="text-primary">Mobile Number List</h4>
                        <p>Select a Mobile No. to be displayed on Portals
                            <a href="#" data-trigger="hover" data-toggle="popover" data-placement="right" data-original-title="Default Mobile" data-content="
                  The Mobile Number that you select will be used in the listings published on the portals">
                                <i class="fa fa-info-circle"></i>
                            </a>
                        </p>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Number 1</label>
                        <div class="col-md-4">
                            <select name="mobile_no_new_ccode_default" id="mobile_no_new_ccode_default" class="selectpicker show-tick form-control input-sm">
 <option value="1">USA (+1)</option> 
 <option value="213">Algeria (+213)</option> 
 <option value="376">Andorra (+376)</option> 
 <option value="244">Angola (+244)</option> 
 <option value="1264">Anguilla (+1264)</option> 
 <option value="1268">Antigua &amp; Barbuda (+1268)</option> 
 <option value="599">Antilles (Dutch) (+599)</option> 
 <option value="54">Argentina (+54)</option> 
 <option value="374">Armenia (+374)</option> 
 <option value="297">Aruba (+297)</option> 
 <option value="247">Ascension Island (+247)</option> 
 <option value="61">Australia (+61)</option> 
 <option value="43">Austria (+43)</option> 
 <option value="994">Azerbaijan (+994)</option> 
 <option value="1242">Bahamas (+1242)</option> 
 <option value="973">Bahrain (+973)</option> 
 <option value="880">Bangladesh (+880)</option> 
 <option value="1246">Barbados (+1246)</option> 
 <option value="375">Belarus (+375)</option> 
 <option value="32">Belgium (+32)</option> 
 <option value="501">Belize (+501)</option> 
 <option value="229">Benin (+229)</option> 
 <option value="1441">Bermuda (+1441)</option> 
 <option value="975">Bhutan (+975)</option> 
 <option value="591">Bolivia (+591)</option> 
 <option value="387">Bosnia Herzegovina (+387)</option> 
 <option value="267">Botswana (+267)</option> 
 <option value="55">Brazil (+55)</option> 
 <option value="673">Brunei (+673)</option> 
 <option value="359">Bulgaria (+359)</option> 
 <option value="226">Burkina Faso (+226)</option> 
 <option value="257">Burundi (+257)</option> 
 <option value="855">Cambodia (+855)</option> 
 <option value="237">Cameroon (+237)</option> 
 <option value="1">Canada (+1)</option> 
 <option value="238">Cape Verde Islands (+238)</option> 
 <option value="1345">Cayman Islands (+1345)</option> 
 <option value="236">Central African Republic (+236)</option> 
 <option value="56">Chile (+56)</option> 
 <option value="86">China (+86)</option> 
 <option value="57">Colombia (+57)</option> 
 <option value="269">Comoros (+269)</option> 
 <option value="242">Congo (+242)</option> 
 <option value="682">Cook Islands (+682)</option> 
 <option value="506">Costa Rica (+506)</option> 
 <option value="385">Croatia (+385)</option> 
 <option value="53">Cuba (+53)</option> 
 <option value="90392">Cyprus North (+90392)</option> 
 <option value="357">Cyprus South (+357)</option> 
 <option value="42">Czech Republic (+42)</option> 
 <option value="45">Denmark (+45)</option> 
 <option value="2463">Diego Garcia (+2463)</option> 
 <option value="253">Djibouti (+253)</option> 
 <option value="1809">Dominica (+1809)</option> 
 <option value="1809">Dominican Republic (+1809)</option> 
 <option value="593">Ecuador (+593)</option> 
 <option value="20">Egypt (+20)</option> 
 <option value="353">Eire (+353)</option> 
 <option value="503">El Salvador (+503)</option> 
 <option value="240">Equatorial Guinea (+240)</option> 
 <option value="291">Eritrea (+291)</option> 
 <option value="372">Estonia (+372)</option> 
 <option value="251">Ethiopia (+251)</option> 
 <option value="500">Falkland Islands (+500)</option> 
 <option value="298">Faroe Islands (+298)</option> 
 <option value="679">Fiji (+679)</option> 
 <option value="358">Finland (+358)</option> 
 <option value="33">France (+33)</option> 
 <option value="594">French Guiana (+594)</option> 
 <option value="689">French Polynesia (+689)</option> 
 <option value="241">Gabon (+241)</option> 
 <option value="220">Gambia (+220)</option> 
 <option value="7880">Georgia (+7880)</option> 
 <option value="49">Germany (+49)</option> 
 <option value="233">Ghana (+233)</option> 
 <option value="350">Gibraltar (+350)</option> 
 <option value="30">Greece (+30)</option> 
 <option value="299">Greenland (+299)</option> 
 <option value="1473">Grenada (+1473)</option> 
 <option value="590">Guadeloupe (+590)</option> 
 <option value="671">Guam (+671)</option> 
 <option value="502">Guatemala (+502)</option> 
 <option value="224">Guinea (+224)</option> 
 <option value="245">Guinea - Bissau (+245)</option> 
 <option value="592">Guyana (+592)</option> 
 <option value="509">Haiti (+509)</option> 
 <option value="504">Honduras (+504)</option> 
 <option value="852">Hong Kong (+852)</option> 
 <option value="36">Hungary (+36)</option> 
 <option value="354">Iceland (+354)</option> 
 <option value="91">India (+91)</option> 
 <option value="62">Indonesia (+62)</option> 
 <option value="98">Iran (+98)</option> 
 <option value="964">Iraq (+964)</option> 
 <option value="972">Israel (+972)</option> 
 <option value="39">Italy (+39)</option> 
 <option value="225">Ivory Coast (+225)</option> 
 <option value="1876">Jamaica (+1876)</option> 
 <option value="81">Japan (+81)</option> 
 <option value="962">Jordan (+962)</option> 
 <option value="7">Kazakhstan (+7)</option> 
 <option value="254">Kenya (+254)</option> 
 <option value="686">Kiribati (+686)</option> 
 <option value="850">Korea North (+850)</option> 
 <option value="82">Korea South (+82)</option> 
 <option value="965">Kuwait (+965)</option> 
 <option value="996">Kyrgyzstan (+996)</option> 
 <option value="856">Laos (+856)</option> 
 <option value="371">Latvia (+371)</option> 
 <option value="961">Lebanon (+961)</option> 
 <option value="266">Lesotho (+266)</option> 
 <option value="231">Liberia (+231)</option> 
 <option value="218">Libya (+218)</option> 
 <option value="417">Liechtenstein (+417)</option> 
 <option value="370">Lithuania (+370)</option> 
 <option value="352">Luxembourg (+352)</option> 
 <option value="853">Macao (+853)</option> 
 <option value="389">Macedonia (+389)</option> 
 <option value="261">Madagascar (+261)</option> 
 <option value="265">Malawi (+265)</option> 
 <option value="60">Malaysia (+60)</option> 
 <option value="960">Maldives (+960)</option> 
 <option value="223">Mali (+223)</option> 
 <option value="356">Malta (+356)</option> 
 <option value="692">Marshall Islands (+692)</option> 
 <option value="596">Martinique (+596)</option> 
 <option value="222">Mauritania (+222)</option> 
 <option value="269">Mayotte (+269)</option> 
 <option value="52">Mexico (+52)</option> 
 <option value="691">Micronesia (+691)</option> 
 <option value="373">Moldova (+373)</option> 
 <option value="377">Monaco (+377)</option> 
 <option value="976">Mongolia (+976)</option> 
 <option value="1664">Montserrat (+1664)</option> 
 <option value="212">Morocco (+212)</option> 
 <option value="258">Mozambique (+258)</option> 
 <option value="95">Myanmar (+95)</option> 
 <option value="264">Namibia (+264)</option> 
 <option value="674">Nauru (+674)</option> 
 <option value="977">Nepal (+977)</option> 
 <option value="31">Netherlands (+31)</option> 
 <option value="687">New Caledonia (+687)</option> 
 <option value="64">New Zealand (+64)</option> 
 <option value="505">Nicaragua (+505)</option> 
 <option value="227">Niger (+227)</option> 
 <option value="234">Nigeria (+234)</option> 
 <option value="683">Niue (+683)</option> 
 <option value="672">Norfolk Islands (+672)</option> 
 <option value="670">Northern Marianas (+670)</option> 
 <option value="47">Norway (+47)</option> 
 <option value="968">Oman (+968)</option> 
 <option value="92">Pakistan (+92)</option> 
 <option value="680">Palau (+680)</option> 
 <option value="507">Panama (+507)</option> 
 <option value="675">Papua New Guinea (+675)</option> 
 <option value="595">Paraguay (+595)</option> 
 <option value="51">Peru (+51)</option> 
 <option value="63">Philippines (+63)</option> 
 <option value="48">Poland (+48)</option> 
 <option value="351">Portugal (+351)</option> 
 <option value="1787">Puerto Rico (+1787)</option> 
 <option value="974">Qatar (+974)</option> 
 <option value="262">Reunion (+262)</option> 
 <option value="40">Romania (+40)</option> 
 <option value="7">Russia (+7)</option> 
 <option value="250">Rwanda (+250)</option> 
 <option value="378">San Marino (+378)</option> 
 <option value="239">Sao Tome &amp; Principe (+239)</option> 
 <option value="966">Saudi Arabia (+966)</option> 
 <option value="221">Senegal (+221)</option> 
 <option value="381">Serbia (+381)</option> 
 <option value="248">Seychelles (+248)</option> 
 <option value="232">Sierra Leone (+232)</option> 
 <option value="65">Singapore (+65)</option> 
 <option value="421">Slovak Republic (+421)</option> 
 <option value="386">Slovenia (+386)</option> 
 <option value="677">Solomon Islands (+677)</option> 
 <option value="252">Somalia (+252)</option> 
 <option value="27">South Africa (+27)</option> 
 <option value="34">Spain (+34)</option> 
 <option value="94">Sri Lanka (+94)</option> 
 <option value="290">St. Helena (+290)</option> 
 <option value="1869">St. Kitts (+1869)</option> 
 <option value="1758">St. Lucia (+1758)</option> 
 <option value="249">Sudan (+249)</option> 
 <option value="597">Suriname (+597)</option> 
 <option value="268">Swaziland (+268)</option> 
 <option value="46">Sweden (+46)</option> 
 <option value="41">Switzerland (+41)</option> 
 <option value="963">Syria (+963)</option> 
 <option value="886">Taiwan (+886)</option> 
 <option value="7">Tajikstan (+7)</option> 
 <option value="66">Thailand (+66)</option> 
 <option value="228">Togo (+228)</option> 
 <option value="676">Tonga (+676)</option> 
 <option value="1868">Trinidad &amp; Tobago (+1868)</option> 
 <option value="216">Tunisia (+216)</option> 
 <option value="90">Turkey (+90)</option> 
 <option value="7">Turkmenistan (+7)</option> 
 <option value="993">Turkmenistan (+993)</option> 
 <option value="1649">Turks &amp; Caicos Islands (+1649)</option> 
 <option value="688">Tuvalu (+688)</option> 
 <option value="256">Uganda (+256)</option> 
 <option value="44" >UK (+44)</option> 
 <option value="380">Ukraine (+380)</option> 
 <option value="971" selected="selected">United Arab Emirates (+971)</option> 
 <option value="598">Uruguay (+598)</option> 
 <option value="1">USA (+1)</option> 
 <option value="7">Uzbekistan (+7)</option> 
 <option value="678">Vanuatu (+678)</option> 
 <option value="379">Vatican City (+379)</option> 
 <option value="58">Venezuela (+58)</option> 
 <option value="84">Vietnam (+84)</option> 
 <option value="84">Virgin Islands - British (+1284)</option> 
 <option value="84">Virgin Islands - US (+1340)</option> 
 <option value="681">Wallis &amp; Futuna (+681)</option> 
 <option value="969">Yemen (North)(+969)</option> 
 <option value="967">Yemen (South)(+967)</option> 
 <option value="381">Yugoslavia (+381)</option> 
 <option value="243">Zaire (+243)</option> 
 <option value="260">Zambia (+260)</option> 
 <option value="263">Zimbabwe (+263)</option>
  </select>
                        </div>
                        <div class="col-md-4">
                            <input id="mobile_no_new_default" name="mobile_no_new_default" type="text" class="ltrim form-control phone-number-field" value="" maxlength="10">
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="">
                                <input type="radio" name="defaultmobile" class="form-control no-marginInput" value="1" checked="checked">
                                <span class="lbl"></span>
                            </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Number 2</label>
                        <div class="col-md-4">
                            <select name="mobile_no_new_ccode1" id="mobile_no_new_ccode1" class="selectpicker show-tick form-control input-sm">
 <option value="1">USA (+1)</option> 
 <option value="213">Algeria (+213)</option> 
 <option value="376">Andorra (+376)</option> 
 <option value="244">Angola (+244)</option> 
 <option value="1264">Anguilla (+1264)</option> 
 <option value="1268">Antigua &amp; Barbuda (+1268)</option> 
 <option value="599">Antilles (Dutch) (+599)</option> 
 <option value="54">Argentina (+54)</option> 
 <option value="374">Armenia (+374)</option> 
 <option value="297">Aruba (+297)</option> 
 <option value="247">Ascension Island (+247)</option> 
 <option value="61">Australia (+61)</option> 
 <option value="43">Austria (+43)</option> 
 <option value="994">Azerbaijan (+994)</option> 
 <option value="1242">Bahamas (+1242)</option> 
 <option value="973">Bahrain (+973)</option> 
 <option value="880">Bangladesh (+880)</option> 
 <option value="1246">Barbados (+1246)</option> 
 <option value="375">Belarus (+375)</option> 
 <option value="32">Belgium (+32)</option> 
 <option value="501">Belize (+501)</option> 
 <option value="229">Benin (+229)</option> 
 <option value="1441">Bermuda (+1441)</option> 
 <option value="975">Bhutan (+975)</option> 
 <option value="591">Bolivia (+591)</option> 
 <option value="387">Bosnia Herzegovina (+387)</option> 
 <option value="267">Botswana (+267)</option> 
 <option value="55">Brazil (+55)</option> 
 <option value="673">Brunei (+673)</option> 
 <option value="359">Bulgaria (+359)</option> 
 <option value="226">Burkina Faso (+226)</option> 
 <option value="257">Burundi (+257)</option> 
 <option value="855">Cambodia (+855)</option> 
 <option value="237">Cameroon (+237)</option> 
 <option value="1">Canada (+1)</option> 
 <option value="238">Cape Verde Islands (+238)</option> 
 <option value="1345">Cayman Islands (+1345)</option> 
 <option value="236">Central African Republic (+236)</option> 
 <option value="56">Chile (+56)</option> 
 <option value="86">China (+86)</option> 
 <option value="57">Colombia (+57)</option> 
 <option value="269">Comoros (+269)</option> 
 <option value="242">Congo (+242)</option> 
 <option value="682">Cook Islands (+682)</option> 
 <option value="506">Costa Rica (+506)</option> 
 <option value="385">Croatia (+385)</option> 
 <option value="53">Cuba (+53)</option> 
 <option value="90392">Cyprus North (+90392)</option> 
 <option value="357">Cyprus South (+357)</option> 
 <option value="42">Czech Republic (+42)</option> 
 <option value="45">Denmark (+45)</option> 
 <option value="2463">Diego Garcia (+2463)</option> 
 <option value="253">Djibouti (+253)</option> 
 <option value="1809">Dominica (+1809)</option> 
 <option value="1809">Dominican Republic (+1809)</option> 
 <option value="593">Ecuador (+593)</option> 
 <option value="20">Egypt (+20)</option> 
 <option value="353">Eire (+353)</option> 
 <option value="503">El Salvador (+503)</option> 
 <option value="240">Equatorial Guinea (+240)</option> 
 <option value="291">Eritrea (+291)</option> 
 <option value="372">Estonia (+372)</option> 
 <option value="251">Ethiopia (+251)</option> 
 <option value="500">Falkland Islands (+500)</option> 
 <option value="298">Faroe Islands (+298)</option> 
 <option value="679">Fiji (+679)</option> 
 <option value="358">Finland (+358)</option> 
 <option value="33">France (+33)</option> 
 <option value="594">French Guiana (+594)</option> 
 <option value="689">French Polynesia (+689)</option> 
 <option value="241">Gabon (+241)</option> 
 <option value="220">Gambia (+220)</option> 
 <option value="7880">Georgia (+7880)</option> 
 <option value="49">Germany (+49)</option> 
 <option value="233">Ghana (+233)</option> 
 <option value="350">Gibraltar (+350)</option> 
 <option value="30">Greece (+30)</option> 
 <option value="299">Greenland (+299)</option> 
 <option value="1473">Grenada (+1473)</option> 
 <option value="590">Guadeloupe (+590)</option> 
 <option value="671">Guam (+671)</option> 
 <option value="502">Guatemala (+502)</option> 
 <option value="224">Guinea (+224)</option> 
 <option value="245">Guinea - Bissau (+245)</option> 
 <option value="592">Guyana (+592)</option> 
 <option value="509">Haiti (+509)</option> 
 <option value="504">Honduras (+504)</option> 
 <option value="852">Hong Kong (+852)</option> 
 <option value="36">Hungary (+36)</option> 
 <option value="354">Iceland (+354)</option> 
 <option value="91">India (+91)</option> 
 <option value="62">Indonesia (+62)</option> 
 <option value="98">Iran (+98)</option> 
 <option value="964">Iraq (+964)</option> 
 <option value="972">Israel (+972)</option> 
 <option value="39">Italy (+39)</option> 
 <option value="225">Ivory Coast (+225)</option> 
 <option value="1876">Jamaica (+1876)</option> 
 <option value="81">Japan (+81)</option> 
 <option value="962">Jordan (+962)</option> 
 <option value="7">Kazakhstan (+7)</option> 
 <option value="254">Kenya (+254)</option> 
 <option value="686">Kiribati (+686)</option> 
 <option value="850">Korea North (+850)</option> 
 <option value="82">Korea South (+82)</option> 
 <option value="965">Kuwait (+965)</option> 
 <option value="996">Kyrgyzstan (+996)</option> 
 <option value="856">Laos (+856)</option> 
 <option value="371">Latvia (+371)</option> 
 <option value="961">Lebanon (+961)</option> 
 <option value="266">Lesotho (+266)</option> 
 <option value="231">Liberia (+231)</option> 
 <option value="218">Libya (+218)</option> 
 <option value="417">Liechtenstein (+417)</option> 
 <option value="370">Lithuania (+370)</option> 
 <option value="352">Luxembourg (+352)</option> 
 <option value="853">Macao (+853)</option> 
 <option value="389">Macedonia (+389)</option> 
 <option value="261">Madagascar (+261)</option> 
 <option value="265">Malawi (+265)</option> 
 <option value="60">Malaysia (+60)</option> 
 <option value="960">Maldives (+960)</option> 
 <option value="223">Mali (+223)</option> 
 <option value="356">Malta (+356)</option> 
 <option value="692">Marshall Islands (+692)</option> 
 <option value="596">Martinique (+596)</option> 
 <option value="222">Mauritania (+222)</option> 
 <option value="269">Mayotte (+269)</option> 
 <option value="52">Mexico (+52)</option> 
 <option value="691">Micronesia (+691)</option> 
 <option value="373">Moldova (+373)</option> 
 <option value="377">Monaco (+377)</option> 
 <option value="976">Mongolia (+976)</option> 
 <option value="1664">Montserrat (+1664)</option> 
 <option value="212">Morocco (+212)</option> 
 <option value="258">Mozambique (+258)</option> 
 <option value="95">Myanmar (+95)</option> 
 <option value="264">Namibia (+264)</option> 
 <option value="674">Nauru (+674)</option> 
 <option value="977">Nepal (+977)</option> 
 <option value="31">Netherlands (+31)</option> 
 <option value="687">New Caledonia (+687)</option> 
 <option value="64">New Zealand (+64)</option> 
 <option value="505">Nicaragua (+505)</option> 
 <option value="227">Niger (+227)</option> 
 <option value="234">Nigeria (+234)</option> 
 <option value="683">Niue (+683)</option> 
 <option value="672">Norfolk Islands (+672)</option> 
 <option value="670">Northern Marianas (+670)</option> 
 <option value="47">Norway (+47)</option> 
 <option value="968">Oman (+968)</option> 
 <option value="92">Pakistan (+92)</option> 
 <option value="680">Palau (+680)</option> 
 <option value="507">Panama (+507)</option> 
 <option value="675">Papua New Guinea (+675)</option> 
 <option value="595">Paraguay (+595)</option> 
 <option value="51">Peru (+51)</option> 
 <option value="63">Philippines (+63)</option> 
 <option value="48">Poland (+48)</option> 
 <option value="351">Portugal (+351)</option> 
 <option value="1787">Puerto Rico (+1787)</option> 
 <option value="974">Qatar (+974)</option> 
 <option value="262">Reunion (+262)</option> 
 <option value="40">Romania (+40)</option> 
 <option value="7">Russia (+7)</option> 
 <option value="250">Rwanda (+250)</option> 
 <option value="378">San Marino (+378)</option> 
 <option value="239">Sao Tome &amp; Principe (+239)</option> 
 <option value="966">Saudi Arabia (+966)</option> 
 <option value="221">Senegal (+221)</option> 
 <option value="381">Serbia (+381)</option> 
 <option value="248">Seychelles (+248)</option> 
 <option value="232">Sierra Leone (+232)</option> 
 <option value="65">Singapore (+65)</option> 
 <option value="421">Slovak Republic (+421)</option> 
 <option value="386">Slovenia (+386)</option> 
 <option value="677">Solomon Islands (+677)</option> 
 <option value="252">Somalia (+252)</option> 
 <option value="27">South Africa (+27)</option> 
 <option value="34">Spain (+34)</option> 
 <option value="94">Sri Lanka (+94)</option> 
 <option value="290">St. Helena (+290)</option> 
 <option value="1869">St. Kitts (+1869)</option> 
 <option value="1758">St. Lucia (+1758)</option> 
 <option value="249">Sudan (+249)</option> 
 <option value="597">Suriname (+597)</option> 
 <option value="268">Swaziland (+268)</option> 
 <option value="46">Sweden (+46)</option> 
 <option value="41">Switzerland (+41)</option> 
 <option value="963">Syria (+963)</option> 
 <option value="886">Taiwan (+886)</option> 
 <option value="7">Tajikstan (+7)</option> 
 <option value="66">Thailand (+66)</option> 
 <option value="228">Togo (+228)</option> 
 <option value="676">Tonga (+676)</option> 
 <option value="1868">Trinidad &amp; Tobago (+1868)</option> 
 <option value="216">Tunisia (+216)</option> 
 <option value="90">Turkey (+90)</option> 
 <option value="7">Turkmenistan (+7)</option> 
 <option value="993">Turkmenistan (+993)</option> 
 <option value="1649">Turks &amp; Caicos Islands (+1649)</option> 
 <option value="688">Tuvalu (+688)</option> 
 <option value="256">Uganda (+256)</option> 
 <option value="44" >UK (+44)</option> 
 <option value="380">Ukraine (+380)</option> 
 <option value="971" selected="selected">United Arab Emirates (+971)</option> 
 <option value="598">Uruguay (+598)</option> 
 <option value="1">USA (+1)</option> 
 <option value="7">Uzbekistan (+7)</option> 
 <option value="678">Vanuatu (+678)</option> 
 <option value="379">Vatican City (+379)</option> 
 <option value="58">Venezuela (+58)</option> 
 <option value="84">Vietnam (+84)</option> 
 <option value="84">Virgin Islands - British (+1284)</option> 
 <option value="84">Virgin Islands - US (+1340)</option> 
 <option value="681">Wallis &amp; Futuna (+681)</option> 
 <option value="969">Yemen (North)(+969)</option> 
 <option value="967">Yemen (South)(+967)</option> 
 <option value="381">Yugoslavia (+381)</option> 
 <option value="243">Zaire (+243)</option> 
 <option value="260">Zambia (+260)</option> 
 <option value="263">Zimbabwe (+263)</option>
  </select>
                        </div>
                        <div class="col-md-4">
                            <input id="mobile_no_new1" name="mobile_no_new1" type="text" class="ltrim form-control phone-number-field" value="" maxlength="10">
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="">
                               <input type="radio" name="defaultmobile" class="form-control no-marginInput" value="2">
                                <span class="lbl"></span>
                            </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Number 3</label>
                        <div class="col-md-4">
                            <select name="mobile_no_new_ccode2" id="mobile_no_new_ccode2" class="selectpicker show-tick form-control input-sm">
 <option value="1">USA (+1)</option> 
 <option value="213">Algeria (+213)</option> 
 <option value="376">Andorra (+376)</option> 
 <option value="244">Angola (+244)</option> 
 <option value="1264">Anguilla (+1264)</option> 
 <option value="1268">Antigua &amp; Barbuda (+1268)</option> 
 <option value="599">Antilles (Dutch) (+599)</option> 
 <option value="54">Argentina (+54)</option> 
 <option value="374">Armenia (+374)</option> 
 <option value="297">Aruba (+297)</option> 
 <option value="247">Ascension Island (+247)</option> 
 <option value="61">Australia (+61)</option> 
 <option value="43">Austria (+43)</option> 
 <option value="994">Azerbaijan (+994)</option> 
 <option value="1242">Bahamas (+1242)</option> 
 <option value="973">Bahrain (+973)</option> 
 <option value="880">Bangladesh (+880)</option> 
 <option value="1246">Barbados (+1246)</option> 
 <option value="375">Belarus (+375)</option> 
 <option value="32">Belgium (+32)</option> 
 <option value="501">Belize (+501)</option> 
 <option value="229">Benin (+229)</option> 
 <option value="1441">Bermuda (+1441)</option> 
 <option value="975">Bhutan (+975)</option> 
 <option value="591">Bolivia (+591)</option> 
 <option value="387">Bosnia Herzegovina (+387)</option> 
 <option value="267">Botswana (+267)</option> 
 <option value="55">Brazil (+55)</option> 
 <option value="673">Brunei (+673)</option> 
 <option value="359">Bulgaria (+359)</option> 
 <option value="226">Burkina Faso (+226)</option> 
 <option value="257">Burundi (+257)</option> 
 <option value="855">Cambodia (+855)</option> 
 <option value="237">Cameroon (+237)</option> 
 <option value="1">Canada (+1)</option> 
 <option value="238">Cape Verde Islands (+238)</option> 
 <option value="1345">Cayman Islands (+1345)</option> 
 <option value="236">Central African Republic (+236)</option> 
 <option value="56">Chile (+56)</option> 
 <option value="86">China (+86)</option> 
 <option value="57">Colombia (+57)</option> 
 <option value="269">Comoros (+269)</option> 
 <option value="242">Congo (+242)</option> 
 <option value="682">Cook Islands (+682)</option> 
 <option value="506">Costa Rica (+506)</option> 
 <option value="385">Croatia (+385)</option> 
 <option value="53">Cuba (+53)</option> 
 <option value="90392">Cyprus North (+90392)</option> 
 <option value="357">Cyprus South (+357)</option> 
 <option value="42">Czech Republic (+42)</option> 
 <option value="45">Denmark (+45)</option> 
 <option value="2463">Diego Garcia (+2463)</option> 
 <option value="253">Djibouti (+253)</option> 
 <option value="1809">Dominica (+1809)</option> 
 <option value="1809">Dominican Republic (+1809)</option> 
 <option value="593">Ecuador (+593)</option> 
 <option value="20">Egypt (+20)</option> 
 <option value="353">Eire (+353)</option> 
 <option value="503">El Salvador (+503)</option> 
 <option value="240">Equatorial Guinea (+240)</option> 
 <option value="291">Eritrea (+291)</option> 
 <option value="372">Estonia (+372)</option> 
 <option value="251">Ethiopia (+251)</option> 
 <option value="500">Falkland Islands (+500)</option> 
 <option value="298">Faroe Islands (+298)</option> 
 <option value="679">Fiji (+679)</option> 
 <option value="358">Finland (+358)</option> 
 <option value="33">France (+33)</option> 
 <option value="594">French Guiana (+594)</option> 
 <option value="689">French Polynesia (+689)</option> 
 <option value="241">Gabon (+241)</option> 
 <option value="220">Gambia (+220)</option> 
 <option value="7880">Georgia (+7880)</option> 
 <option value="49">Germany (+49)</option> 
 <option value="233">Ghana (+233)</option> 
 <option value="350">Gibraltar (+350)</option> 
 <option value="30">Greece (+30)</option> 
 <option value="299">Greenland (+299)</option> 
 <option value="1473">Grenada (+1473)</option> 
 <option value="590">Guadeloupe (+590)</option> 
 <option value="671">Guam (+671)</option> 
 <option value="502">Guatemala (+502)</option> 
 <option value="224">Guinea (+224)</option> 
 <option value="245">Guinea - Bissau (+245)</option> 
 <option value="592">Guyana (+592)</option> 
 <option value="509">Haiti (+509)</option> 
 <option value="504">Honduras (+504)</option> 
 <option value="852">Hong Kong (+852)</option> 
 <option value="36">Hungary (+36)</option> 
 <option value="354">Iceland (+354)</option> 
 <option value="91">India (+91)</option> 
 <option value="62">Indonesia (+62)</option> 
 <option value="98">Iran (+98)</option> 
 <option value="964">Iraq (+964)</option> 
 <option value="972">Israel (+972)</option> 
 <option value="39">Italy (+39)</option> 
 <option value="225">Ivory Coast (+225)</option> 
 <option value="1876">Jamaica (+1876)</option> 
 <option value="81">Japan (+81)</option> 
 <option value="962">Jordan (+962)</option> 
 <option value="7">Kazakhstan (+7)</option> 
 <option value="254">Kenya (+254)</option> 
 <option value="686">Kiribati (+686)</option> 
 <option value="850">Korea North (+850)</option> 
 <option value="82">Korea South (+82)</option> 
 <option value="965">Kuwait (+965)</option> 
 <option value="996">Kyrgyzstan (+996)</option> 
 <option value="856">Laos (+856)</option> 
 <option value="371">Latvia (+371)</option> 
 <option value="961">Lebanon (+961)</option> 
 <option value="266">Lesotho (+266)</option> 
 <option value="231">Liberia (+231)</option> 
 <option value="218">Libya (+218)</option> 
 <option value="417">Liechtenstein (+417)</option> 
 <option value="370">Lithuania (+370)</option> 
 <option value="352">Luxembourg (+352)</option> 
 <option value="853">Macao (+853)</option> 
 <option value="389">Macedonia (+389)</option> 
 <option value="261">Madagascar (+261)</option> 
 <option value="265">Malawi (+265)</option> 
 <option value="60">Malaysia (+60)</option> 
 <option value="960">Maldives (+960)</option> 
 <option value="223">Mali (+223)</option> 
 <option value="356">Malta (+356)</option> 
 <option value="692">Marshall Islands (+692)</option> 
 <option value="596">Martinique (+596)</option> 
 <option value="222">Mauritania (+222)</option> 
 <option value="269">Mayotte (+269)</option> 
 <option value="52">Mexico (+52)</option> 
 <option value="691">Micronesia (+691)</option> 
 <option value="373">Moldova (+373)</option> 
 <option value="377">Monaco (+377)</option> 
 <option value="976">Mongolia (+976)</option> 
 <option value="1664">Montserrat (+1664)</option> 
 <option value="212">Morocco (+212)</option> 
 <option value="258">Mozambique (+258)</option> 
 <option value="95">Myanmar (+95)</option> 
 <option value="264">Namibia (+264)</option> 
 <option value="674">Nauru (+674)</option> 
 <option value="977">Nepal (+977)</option> 
 <option value="31">Netherlands (+31)</option> 
 <option value="687">New Caledonia (+687)</option> 
 <option value="64">New Zealand (+64)</option> 
 <option value="505">Nicaragua (+505)</option> 
 <option value="227">Niger (+227)</option> 
 <option value="234">Nigeria (+234)</option> 
 <option value="683">Niue (+683)</option> 
 <option value="672">Norfolk Islands (+672)</option> 
 <option value="670">Northern Marianas (+670)</option> 
 <option value="47">Norway (+47)</option> 
 <option value="968">Oman (+968)</option> 
 <option value="92">Pakistan (+92)</option> 
 <option value="680">Palau (+680)</option> 
 <option value="507">Panama (+507)</option> 
 <option value="675">Papua New Guinea (+675)</option> 
 <option value="595">Paraguay (+595)</option> 
 <option value="51">Peru (+51)</option> 
 <option value="63">Philippines (+63)</option> 
 <option value="48">Poland (+48)</option> 
 <option value="351">Portugal (+351)</option> 
 <option value="1787">Puerto Rico (+1787)</option> 
 <option value="974">Qatar (+974)</option> 
 <option value="262">Reunion (+262)</option> 
 <option value="40">Romania (+40)</option> 
 <option value="7">Russia (+7)</option> 
 <option value="250">Rwanda (+250)</option> 
 <option value="378">San Marino (+378)</option> 
 <option value="239">Sao Tome &amp; Principe (+239)</option> 
 <option value="966">Saudi Arabia (+966)</option> 
 <option value="221">Senegal (+221)</option> 
 <option value="381">Serbia (+381)</option> 
 <option value="248">Seychelles (+248)</option> 
 <option value="232">Sierra Leone (+232)</option> 
 <option value="65">Singapore (+65)</option> 
 <option value="421">Slovak Republic (+421)</option> 
 <option value="386">Slovenia (+386)</option> 
 <option value="677">Solomon Islands (+677)</option> 
 <option value="252">Somalia (+252)</option> 
 <option value="27">South Africa (+27)</option> 
 <option value="34">Spain (+34)</option> 
 <option value="94">Sri Lanka (+94)</option> 
 <option value="290">St. Helena (+290)</option> 
 <option value="1869">St. Kitts (+1869)</option> 
 <option value="1758">St. Lucia (+1758)</option> 
 <option value="249">Sudan (+249)</option> 
 <option value="597">Suriname (+597)</option> 
 <option value="268">Swaziland (+268)</option> 
 <option value="46">Sweden (+46)</option> 
 <option value="41">Switzerland (+41)</option> 
 <option value="963">Syria (+963)</option> 
 <option value="886">Taiwan (+886)</option> 
 <option value="7">Tajikstan (+7)</option> 
 <option value="66">Thailand (+66)</option> 
 <option value="228">Togo (+228)</option> 
 <option value="676">Tonga (+676)</option> 
 <option value="1868">Trinidad &amp; Tobago (+1868)</option> 
 <option value="216">Tunisia (+216)</option> 
 <option value="90">Turkey (+90)</option> 
 <option value="7">Turkmenistan (+7)</option> 
 <option value="993">Turkmenistan (+993)</option> 
 <option value="1649">Turks &amp; Caicos Islands (+1649)</option> 
 <option value="688">Tuvalu (+688)</option> 
 <option value="256">Uganda (+256)</option> 
 <option value="44" >UK (+44)</option> 
 <option value="380">Ukraine (+380)</option> 
 <option value="971" selected="selected">United Arab Emirates (+971)</option> 
 <option value="598">Uruguay (+598)</option> 
 <option value="1">USA (+1)</option> 
 <option value="7">Uzbekistan (+7)</option> 
 <option value="678">Vanuatu (+678)</option> 
 <option value="379">Vatican City (+379)</option> 
 <option value="58">Venezuela (+58)</option> 
 <option value="84">Vietnam (+84)</option> 
 <option value="84">Virgin Islands - British (+1284)</option> 
 <option value="84">Virgin Islands - US (+1340)</option> 
 <option value="681">Wallis &amp; Futuna (+681)</option> 
 <option value="969">Yemen (North)(+969)</option> 
 <option value="967">Yemen (South)(+967)</option> 
 <option value="381">Yugoslavia (+381)</option> 
 <option value="243">Zaire (+243)</option> 
 <option value="260">Zambia (+260)</option> 
 <option value="263">Zimbabwe (+263)</option>
  </select>
                        </div>
                        <div class="col-md-4">
                            <input id="mobile_no_new2" name="mobile_no_new2" type="text" class="ltrim form-control phone-number-field" value="" maxlength="10">
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label class="">
                              <input type="radio" name="defaultmobile" class="form-control no-marginInput" value="3">
                                <span class="lbl"></span>
                            </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close-notes" class="btn btn-success save-mobile" data-dismiss="modal"><i class="fa fa-check"></i> Save and Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Access Time Modal -->
<div class="modal fade" id="access_time" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h5 class="modal-title">Access Timings</h5>
            </div>
            <div class="modal-body">
                <h4 class="text-primary">Timings</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>From</label>
                            <select name="access_timings_from" class="selectpicker show-tick form-control input-sm" id="access_timings_from">
                                        <option value="" selected>Select</option>
                                                                                <option value="0">00 Hrs</option>
                                                                                <option value="1">01 Hrs</option>
                                                                                <option value="2">02 Hrs</option>
                                                                                <option value="3">03 Hrs</option>
                                                                                <option value="4">04 Hrs</option>
                                                                                <option value="5">05 Hrs</option>
                                                                                <option value="6">06 Hrs</option>
                                                                                <option value="7">07 Hrs</option>
                                                                                <option value="8">08 Hrs</option>
                                                                                <option value="9">09 Hrs</option>
                                                                                <option value="10">10 Hrs</option>
                                                                                <option value="11">11 Hrs</option>
                                                                                <option value="12">12 Hrs</option>
                                                                                <option value="13">13 Hrs</option>
                                                                                <option value="14">14 Hrs</option>
                                                                                <option value="15">15 Hrs</option>
                                                                                <option value="16">16 Hrs</option>
                                                                                <option value="17">17 Hrs</option>
                                                                                <option value="18">18 Hrs</option>
                                                                                <option value="19">19 Hrs</option>
                                                                                <option value="20">20 Hrs</option>
                                                                                <option value="21">21 Hrs</option>
                                                                                <option value="22">22 Hrs</option>
                                                                                <option value="23">23 Hrs</option>
                                                                                </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>To</label>
                            <select name="access_timings_to" class="selectpicker show-tick form-control input-sm" id="access_timings_to">
                                        <option value="" selected>Select</option>
                                                                                <option value="0">00 Hrs</option>
                                                                                <option value="1">01 Hrs</option>
                                                                                <option value="2">02 Hrs</option>
                                                                                <option value="3">03 Hrs</option>
                                                                                <option value="4">04 Hrs</option>
                                                                                <option value="5">05 Hrs</option>
                                                                                <option value="6">06 Hrs</option>
                                                                                <option value="7">07 Hrs</option>
                                                                                <option value="8">08 Hrs</option>
                                                                                <option value="9">09 Hrs</option>
                                                                                <option value="10">10 Hrs</option>
                                                                                <option value="11">11 Hrs</option>
                                                                                <option value="12">12 Hrs</option>
                                                                                <option value="13">13 Hrs</option>
                                                                                <option value="14">14 Hrs</option>
                                                                                <option value="15">15 Hrs</option>
                                                                                <option value="16">16 Hrs</option>
                                                                                <option value="17">17 Hrs</option>
                                                                                <option value="18">18 Hrs</option>
                                                                                <option value="19">19 Hrs</option>
                                                                                <option value="20">20 Hrs</option>
                                                                                <option value="21">21 Hrs</option>
                                                                                <option value="22">22 Hrs</option>
                                                                                <option value="23">23 Hrs</option>
                                                                            </select>
                        </div>
                    </div>
                </div>
                <h5 class="text-primary">Week Days</h5>
                <div class="well">
                    <label class="checkbox-inline">
                            <input class="access_timings_days" name="access_timings_sun" type="checkbox" day="sun" id="access_timings_sun" checked="checked" value="1">
                            <span class="lbl padding">Sun</span>
                        </label>
                    <label class="checkbox-inline">
                            <input class="access_timings_days" name="access_timings_mon" type="checkbox" day="mon" id="access_timings_mon" checked="checked" value="1">
                            <span class="lbl padding">Mon</span>
                        </label>
                    <label class="checkbox-inline">
                           <input class="access_timings_days" name="access_timings_tue" type="checkbox" day="tue" id="access_timings_tue" checked="checked" value="1">
                            <span class="lbl padding">Tue</span>
                        </label>
                    <label class="checkbox-inline">
                            <input class="access_timings_days" name="access_timings_wed" type="checkbox" day="wed" id="access_timings_wed" checked="checked" value="1">
                            <span class="lbl padding">Wed</span>
                        </label>
                    <label class="checkbox-inline">
                           <input class="access_timings_days" name="access_timings_thu" type="checkbox" day="thu" id="access_timings_thu" checked="checked" value="1">
                            <span class="lbl padding">Thu</span>
                        </label>
                    <label class="checkbox-inline">
                           <input class="access_timings_days" name="access_timings_fri" type="checkbox" day="fri" id="access_timings_fri" checked="checked" value="1">
                            <span class="lbl padding">Fri</span>
                        </label>
                    <label class="checkbox-inline">
                            <input class="access_timings_days" name="access_timings_sat" type="checkbox" day="sat" id="access_timings_sat" checked="checked" value="1">
                            <span class="lbl padding">Sat</span>
                        </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success testtest" id="btn-close-accesstiming" data-dismiss="modal"><i class="fa fa-check"></i> Save and Close</button>
            </div>
        </div>
    </div>
</div>
<!-- upload marketing photos Modal -->
<div class="modal fade" id="popup3" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Upload Marketing Photos</h4>
            </div>
            <div class="modal-body">
                <div id="inner_tab">
                    <div class="inner_tab_nav">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#user_profile_photos" data-toggle="tab">User Profile Photos</a></li>
                            <li><a href="#contact_image" data-toggle="tab">Contact Image</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="user_profile_photos">
                            <p>Upload the user profile photo here, which will displayed on PDF brochures and the listing web preview. Dimension 160px width by 160px height. File format: JPG, PNG.</p>
                            <form id='image_upload_form' method='post' enctype='multipart/form-data' action='<?php echo base_url();?>users/uploadphoto/?id=ksadfhi7asflkdasfj89' target='upload_to1'>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type='file' id='file_browse' class="half-width" name='image' />
                                            <input type='hidden' class="current_User_randkey" name='current_User_randkey' id="current_User_randkey" />
                                            <input type='hidden' class="current_User" name='current_User' id="current_User" />
                                            <input type='hidden' class="current_User_client_id" name='current_User_client_id' id="current_User_client_id" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary" id="buttonUpload" onClick="this.form.submit()"><i class="fa fa-upload"></i> Upload</button>
                                        <button type="button" class="btn btn-danger" id="delete_agent_photo1" onClick="return false;"><i class="fa fa-trash"></i> Delete</button>
                                    </div>
                                </div>
                                <div class="half-width inline-block"><img style="display:none;" class="download_animation" src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="25" height="25" /></div>
                                <div class="row text-center user_marketing_img">
                                    <img src="<?php echo base_url();?>images/no-user-image-square.jpg" id="photopreview">
                                </div>
                            </form>
                            <iframe style="display:none" name='upload_to1'></iframe>
                        </div>
                        <div class="tab-pane fade" id="contact_image">
                            <p>Upload the user profile photo here, which will displayed on PDF brochures and the listing web preview. Dimension 160px width by 160px height. File format: JPG, PNG.</p>
                            <form id='userphoto2 upload_form2' method='post' enctype='multipart/form-data' action='<?php echo base_url();?>users/uploadphoto2' target='upload_to2'>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type='file' id='file_browse2' class="half-width" name='image2' />
                                            <input type='hidden' class="current_User_randkey" name='current_User_randkey' />
                                            <input type='hidden' class="current_User" name='current_User' />
                                            <input type='hidden' class="current_User_client_id" name='current_User_client_id' />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-primary" id="buttonUpload2" onClick="this.form.submit()"><i class="fa fa-upload"></i> Upload</button>
                                        <button type="button" class="btn btn-danger" id="delete_agent_photo2" onClick="return false;"><i class="fa fa-trash"></i> Delete</button>
                                    </div>
                                </div>
                            </form>
                            <div class="half-width inline-block"><img style="display:none;" class="download_animation" src="<?php echo base_url();?>mydata/images/ajax-loader.gif" width="25" height="25" /></div>
                            <div class="row text-center user_marketing_img">
                                <img src="<?php echo base_url();?>images/no-user-image-square.jpg" id="photopreview2">
                            </div>
                        </div>
                        <iframe style="display:none" name='upload_to2'></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- js starts here -->
<script type="text/javascript" src="<?php echo site_url();?>js_module/common.js?ts=123456789"></script>
<script type="text/javascript" src="<?php echo site_url();?>js_module/users.js?ts=1212"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(document.body).on("click", '.popup_email', function() {
            $("#email_default").val($("#email").val());
        });
        $(document.body).on("click", '.save-email', function() {
            $("#email").val($("#email_default").val());
            $("#myForm").validate({
                rules: {
                    email: {
                        email: true
                    }
                },
                errorClass: 'form_fields_error',
                errorPlacement: function(error, element) {}
            }).form();
        });
        $(document.body).on("click", '.popup_mobile', function() {
            $("#mobile_no_new_default").val($("#mobile_no_new").val());
            $("#mobile_no_new_ccode_default").val($("#mobile_no_new_ccode").val());
            $('#mobile_no_new_ccode_default_field').val($("#mobile_no_new_ccode option:selected").attr(
                'rel'));
        });
        $(document.body).on("click", '.save-mobile', function() {
            $("#mobile_no_new").val($("#mobile_no_new_default").val());
            $("#mobile_no_new_ccode").val($("#mobile_no_new_ccode_default").val());
            $('#mobile_no_new_ccode_field').val($("#mobile_no_new_ccode_default option:selected").attr(
                'rel'));
        });
        $(document.body).on("click", '#defaultE', function() {
            $("#defaultE").removeClass("contact-hollow-circle");
            $("#E1,#E2").addClass("contact-hollow-circle");
            $("#email").val($("#email_default").val());
        });
        $(document.body).on("click", '#E1', function() {
            $("#E1").removeClass("contact-hollow-circle");
            $("#defaultE,#E2").addClass("contact-hollow-circle");
            $("#email").val($("#email1").val());
        });
        $(document.body).on("click", '#E2', function() {
            $("#E2").removeClass("contact-hollow-circle");
            $("#E1,#defaultE").addClass("contact-hollow-circle");
            $("#email").val($("#email2").val());
        });
        //for email popup
        $(document.body).on("click", '#defaultM', function() {
            $("#defaultM").removeClass("contact-hollow-circle");
            $("#M1,#M2").addClass("contact-hollow-circle");
            $("#mobile_no_new").val($("#mobile_no_new_default").val());
            $("#mobile_no_new_ccode").val($("#mobile_no_new_ccode_default").val());
            $('#mobile_no_new_ccode_field').val($("#mobile_no_new_ccode_default option:selected").attr(
                'rel'));
        });
        $(document.body).on("click", '#M1', function() {
            $("#M1").removeClass("contact-hollow-circle");
            $("#defaultM,#M2").addClass("contact-hollow-circle");
            $("#mobile_no_new").val($("#mobile_no_new1").val());
            $("#mobile_no_new_ccode").val($("#mobile_no_new_ccode1").val());
            $('#mobile_no_new_ccode_field').val($("#mobile_no_new_ccode1 option:selected").attr('rel'));
        })
        $(document.body).on("click", '#M2', function() {
            $("#M2").removeClass("contact-hollow-circle");
            $("#M1,#defaultM").addClass("contact-hollow-circle");
            $("#mobile_no_new").val($("#mobile_no_new2").val());
            $("#mobile_no_new_ccode").val($("#mobile_no_new_ccode2").val());
            $('#mobile_no_new_ccode_field').val($("#mobile_no_new_ccode2 option:selected").attr('rel'));
        })
    });

</script>
<script>
    $(document).ready(function() {
        $("input#emailsLeads, input#passwordemail, input#imap").change(function() {
            $('#connect_status').val('0');
        });
        //                  for port imap
        $("#port").change(function() {
            var val_port = this.value;
            if (val_port == 'other') {
                $('#port_extra').val('');
                $('#port_extra').css('display', '');
                $('#port_extra').focus();
            } else {
                $('#port_extra').val('');
                $('#port_extra').css('display', 'none');
            }
        });
        //                    END for port imap
        $(".ltrim, #port_extra").numeric();
    });
    $(".ltrim").blur(function() {
        var str = $(this).val();
        $(this).val((ltrim(str, "0")));
    });

    function ltrim(str, chars) {
        chars = chars || "\\s";
        return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
    }

</script>
<script type="text/javascript">
    function updateselectvalues() {
        $("#select1values").val('');
        $("#select1 option").each(function() {
            $oldval = $("#select1values").val();
            $("#select1values").val($(this).val() + ',' + $oldval);
        });
        $("#select2values").val('');
        $("#select2 option").each(function() {
            $oldval = $("#select2values").val();
            $("#select2values").val($(this).val() + ',' + $oldval);
        });
        $("#select3values").val('');
        $("#select3 option").each(function() {
            $oldval = $("#select3values").val();
            $("#select3values").val($(this).val() + ',' + $oldval);
        });
        // add users data here
        $("#select1uservalues").val('');
        $("#select1user option").each(function() {
            $oldval = $("#select1uservalues").val();
            $("#select1uservalues").val($(this).val() + ',' + $oldval);
        });
        $("#select2uservalues").val('');
        $("#select2user option").each(function() {
            $oldval = $("#select2uservalues").val();
            $("#select2uservalues").val($(this).val() + ',' + $oldval);
        });
    }
    //updateselectvalues();
    $().ready(function() {
        $('#add_to_two').click(function() {
            $('#select1 option:selected').remove().appendTo('#select2');
            updateselectvalues();
        });
        $('#back_to_one').click(function() {
            $('#select2 option:selected').remove().appendTo('#select1');
            updateselectvalues();
        });
        $('#add_to_three').click(function() {
            $('#select2 option:selected').remove().appendTo('#select3');
            updateselectvalues();
        });
        $('#back_to_two').click(function() {
            $('#select3 option:selected').remove().appendTo('#select2');
            updateselectvalues();
        });
        $('#one_to_three').click(function() {
            $('#select1 option:selected').remove().appendTo('#select3');
            updateselectvalues();
        });
        $('#three_to_one').click(function() {
            $('#select3 option:selected').remove().appendTo('#select1');
            updateselectvalues();
        });
        //add user function starts here
        $('#add_to_two_user').click(function() {
            $('#select1user option:selected').remove().appendTo('#select2user');
            updateselectvalues();
        });
        $('#add_to_one_user').click(function() {
            $('#select2user option:selected').remove().appendTo('#select1user');
            updateselectvalues();
        });
    });
    $(document.body).on("click", '#buttonUpload, #buttonUpload2', function() {
        if ($('#document_name').val() != '') {
            $(".download_animation").css('display', 'inline');
        } else {
            $(".download_animation").css('display', 'none');
        }
        setTimeout(function() {
            $(".download_animation").css('display', 'none');
        }, 10000);
    });

</script>
<script type='text/javascript'>
    //Upload Logo
    $(document).ready(function() {
        $("#popup-avatar,#popup-agent-head-shot,#popup-agent-footer-image-2").click(function() {
            if ($('input#id').val() < 1) {
                alert("Please save the user first then upload images!");
                return false;
            }
        });
        $(document.body).on("click", "#delete_agent_photo2", function(event) {
            if ($('input#photo_agent2').val() != '') {
                $.post('<?php echo base_url();?>users/delete_agent_photo2/', {
                        user_id: $('input#id').val(),
                        filename: $('input#photo_agent2').val()
                    },
                    function(data) {
                        $('input#photo_agent2').val('')
                        $('#photopreview2').attr('height', '160');
                        $('#photopreview2').attr('src',
                            '<?php echo base_url();?>images/no-user-image-square.jpg');
                    }
                );
            } else {
                alert('No image uploaded!')
            }
        });
        $(document.body).on("click", "#delete_agent_photo1", function(event) {
            if ($('input#photo_agent').val() != '') {
                $.post('<?php echo base_url();?>users/delete_agent_photo1/', {
                        user_id: $('input#id').val(),
                        filename: $('input#photo_agent').val()
                    },
                    function(data) {
                        $('input#photo_agent').val('')
                        $('#photopreview').attr('height', '150');
                        $('#photopreview').attr('src',
                            '<?php echo base_url();?>images/no-user-image-square.jpg');
                    }
                );
            } else {
                alert('No image uploaded!')
            }
        });
        $('#image_upload_form').submit(function() {
            $('div#ajax_upload_demo1 img').attr('src',
                '<?php echo base_url();?>images/no-user-image-square.jpg');
        });
        $('iframe[name=upload_to1]').load(function() {
            var result = $(this).contents().text();
            if (result != '') {
                if (result == 'Err:format') {
                    $('div#ajax_upload_demo1 img').attr('src',
                        '<?php echo base_url();?>images/no-user-image-square.jpg');
                    $(".download_animation").css('display', 'none');
                } else {
                    //  alert(result);
                    //  alert($('current_User_client_id').val());
                    $('#photo_agent').val(result);
                    $('#photopreview').attr('src',
                        '<?php echo base_url();?>uploads/user/profile/'+$("#current_User_client_id").val()+'/' +
                        $(this).contents().text());
                    $(".download_animation").css('display', 'none');
                }
            }
        });
    });
    $(document).ready(function() {
        $('#image_upload_form').submit(function() {
            $('div#ajax_upload_demo2 img').attr('src',
                '<?php echo base_url();?>images/no-user-image-square.jpg');
        });
        $('iframe[name=upload_to2]').load(function() {
            var result = $(this).contents().text();
            if (result != '') {
                if (result == 'Err:big') {
                    alert('Invalid format: Please upload PNG file.');
                    $('div#ajax_upload_demo1 img').attr('src',
                        '<?php echo base_url();?>images/no-user-image-square.jpg');
                    $(".download_animation").css('display', 'none');
                } else if (result == 'Err:format') {
                    $('div#ajax_upload_demo2 img').attr('src',
                        '<?php echo base_url();?>images/no-user-image-square.jpg');
                    $(".download_animation").css('display', 'none');
                } else {
                    $('#photo_agent2').val(result);
                    $('#photopreview2').attr('src', $(this).contents().text());
                    $('#photopreview2').attr('height', '');
                    $(".download_animation").css('display', 'none');
                }
            }
        });
    });

</script>
<script>
    var screenname = "users";
    $(document).ready(function() {});

</script>
