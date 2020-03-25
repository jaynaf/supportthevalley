module.exports = function(grunt) {

  grunt.initConfig({

    // Watches for changes and runs tasks
    // Livereload is setup for the 35729 port by default
    watch: {
      sass: {
        files: ['scss/**/*.scss'],
        tasks: ['sass:dev'],
        options: {
          livereload: 35729
        }
      },
      php: {
        files: ['**/*.php'],
        options: {
          livereload: 35729
        }
      }
    },

    // Sass object
    sass: {
      dev: {
        files: [
          {
            src: ['**/*.scss', '!**/_*.scss'],
            cwd: 'scss',
            dest: 'css',
            ext: '.css',
            expand: true
          }
        ],
        options: {
          style: 'expanded',
          compass: true
        }
      }
    }

  });

  // Default task
  grunt.registerTask('default', ['watch']);

  // Load up tasks
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');

};