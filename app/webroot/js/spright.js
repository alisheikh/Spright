/**
 * Spright. (http://spright.com.au)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @link http://spright.com.au
 * @since Spright. 0.4
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */



/*
 * Global functions
 *
 */

    //Save Button
$('#saveBtn').click(function() {

    form = $('form:first');


    if(form.valid()){
        

        $(this).html('<i class="fa fa-spinner fa-spin"></i>');
        $(this).prop('disabled',true);
        form.submit();

    }
});



  $('#close, #overlay').click(function(e) {
      e.preventDefault();
      $('#overlay, #alertModalOuter').fadeOut(400, function() {
      $('#close').remove();
    });
});

function getLocationsNextLevel(name, level, source, div) {
    "use strict";
  var currentLevel = level;
  var neinxtLevel = level + 1;
  var feature = div;
  var $select = $(feature + ' select:eq(' + level + ')');
  var selectName = $(this).attr('name');
  var selected = level - 1;
    //What level are we updating data for?


  switch (level) {
  case 1:
  var $selectItems = $(feature + ' select').eqAnyOf([1, 2, 3, 4]); //Make sure there is a space in front of select
    break;
  case 2:
            var $selectItems = $(feature + ' select').eqAnyOf([2, 3, 4]); //Make sure there is a space in front of select
            break;
        case 3:
            var $selectItems = $(feature + ' select').eqAnyOf([3, 4]); //Make sure there is a space in front of select
            break;
        case 4:
            var $selectItems = $(feature + ' select').eqAnyOf([4]); //Make sure there is a space in front of select
            break;
    }


    $(name + 'ID').val($(feature + ' select:eq(' + selected + ')').children(":selected").attr("id"));

    //Get the ID of the select Node
    var node = $(feature + ' select:eq(' + selected + ')').val();

    //Empty and disable child nodes
    $selectItems.select2('data', null)

    $selectItems.val("");
    $.getJSON(source + '?key=' + node, function(data) {
        if (data.length != 0) {
           // $select.empty().append('<option>--</option>');
            $select.prop('disabled', false);
            $.each(data, function(key, val) {
                $select.append('<option value="' + val.key + '"id="' + val.key + '">' + val.title + '</option>');
            })
        }
    })
}

/*
 ** Dependant drop downs
 */
function getLocations() {
    console.log('populateLocations() Activated');

    var t0 = '#' + $('#chooseLocation select').eq('0').attr('id'); //Site
    var t1 = '#' + $('#chooseLocation select').eq('1').attr('id'); //Building
    var t2 = '#' + $('#chooseLocation select').eq('2').attr('id'); //Floor
    var t3 = '#' + $('#chooseLocation select').eq('3').attr('id'); //Room

    console.log($(t1).has('option').length)

    jsonURL = '/codes/buildLocations.json';
    container = '#chooseLocation';
    if ($(t1).has('option').length === 0) {
        console.log('disable buildings, floors, rooms')
        $(t1).prop('disabled', true);
        $(t2).prop('disabled', true);
        $(t3).prop('disabled', true);
    }
    var $selectSite = $(t0);
    console.log($selectSite);
    if ($selectSite.has('option').length <= 1) {

        //first level
        $.getJSON(jsonURL, function(data) {
            console.log('Site SELECT empty');
            $.each(data, function(key, val) {
                $selectSite.append('<option value="' + val.key + '"id="' + val.key + '">' + val.title + '</option>');
            })
        });
    } else {
        console.log('Site SELECT has values');
    }

    //QS1 Start
    $(t0).change(function() {
        console.log('changed 0')
        getLocationsNextLevel(t0, 1, jsonURL, container);
    })
    $(t1).change(function() {
        console.log('changed 1')
        getLocationsNextLevel(t1, 2, jsonURL, container);
    })
    $(t2).change(function() {
        console.log('changed 2')
        getLocationsNextLevel(t2, 3, jsonURL, container);
    })
    $(t3).change(function() {
        console.log('changed 3')
        getLocationsNextLevel(t3, 4, jsonURL, container);
    })

}

/*
 * Module: Dashboard
 * 
 */

    var yourJobsTable = $('#your-jobs-table').DataTable({
        //  "scrollX": true,
   "language": {
        "emptyTable": "No jobs to display"
    },
        stateSave: true,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "/apis/yourjobs.json",
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<button id=\"view\"class='btn btn-default btn-xs' type='button'><i class='fa fa-search'></i></button> <button id=\"edit\" class='btn btn-default btn-xs' type='button'><i class='fa fa-pencil'></i></button>"
        }],
        "columns": [{
                data: "JobID"
            }, {
                data: "fullname"
            }, {
                data: "SiteCode"
            }, {
                data: "BuildingCode"
            }, {
                data: "FloorCode"
            }, {
                data: "RoomCode"
            }, {
                data: "Status"
            },
            {
                data: "qs1"
            }, {
                data: "qs2"
            }, {
                data: "qs3"
            }, {
                data: "qs4"
            }, {
                data: "qs5"
            },
            {
                data: "created"
            },
             {
                data: null,"bSearchable": false, "bSortable": false // need to supply a null value for
            },
        ],
    });

