/*
*  Project: Spright.
*  Description: The following includes all relevent functions related to the Work Management module
*  Author: Ashley Smith
*  License: MIT License
*  Website: http://spright.com.au (https://github.com/AshHimself/Spright)
*/

 /**
 *
 * Work order list data table
 *
 **/
 
    var jobsTable = $('#jobs-table').DataTable({
        stateSave: true,
        "bProcessing": false,
        "bServerSide": true,
        "sAjaxSource": "/apis/getjobs.json",
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<button id=\"view\"class='btn btn-default btn-xs' type='button'><i class='fa fa-search'></i></button>"
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

/**
 * View Button on table rows
 */
   $('#jobs-table tbody').on( 'click', '#view', function () {

    var data = jobsTable.row( $(this).parents('tr') ).data();
      
       window.location = "/jobs/view/" + data.DT_RowId;
    } );
/**
 * Complete a job function (Currently not being used)
 */
   $('#completJob').click(function() {

        var id = $('#JobId').val();
        var completiondate = $('#JobCompletiondate').val();
        var completioncomments = $('#JobCompletioncomments').val();


        var $valid = $("#JobEditForm").valid();
                console.log($valid)
                if(!$valid) {
                    $JobAddFormValidator.focusInvalid();
                    return false;
        }

        $('#completJob').prop('disabled', true);

        $.ajax({
            type: 'GET',
            url: '/jobs/completeJob',
            data: {
                id: id,
                completiondate: completiondate,
                completioncomments: completioncomments
            },
            success: function(data) {
                
                window.location.href = "/jobs";

            }
        })
    });

   /** 
   *
   * Work Planner
   *
   **/
   
   var tasksTable = $('#tasks-table').dataTable({
        // "scrollX": true,

        "bProcessing": false,
        "bServerSide": true,
        "sAjaxSource": "/jobviews/gettasks.json",
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

        ],
    });




    $(function() {

        //Scheduler
        var fromSchedule;
        var fromSchedulerData;
        var fromResource;

        selectedRowID = false;


        $('#tasks-table tbody').on('click', 'tr', function() {
            if ($(this).hasClass('success')) {
                $(this).removeClass('success');
                fromSchedule = false;
                fromSchedulerData = false;

            } else {
                tasksTable.$('tr.success').removeClass('success');
                $(this).addClass('success');
                fromSchedulerData = tasksTable.fnGetData(this);
                fromSchedule = this.id


            }

            selectedRowID = this.id;
        });


        //Add a hover placholder that lets users know where they can schedule jobs too..
        //Only executes when a job has been selected in the scheduler
        $("#resources td").hover(
            function() {

                if (fromSchedule) {
                    $(this).addClass("scheduleHighlight")
                };
            },
            function() {
                $(this).removeClass("scheduleHighlight");
            }
        );

        $("[data-toggle=popover]").popover(taskPopOverSettings);

        $("#resources td").on("click", function(e) {
                var $jobCode = '#' + toSchedule;

                var toSchedule = $(this).attr('id');

                



                        if (fromSchedule) {
                            //Remove the Empty placeholder when a job is assigned if they have no jobs
                            var noJobs = $("#empty_" + toSchedule);
                            if (noJobs.length) {
                                noJobs.remove();
                            }

                            console.log(fromSchedulerData)
                            taskCode = fromSchedulerData.TaskCode;
                            jobID = fromSchedulerData.JobID;
                            taskID = fromSchedulerData.DT_RowId;   
                            console.log(fromSchedulerData.JobID);     

                            $('#' + toSchedule + '> ul').prepend("<li data-jobid=\""+jobID+"\" data-placement=\"bottom\" data-toggle=\"popover\" data-title=\"Task Details\" data-container=\"body\" type=\"button\" data-html=\"true\" class=\"list-group-item scheduledTask\" id=\"" + taskID + "\" class='list-group-item'><i class='fa fa-calendar wp_scheduled'></i># "+ taskID +" " + taskCode + "</li>");
                            $('#tasks-table #' + fromSchedule).toggleClass("success");

                            $('#tasks-table  #' + fromSchedule).remove();

                            scheduleJob(fromSchedule, toSchedule);
                            toSchedule = false;
                            fromSchedule = false;
                        }   
            })


        //Triggered when its time to save the job
        function scheduleJob(job, resource) {


            $.ajax({
                type: "GET",
                url: "/tasks/schedule.json",

                data: {
                    job: job,
                    resource: resource
                },
                success: function() {
                    
                    //init popover
                    $('[data-toggle="popover"]').popover('hide');

                    //display growler function now its scheduler
                    $.growl('Scheduled', {
                        type: 'success',

                        placement: {
                            from: "bottom",
                            align: "right"
                        }
                    });
                }
            });

        }




            });

    //Reload table every x seconds
            //Reload table every x seconds
    setInterval(function() {
        tasksTable.api().ajax.reload(function ( json ) {

if(selectedRowID){
                $('#tasks-table #'+selectedRowID).addClass('success');
                fromSchedulerData = tasksTable.fnGetData('#tasks-table #'+selectedRowID);
                fromSchedule = selectedRowID

}

} );

    }, 5000);

//Open Modal

var originalLeave = $.fn.popover.Constructor.prototype.leave;
$.fn.popover.Constructor.prototype.leave = function(obj){
  var self = obj instanceof this.constructor ?
    obj : $(obj.currentTarget)[this.type](this.getDelegateOptions()).data('bs.' + this.type)
  var container, timeout;

  originalLeave.call(this, obj);

  if(obj.currentTarget) {
    container = $(obj.currentTarget).siblings('.popover')
    timeout = self.timeout;
    container.one('mouseenter', function(){
      //We entered the actual popover – call off the dogs
      clearTimeout(timeout);
      //Let's monitor popover content instead
      container.one('mouseleave', function(){
        $.fn.popover.Constructor.prototype.leave.call(self, self);
      });
    })
  }
};

//$('body').popover({ selector: '.scheduledTask', trigger: 'click hover', placement: 'auto', delay: {show: 50, hide: 400}});

  //Popover for tasks that have been scheduled

//$('body').popover({ selector: '[data-popover]', trigger: 'click hover', placement: 'auto', delay: {show: 50, hide: 400}});

taskPopOverSettings = {
    
    placement: 'auto',
    delay: {show: 50, hide: 400},
    trigger: 'click hover',
    html: true, 
    content: function() {
        $('.popover').not(this).hide();

        div_id = this.id


         return details_in_popup($(this).attr('href'), div_id);


          
        }
}


   $("[data-toggle=popover]").popover(taskPopOverSettings);



   function details_in_popup(link, div_id){
   var ajaxTask =  $.ajax({
        data: {
                    task_id: div_id,
                    
            },
        url: '/jobs/getTask/'+div_id+'.json',
        cache:true,
        success: function(response){



                        content = '<div class="btn-group" role="group" aria-label="..."> \
                        <strong>Description</strong></br> <p>'+response.Job.description+'</p></div>';

            
        }
    });


    return '<div id="'+ div_id +'">'+content+'</div>';
}

$('body').on('click', function (e) {
    //only buttons
    if ($(e.target).data('toggle') !== 'popover'
        && $(e.target).parents('.popover.in').length === 0) { 

    }
});


function quickJobView(id){



    
     $('#quickView').modal('show')  



}


$('#quickView').on('show.bs.modal', function (e) {

     jobID = $('#resources #'+id).attr("data-jobid");
   


jQuery.ajax({
    type: 'GET',
    url: '/jobs/getjob/'+jobID+'.json',
    success: function(data) {

    $('#quickView').loadJSON(data);
    

    }
});

  
});

//Open a modal when clicking on a scheduled job
      $( 'body' ).on( 'click', '.scheduledTask', function () {

        quickJobView(this.id);

    });


/**
*
* Raise Work Order
*
**/

       $("#JobFullname").select2({
            allowClear: true,
            minimumInputLength: 2,
            createSearchChoice: function(term) {
                return {
                    id: term,
                    text: term
                };
            },
            ajax: {
                url: '/users/getNames.json',
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
                                text: item.fullname,
                                slug: item.fullname,
                                id: item.fullname
                            }
                        })
                    };
                }
            }
        });

    $('#JobFullname').on('select2-selecting', function(e){ 

setTimeout(function(){
            var value = $('#JobFullname').val();
            $('#JobFullname').valid();
}, 500);



});


