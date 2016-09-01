'use strict';
module.exports = function (grunt) {

    var js_files_lint_minify = [
        'js/main.js'
    ];

    var js_files_concat = [
        'js/jquery-1.12.3.min.js',
        'js/bootstrap.min.js',
        'js/slick.min.js',
        'js/TweenMax.min.js',
        'js/jquery.waypoints.min.js',
        'node_modules/jquery-form-validator/form-validator/jquery.form-validator.min.js',
        'js/main.min.js'
    ];

    grunt.initConfig({
        sass: {
            dist: {
                files: [{
                    expand: true,
                    cwd: 'css',
                    src: ['*.scss'],
                    dest: 'tmp',
                    ext: '.css'
                }]
            }
        },

        cmq: {
            options: {
                log: false
            },
            your_target: {
                files: {
                    'public/css/full': ['tmp/*.css']
                }
            }
        },

        jshint: {
            files: {
                src: js_files_lint_minify
            }
        },

        uglify: {
            default: {
                files: {
                    'js/main.min.js': js_files_lint_minify
                }
            }
        },

        concat: {
            default: {
                src: js_files_concat,
                dest: 'public/js/main.min.js',
            }
        },

        cssmin: {
            target: {
                files: [{
                    expand: true,
                    cwd: 'public/css/full',
                    src: ['*.css', '!*.min.css'],
                    dest: 'public/css',
                    ext: '.min.css'
                }]
            }
        },

        clean: {
            build: {
                src: ['tmp']
            }
        },

        watch: {
            scss: {
                files: ['**/*.scss'],
                tasks: ['sass','cmq','cssmin','clean'],
                options: {
                    spawn: false,
                },
            }
        }

    });

    grunt.loadNpmTasks('grunt-contrib-sass');
    grunt.loadNpmTasks('grunt-contrib-clean');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-combine-media-queries');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-contrib-watch');

    grunt.registerTask('default', ['watch']);
    grunt.registerTask('build-css',['sass','cmq','cssmin','clean']);
    grunt.registerTask('build-js',['jshint','uglify','concat']);
};