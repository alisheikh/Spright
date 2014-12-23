/**
 *
 * Job Templates list data table
 *
 **/

    var jobsTemplatesTable = $('#job-templates').DataTable({
        stateSave: true,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "/jobtemplates/getjobtemplates.json",
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<button id=\"edit\" class='btn btn-default btn-xs' type='button'><i class='fa fa-pencil'></i></button> <button id=\"delete\" class='btn btn-default btn-xs' type='button'><i class='fa fa-times'></i></button>"
        }],
        "columns": [{
                data: "code"
            }, {
                data: "description"
            },
            {
                data: "created"
            },
             {
                data: null,"bSearchable": false, "bSortable": false //Actions column
            },
        ],
    });


/**
 * Edit button on table rows
 */
   $('#job-templates tbody').on( 'click', '#edit', function () {

     var data = jobsTemplatesTable.row( $(this).parents('tr') ).data();
     window.location = "/jobtemplates/edit/" + data.id;

    } );

   $('#job-templates tbody').on( 'click', '#delete', function () {

     var data = jobsTemplatesTable.row( $(this).parents('tr') ).data();
     
     alert('create delete function');

    } );

/**
 *
 * Job Templates Tasks list data table
 *
 **/

    var jobsTemplateTasksTable = $('#job-template-tasks').DataTable({
        "sDom": '<"top">rt<"bottom"flp><"clear">',
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "/jobtemplates/getjobtemplates.json",
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<button id=\"edit\" class='btn btn-default btn-xs' type='button'><i class='fa fa-pencil'></i></button> <button id=\"delete\" class='btn btn-default btn-xs' type='button'><i class='fa fa-times'></i></button>"
        }],
        "columns": [{
                data: "code"
            }, {
                data: "description"
            },
            {
                data: "created"
            },
             {
                data: null,"bSearchable": false, "bSortable": false //Actions column
            },
        ],
    });


/**
 * Edit button on table rows
 */
   $('#job-template-tasks tbody').on( 'click', '#edit', function () {

     var data = jobsTemplatesTable.row( $(this).parents('tr') ).data();
     window.location = "/jobtemplates/edit/" + data.id;

    } );

   $('#job-template-tasks tbody').on( 'click', '#delete', function () {

     var data = jobsTemplatesTable.row( $(this).parents('tr') ).data();
     
     alert('create delete function');

    } );

/**
 *
 * Fault Codes list data table
 *
 **/

    var faultCodesTable = $('#fault-codes').DataTable({
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "/faulttypes/getfaulttypes.json",
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<button id=\"edit\" class='btn btn-default btn-xs' type='button'><i class='fa fa-pencil'></i></button> <button id=\"delete\" class='btn btn-default btn-xs' type='button'><i class='fa fa-times'></i></button>"
        }],
        "columns": [{
                data: "code"
            },
            {
                data: "created"
            },
             {
                data: null,"bSearchable": false, "bSortable": false //Actions column
            },
        ],
    });


/**
 * Edit button on table rows
 */
   $('#fault-codes tbody').on( 'click', '#edit', function () {

     var data = faultCodesTable.row( $(this).parents('tr') ).data();
  
     window.location = "/faulttypes/edit/" + data.DT_RowId;

    } );

   $('#fault-codes tbody').on( 'click', '#delete', function () {

     var data = faultCodesTable.row( $(this).parents('tr') ).data();
     
                $.ajax({
                                    type: "POST",
                                    url: "/faulttypes/delete/",
                                    data: {
                                        faulttype_id: data.DT_RowId
                                    },
                                    success: function(data) {

                                    faultCodesTable.fnDeleteRow('#1');

                                    }
                                })

    } );