/**
*
* Your Tasks
*
**/




yourtasksTable = $('#yourTasks-table').DataTable({
    "sDom": '<"top"ilp><"bottom"ti><"clear">r',
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<button id=\"view\" class=\"btn btn-default btn-xs\" type=\"button\"><i class=\"fa fa-list-alt\"></i></button>"
        }],

        "bProcessing": false,
        "bServerSide": true,
        "sAjaxSource": "/apis/getyourtasks.json",
        "columns": [
          
            {
                data: "JobID"
            }, {
                data: "fullname"
            },
            { data: "description" },
            { data: "Status" },
             {
                data: "SiteCode"
            }, {
                data: "BuildingCode"
            }, {
                data: "FloorCode"
            }, {
                data: "RoomCode"
            }, {
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
                data: null
            }

        ],
    });

//Refresh to get new jobs tasks.
    setInterval(function() {
        yourtasksTable.ajax.reload(function ( json ) {
} );

    }, 10000);




   $('#yourTasks-table tbody').on( 'click', '#view', function () {

    var data = yourtasksTable.row( $(this).parents('tr') ).data();
    var taskID = data.DT_RowId;
    var status = data.Status;

    switch(status) {
    case 'Scheduled':
       html = "<div class=\"text-center\"><button id=\""+taskID+"\" value = \"6\" class=\"btn btn-success btn-lg rejaccTask\">ACCEPT</button> <button id=\""+taskID+"\" class=\"btn btn-danger btn-lg rejaccTask\" value = \"7\">REJECT</button></div>";
       bootbox.dialog({message: html});
        break;
    case 'Accepted':

        jQuery.ajax({
        type: 'GET',
        url: '/tasks/completetask/'+taskID,
        success: function(data) {

        bootbox.dialog({message: data});

        $("#TaskCompletetaskForm").validate({
              debug:false,
               ignore: [],
              rules: {
            'data[Task][completiondate]' : "required",
             'data[Task][faulttype_id]': "required",
            'data[Task][completioncomments]': "required"
  }    
  
});
        

        }
    });
        
        break;
}     

    } );



    /* complete a Task */

   $('body').on( 'click', '.completedTask', function () {

    taskID = this.id;
    console.log('validate time')
               
        if($("#TaskCompletetaskForm").valid()) {
            console.log('valid or fucking is it.')
        
            $(this).html('<i class="fa fa-spinner fa-spin"></i>');
    $(this).prop('disabled',true);


    jQuery.ajax({ 
        type: 'POST',
        data: $('#TaskCompletetaskForm').serialize(),
        url: '/tasks/save/'+taskID,
        success: function(data) {

         tasksTable.api().ajax.reload(); //Reload yourtasks datatable
         bootbox.hideAll(); //Close modal

        $.growl("Task Completed", {
                type: "success",

                placement: {
                    from: "bottom",
                    align: "right"
                }
        });
        

    }

    });
        }else{
            console.log('NOT VALID')
        }
    } );

       /* reject or accept a Task */

   $('body').on( 'click', '.rejaccTask', function () {

    task_id = this.id;
    statustype_id = this.value;

    $(this).html('<i class="fa fa-spinner fa-spin"></i>');
    $(this).prop('disabled',true);

     
    

    jQuery.ajax({ 
        type: 'POST',
        data: {"data[Task][statustype_id]": statustype_id, "data[Task][id]": task_id},
        url: '/tasks/save/'+task_id,
        success: function(data) {

        yourTasksTable.api().ajax.reload(); //Reload yourtasks datatable
        bootbox.hideAll(); //Close modal

        $.growl("Task Updated", {
                type: "success",

                placement: {
                    from: "bottom",
                    align: "right"
                }
        });
        

    }

    });

    } );

   /**
   *
   * View Job
   *
   **/
   
   function formatJobView ( completioncomments, completiondate ) {
    return '<div><strong>Completion Date/Time:</strong> ' + completiondate + '<br /><strong>Completion Comments:</strong> ' + completioncomments + '</div>';
}
 $(document).ready(function() {
   table = $('.jobTasks').DataTable( {} );
} );


// Add event listener for opening and closing details
$('.jobTasks tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = table.row( tr );
 
    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        // Open this row
        row.child( formatJobView( tr.data('child-completioncomments'), tr.data('child-completiondate') )).show();
        tr.addClass('shown');
    }
} );


   


      




