var category_residential = [1,2,5,8,10,13,14,15,16,48];
var category_furnished = [6,7,11,18,21,50];
var category_land = [7,11,18];
var category_view = [2, 13, 15, 14, 16, 30];
var category_floor = [2,16, 12, 17, 9,12,7,11,18,6,21,48,50];
var display_order = ['overall_score','media_score','address_score','description_score', 'price_score', 'beds_baths_score', 'facilities_score'];


function QualityScore(listing) {
    this.renderSolidGauge = function(listing){
    	//alert(listing);
        this.listing = listing;
        
        var value = parseInt(listing_item.quality.overall_score);
        if(isNaN(value) || value == null) {
            $("#top_score_wrap").hide();
            return false;
        }
        var gaugeOptions = {
            chart: {
                type: 'solidgauge',
                spacingTop: 0,
                spacingLeft: 0,
                spacingRight: 0,
                spacingBottom: 0
            },
            title: null,
            pane: {
                center: ['50%', '50%'],
                size: '100%',
                startAngle: 0,
                endAngle: 360,
                background: {
                    backgroundColor: '#eee',
                    innerRadius: '80%',
                    outerRadius: '100%',
                    shape: 'arc',
                    borderWidth:0
                }
            },
            tooltip: {
                enabled: false
            },
            // the value axis
            yAxis: {
                stops: [
                    [.19 , '#EE2828'],
                    [.39 , '#E6772E'],
                    [.59 , '#E9C003'],
                    [.79 , '#8cc43d'], // red
                    [1 , '#2DA761'] // yellow
                ],
                lineWidth: 0,
                minorTickInterval: null,
                tickPixelInterval: 400,
                tickWidth: 0,
                title: {
                    y: -70
                },
                labels: {
                    enabled: false
                }
            },
            plotOptions: {
                solidgauge: {
                    innerRadius: '80%',
                    dataLabels: {
                        y: 12,
                        borderWidth: 0,
                        useHTML: true,
                        align: "center"
                    }
                }
            }
        };

        for(key in listing_item.quality) {
            if(key == "overall_score" || key == "price_diff") {
                continue;
            }
            var quality = listing_item.quality[key];
            var css_class = getClassFromValue(quality);
            
            $("#tf-"+key + " .value").attr("class", "value");
            $("#tf-"+key + " .value").addClass(css_class);
            $("#tf-"+key + " .value").html(quality + "%");
            if(quality == 100) {
                $("#tf-"+key + " .tf-suggestions").hide();
            }
            else {
                $("#tf-"+key + " .tf-suggestions").show();
            }
        }
        if(!listing_item.quality.price_diff || !listing_item.quality.price_score) {
            $("#tf-price_score").hide();
        }
        else {
            $("#tf-price_score").show();
        }
        var css_class = getClassFromValue(listing_item.quality.overall_score);
        var label = getLabelFromValue(listing_item.quality.overall_score);

        $(".tf-wrapper .title .quality").html(label);
        $(".tf-wrapper .title .quality").attr("class", "quality");
        $(".tf-wrapper .title .quality").addClass(css_class);

        $(".tf-wrapper .title .value").attr("class", "value");
        $(".tf-wrapper .title .value").addClass(css_class);
        $(".tf-wrapper .title .value").html(listing_item.quality.overall_score + "%");

        $("#top_score_wrap").show();
        $('#top_overall_score').highcharts(Highcharts.merge(gaugeOptions, {
            yAxis: {
                min: 0,
                max: 100,
                title: {
                    text: ''
                }
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Speed',
                data: [value],
                dataLabels: {
                    format: '<div style="text-align:center;"><span style="font-size:12px;color:' +
                    ('black') + '">{y}%</span><br/>' +
                    '<span style="font-size:12px;color:silver"></span></div>'
                },
                tooltip: {
                    valueSuffix: ' km/h'
                }
            }]
        }));
    };

}


