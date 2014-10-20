/**
* Spright. (http://spright.com.au)
*
* Licensed under The MIT License
* Redistributions of files must retain the above copyright notice.
*
* @link http://spright.com.au
* @since Spright. 0.2
* @license http://www.opensource.org/licenses/mit-license.php MIT License
*/

/*
* Module: User Management
* Location: View - > add.ctp
* Function: Create a user
*/

$(document).ready(function() {



  $('#UserAddForm').bootstrapValidator({
    feedbackIcons: {
      valid: 'glyphicon glyphicon-ok',
      invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      'data[User][username]': {
        validators: {
          notEmpty: {
            message: 'Please supply a username'
          }
        }
      },
      'data[User][password]': {
        validators: {
          notEmpty: {
            message: 'Please supply a password'
          }
        }
      },
      'data[User][group_id]': {
        validators: {
          notEmpty: {
            message: 'Please select a user role'
          }
        }
      }
    }
  });

});


/*
* Module: User Management
* Location: View - > changepassword.ctp
* Function: Change a user password
*/

$(document).ready(function() {

  $('#UserPasswordForm').bootstrapValidator({
    feedbackIcons: {
      valid: 'glyphicon glyphicon-ok',
      invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      'data[User][password1]': {
        validators: {
          identical: {
            field: 'data[User][password2]',
            message: 'Your new passwords must match'
          },
          notEmpty: {
            message: 'Please enter a new password'
          }
        }
      },
      'data[User][password2]': {
        validators: {
          identical: {
            field: 'data[User][password1]',
            message: 'Your new passwords must match'
          },
          notEmpty: {
            message: 'Please enter a new password'
          }
        }
      },
            'data[User][current]': {
        validators: {
          notEmpty: {
            message: 'Please enter your current password'
          }
        }
      }
    }
  });
});

//Plugin to allow you to select multiple elements via the eq feature;
//Source: http://stackoverflow.com/questions/16213158/use-jquery-to-select-multiple-elements-with-eq
$.fn.eqAnyOf = function (arrayOfIndexes) {
  return this.filter(function(i) {
    return $.inArray(i, arrayOfIndexes) > -1;
  });
};



$(document).ready(function(){
  $(window).resize(function() {

    ellipses1 = $("#bc1 :nth-child(2)")
    if ($("#bc1 a:hidden").length >0) {ellipses1.show()} else {ellipses1.hide()}

      ellipses2 = $("#bc2 :nth-child(2)")
    if ($("#bc2 a:hidden").length >0) {ellipses2.show()} else {ellipses2.hide()}

  })

}); 

jq
/*
* Module: Work Order Management
* Location: View - > changepassword.ctp
* Function: Change a user password
*/

//The room input should  be disabled until a building is elect
$("#JobRoomId").prop('disabled', true);

