module.exports = function(grunt) {
  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    // settings
    temp: '.temp',

    sass: {
      options: {
        includePaths: ['<%= temp %>/bower_components/foundation/scss']
      },
      dist: {
        options: {
          outputStyle: 'compressed'
        },
        files: {
          '<%= temp %>/css/_style.css': 'scss/style.scss'
        }
      }
    },

    autoprefixer: {
      options: {
        browsers: ['last 3 versions', '> 5%', 'Firefox ESR' , 'ie 9']
      },
      target: {
        expand    : true,
        flatten   : true,
        src       : '<%= temp %>/css/*.css',
        dest      : '<%= temp %>/css/'
      }
    },

    copy: {
      scripts: {
        expand  : true,
        cwd     : '<%= temp %>/bower_components/',
        src     : '**/*.js',
        dest    : '<%= temp %>/js'
      },

      maps: {
        expand  : true,
        cwd     : '<%= temp %>/bower_components/',
        src     : '**/*.map',
        dest    : '<%= temp %>/js'
      }
    },

    uglify: {
      dist: {
        files: {
          'js/modernizr/modernizr.min.js'     : ['<%= temp %>/js/modernizr/modernizr.js'],
          '<%= temp %>/js/infrastrukt.min.js' : ['js/infrastrukt.js']
        }
      }
    },

    concat: {
      js: {
        options: {
          separator: ';'
        },
        src: [
          '<%= temp %>/js/foundation/js/foundation.min.js',
          '<%= temp %>/js/infrastrukt.min.js'
        ],
        dest: 'js/app.js'
      },
      css: {
        src: [
            'scss/theme/_comment-block.scss',
            '<%= temp %>/css/_style.css'
        ],
        dest: 'style.css'
      }
    },

    watch: {
      grunt: { files: ['Gruntfile.js'] },

      sass: {
        files: 'scss/**/*.scss',
        tasks: ['sass', 'copy' , 'uglify', 'concat']
      }
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-autoprefixer');

  grunt.registerTask('build', ['sass', 'autoprefixer', 'copy', 'uglify', 'concat']);
  grunt.registerTask('default', ['watch', 'build']);
};