function renderDistribution(distribution) {
    $('#quality-distribution-graph').highcharts({
        chart: {
            type: 'column',
            height: 200
        },
        // title: {
           // text: '<h4 class="text-center">Listing Quality Distribution</h4>',
           // useHTML: true
       // },
		       title: {
		    text: '',
		    style: {
		        display: 'none'
		    }
		},
        xAxis: {
            categories: [
                'Poor',
                'Below Average',
                'Good',
                'Very Good',
                'Outstanding',
            ],
            crosshair: true,
            minorTickInterval: null,
            tickWidth:0
        },
        yAxis: {
            min: 0,
            title: {
                text: ''
            }
        },
        tooltip: {
            enabled:false
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            },
            series: {
                colorByPoint: true,
                colors: ['#EE2828', '#E6772E', '#E9C003', '#8CC43D','#2DA761']
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: '',
            showInLegend: false,
            data: distribution,
            pointWidth: 20
        }]
    });
}
function renderQualityMeter(elem_id, value) {
    return $('#'+elem_id).highcharts({
        chart: {
            type: 'gauge',
            plotBorderWidth: 0,
            plotBackgroundColor: "#fff",
            plotBackgroundImage: null,
            height: 200
        },

        // title: {
            // text: '<h4 class="text-center">Company\'s Listing Quality</h4>',
            // useHTML: true
        // },
		title: {
		    text: '',
		    style: {
		        display: 'none'
		    }
		},
        tooltip: {
            enabled: false
        },
        pane: [{
            startAngle: -90,
            endAngle: 90,
            background: null,
            center: ['50%', '90%'],
            size: 230
        }],
        yAxis: [{
            min: 0,
            max: 100,
            minorTickPosition: 'outside',
            tickPosition: 'outside',
            labels: {
                enabled:false
            },
            plotBands: [{
                from: 0,
                to: 20,
                color: '#EE2828',
                thickness:6
            },{
                from: 20,
                to: 40,
                color: '#E6772E',
                thickness:6
            }, {
                from: 40,
                to: 60,
                color: '#E9C003',
                thickness:6
            }, {
                from: 60,
                to: 80,
                color: '#8CC43D',
                thickness:6
            }, {
                from: 80,
                to: 100,
                color: '#2DA761',
                thickness:6
            }],
            pane: 0,
            minorTickInterval: null,
            tickWidth:0,
            title: {
                text: '',
                y: -40
            }
        }],

        plotOptions: {
            gauge: {
                dataLabels: {
                    enabled: true,
                    x: 0,
                    y: -160,
                    useHTML: true,
                    borderWidth: 0,
                    formatter: function() {
                        var color = getColorFromValue(this.point.y);
                        return '<b style="color:'+color+';font-size:18px;">' + this.point.y + "%</b>";
                    }
                },
                dial: {
                    radius: '90%'
                }
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            data: [value],
            yAxis: 0
        }]

    });
}

function getClassFromValue(value) {
    if(value < 20) { return 'red'; }
    if(value < 40) { return 'orange'; }
    if(value < 60) { return 'yellow'; }
    if(value < 80) { return 'limegreen'; }
    if(value >= 80) { return 'darkgreen'; }
}

function getColorFromValue(value) {
    if(value < 20) { return '#ee2828'; }
    if(value < 40) { return '#e6772e'; }
    if(value < 60) { return '#e9c003'; }
    if(value < 80) { return '#8cc43d'; }
    if(value >= 80) { return '#2da761'; }
}

function getLabelFromValue(value) {
    if(value < 20) { return 'Poor'; }
    if(value < 40) { return 'Below Average'; }
    if(value < 60) { return 'Good'; }
    if(value < 80) { return 'Very Good'; }
    if(value >= 80) { return 'Outstanding'; }
}

