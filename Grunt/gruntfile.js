module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({

    uglify: {
    options: {
      manage: false
    },

    my_target:{

      files:{
'../app/webroot/spright.min.js' : ['../app/webroot/js/spright.js']

      }
    }

  }
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-uglify');

  // Default task(s).
  grunt.registerTask('default', ['uglify']);

};