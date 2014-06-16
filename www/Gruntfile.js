module.exports = function (grunt) {

     // show elapsed time at the end
        require('time-grunt')(grunt);

        // load all grunt tasks
        require('load-grunt-tasks')(grunt);
    
    // Initialize configuration object
    grunt.initConfig({
       
        
        // User editable project settings & variables
        options: {
            // Base path to your assets folder
            assets: 'app/assets',
            
            dist_assets: 'public/assets',

            // App base
            app: 'app',

            // Published assets path
            dist: 'public',

            // Base path bower components
            bower: './bower_components',

            // Files to be clean on rebuild
            clean: {
                all: ['<%= options.css.concat %>',
                        '<%= options.css.min %>',
                        '<%= options.sass.compiled %>',
                        '<%= options.js.min %>',
                        '<%= options.js.concat %>'],
                concat: ['<%= options.css.concat %>', '<%= options.js.concat %>']
            },


            // fonts settings 
            fonts: {
                base: '<%= options.bower %>',
                files: '<%= options.fonts.base %>/bootstrap/'
            },

            // CSS settings
            css: {
                base: 'app/assets/stylesheets',                         // Base path to your CSS folder
                files: ['app/assets/stylesheets/*.css'],                         // CSS files in order you'd like them concatenated and minified
                concat: '<%= options.css.base %>/concat.css',   // Name of the concatenated CSS file
                min: '<%= options.dist_assets %>/styles/styles.min.css'     // Name of the minified CSS file
            },

            // JavaScript settings
            js: {
                base: 'app/assets/javascripts',                          // Base path to you JS folder
                files: ['./bower_components/jquery/dist/jquery.js',
                    './bower_components/bootstrap/dist/js/bootstrap.js',
                    'app/assets/javascript/frontend.js'],                           // JavaScript files in order you'd like them concatenated and minified
                concat: '<%= options.js.base %>/concat.js',     // Name of the concatenated JavaScript file
                min: '<%= options.dist_assets %>/javascripts/scripts.min.js'     // Name of the minified JavaScript file
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
                    'tmp',
                    'public/assets',
                    'public/views'
                ]
            },
            concat: {
                src: '<%= options.clean.concat %>'
            }
        },

        // Copies remaining files to places other tasks can use
        copy: {
            js: {
                files: [{
                    expand: true,
                    dot: true,
                    cwd: '<%= options.assets %>',
                    dest: '<%= options.dist_assets %>',
                    src: [
                       'jquery/jquery.min.js',
                       'sass-bootstrap/dist/js/bootstrap.min.js',
                       'javascripts/frontend.js'
                    ]
                }]
            },
            style: {
                files: [{
                    expand: true,
                    dot: true,
                    cwd: '<%= options.assets %>',
                    dest: '<%= options.dist_assets %>',
                    src: [
                       'sass-bootstrap/dist/css/bootstrap.min.css',
                       'stylesheets/main.css'
                    ]
                }]
            },
            images: {
                files: [{
                    expand: true,
                    dot: true,
                    cwd: '<%= options.assets %>',
                    dest: '<%= options.dist_assets %>',
                    src: [
                        '{,*/}*.{ico,png,txt}',
                        'images/{,*/}*.{ico,png,txt}'
                    ]
                }]
            },
            fonts: {
                files: [{
                    expand: true,
                    dot: true,
                    cwd: '<%= options.fonts.files %>',
                    dest: '<%= options.dist_assets %>',
                    src: [
                        'fonts/{,*/}*.*'
                    ]
                }]
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

        // 
        filerev: {
            options: {
                encoding: 'utf8',
                algorithm: 'md5',
                length: 8
            },
            source: {
                files: [{
                    src: [
                        '<%= options.dist_assets %>/javascripts/{,*/}*.js',
                        '<%= options.dist_assets %>/stylesheets/{,*/}*.css'
                    ]
                }]
            }
        },

        useminPrepare: {
            html: [
                '<%= options.app %>/views/layouts-dev/{,*/}*.php',
                '<%= options.app %>/views/layouts-dev/site-dev/{,*/}*.php'
            ],
            options: {
                dest: '<%= options.dist %>'
            }
            
        },

        // usemin has access to the revved files mapping through grunt.filerev.summary
        usemin: {
            options: {
                dirs: ['<%= options.dist_assets %>'],
                assetsDirs: ['<%= options.dist %>'],
                patterns: {
                    js: [
                        [/["']([^:"']+\.(?:png|gif|jpe?g))["']/img, 'Image replacement in js files']
                    ]
                }
            },
            html: ['<%= options.app %>/views/layouts/{,*/}*.php'],
            css: ['<%= options.dist_assets %>/stylesheets/{,*/}*.css'],
            js: ['<%= options.dist_assets %>/javascripts/{,*/}*.js']

        },

        htmlmin: {
            dist: {
                options: {
                    /*removeCommentsFromCDATA: true,
                    // https://github.com/yeoman/grunt-usemin/issues/44
                    //collapseWhitespace: true,
                    collapseBooleanAttributes: true,
                    removeAttributeQuotes: true,
                    removeRedundantAttributes: true,
                    useShortDoctype: true,
                    removeEmptyAttributes: true,
                    removeOptionalTags: true*/
                },
                files: [{
                    expand: true,
                    cwd: '<%= options.app %>/views/layouts-dev',
                    src: '{,*/}*.php',
                    dest: '<%= options.app %>/views/layouts'
                }]
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

        // Display notifications
        notify: {
            watch: {
                options: {
                    title: '<%= options.notify.watch.title %>',
                    message: '<%= options.notify.watch.message %>'
                }
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
                tasks: ['sass', 'concat:css', 'cssmin', 'clean:concat'], //tasks to run
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


    // Register tasks
    grunt.registerTask('default', ['watch']); // Default task
    grunt.registerTask('build-dev', ['clean:all', 'sass', 'copy']);
    grunt.registerTask('build-pro', ['clean:all', 'copy', 'sass', 'useminPrepare', 'htmlmin', 'concat', 'cssmin', 'uglify', 'filerev', 'usemin', 'clean:concat']);

}
