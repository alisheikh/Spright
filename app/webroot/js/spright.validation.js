/*
* Raise a job
*/


  	
 // override jquery validate plugin defaults
$.validator.setDefaults({
	 ignore: [],
    highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});


var $JobAddFormValidator = $("#").validate({
	debug:false,	
ignore: "",
          rules: {

            'data[Job][description]': {
              required: true
    
            },

            'data[Job][asset_id]': {
            required: function(element) {
            return $("#JobSiteId").is(':empty');
        }
    
            },
            'data[Job][site_id]': {
            required: function(element) {
            return $("#JobAssetId").is(':empty');
        }
},
            'data[Job][qs1]': {
              required: true
    
            },
            'data[Job][completioncomments]': {
  required:{
      depends: function(element) {

        return $('#JobFaulttypeId').val() >=1;

    }
      }
  },
  'data[Job][faulttype_id]': {
  required:{
      depends: function(element) {

        return $('#JobCompletioncomments').val();

    }
      }
  }
          }    
});


//Create Job Wizard
var $CreateJobFormValidator = $("#JobAddForm").validate({
  debug:false,
  ignore: ":disabled",
  rules: {
                'data[Job][fullname]': {
              required: true,
              minlength: 2

            },

            'data[Job][phone]': {
              required: true,
              minlength: 2

            },
            'data[Job][email]': {
              required: true,
              email: true

            },
            'data[Job][description]': {
              required: true
    
            }, 

            'data[Job][asset_id]': {
            required: function(element) {
            return $("#JobSiteId").select2('data') === null
        }
    
            },
            'data[Job][site_id]': {
            required: function(element) {
            return $("#JobAssetId").is(':empty');
        }
},
            'data[Job][qs1]': {
              required: true
    
            }
  }    
  
});




