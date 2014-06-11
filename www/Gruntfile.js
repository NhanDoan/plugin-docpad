module.exports = function (grunt) {

    // Initialize configuration object
    grunt.initConfig({

        // Read in project settings
        pkg: grunt.file.readJSON('package.json'),

        // User editable project settings & variables
        options: {
            // Base path to your assets folder
            base: 'app/assets',

            // Published assets path
            publish: 'public/assets',

            // Files to be clean on rebuild
            clean: {
                all: ['<%= options.css.concat %>',
                        '<%= options.css.min %>',
                        '<%= options.sass.compiled %>',
                        '<%= options.js.min %>',
                        '<%= options.js.concat %>'],
                concat: ['<%= options.css.concat %>', '<%= options.js.concat %>']
            },

            // CSS settings
            css: {
                base: 'app/assets/stylesheets',                         // Base path to your CSS folder
                files: ['app/assets/stylesheets/*.css'],                         // CSS files in order you'd like them concatenated and minified
                concat: '<%= options.css.base %>/concat.css',   // Name of the concatenated CSS file
                min: '<%= options.publish %>/styles/styles.min.css'     // Name of the minified CSS file
            },

            // JavaScript settings
            js: {
                base: 'app/assets/javascripts',                          // Base path to you JS folder
                files: ['./bower_components/jquery/dist/jquery.js',
                    './bower_components/bootstrap/dist/js/bootstrap.js',
                    'app/assets/javascript/frontend.js'],                           // JavaScript files in order you'd like them concatenated and minified
                concat: '<%= options.js.base %>/concat.js',     // Name of the concatenated JavaScript file
                min: '<%= options.publish %>/javascripts/scripts.min.js'     // Name of the minified JavaScript file
            },

            // SASS Settings
            sass: {
                base: 'app/assets/stylesheets',                            // Base path to you SASS folder
                file: 'app/assets/stylesheets/main.scss',                          // SASS file (ideally, one file which contains imports)
                compiled: '<%= options.css.base %>/main.css'    // Name of the compiled SASS file
            },

            // Notification messages
            notify: {
                watch: {
                    title: 'Live Reloaded!',
                    message: 'Files were modified, recompiled and site reloaded'
                }
            },

            // Files and folders to watch for live reload and rebuild purposes
            watch: {
                files: ['<%= options.js.files %>',
                 '<%= options.css.files %>',
                 '<%= options.sass.base %>/*.sass',
                 '<%= options.sass.base %>/*.scss',
                 '!<%= options.js.min %>',
                 '!<%= options.sass.compiled %>']
            }
        },

        // Clean files and folders before replacement
        clean: {
            all: {
                src:[
                    '<%= options.clean.all %>',
                    'tmp'
                ]
            },
            concat: {
                src: '<%= options.clean.concat %>'
            }
        },

        // Concatenate multiple sets of files
        concat: {
            css: {
                files: {
                    '<%= options.css.concat %>' : ['<%= options.css.files %>']
                }
            },
            js_frontend: {
                options: {
                    block: true,
                    line: true,
                    stripBanners: true
                },
                files: {
                    '<%= options.js.concat %>' : '<%= options.js.files %>',
                }
            }
        },

        // Minify and concatenate CSS files
        cssmin: {
            minify: {
                src: '<%= options.css.concat %>',
                dest: '<%= options.css.min %>'
            }
        },

        // Javascript linting - JS Hint
        jshint: {
            files: ['<%= options.js.files %>'],
            options: {
                // Options to override JSHint defaults
                curly: true,
                indent: 4,
                trailing: true,
                devel: true,
                globals: {
                    jQuery: true
                }
            }
        },

        // Compile SASS files
        sass: {
            dist: {
                files: {
                    '<%= options.sass.compiled %>': '<%= options.sass.file %>'
                }
            },
            options: {
                sourcemap: true,
                loadPath: ['{{vendor_path}}'],
            },
            main: {
                files: [{
                    expand: true,
                    src: ['<%= options.sass.base %>/{,*/}*.{scss,sass}'],
                    dest: './tmp',
                    ext: '.css'
                }]
            }
        },

        // Display notifications
        notify: {
            watch: {
                options: {
                    title: '<%= options.notify.watch.title %>',
                    message: '<%= options.notify.watch.message %>'
                }
            }
        },

        // Javascript minification - uglify
        uglify: {
            options: {
                preserveComments: false
            },
            files: {
                src: '<%= options.js.concat %>',
                dest: '<%= options.js.min %>'
            }
        },

        // Watch for files and folder changes
        watch: {
            js_frontend: {
                files: [
                    //watched files
                   '<%= options.js.files %>'
                ],
                tasks: ['concat:js_frontend', 'uglify'], //tasks to run
                options: {
                    livereload: true //reloads the browser
                }
            },
            sass: {
                files: ['<%= options.sass.file %>'], //watched files
                tasks: ['sass', 'concat:css', 'cssmin'], //tasks to run
                options: {
                    livereload: true //reloads the browser
                }
            },
            tests: {
                files: ['app/controllers/*.php', 'app/models/*.php'], //the task will run only when you save files in this location
                tasks: ['phpunit']
            }
        }

    });

    // Load npm tasks
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-livereload');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-notify');

    // Register tasks
    grunt.registerTask('default', ['watch']); // Default task
    grunt.registerTask('init', ['clean:all', 'sass',  'sass:dist', 'concat', 'cssmin', 'uglify', 'clean:concat']);
}