//View job from datatable
   $('#your-jobs-table tbody').on( 'click', '#view', function () {
               var data = yourJobsTable.row( $(this).parents('tr') ).data();
      
       window.location = "/jobs/view/" + data.JobID;
    } );

//Edit job from datatable
   $('#your-jobs-table tbody').on( 'click', '#edit', function () {
               var data = yourJobsTable.row( $(this).parents('tr') ).data();
        
        window.location = "/jobs/edit/" + data.JobID;
    } );



/*
 * Module: Planned Maintenance
 * Location:
 * Function: Create schedules for work<button type="button" class="btn btn-xs btn-default">button</button>
 */


//Get Assets
$(".codeSearch").select2({
    minimumInputLength: 2,
    ajax: {
        url: '/codes/getAssets.json',
        dataType: 'json',
        type: "GET",
        quietMillis: 50,
        data: function(term) {
            return {
                q: term
            };
        },
        results: function(data) {
            return {
                results: $.map(data, function(item) {
                    return {
                        text: item.code,
                        slug: item.code,
                        id: item.id
                    }
                })
            };
        }
    }
});


$(function() {
    if ($('#page-wrapper').is('.createSchedule')) {

        getLocations();

        $(document).ready(function() {
            $('#rootwizard').bootstrapWizard({
        
                onTabShow: function(tab, navigation, index) {
                    var $total = navigation.find('li').length;
                    var $current = index + 1;
                    var $percent = ($current / $total) * 100;
                    $('#rootwizard').find('.bar').css({
                        width: $percent + '%'
                    });

                    // If it's the last tab then hide the last button and show the finish instead
                    if ($current >= $total) {
                        $('#rootwizard').find('.pager .next').hide();
                        $('#rootwizard').find('.pager .finish').show();
                        $('#rootwizard').find('.pager .finish').removeClass('disabled');
                    } else {
                        $('#rootwizard').find('.pager .next').show();
                        $('#rootwizard').find('.pager .finish').hide();
                    }

                }
            });

        });

        $(document).tooltip({
            selector: "[title]",
            placement: "bottom",
            trigger: "focus",
            animation: false
        });

        $('#ScheduleFreq').on('change', function() {

            if (this.value == "MONTHLY") {

                $("#repeatLabel").html('Months');

            }

            if (this.value == "DAILY") {

                $("#repeatLabel").html('Days');

            }


            if (this.value == "YEARLY") {

                $("#repeatLabel").html('Years');

            }

            if (this.value == "WEEKLY") {
                $("#weekly").show();
                $("#repeatLabel").html('Weeks');

            } else {
                $("#weekly").hide();
            }
        });


        //select after radiobutton if the occurence input has focus

        $('#scheduleCount').on('focus', function() {

            $("#runtimeCount").prop("checked", true)

        });

        //select on radio button when datetime input has focus
        $('#enddate').on('focus', function() {
            console.log('sdfsdf')

            $("#runtimeScheduled").prop("checked", true)

        });


        $('#scheduleLegend').simplecolorpicker({
            theme: 'fontawesome'
        });

        $(function() {
            $('#scheduleEndDate').datetimepicker({
                language: 'pt-BR'
            });
        });

        $(function() {
            $('#datetimepicker1').datetimepicker({
                language: 'pt-BR'
            });
        });

    }

});

/*
 * END Planned Maintenance MODULE
 */





/*
 * Module: User Management
 * Location: View - > add.ctp
 * Function: Create a user
 */

