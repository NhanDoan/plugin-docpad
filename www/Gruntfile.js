module.exports = function(grunt) {

    var mozjpeg = require('imagemin-mozjpeg');

    //Initializing the configuration object
    grunt.initConfig({
        options: {
            dest: './public/assets',
            src: './app/assets',
            dest_js: '<%= options.dest %>/javascript',
            src_js: '<%= options.src %>/javascript',
            dest_css: '<%= options.dest %>/stylesheets',
            src_css: '<%= options.src %>/stylesheets',
            bower_bt: './bower_components/bootstrap',
            bower_jq: './bower_components/jQuery'
        },
        // Task configuration
        copy: {
            main: {
                expand: true,
                cwd: '<%= options.bower_bt %>/fonts/',
                src: '**',
                dest: '<%= options.dest %>/fonts/',
                flatten: true,
                filter: 'isFile',
            },
        },
        less: {
            development: {
                options: {
                    compress: true, //minifying the result
                },
                files: {
                    //compiling frontend.less into frontend.css
                    "<%= options.dest_css %>/frontend.css": "<%= options.src_css %>/frontend.less"
                }
            }
        },
        sass: { // Task
            dist: { // Target
                options: { // Target options
                    style: 'expanded'
                },
                files: { // Dictionary of files
                    'main.css': 'main.scss', // 'destination': 'source'
                    'widgets.css': 'widgets.scss'
                }
            }
        },
        concat: {
            options: {
                separator: ';',
            },
            js_frontend: {
                src: [
                    '<%= options.bower_jq %>/dist/jquery.js',
                    '<%= options.bower_bt %>/dist/js/bootstrap.js',
                    '<%= options.src_js%>/frontend.js'
                ],
                dest: '<%= options.src_js%>/frontend-min.js',
            }
        },
        uglify: {
            options: {
                mangle: false // Use if you want the names of your functions and variables unchanged
            },
            frontend: {
                files: {
                    '<%= options.dest_js%>/frontend-min.js': '<%= options.src_js%>/frontend-min.js',
                }
            }
        },
        phpunit: {
            classes: {},
            options: {}
        },
        watch: {
            js_frontend: {
                files: [
                    //watched files
                    '<%= options.bower_jq %>/dist/jquery.js',
                    '<%= options.bower_bt %>/dist/js/bootstrap.js',
                    '<%= options.src_js %>/frontend.js'
                ],
                tasks: ['concat:js_frontend', 'uglify:frontend'], //tasks to run
                options: {
                    livereload: true //reloads the browser
                }
            },
            less: {
                files: ['<%= options.src_css %>/*.less'], //watched files
                tasks: ['less'], //tasks to run
                options: {
                    livereload: true //reloads the browser
                }
            },
            tests: {
                files: ['app/controllers/*.php', 'app/models/*.php'], //the task will run only when you save files in this location
                tasks: ['phpunit']
            }
        },
        imagemin: {
            dynamic: {
                files: [{
                    expand: true,
                    cwd: '<%= options.src %>/images/',
                    src: ['**/*.{png,jpg,gif}'],
                    dest: '<%= options.dest %>/images/'
                }]
            }
        }
    });

    // Plugin loading
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-phpunit');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-contrib-imagemin');

    // Task definition
    grunt.registerTask('init', ['copy', 'less', 'concat', 'uglify', 'imagemin']);
    grunt.registerTask('default', ['watch']);

};