function getPhotosSuggestion(num_photos) {
    if(num_photos == 0) {
        return "Oops! Your listing does not have a photo. Add at least 10 good quality photos to get your listing to stand out.";
    }
    if(num_photos < 4) {
        return  "So-so. You have very few photos attached to this listing. Add at least 10 good quality photos in total and make your listing a winner!";
    }
    if(num_photos < 10) {
        return "Average. Add a few more photos and your listing can really shine.";
    }
    return false;
}

function getFloorPlanSuggestion(floor_plans) {
    if(floor_plans == 0) {
        return "There is no floor plan attached to this listing. Add at least 1 floor plan.";
    }
    return false;
}

function otherMediaSuggestions(other_medias) {
    if(other_medias == 0) {
        return "There is no PDF brochure or video linked to this listing. Add either or both to ensure a listing of superior quality."
    }
    return false;
}


function titleSuggestions(title) {
    if(title.length < 20) {
        return "Listing title is too brief. Use at least 50 characters to create a compelling title for your listing. For a perfect score, use at least 90 characters.";
    }
    if(title.length < 50) {
        return "Listing title is of average length. Use at least 50 characters to ensure an attention-grabbing headline for your listing. For a perfect score, use at least 90 characters.";
    }
    if(title.length >= 50 && title.length < 90) {
        return "Almost there! The length of your listing title is better than average. At least 90 characters and a perfect score is yours.";
    }
    return false;
}


function descriptionSuggestions(desc) {
    if(!desc || desc.length == 0) {
        return "Nothing to say? Use at least 300 characters to highlight the unique selling points of your listing. For a perfect score, use at least 1550 characters.";
    }
    if(desc.length < 300) {
        return "Listing description is too brief. Use at least 300 characters to highlight what makes this property special. For a perfect score, use at least 1550 characters.";
    }
    if(desc.length >= 300 && desc.length < 1550) {
        return "Looking good! Use at least 1550 characters to achieve a perfect score.";
    }
    return false;
}

function getPriceSuggestions(variation, listing_item) {
    variation = parseInt(variation);
    var type = (listing_item.type == 1) ? "tenant" : "buyer";
    if(variation > 0) {
        return "Your listing is overpriced by "+variation+"%. Ensure that the listing price is within the price range to increase "+type+" interest."
    }
    if(variation < 0) {
        return "Your listing is underpriced by "+Math.abs(variation)+"%. A potential "+type+" might doubt the credibility of your listing. Ensure that the listing price is within the price range to improve "+type+" response.";
    }
    return false;
}

function getAddressSuggestions(listing_item) {
    var sub_location = listing_item.sub_area_location_id;
    var type = (listing_item.type == 1) ? "tenants" : 'buyers';
    if(!sub_location || sub_location == 0) {
        return "Your listing doesn't have a Sub-location. Specify a Sub-location to make it easy for the "+type+" to locate your property in a map search.";
    }
    return false;
}

function getAdditionInfoSuggestion(listing_item) {
    var suggestion = [];
    var cat_id = parseInt(listing_item.category_id);
    if(!isNaN(cat_id) && cat_id > 0) {
        if(category_residential.indexOf(cat_id) >= 0 && (!listing_item.baths || listing_item.baths == "0")) {
            suggestion.push("No. of Baths");
        }
        if(category_furnished.indexOf(cat_id) < 0 && listing_item.furnished =="0") {
            suggestion.push("Furnishing Type");
        }
        if(category_land.indexOf(cat_id) < 0 && !listing_item.parking) {
            suggestion.push("No. of Parking");
        }
        if(category_view.indexOf(cat_id) >= 0) {
            if(!listing_item.view_id) {
                suggestion.push("View");
            }
            if(!listing_item.unit_type) {
                suggestion.push("Unit Type");
            }
        }
        if(!listing_item.street_no) {
            suggestion.push("Street No.");
        }
        if(category_floor.indexOf(cat_id) < 0 && (!listing_item.floor_no || listing_item.floor_no == "0")) {
            suggestion.push("Floor No.");
        }
    }
    var type = (listing_item.type == 1) ? "tenants" : 'buyers';
    if(suggestion.length >= 2) {
        var last =  suggestion.pop();
        var message = (suggestion.join(", ") +" and "+ last);
        message = message.replace(/\.$/, '');
        return "Your listing doesnâ€™t specify "+message+".  Add this valuable information to ensure "+type+" better understand what this property includes.";
    }
    if(suggestion.length == 1) {
        return "Your listing doesnâ€™t specify "+suggestion[0]+". Add this valuable information to ensure "+type+" better understand what this property includes.";
    }
    return false;
}