$(document).ready(function() {

    //Dynamic field for skills

    //Add Skill


    $('#UserSkillsTable').on('click', '#addSkill', function() {

        row = $("<tr></tr>");
        col1 = $("<td><select id=\"SkillCode\"></select> <button class=\"btn btn-default btn-sm \" id=\"saveSkill\">Save</button></td>");
        col2 = $("<td><button class=\"btn btn-danger btn-sm pull-right\" id=\"cancelSkill\"><i class=\"fa fa-minus\"></i></button></td>");

        row.append(col1, col2).prependTo("#UserSkillsTable");


        var $select = $('#SkillCode');
        $.getJSON('/skills/getskills.json', function(data) {

            $select.html('');

            $.each(data, function(key, val) {
                $select.append('<option id="' + val.id + '">' + val.code + '</option>');
            })
        });

    });


    //Cancel Skill
    $('table').on('click', 'tr #cancelSkill', function(e) {
        e.preventDefault();
        $(this).closest('tr').remove();
    });


    /*
     * Module: User Management
     * Location: View - > changepassword.ctp
     * Function: Change a user password
     */



    //Plugin to allow you to select multiple elements via the eq feature;
    //Source: http://stackoverflow.com/questions/16213158/use-jquery-to-select-multiple-elements-with-eq
    $.fn.eqAnyOf = function(arrayOfIndexes) {
        return this.filter(function(i) {
            return $.inArray(i, arrayOfIndexes) > -1;
        });
    };



    $(document).ready(function() {
        $(window).resize(function() {

            ellipses1 = $("#bc1 :nth-child(2)")
            if ($("#bc1 a:hidden").length > 0) {
                ellipses1.show()
            } else {
                ellipses1.hide()
            }

            ellipses2 = $("#bc2 :nth-child(2)")
            if ($("#bc2 a:hidden").length > 0) {
                ellipses2.show()
            } else {
                ellipses2.hide()
            }

        })

    });


    /*
     * Module: Work Order Management
     * Location: View - > changepassword.ctp
     * Function: Change a user password
     */


/* Job Edit / View Tool bar */

//Cancel Button
    $('#cancelJob').click(function() {
        history.go(-1);
    } );



// $("form").on('submit', function () {
//     var $valid = $(".jobAttributes").valid();
//     console.log($valid)
//     if (!$valid) {
//         $JobAddFormValidator.focusInvalid();
//         return false;
//     } else {

//         return true;
//             // $('.jobAttributes').submit();
//     }
// });


//Save Button
$('#saveJob').click(function() {

    var currentStatus = $('#JobStatustypeId').val();

        var $valid = $(".jobAttributes").valid();
    console.log($valid)
    if (!$valid) {
        $JobAddFormValidator.focusInvalid();
        return false;
    } else {

        if($(this).hasClass('actionComplete')){
            $('#JobStatustypeId').val('3');
        }else{
            $('#JobStatustypeId').val(currentStatus);
        }
        $(".jobAttributes").submit();
        return true;
            // $('.jobAttributes').submit();
    }
 
});

$(document).on( 'shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
   var activeTab = e.target.id;

   if(activeTab == 'completeTab'){
    $('#saveJob').html('Complete').addClass('btn-danger actionComplete');
   }else{
    $('#saveJob').html('Save').removeClass('btn-danger actionComplete');
   }
})





    //Get Assets
    $("#JobAssetId").select2({
        minimumInputLength: 2,
        ajax: {
            url: '/codes/getAssets.json',
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function(term) {
                return {
                    q: term
                };

            },
            success: function(data) {
                console.log('sdfsfsdf')

            },
            results: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.code,
                            slug: item.code,
                            id: item.id
                        }
                    })
                };
            }

        }

    });

        $("#JobAssetId").on("select2-selecting", function(e) { 



setTimeout(function(){
          var asset_id = $('#JobAssetId').val();
      
                                $.ajax({
                                    type: "GET",
                                    url: "/codes/getParents.json",
                                    data: {
                                        asset_id: asset_id
                                    },
                                    success: function(data) {

                                        console.log(data[0].title)

                                    }
                                })
}, 1000);




    });


    //Date time attribute 
    $('.form_datetime').datetimepicker({
        format: 'yyyy-mm-dd hh:mm:ss',
        weekStart: 1,
        todayBtn: 1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });

    $('.form_datetime').datetimepicker('update', new Date());



    /**
     * Checks to see if a job is already created and opens a modal if it is
     * @param {Number} a
     * @param {Number} b
     * @return {Number} sum
     */
    function checkForDuplicates(qs, id) {
        var room_id = $('#JobRoomId').val();
        $.getJSON('/jobs/checkForDuplicates.json?node=' + id + '&qs=' + qs + '&room_id=' + room_id,
            function(data) {
                if (data.length != 0) {
                    bootbox.dialog({
                        message: "A job has already been logged against this location for this type of job. Do you still want to raise a job?",
                        title: "Possible Duplicate!",
                        buttons: {
                            danger: {
                                label: "Yes",
                                className: "btn-danger",
                                callback: function() {}
                            },
                            success: {
                                label: "No",
                                className: "btn-success",
                                callback: function() {
                                    window.location.href = "/";
                                }
                            }
                        }
                    });
                }
            }
        );
    }

    function QSdependantList(name, level, source, div) {
        var currentLevel = level;
        var nextLevel = level + 1;
        var feature = div;
        var $select = $(feature + ' select:eq(' + level + ')');

        var selectName = $(this).attr('name');
        var selected = level - 1;
        //What level are we updating data for?
        console.log('Level: ' + level)

        switch (level) {
            case 1:
                var $selectItems = $(feature + ' select').eqAnyOf([1, 2, 3, 4]); //Make sure there is a space in front of select
                break;
            case 2:
                var $selectItems = $(feature + ' select').eqAnyOf([2, 3, 4]); //Make sure there is a space in front of select
                break;
            case 3:
                var $selectItems = $(feature + ' select').eqAnyOf([3, 4]); //Make sure there is a space in front of select
                break;
            case 4:
                var $selectItems = $(feature + ' select').eqAnyOf([4]); //Make sure there is a space in front of select
                break;
        }


        $(name + 'ID').val($(feature + ' select:eq(' + selected + ')').children(":selected").attr("id"));

        //Get the ID of the select Node
        var node = $(feature + ' select:eq(' + selected + ')').val();

        //Empty and disable child nodes
        $selectItems.select2('data', null)

        $selectItems.val("");
        $.getJSON(source + '?key=' + node, function(data) {
            if (data.length != 0) {
              //  $select.empty().append('<option>--</option>');
                $select.prop('disabled', false);
                $.each(data, function(key, val) {
                    $select.append('<option value="' + val.key + '"id="' + val.key + '">' + val.title + '</option>');
                })
            } else {
                checkForDuplicates(selectName, node);
            }
        })
    }

    $(function() {
        if ($('#section').is('.createJob')) {

            //Activate Location JSON calls
            populateLocations();

            /*
             ** Dependant drop downs
             */

            $('#JobQs2').prop('disabled', true);
            $('#JobQs3').prop('disabled', true);
            $('#JobQs4').prop('disabled', true);
            $('#JobQs5').prop('disabled', true);

            var $select = $('#JobQs1');
            //first level
            $.getJSON('/questions/buildQuestion.json?root=1', function(data) {
                $.each(data, function(key, val) {
                    $select.append('<option value="' + val.key + '"id="' + val.key + '">' + val.title + '</option>');
                })
            });
            //QS1 Start
            $("#JobQs1").change(function() {
                var source = '/questions/buildQuestion.json';
                var div = '#helpwith';
                QSdependantList('#JobQs1', 1, source, div);
            })
            $("#JobQs2").change(function() {
                var source = '/questions/buildQuestion.json';
                var div = '#helpwith';
                QSdependantList('#JobQs2', 2, source, div);
            })
            $("#JobQs3").change(function() {
                var source = '/questions/buildQuestion.json';
                var div = '#helpwith';
                QSdependantList('#JobQs3', 3, source, div);
            })
            $("#JobQs4").change(function() {
                var source = '/questions/buildQuestion.json';
                var div = '#helpwith';
                QSdependantList('#JobQs1', 4, source, div);
            })

        }
    })



    /* 
     *
     * Module: Location Management
     *
     */

    $(document).ready(function() {


        //Determine the type of location based on where it sits in the tree
        function determineLocationType(type) {
            console.log(type)
            switch (type) {
                case 1:
                    locationType = 1
                    locationTypeName = null;
                    break;
                case 2:
                    locationType = 2
                    locationTypeName = 'Site';
                    break;
                case 3:
                    locationType = 3
                    locationTypeName = 'Building';
                    break;
                case 4:
                    locationType = 4
                    locationTypeName = 'Floor';
                    break;
                case 5:
                    locationType = 5
                    locationTypeName = 'Room';
                    break;
            }

            return locationType;
            return locationTypeName;

        }

        function addLocationNode(nodeName, data) {

            var tree = $("#locationTree").fancytree("getTree"),
                activeNode = tree.getActiveNode();
            tree.getNodeByKey(tree.activeNode.key).setExpanded().done(function() {
                    activeNode.addChildren({
                        title: nodeName,
                        key: data
                    })



                }),

                tree.getNodeByKey(data).setActive(true);
        }

        //hide elemements in the form as it changes depending on the tree level
        function hideLocationElements() {

            $("#CodeIndexForm label").hide();
            $("#CodeIndexForm input").hide();
            $("#CodeIndexForm textarea").hide();
            $("#CodeIndexForm select").hide();
        }

        tree = $("#locationTree").fancytree({

            selectMode: 1,

            init: function(event, data) {
                hideLocationElements();
            },

            activate: function(event, data) {

                hideLocationElements();

                // A node was activated: display its title:
                var node = data.node;
                currentNodeLevel = node.getLevel();

                $('#saveQuestion').prop('disabled', false);
                $('#saveQuestion').html('Save');


                //Show relevents attributes based on the node type (Site, Building, Floor, Room etc) selected. 
                switch (currentNodeLevel) {
                    case 1:
                        console.log('do nothing');
                        break;
                    case 2:
                        $('.site').each(function() {
                            $('#' + this.id).toggle();
                            $("#CodeIndexForm label[for='" + this.id + "']").toggle();
                        });
                        break;
                    case 3:
                        $('.building').each(function() {
                            $('#' + this.id).toggle();
                            $("#CodeIndexForm label[for='" + this.id + "']").toggle();
                        });
                        break;
                    case 4:
                        $('.floor').each(function() {
                            $('#' + this.id).toggle();
                            $("#CodeIndexForm label[for='" + this.id + "']").toggle();
                        });
                        break;
                    case 5:
                        $('.room').each(function() {
                            $('#' + this.id).toggle();
                            $("#CodeIndexForm label[for='" + this.id + "']").toggle();
                        });
                        break;
                }

                //Determine what type of location is selected in the tree
                determineLocationType(currentNodeLevel);

                //Update the view pane with the location types name.
                $('#locationHeader').html(locationTypeName);

                $.getJSON('/codes/view/' + node.key + '.json', function(data) {

                    $('#saveLocation').prop('disabled', false);
                    $('#CodeIndexForm').loadJSON(data);
                })

                .fail(function() {
                    console.log("error");
                })

                //Disable the toolbar when the end user attemps to create a child node on a room node.
                if (node.getLevel() >= 5) {
                    $('#addLocation').prop('disabled', true);
                    $('#editLocation').prop('disabled', false);
                    $('#deleteLocation').prop('disabled', false);
                } else {
                    $('#addLocation').prop('disabled', false);
                    $('#editLocation').prop('disabled', false);
                    $('#deleteLocation').prop('disabled', false);
                }
            },
            deactivate: function(event, data) {

                $('#addQuestion').prop('disabled', true);
                $('#editQuestion').prop('disabled', true);
                $('#deleteQuestion').prop('disabled', true);
            },
            extensions: ["glyph", "edit"],

            selectMode: 2,
            glyph: {
                map: {
                    doc: "glyphicon glyphicon-file",
                    docOpen: "glyphicon glyphicon-file",
                    checkbox: "glyphicon glyphicon-unchecked",
                    checkboxSelected: "glyphicon glyphicon-check",
                    checkboxUnknown: "glyphicon glyphicon-share",
                    error: "glyphicon glyphicon-warning-sign",
                    expanderClosed: "glyphicon glyphicon-plus-sign",
                    expanderLazy: "glyphicon glyphicon-plus-sign",
                    // expanderLazy: "glyphicon glyphicon-expand",
                    expanderOpen: "glyphicon glyphicon-minus-sign",
                    // expanderOpen: "glyphicon glyphicon-collapse-down",
                    folder: "glyphicon glyphicon-folder-close",
                    folderOpen: "glyphicon glyphicon-folder-open",
                    loading: "glyphicon glyphicon-refresh"
                        // loading: "icon-spinner icon-spin"
                }
            },
            source: {
                url: "/codes/buildLocations.json?key=0",
                cache: false
            },
            lazyLoad: function(event, data) {
                var node = data.node;
                // Issue an ajax request to load child nodes
                data.result = {

                    url: "/codes/buildLocations.json",
                    data: {
                        key: node.key
                    }
                }
            }
        });

        //Delete a node from the tree
        $('#deleteLocation').click(function() {
            bootbox.confirm("Are you sure you want to delete this location", function(result) {


                if (result) {
                    var node = $("#locationTree").fancytree("getActiveNode");
                    node.remove();

                    $.ajax({
                        type: "GET",
                        url: "/codes/deleteCode.json",
                        data: {
                            key: node.key
                        }
                    })
                }

            });




        });

        //Disable action buttons until required;
        $('#addLocation').prop('disabled', true);
        $('#editLocation').prop('disabled', true);
        $('#deleteLocation').prop('disabled', true);
        $('#saveLocation').prop('disabled', true);
        //$('#deleteQuestion').prop('disabled', true);

        //Add a Node to the Tree
        $('#addLocation').click(function() {
            var tree = $("#locationTree").fancytree("getTree"),
                activeNode = tree.getActiveNode();

            var node = $("#locationTree").fancytree("getActiveNode");

            console.log(currentNodeLevel)

            bootbox.dialog({
                title: "Create a Node",
                message: '<div class="row">  ' +
                    '<div class="col-md-12"> ' +
                    '<form class="form-horizontal"> ' +
                    '<div class="form-group" id="locationAtt"> ' +
                    '<label class="col-md-4 control-label" for="locationName">Name *</label> ' +
                    '<div class="col-md-6"> ' +
                    '<input id="locationName" name=locationName" type="text" class="form-control input-md"> ' +
                    '<span class="help-block">Please supply a node name</span> </div> ' +
                    '</div> ' +
                    '</form> </div>  </div>',
                buttons: {
                    success: {
                        label: "Save",
                        className: "btn-success",
                        callback: function() {
                            var locationName = $('#locationName').val();

                            determineLocationType(currentNodeLevel);



                            if (!locationName) {
                                $('#locationAtt').attr('class', 'has-error');
                                return false;
                            }
                            $.ajax({
                                type: "GET",
                                url: "/codes/saveCode/",
                                data: {
                                    code: locationName,
                                    parent_id: tree.activeNode.key,
                                    locationType: locationType,
                                    count: 0
                                },
                                success: function(data) {

                                    addLocationNode(locationName, data);

                                }
                            })
                        }
                    }
                }
            })
        })


        //Enable save button if any values in the form are changed.
        $("#CodeIndexForm").bind("change paste keyup", function() {
            $('#saveLocation').html('Save');
            $('#saveLocation').prop('disabled', false);
        });


        //Save question via JSON request
        $('#saveLocation').click(function() {

            var node = $("#locationTree").fancytree("getActiveNode");
            var newNodeValue = $("#CodeCode").val();
            node.setTitle(newNodeValue);

            data = $("#CodeIndexForm").serialize();

            $.ajax({
                type: "POST",
                url: "/codes/updateCode.json",
                data: data
            })
            $('#saveLocation').prop('disabled', true);
            $(this).html('<i class="fa fa-check"></i> Saved!');

            $.growl("Saved!", {
                type: "success",

                placement: {
                    from: "bottom",
                    align: "right"
                }
            });

        })

        //Get the value from the input and update the Tree node

        $(this).prop('disabled', true);


    });


    /*
     ** Dependant drop downs
     */
    function populateLocations() {
        console.log('populateLocations() Activated');

        var t0 = '#' + $('#chooseLocation select').eq('0').attr('id'); //Site
        var t1 = '#' + $('#chooseLocation select').eq('1').attr('id'); //Building
        var t2 = '#' + $('#chooseLocation select').eq('2').attr('id'); //Floor
        var t3 = '#' + $('#chooseLocation select').eq('3').attr('id'); //Room

        console.log($(t1).has('option').length)

        jsonURL = '/codes/populateLocations.json';
        container = '#chooseLocation';
        if ($(t1).has('option').length === 0) {
            console.log('disable buildings, floors, rooms')
            $(t1).prop('disabled', true);
            $(t2).prop('disabled', true);
            $(t3).prop('disabled', true);
        }
        var $selectSite = $(t0);
        console.log($selectSite);
        if ($selectSite.has('option').length <= 1) {

            //first level
            $.getJSON(jsonURL, function(data) {
                console.log('Site SELECT empty');
                $.each(data, function(key, val) {
                    $selectSite.append('<option value="' + val.key + '"id="' + val.key + '">' + val.title + '</option>');
                })
            });
        } else {
            console.log('Site SELECT has values');
        }

        //QS1 Start
        $(t0).change(function() {
            console.log('changed 0')
            QSdependantList(t0, 1, jsonURL, container);
        })
        $(t1).change(function() {
            console.log('changed 1')
            QSdependantList(t1, 2, jsonURL, container);
        })
        $(t2).change(function() {
            console.log('changed 2')
            QSdependantList(t2, 3, jsonURL, container);
        })
        $(t3).change(function() {
            console.log('changed 3')
            QSdependantList(t3, 4, jsonURL, container);
        })

    }



    /*
     *
     *
     * ASSET MANAGEMENT
     *
     *
     */



    $(function() {
        if ($('#page-wrapper').is('.assetCreate')) {

            populateLocations();

        }

    });

    //Edit Asset
    $(".btnViewMode").click(function() {

        $(this).toggleClass("btn-success");

        if ($(this).is(".btn-success")) {

            $(".btnCanMode").toggle();
            $(".btnDecomission").toggle();
            //$("#CodeAssetviewForm *").prop("disabled", false).not('#CodeCode');

            $(this).prop('type', 'submit');
            $(this).html('Save');
        } else {
            //  $("#CodeAssetviewForm *").prop("disabled", true);
            $(".btnCanMode").toggle();
            $(".btnDecomission").toggle();
            $("#CodeAssetviewForm").submit();

            $(this).html('Saving!');
        }

    });



    //Cancel Changes Asset
    $(".btnCanMode").click(function() {
        location.reload(true); //true force page to reload and not use cache
    });

    //Delete Attachment Confirmation
    $(".btnDelAttach").click(function() {

        var node = this.id;

        bootbox.confirm("Are you sure you want to delete this attachment?", function(result) {

            $("#asset_" + node).fadeOut("slow");
            $.ajax({
                type: "GET",
                url: "/attachments/delete/",
                data: {
                    node: node
                }
            })
        })


    });


