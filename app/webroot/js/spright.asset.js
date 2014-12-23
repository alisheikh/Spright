    var assetsTable = $('#assets-table').DataTable({
        //  "scrollX": true,
   "language": {
        "emptyTable":     "No jobs to display"
    },
        stateSave: true,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": "/apis/assetlist.json",
        "columnDefs": [{
            "targets": -1,
            "data": null,
            "defaultContent": "<button id=\"view\"class='btn btn-default btn-xs' type='button'><i class='fa fa-search'></i></button>"
        }],
        "columns": [

        { data: "asset" }, 
        { data: "description" },
        { data: "Site" },
        { data: "building" },
        { data: "floor" },    
        { data: "room" },     
        { data: "created" },
             {
                data: null,"bSearchable": false, "bSortable": false // need to supply a null value for
            },
        ],
    });

/**
 * Save Button on table rows
 */
   $('#assets-table tbody').on( 'click', '#view', function () {
      var data = assetsTable.row( $(this).parents('tr') ).data();      
      window.location = "/codes/assetview/" + data.DT_RowId;
    } );


   //Save Button
$('#saveAsset').click(function() {

    form = $('form:first');


    if(form.valid()){
        

        $(this).html('<i class="fa fa-spinner fa-spin"></i>');
        $(this).prop('disabled',true);
        form.submit();

    } 
});

    /**
    *
    * VALIDATION
    *
    **/

    $( ".assetForm" ).validate({
rules: {
'data[Code][code]': {
required: true,
    remote: {
        url: "/codes/validAsset",
        type: "get",
        data: {
          asset_id: function() {
            return $( "#CodeId" ).val();
          },
          orginalCode: function() {
            return $( "#orginalCode" ).val();
          },
        } 
      }

},
    'data[Site][code]': {
required: true,
    }
}
});