function getFacilitiesSuggestion(facilities) {
    if(facilities == 0) {
        return "Your listing doesnâ€™t mention any facilities. Add at least 8 features, amenities and nearby places in total to make it stand out. To achieve a perfect score, add at least 16 features, amenities and nearby places in total.";
    }
    if(facilities < 8) {
        return "Your listing mentions only "+facilities+" facilities. Add at least 8 features, amenities and nearby places in total to make it stand out. To achieve a perfect score, add at least 16 features, amenities and nearby places in total.";
    }
    if(facilities >=8 && facilities < 16) {
        return "Your listing mentions "+facilities+" facilities, which is better than the average. Add at least 16 features, amenities and nearby places in total to achieve a perfect score.";
    }
    return false;
}


function getOtherMediaCount(listing) {
    var count = 0;
    if(listing.video_embed_code != "") {
        count++;
    }
    if(listing["360_embed_code"] != "") {
        count++;
    }
    if(listing.audio_embed_code != "") {
        count++;
    }
    if(listing.virtual_tour_embed_code != "") {
        count++;
    }
    if(listing.qr_code_link != "") {
        count++;
    }
    if(listing.pdf_brochure != "") {
        count++;
    }
    if(listing.video_path != "") {
        count++;
    }
    return count;
}

function getItemSuggestion(type, listing_item, topform) {
    suggestion = false;
    switch(type) {
        case 'media':
            var photos = parseInt(listing_item.photos) - parseInt(listing_item.num_floorplans);
            var photo_suggestion = getPhotosSuggestion(photos);
            var floor_plan_suggestions = "";
            if(category_land.indexOf(parseInt(listing_item.category_id)) < 0 ) {
                floor_plan_suggestions = getFloorPlanSuggestion(parseInt(listing_item.num_floorplans));
            }
            var other_media_suggestions = otherMediaSuggestions(getOtherMediaCount(listing_item));
            var i = 1;
            suggestion = "";

            if(photos >= 10 && photos < 14 && !floor_plan_suggestions  && other_media_suggestions) {
                photo_suggestion = "Excellent! The photos and floor plan look great. Bring the total number of pictures up to 14 for a perfect score.";
            }
            else if(photos >= 10 && photos < 16 && floor_plan_suggestions  && other_media_suggestions) {
                photo_suggestion = "Excellent! The photos look great. Bring the total number of pictures up to 16 for a perfect score.";
            }
            if(photo_suggestion) {
                suggestion = (i + " . " + photo_suggestion + "<br><br>");
                i++;
            }
            if(floor_plan_suggestions) {
                suggestion += (i + " . " + floor_plan_suggestions+ "<br><br>");
                i++;
            }
            if(other_media_suggestions) {
                suggestion += (i + " . " + other_media_suggestions+ "<br><br>");
                i++;
            }
            break;
        case 'address':
            suggestion = getAddressSuggestions(listing_item);
            break;
        case 'description':
            var title_suggestion = titleSuggestions(listing_item.name);
            var desc_suggestion = descriptionSuggestions(convertHtmlToText(listing_item.description));
            var i = 1;
            suggestion = "";
            if(title_suggestion) {
                suggestion = (i + " . " + title_suggestion + "<br><br>");
                i++;
            }
            if(desc_suggestion) {
                suggestion += (i + " . " + desc_suggestion+ "<br><br>");
                i++;
            }
            break;
        case 'price':
            if(topform && listing_item.quality.price_diff) {
                suggestion = getPriceSuggestions(listing_item.quality.price_diff, listing_item);
            }
            else if(listing_item.quality.price_diff) {
                suggestion = getPriceSuggestions(listing_item.quality.price_diff, listing_item);
            }
            break;
        case 'beds_baths':
            suggestion = getAdditionInfoSuggestion(listing_item);
            break;
        case 'facilities':
            facilities = 0;
            if(listing_item.features_id) {
                var facilities = listing_item.features_id.split("}{").length;
            }
            if(listing_item.area_iformation_data) {
                var area_info = JSON.parse(listing_item.area_iformation_data);
                for(key in area_info) {
                    facilities++;
                }
            }
            suggestion = getFacilitiesSuggestion(facilities);
            break;
    }
    return suggestion;
}