/**
*
* Upoad Component
*
**/


    $(function() {

        var ul = $('#upload ul');

        $('#drop a').click(function() {
            // Simulate a click on the file input button
            // to show the file browser dialog
            $(this).parent().find('input').click();
        });

        // Initialize the jQuery File Upload plugin
        $('#upload').fileupload({

            formData: {
                foreign_key: $('#CodeId').val()

            },

            // This element will accept file drag/drop uploading
            dropZone: $('#drop'),

            // This function is called when a file is added to the queue;
            // either via the browse button, or via drag/drop:
            add: function(e, data) {




                var tpl = $('<li class="list-group-item"><input type="text" value="0" data-width="48" data-height="48"' +
                    ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

                // Append the file name and file size
                tpl.find('p').text(data.files[0].name)
                    .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

                // Add the HTML to the UL element
                data.context = tpl.appendTo(ul);

                // Initialize the knob plugin
                tpl.find('input').knob();

                // Listen for clicks on the cancel icon
                tpl.find('span').click(function() {

                    if (tpl.hasClass('working')) {
                        jqXHR.abort();
                    }

                    tpl.fadeOut(function() {
                        tpl.remove();
                    });

                });

                // Automatically upload the file once it is added to the queue
                var jqXHR = data.submit();
            },

            progress: function(e, data) {

                // Calculate the completion percentage of the upload
                var progress = parseInt(data.loaded / data.total * 100, 10);

                // Update the hidden input field and trigger a change
                // so that the jQuery knob plugin knows to update the dial
                data.context.find('input').val(progress).change();

                if (progress == 100) {
                    data.context.removeClass('working');
                }
            },

            fail: function(e, data) {
                // Something has gone wrong!
                data.context.addClass('error');
            }

        });


        // Prevent the default action when a file is dropped on the window
        $(document).on('drop dragover', function(e) {
            e.preventDefault();
        });

        // Helper function that formats the file sizes
        function formatFileSize(bytes) {
            if (typeof bytes !== 'number') {
                return '';
            }

            if (bytes >= 1000000000) {
                return (bytes / 1000000000).toFixed(2) + ' GB';
            }

            if (bytes >= 1000000) {
                return (bytes / 1000000).toFixed(2) + ' MB';
            }

            return (bytes / 1000).toFixed(2) + ' KB';
        }

    });

    /*
     *
     * Decision Tree
     *
     */



    $(document).ready(function() {


   





        $('#JobtemplateElements').hide();


        tree = $("#questions").fancytree({

            activate: function(event, data) {

                // A node was activated: display its title:
                var node = data.node;
                console.log(node.data.count);
                $('#saveQuestion').prop('disabled', false);
                $('#saveQuestion').html('Save');

                if(node.data.count===0){
                    $('#JobtemplateElements').show();
                }else{
                    $('#JobtemplateElements').hide();
                }



                $.getJSON('/questions/view/' + node.key + '.json', function(data) {
                    $('#saveQuestion').prop('disabled', false);
                    $('#QuestionIndexForm').loadJSON(data);



                })

                .fail(function() {
                    console.log("error");
                })

                if (node.getLevel() >= 6) {
                    $('#addQuestion').prop('disabled', true);
                    $('#editQuestion').prop('disabled', false);
                    $('#deleteQuestion').prop('disabled', false);
                } else {
                    $('#addQuestion').prop('disabled', false);
                    $('#editQuestion').prop('disabled', false);
                    $('#deleteQuestion').prop('disabled', false);
                }
            },
            deactivate: function(event, data) {

                $('#addQuestion').prop('disabled', true);
                $('#editQuestion').prop('disabled', true);
                $('#deleteQuestion').prop('disabled', true);
            },
            clickFolderMode: 3,
            selectMode: 3,
            autoActivate: true,
            extensions: ["glyph", "edit"],


            glyph: {
                map: {
                    doc: "glyphicon glyphicon-file",
                    docOpen: "glyphicon glyphicon-file",
                    checkbox: "glyphicon glyphicon-unchecked",
                    checkboxSelected: "glyphicon glyphicon-check",
                    checkboxUnknown: "glyphicon glyphicon-share",
                    error: "glyphicon glyphicon-warning-sign",
                    expanderClosed: "glyphicon glyphicon-plus-sign",

                    expanderLazy: "glyphicon glyphicon-plus-sign",
                    // expanderLazy: "glyphicon glyphicon-expand",
                    expanderOpen: "glyphicon glyphicon-minus-sign",
                    // expanderOpen: "glyphicon glyphicon-collapse-down",
                    folder: "glyphicon glyphicon-folder-close",
                    folderOpen: "glyphicon glyphicon-folder-open",
                   // loading: "glyphicon glyphicon-refresh"
                     loading: "icon-spinner icon-spin"
                }
            },
            source: {
                url: "/questions/buildquestion.json?root=1",
                cache: true
            },
            lazyLoad: function(event, data) {
                var node = data.node;
                // Issue an ajax request to load child nodes
                data.result = {

                    url: "/questions/buildquestion.json",
                    data: {
                        key: node.key
                    }
                }
            }
        });

        //addQuestionNode() will add a node to the tree from the modal window
        function addQuestionNode(nodeName, data) {

            var tree = $("#questions").fancytree("getTree"),
                activeNode = tree.getActiveNode(); 
                

            tree.getNodeByKey(tree.activeNode.key).setExpanded().done(function() {
                activeNode.addChildren({
                    title: nodeName,
                    key: data,
                    count: 0
                });

                activeNode.fromDict ({count: 1}); // Update the node count to be > than 0 so a job template can't be assigned.
                tree.getNodeByKey(data).setActive(true); //Active newly created child.

            })
        }

        //Delete a node from the tree
        $('#deleteQuestion').click(function() {
            bootbox.confirm("Are you sure you want to delete this node", function(result) {


                if (result) {
                    var node = $("#questions").fancytree("getActiveNode");
                    node.remove();

                    $.ajax({
                        type: "GET",
                        url: "/questions/deleteCode",
                        data: {
                            key: node.key
                        }
                    })
                }

            });




        });

        //Disable action buttons until required;
        $('#addQuestion').prop('disabled', true);
        $('#editQuestion').prop('disabled', true);
        $('#deleteQuestion').prop('disabled', true);
        $('#saveQuestion').prop('disabled', true);
        //$('#deleteQuestion').prop('disabled', true);




        //Add a Node to the Tree
        $('#addQuestion').click(function() {

            var tree = $("#questions").fancytree("getTree"),
                activeNode = tree.getActiveNode();

            var node = $("#questions").fancytree("getActiveNode");

            bootbox.dialog({
                title: "Create a Node",
                message: '<div class="row">  ' +
                    '<div class="col-md-12"> ' +
                    '<form class="form-horizontal"> ' +
                    '<div class="form-group" id="locationAtt"> ' +
                    '<label class="col-md-4 control-label" for="questionName">Name *</label> ' +
                    '<div class="col-md-6"> ' +
                    '<input id="questionName" name=questionName" autofocus="autofocus" type="text" class="form-control input-md"> ' +
                    '<span class="help-block">Please supply a node name</span> </div> ' +
                    '</div> ' +
                    '</form> </div>  </div>',
                buttons: {
                    success: {
                        label: "Save",
                        className: "btn-success",
                        callback: function() {
                            var questionName = $('#questionName').val();

                            if (!questionName) {
                                $('#locationAtt').attr('class', 'has-error');
                                return false;
                            }
                            $.ajax({
                                type: "GET",
                                url: "/questions/saveCode/",
                                data: {
                                    code: questionName,
                                    id: tree.activeNode.key
                                },
                                success: function(data) {
                                    addQuestionNode(questionName, data);

                                }
                            })
                        }
                    }
                }
            })
        })


        //Enable save button if any values in the form are changed.
        $("#QuestionIndexForm").bind("change paste keyup", function() {
            $('#saveQuestion').html('Save');
            $('#saveQuestion').prop('disabled', false);
        });


        //Save question via JSON request
        $('#saveQuestion').click(function() {

            var node = $("#questions").fancytree("getActiveNode");
            var newNodeValue = $("#QuestionCode").val();
            node.setTitle(newNodeValue);

            data = $("#QuestionIndexForm").serialize();

            $.ajax({
                type: "POST",
                url: "/questions/updateCode.json",
                data: data
            })
            $('#saveQuestion').prop('disabled', true);
            $(this).html('<i class="fa fa-check"></i> Saved!');

            $.growl("Saved!", {
                type: "success",

                placement: {
                    from: "bottom",
                    align: "right"
                }
            });

        })

        $(this).prop('disabled', true);


    });


        $("#JobSiteId").select2({allowClear: true});
        $("#JobBuildingId").select2({allowClear: true});
        $("#JobFloorId").select2({allowClear: true});
        $("#JobRoomId").select2({allowClear: true});

        $("#JobQs1").select2();
        $("#JobQs2").select2();
        $("#JobQs3").select2();
        $("#JobQs4").select2();
        $("#JobQs5").select2();


 




});
