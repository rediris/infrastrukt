module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        includePaths: ['.temp/bower_components/foundation/scss']
      },
      dist: {
        options: {
          outputStyle: 'compressed'
        },
        files: {
          '.temp/_style.scss': 'scss/style.scss'
        }
      }
    },

    copy: {
      scripts: {
        expand: true,
        cwd: '.temp/bower_components/',
        src: '**/*.js',
        dest: '.temp/js'
      },

      maps: {
        expand: true,
        cwd: '.temp/bower_components/',
        src: '**/*.map',
        dest: '.temp/js'
      }
    },

    uglify: {
      dist: {
        files: {
          'js/modernizr/modernizr.min.js': ['.temp/js/modernizr/modernizr.js']
        }
      }
    },

    concat: {
      js: {
        options: {
          separator: ';'
        },
        src: [
          '.temp/js/foundation/js/foundation.min.js',
          //'.temp/js/custom/*.js',
          'js/infrastrukt.js'
        ],
        dest: 'js/app.js'
      },
      css: {
        src: [
            'scss/theme/comment-block.scss',
            '.temp/_style.scss'
        ],
        dest: 'style.css'
      }
    },

    watch: {
      grunt: { files: ['Gruntfile.js'] },

      sass: {
        files: 'scss/**/*.scss',
        tasks: ['sass']
      }
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.registerTask('build', ['sass', 'copy', 'uglify', 'concat']);
  grunt.registerTask('default', ['watch']);
};