$(function() {
    $('.dd-popover').popover({
        animation: true,
        trigger: 'click',
        html : true,
        placement : 'bottom',
        container: '.dd-icon'
    });

    $(".tf-suggestions").click(function(e){
        var type = $(this).data('type');
        var suggestion = getItemSuggestion(type, listing_item, true);
        if(suggestion) {
            var value = $("#tf-"+type + "_score .value").html();
            var label = $("#tf-"+type + "_score .tf-lbl").html();
            var css_class = getClassFromValue(value.replace("%",''));
            $(".tf-suggestion-item .title .value").html(value);
            $(".tf-suggestion-item .title .value").attr('class','value');
            $(".tf-suggestion-item .title .value").addClass(css_class);
            $(".tf-suggestion-item .title .tf-lbl").html(label);
            $("#tf-suggestion").html(suggestion);
            $(".tf-suggestions-list").addClass('active');
            $(".tf-suggestion-item").addClass('active');
        }
        e.stopPropagation();
    });

    $('#tf-dropdown-wrap').on('show.bs.dropdown', function () {
        $(".tf-suggestions-list").removeClass('active');
        $(".tf-suggestion-item").removeClass('active');
    })

    $(".tfs-back").click(function(e){
        $(".tf-suggestions-list").removeClass('active');
        $(".tf-suggestion-item").removeClass('active');
        e.stopPropagation();
    });

    $('.dropdown-menu').click(function(event){
       // event.stopPropagation();//shafiq comments
    });

    $("#tab4").on("click", "#show-hide-aggregates", function(){
        $(".aggregate-score-wrap").slideToggle('fast');
        $(this).find('i').toggleClass("icon-down-open icon-up-open");
    });

    $("#tab4").on("click", "#next-aggregate-chart", function(){
        var chart = $("#aggregate-score-gauge").highcharts();
        var current = $("#aggregate-score-gauge").data('current');
        var current_index = display_order.indexOf(current);
        var next_index = (current_index == (display_order.length -1) ) ? 0 :  current_index + 1;
        var next = aggregate_scores[next_index];
        $("#aggregate-score-gauge").data('current', display_order[next_index]);
        $("#overall-quality-title").html(next.title);
        var point = chart.series[0].points[0];
        point.update(next.value);
    });

    $("#tab4").on("click", '#prev-aggregate-chart', function(){
        var chart = $("#aggregate-score-gauge").highcharts();
        var current = $("#aggregate-score-gauge").data('current');
        var current_index = display_order.indexOf(current);
        var next_index = (current_index == 0 ) ? display_order.length - 1 :  current_index - 1;
        var next = aggregate_scores[next_index];
        $("#aggregate-score-gauge").data('current', display_order[next_index]);
        $("#overall-quality-title").html(next.title);
        var point = chart.series[0].points[0];
        point.update(next.value);
    });

});
