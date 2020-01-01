$(function() {

    //Make popups movable
    $(".draggable").draggable();
    $('#leads_viewings_select_popup').draggable();

    //event to remove (press Enter) key
    $(window).keydown(function(event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });



    $('#preview_lead').live('click', function() {

        //var lead_ref_edit = $('#lead_ref_edit').val();

        $('#load_listing_popup').attr('style', 'display:none');
        $('#load_deal_popup').attr('style', 'display:none');

        $('#load_lead_popup').attr('style', 'display:block');
        var lead_id = $('#hdn_leads_id_edit').val();

        $.getJSON(mainurl + "calendar/preview_lead_popup/" + lead_id, function(json) {
            var jsonData = '';
            if (json) {
                $.each(json, function(key, val) {
                    if (key == "ref") {
                        jsonData += '<td id="lead_td"><form target="_blank" id="popup_form_lead_' + lead_id + '" action=' + mainurl + 'leads/ method="POST"><input type="hidden" name="leads_id" value="' + lead_id + '"><input type="hidden" name="id" value="' + lead_id + '">\n\
                                    <div class="popup_a" style="text-align:center; font-size:12px; text-decoration:none;">\n\
                                    <a href="#" id="lead_submit_' + lead_id + '">' + val + '</a></div></form></td>';
                    } else {
                        jsonData += '<td class="lead_td_class">' + val + '</td>';
                    }
                });
                jsonData = "<div id='lead_table'><table width='100%' cellspacing='5'><tr><td>Reference</td><td>Full Name</td>\n\
                    <td>Status</td><td>Sub status</td></tr><tr id='lead_tr'>" +
                        jsonData + "</tr></table></form></div>";

            } else {
                jsonData = "<div id='lead_table'>No record found</div>";
            }

            $('#load_lead_popup #lead_table').remove();
            $('#load_lead_popup').append(jsonData);

        }); //End json

        $('#lead_submit_' + lead_id).live('click', function() {

            $('#popup_form_lead_' + lead_id).submit();
        });


    });


    $('#preview_listing').live('click', function() {

        $('#load_lead_popup').attr('style', 'display:none');
        $('#load_deal_popup').attr('style', 'display:none');

        $('#load_listing_popup').attr('style', 'display:block');
        var listing_id = $('#hdn_listings_id_edit').val();

        $.getJSON(mainurl + "calendar/preview_listing_popup/" + listing_id, function(json) {
            var jsonData = '';
            var rand_key = '';
            var client_id = '';
            var agent_id = '';

            if (json) {
                $.each(json, function(key, val) {
                    if (key == "ref") {
                        jsonData += '<td class="lead_td_class"><a target="_blank" href="' + mainurl + "preview/index/" + rand_key + "/" + client_id + "/" + agent_id + '">' + val + '</a></td>';
                    } else if (key == 'rand_key') {

                        //jsonData -= '<td class="lead_td_class">' + val + '</td>';

                        rand_key = val;
                    } else if (key == 'client_id') {
                        client_id = val;
                    } else if (key == 'agent_id') {
                        agent_id = val;

                    } else {
                        jsonData += '<td class="lead_td_class">' + val + '</td>';
                    }
                });
                jsonData = "<div id='listing_table'><table  width='100%' cellspacing='5'><tr><td>Reference</td><td>Category</td><td>Emirate</td><td>Location</td><td>Sub Location</td></tr><tr id='listing_tr'>" +
                        jsonData + "</tr></table></div>";

            } else {
                jsonData = "<div id='listing_table'>No record found</div>";
            }

            $('#load_listing_popup #listing_table').remove();
            $('#load_listing_popup').append(jsonData);

        }); //End json


    });

    $('#preview_deal').live('click', function() {

        $('#load_listing_popup').attr('style', 'display:none');
        $('#load_lead_popup').attr('style', 'display:none');

        $('#load_deal_popup').attr('style', 'display:block');
        var deal_id = $('#hdn_deals_id_edit').val();

        $.getJSON(mainurl + "calendar/preview_deal_popup/" + deal_id, function(json) {
            var jsonData = '';

            if (json) {
                $.each(json, function(key, val) {
                    if (key == "ref") {
                        jsonData += '<td class="lead_td_class" id="deal_td"><form target="_blank" id="popup_form_deal_' + deal_id + '" action=' + mainurl + 'deals/ method="POST"><input type="hidden" name="deals_id" value="' + deal_id + '"><input type="hidden" name="id" value="' + deal_id + '">\n\
                                <div class="popup_a" style="text-align:center; font-size:12px; text-decoration:none;">\n\
                                <a href="#" id="deal_submit_' + deal_id + '">' + val + '</a></div></form></td>';
                    } else if (key == "price") {
                        jsonData += '<td class="lead_td_class">' + val + '</td><td class="lead_td_class">AED</td>';
                    }
                    else {
                        jsonData += '<td class="lead_td_class">' + val + '</td>';
                    }
                });
                jsonData = "<div id='deal_table'><table width='100%'><tr><td>Reference</td><td>Type</td><td>Status</td><td>Sub status</td><td>Emirate</td><td>Location</td><td>Price</td></tr><tr id='deal_tr'>" +
                        jsonData + "</tr></table></div>";
            } else {
                jsonData = "<div id='deal_table'>No record found</div>";
            }

            $('#load_deal_popup #deal_table').remove();
            $('#load_deal_popup').append(jsonData);

        }); //End json

        $('#deal_submit_' + deal_id).live('click', function() {

            $('#popup_form_deal_' + deal_id).submit();
        });
    });



    $('#leadPreviewClose').live('click', function() {
        $('#load_lead_popup').fadeOut('slow');
        $('#lead_table').html('');
    });
    $('#listingPreviewClose').live('click', function() {
        $('#load_listing_popup').fadeOut('slow');
        $('#listing_table').html('');
    });
    $('#dealPreviewClose').live('click', function() {
        $('#load_deal_popup').fadeOut('slow');
        $('#deal_table').html('');
    });



    //Event to open listing preview
    $('#popup_listing_preview').live("click", function() {

        var rand_key = genRandKey();


        if ($(this).attr('id') == 'popup_listing_preview') {

            var current_agent_id = 3;
            var preview_url = mainurl + 'preview/index/' + rand_key + '/' + 2918 + '/' + current_agent_id;

            window.open(preview_url);
            return;

        }


    });



    $('#cevent_type').live('change', function() {
        var type = $('#cevent_type').val();
        if(type === 'Viewing'){
            $('#pack_user_tr').removeAttr('id');
        }else{
            $('.pack_user_tr').attr('id', 'pack_user_tr');
        }
        
    });
    
    $('#event_type').live('change', function() {
        var type = $('#event_type').val();
        if(type === 'Viewing'){
            $('#pack_user_edit_tr').css('display', '');
        }else{
            //$('.pack_user_edit_tr').attr('id', 'pack_user_edit_tr');
        }
        
    });






    /************POPUPS************/






//the end of the function e.i. $(document).ready();
});