//Get Assets
      $("#JobAssetId").select2({
            minimumInputLength: 2,
            ajax: {
                url: '/codes/getAssets.json',
                dataType: 'json',
                type: "GET",
                quietMillis: 50,
                data: function (term) {
                    return {
                        q: term
                    };
                },
                results: function (data) {
                    return {
                        results: $.map(data, function (item) {
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


    });

//Date time attribute 
$('.form_datetime').datetimepicker({
        format: 'yyyy-mm-dd hh:mm:ss',
        weekStart: 1,
        todayBtn:  1,
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
function checkForDuplicates(qs,id){
  var room_id = $('#JobRoomId').val();
  $.getJSON('/jobs/checkForDuplicates.json?node='+id+'&qs='+qs+'&room_id='+room_id,
    function(data) {
      if(data.length != 0){
        bootbox.dialog({
          message: "A job has already been logged against this location for this type of job. Do you still want to raise a job?",
          title: "Possible Duplicate!",
          buttons: {
            danger: {
              label: "Yes",
              className: "btn-danger",
              callback: function() {
              }
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
function QSdependantList(name,level,source,div){
  var currentLevel = level;
  var nextLevel = level + 1;
  var feature = div;
  var $select = $(feature+' select:eq('+level+')');

  var selectName = $(this).attr('name');
  var selected = level - 1;
  //What level are we updating data for?
console.log('Level: ' + level)

  switch(level) {
    case 1:
    var $selectItems = $(feature + ' select').eqAnyOf([1, 2, 3,4]); //Make sure there is a space in front of select
    break;
    case 2:
    var $selectItems = $(feature + ' select').eqAnyOf([2, 3,4]); //Make sure there is a space in front of select
    break;
    case 3:
    var $selectItems = $(feature + ' select').eqAnyOf([3,4]); //Make sure there is a space in front of select
    break;
    case 4:
    var $selectItems = $(feature + ' select').eqAnyOf([4]); //Make sure there is a space in front of select
    break;
  }


  $(name+'ID').val($(feature+' select:eq('+selected+')').children(":selected").attr("id"));

  //Get the ID of the select Node
  var node = $(feature+' select:eq('+selected+')').val();

  //Empty and disable child nodes
  $selectItems.select2('data', null)

  $selectItems.val("");
  $.getJSON(source+'?key='+node, function(data){
    if(data.length != 0){
      $select.empty().append('<option>--</option>');
      $select.prop('disabled', false);
      $.each(data, function(key, val){
        $select.append('<option value="'+val.key+'"id="' +val.key + '">' + val.title + '</option>');
      })
    }else{
      checkForDuplicates(selectName,node);
    }
  }
  )
}

$(function(){
  if($('#page-wrapper').is('.createJob')){

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
$.getJSON('/questions/buildQuestion.json?root=1', function(data){
  $.each(data, function(key, val){
    $select.append('<option value="'+val.key+'"id="' +val.key + '">' + val.title + '</option>');
  })
});
//QS1 Start
$("#JobQs1").change(function() {
  var source = '/questions/buildQuestion.json';
  var div = '#helpwith';
  QSdependantList('#JobQs1',1,source,div);
})
$("#JobQs2").change(function() {
  var source = '/questions/buildQuestion.json';
  var div = '#helpwith';
  QSdependantList('#JobQs2',2,source,div);
})
$("#JobQs3").change(function() {
  var source = '/questions/buildQuestion.json';
  var div = '#helpwith';
  QSdependantList('#JobQs3',3,source,div);
})
$("#JobQs4").change(function() {
  var source = '/questions/buildQuestion.json';
  var div = '#helpwith';
  QSdependantList('#JobQs1',4,source,div);
})

}
})



/* 
 *
 * LOCATION MANAGEMANT 
 *
 */

//Disable the add,edit, delete buttons until it is selected in the bind event below
function disableLocButtons(){
  $("#locationAdd").prop('disabled', true);
  $("#locationEdit").prop('disabled', true);
  $("#locationDelete").prop('disabled', true);
}

function enableLocButtons(){
  $("#locationAdd").prop('disabled', false);
  $("#locationEdit").prop('disabled', false);
  $("#locationDelete").prop('disabled', false);
}

function getLocationData(node,level){

 $('#LocationForm').trigger("reset");

 $.getJSON('/codes/viewLocations/'+node+'.json', 


  function(data) {


    switch(level) {
      case 2:
      locationType = 'Site';
      $(".building,.floor,.room").hide();
      $(".site").show();
      break;
      case 3:
      locationType = 'Building';
      $(".site,.floor,.room").hide();
      $(".building").show();
      break;
      case 4:
      locationType = 'Floor';
      break;  
      case 5:
      locationType = 'Room';
      break;
    }
    
    $('#SiteDescription').val(data[0].description);
    $('#SiteAddress').val(data[0].address);
    
  });
}

disableLocButtons();

$(function() {
$.getJSON(
    '/questions/buildquestion.json',
    function(data) {
        $('#tree1').tree({
            data: data
        });
    }
);
});

$('#tree2').tree({
  dragAndDrop: false,
  closedIcon: $('<i class="fa fa-arrow-circle-right"></i>'),
  openedIcon: $('<i class="fa fa-arrow-circle-down"></i>')
});


//hide all attributes at first
$(".site,.building").hide();

$('#tree2').bind(
  'tree.select',
  function(event) {
    if (event.node) {
            // node was selected

            enableLocButtons();

            
            var treeName = $('#tree2');
            var node = treeName.tree('getSelectedNode');
            var nodeLevel = $('#tree2').tree('getNodeById',node.id);
            var level = nodeLevel.getLevel();

            getLocationData(node.id,level);

          }
          else {
            disableLocButtons();
            // event.node is null
            // a node was deselected
            // e.previous_node contains the deselected node
          }
        }
        );

$( "#locationEdit" ).click(function() {
  var treeName = $('#tree2');
  var selected = treeName.tree('getSelectedNode');
});


$( "#locationDelete" ).click(function() {


  bootbox.confirm("Are you sure you want to delete this location?", function(result) {


   if(result){
    var treeName = $('#tree2');
    var node = treeName.tree('getSelectedNode');

    treeName.tree('removeNode', node);

    $.ajax({
      type: "GET",
      url: "/codes/deleteCode/",
      data: { node:node.id}
    })   


  }
  
}); 

});


$( "#locationAdd" ).click(function() {

  var treeName = $('#tree2');
  var node = treeName.tree('getSelectedNode');
  
  var nodeLevel = $('#tree2').tree('getNodeById',node.id);
  var level = nodeLevel.getLevel();
  
  switch(level) {
    case 1:
    locationType = 'Site';
    break;
    case 2:
    locationType = 'Building';
    break;
    case 3:
    locationType = 'Floor';
    break;  
    case 4:
    locationType = 'Room';
    break;
  }
  
  
  bootbox.dialog({
    title: "Create a " + locationType,
    message: '<div class="row">  ' +
    '<div class="col-md-12"> ' +
    '<form class="form-horizontal"> ' +
    '<div class="form-group" id="locationAtt"> ' +
    '<label class="col-md-4 control-label" for="location">Name *</label> ' +
    '<div class="col-md-6"> ' +
    '<input id="location" name=location" type="text" class="form-control input-md"> ' +
    '<span class="help-block">This must be unique</span> </div> ' +
    '</div> ' +
    '<div class="col-md-12"> ' +
    '<form class="form-horizontal"> ' +
    '<div class="form-group"> ' +
    '<label class="col-md-4 control-label" for="description">Description</label> ' +
    '<div class="col-md-6"> ' +
    '<textarea id="description" name=description" type="text" class="form-control input-md"> </textarea>' +
    '</div> ' +
    '</form> </div>  </div>',
    buttons: {
      success: {
        label: "Save",
        className: "btn-success",
        callback: function () {

          var location = $('#location').val();

          if (!location){ 
           $('#locationAtt').attr('class', 'has-error'); 
           return false; 
         }


         $.ajax({
           type: "GET",
           url: "/codes/saveCode/",
           data: { location: location, parent_id:node.id},
           success: function(data) {
            savedNowAppend(node.id,location,data);

          }
        })  
       }
     }
   }
 }
 );






});


function savedNowAppend(parent,name,id){

 var treeName = $('#tree2');
 var parent_node = treeName.tree('getNodeById', parent);
 treeName.tree('openNode', parent_node);
 treeName.tree(

  'appendNode',
  {
    label: name,
    id: id
  },
  parent_node

  );

 var new_node = treeName.tree('getNodeById', id);
 treeName.tree('addToSelection', new_node);

}

/*
** Dependant drop downs
*/
function populateLocations(){
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
if ($selectSite.has('option').length <=1) {

//first level
$.getJSON(jsonURL, function(data){
  console.log('Site SELECT empty');
  $.each(data, function(key, val){
    $selectSite.append('<option value="'+val.key+'"id="' +val.key + '">' + val.title + '</option>');
  })
});
}else{
  console.log('Site SELECT has values');
}

//QS1 Start
$(t0).change(function() {
  console.log('changed 0')
  QSdependantList(t0,1,jsonURL,container);
})
$(t1).change(function() {
  console.log('changed 1')
  QSdependantList(t1,2,jsonURL,container);
})
$(t2).change(function() {
  console.log('changed 2')
  QSdependantList(t2,3,jsonURL,container);
})
$(t3).change(function() {
  console.log('changed 3')
  QSdependantList(t3,4,jsonURL,container);
})

}



/*
*
*
* ASSET MANAGEMENT
*
*
*/



$(function(){
  if($('#page-wrapper').is('.assetCreate')){

    populateLocations();

  }

});

//Validation
$(document).ready(function() {
  $('.assetForm')
  .bootstrapValidator({
    excluded: [':disabled'],
    feedbackIcons: {
      valid: 'glyphicon glyphicon-ok',
      invalid: 'glyphicon glyphicon-remove',
      validating: 'glyphicon glyphicon-refresh'
    },
    fields: {
      'data[Code][code]': {
        message: 'Please supply a unique asset code',
        validators: {

          remote: {
            message: 'Asset code already in use',
            url: '/codes/validAsset.json',
            data: {
              type: 'code'
            }
          }
        }
      },
      'data[Code][status]': {
        validators: {
          notEmpty: {
            message: 'An asset must have a status'
          }
        }
      },
      city: {
        validators: {
          notEmpty: {
            message: 'The city is required'
          }
        }
      }
    }
  })
        // Called when a field is invalid
        .on('error.field.bv', function(e, data) {
            // data.element --> The field element

            var $tabPane = data.element.parents('.tab-pane'),
            tabId    = $tabPane.attr('id');

            $('a[href="#' + tabId + '"][data-toggle="tab"]')
            .parent()
            .find('i')
            .removeClass('fa-check')
            .addClass('fa-times');
          })
        // Called when a field is valid
        .on('success.field.bv', function(e, data) {
            // data.bv      --> The BootstrapValidator instance
            // data.element --> The field element

            var $tabPane = data.element.parents('.tab-pane'),
            tabId    = $tabPane.attr('id'),
            $icon    = $('a[href="#' + tabId + '"][data-toggle="tab"]')
            .parent()
            .find('i')
            .removeClass('fa-check fa-times');

            // Check if the submit button is clicked
            if (data.bv.getSubmitButton()) {
                // Check if all fields in tab are valid
                var isValidTab = data.bv.isValidContainer($tabPane);
                $icon.addClass(isValidTab ? 'fa-check' : 'fa-times');
              }
            });
      }); 


//Edit Asset
$( ".btnViewMode" ).click(function() {

  $(this).toggleClass( "btn-success" );

  if($(this).is(".btn-success")){

    $( ".btnCanMode" ).toggle();
    $( ".btnDecomission" ).toggle();
        //$("#CodeAssetviewForm *").prop("disabled", false).not('#CodeCode');

        $(this).prop('type', 'submit');
        $(this).html('Save');
      }else {
      //  $("#CodeAssetviewForm *").prop("disabled", true);
      $( ".btnCanMode" ).toggle();
      $( ".btnDecomission" ).toggle();
      $( "#CodeAssetviewForm" ).submit();

      $(this).html('Saving!');
    }

  });



//Cancel Changes Asset
$( ".btnCanMode" ).click(function() {
   location.reload(true); //true force page to reload and not use cache
 });

//Delete Attachment Confirmation
$( ".btnDelAttach" ).click(function() {

  var node = this.id;

  bootbox.confirm("Are you sure you want to delete this attachment?", function(result) {

    $( "#asset_"+node ).fadeOut( "slow" );
    $.ajax({
      type: "GET",
      url: "/attachments/delete/",
      data: { node: node}
    })   
  })


}); 


$(function(){



    
    /* Here we will store all data */
    var myArguments = {};   
    
    function assembleData(object,arguments)
    {       
        var data = $(object).sortable('toArray'); // Get array data 
        var step_id = $(object).attr("id"); // Get step_id and we will use it as property name



        var arrayLength = data.length; // no need to explain
        
        /* Create step_id property if it does not exist */
        if(!arguments.hasOwnProperty(step_id)) 
        { 
            arguments[step_id] = new Array();
        }   
        
        /* Loop through all items */
        for (var i = 0; i < arrayLength; i++) 
        {
            var image_id = data[i]; 
            /* push all image_id onto property step_id (which is an array) */
            arguments[step_id].push(image_id);          
        }
        return arguments;
    }   
   
    /* Sort images */ 

var rotation = 0;

jQuery.fn.rotate = function(degrees) {
    $(this).css({'-webkit-transform' : 'rotate('+ degrees +'deg)',
                 '-moz-transform' : 'rotate('+ degrees +'deg)',
                 '-ms-transform' : 'rotate('+ degrees +'deg)',
                 'transform' : 'rotate('+ degrees +'deg)'});
};

    $('.step').sortable({

        connectWith: '.step',
  
        /* That's fired first */    
        start : function( event, ui ) {

                rotation += 5;
    ui.item.rotate(rotation);

        var text = $.trim(ui.item.text());
        ui.item.removeClass("image"); 
        ui.item.addClass("image2"); 
       ui.item.startHtml = ui.item.html();
       
       ui.item.html('<div style="width:30px;font-size:14px;display: inline-block;" class="rf-ind-drag default drag">DROP ME</div>');

            myArguments = {}; /* Reset the array*/  
        },      
            over : function(){
         $(this).addClass('valid');
     },
     out : function(){
          $(this).removeClass('valid');
     },
        /* That's fired second */
        remove : function( event, ui ) {
            /* Get array of items in the list where we removed the item */          
            myArguments = assembleData(this,myArguments);
            console.log(ui.item.index());
        },      
        /* That's fired thrird */       
        receive : function( event, ui ) {
            /* Get array of items where we added a new item */  
           
            myArguments = assembleData(this,myArguments);       
            console.log(ui.item.index());
        },
        update: function(e,ui) {
            if (this === ui.item.parent()[0]) {
                 /* In case the change occures in the same container */ 
                 if (ui.sender == null) {
                    myArguments = assembleData(this,myArguments);       
                } 
            }
        },      
        /* That's fired last */         
        stop : function( event, ui ) {     

        console.log(ui.item);             
            /* Send JSON to the server */

                          rotation -= 5;
    ui.item.rotate(rotation);
ui.item.addClass("image"); 
ui.item.removeClass("image2"); 
             ui.item.html(ui.item.startHtml);
            $("#result").html("Send JSON to the server:<pre>"+JSON.stringify()+"</pre>");  


$.ajax({
            type: "POST",
            url: "/jobs/schedule",
            
            data    :
                    {
                    sort:JSON.stringify(myArguments)
                    },
            success: function() {
                console.log('sent to server');
            }               
        });

        },  
    });
});




$('#tree1').tree({
    closedIcon: $('<i class="fa fa-arrow-circle-right"></i>'),
    openedIcon: $('<i class="fa fa-arrow-circle-down"></i>')
});



$(function(){

    var ul = $('#upload ul');

    $('#drop a').click(function(){
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
        add: function (e, data) {




            var tpl = $('<li class="list-group-item"><input type="text" value="0" data-width="48" data-height="48"'+
                ' data-fgColor="#0788a5" data-readOnly="1" data-bgColor="#3e4043" /><p></p><span></span></li>');

            // Append the file name and file size
            tpl.find('p').text(data.files[0].name)
                         .append('<i>' + formatFileSize(data.files[0].size) + '</i>');

            // Add the HTML to the UL element
            data.context = tpl.appendTo(ul);

            // Initialize the knob plugin
            tpl.find('input').knob();

            // Listen for clicks on the cancel icon
            tpl.find('span').click(function(){

                if(tpl.hasClass('working')){
                    jqXHR.abort();
                }

                tpl.fadeOut(function(){
                    tpl.remove();
                });

            });

            // Automatically upload the file once it is added to the queue
            var jqXHR = data.submit();
        },

        progress: function(e, data){

            // Calculate the completion percentage of the upload
            var progress = parseInt(data.loaded / data.total * 100, 10);

            // Update the hidden input field and trigger a change
            // so that the jQuery knob plugin knows to update the dial
            data.context.find('input').val(progress).change();

            if(progress == 100){
                data.context.removeClass('working');
            }
        },

        fail:function(e, data){
            // Something has gone wrong!
            data.context.addClass('error');
        }

    });


    // Prevent the default action when a file is dropped on the window
    $(document).on('drop dragover', function (e) {
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

//Had some conflict with the twitter framework so use $.noConflict();


//$.noConflict();



$(function(){
  if($('#page-wrapper').is('.createJob')){





  $('.raiseJobForm')
  .bootstrapValidator({
    excluded: [':disabled']
   ,
    fields: {

      'data[Job][email]': {
        validators: {
          notEmpty: {
            message: 'Please supply an email address'
          }
        }
      },
      'data[Job][description]': {
        validators: {
          notEmpty: {
            message: 'Please provide a brief description'
          }
        }
      },
            'data[Job][fullname]': {
        validators: {
          notEmpty: {
            message: 'Please provide the full name of the user requesting this job'
          }
        }
      },
            'data[Job][qs1]': {
        validators: {
          notEmpty: {
            message: 'Please provide at least one question'
          }
        }
      },
            'data[Job][site_id]': {
        validators: {
          notEmpty: {
            message: 'Please provide a site'
          }
        }
      }
    }
  })
   



}
})



/*
*
* Question Set Management
*
*/

//addQuestionNode() will add a node to the tree from the modal window
function addQuestionNode(nodeName,data){

    var tree = $("#questions").fancytree("getTree"),
    activeNode = tree.getActiveNode();
    tree.getNodeByKey(tree.activeNode.key).setExpanded().done(function(){
       activeNode.addChildren({
        title: nodeName
    }); 

       console.log(data)
       tree.getNodeByKey(data).setSelected(true);

   })
}

//Delete a node from the tree
$('#deleteQuestion').click(function(){
  bootbox.confirm("Are you sure you want to delete this node", function(result) {


     if(result){
        var node = $("#questions").fancytree("getActiveNode");
        node.remove();

        $.ajax({
          type: "GET",
          url: "/questions/deleteCode.json",
          data: { key:node.key}
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
$('#addQuestion').click(function(){

    var tree = $("#questions").fancytree("getTree"), activeNode = tree.getActiveNode();

    var node = $("#questions").fancytree("getActiveNode");

    bootbox.dialog({
        title: "Create a Node",
        message: '<div class="row">  ' +
        '<div class="col-md-12"> ' +
        '<form class="form-horizontal"> ' +
        '<div class="form-group" id="locationAtt"> ' +
        '<label class="col-md-4 control-label" for="questionName">Name *</label> ' +
        '<div class="col-md-6"> ' +
        '<input id="questionName" name=questionName" type="text" class="form-control input-md"> ' +
        '<span class="help-block">Please supply a node name</span> </div> ' +
        '</div> ' +
        '</form> </div>  </div>',
        buttons: {
          success: {
            label: "Save",
            className: "btn-success",
            callback: function () {
              var questionName = $('#questionName').val();

              if (!questionName){ 
                 $('#locationAtt').attr('class', 'has-error'); 
                 return false; 
             }
             $.ajax({
                 type: "GET",
                 url: "/questions/saveCode/",
                 data: { code: questionName, id:tree.activeNode.key},
                 success: function(data) {
            addQuestionNode(questionName,data);

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
     $('#saveQuestion').click(function(){

data = $("#QuestionIndexForm").serialize();

 $.ajax({
          type: "POST",
          url: "/questions/updateCode.json",
          data: data
      }) 

$(this).html('<i class="fa fa-check"></i> Saved!');

$.growl("Saved!", {

position: 'bottom-right',
  animate: {
    enter: 'animated fadeInRight',
    exit: 'animated fadeOutRight'
  }               
});

     })

//Get the value from the input and update the Tree node
 var node = $("#questions").fancytree("getActiveNode");
 var newNodeValue = $("#QuestionCode").val();
 node.setTitle(newNodeValue);



$(this).prop('disabled', true);







     tree =   $("#questions").fancytree({
        activate: function(event, data){


      // A node was activated: display its title:
      var node = data.node;


      $.getJSON('/questions/view/'+node.key+'.json', function(data){
        $('#saveQuestion').prop('disabled', false);
        $('#QuestionIndexForm').loadJSON(data);



    })

        .fail(function() {
    console.log( "error" );
  })

      if(node.getLevel()>=6){
        $('#addQuestion').prop('disabled', true);
        $('#editQuestion').prop('disabled', false);
        $('#deleteQuestion').prop('disabled', false);
    }else{
        $('#addQuestion').prop('disabled', false);
        $('#editQuestion').prop('disabled', false);
        $('#deleteQuestion').prop('disabled', false);
    }},
    deactivate: function(event, data){

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
    url: "/questions/buildquestion.json?root=1",
    cache: false
},
lazyLoad: function(event, data) {
  var node = data.node;
      // Issue an ajax request to load child nodes
      data.result = {

        url: "/questions/buildquestion.json",
        data: {key: node.key}
    }
}
});


     $(document).ready(function() { 
        $("#JobSiteId").select2(); 
        $("#JobBuildingId").select2(); 
        $("#JobFloorId").select2(); 
        $("#JobRoomId").select2(); 

        $("#JobQs1").select2(); 
        $("#JobQs2").select2(); 
        $("#JobQs3").select2(); 
        $("#JobQs4").select2(); 
        $("#JobQs5").select2(); 


        $("#JobFullname").select2({
            minimumInputLength: 2,
            createSearchChoice: function (term) {
              return { id: term, text: term };
          },
          ajax: {
            url: '/users/getNames.json',
            dataType: 'json',
            type: "GET",
            quietMillis: 50,
            data: function (term) {
                return {
                    q: term
                };
            },
            results: function (data) {
                return {
                    results: $.map(data, function (item) {
                        return {
                            text: item.fullname,
                            slug: item.fullname,
                            id: item.fullname
                        }
                    })
                };
            }
        }
    });   




