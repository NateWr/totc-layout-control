'use strict';

module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({

		// Load grunt project configuration
		pkg: grunt.file.readJSON('package.json'),

		// Configure less CSS compiler
		less: {
			build: {
				options: {
					ieCompat: true
				},
				files: {
					'assets/css/style.css': [
						'assets/less/style.less',
						'assets/less/style-*.less'
					]
				}
			}
		},

		cssmin: {
			build: {
				files: [
					{
						src: 'style.css',
						dest: 'style.min.css',
					}
				]
			}
		},

		// Configure JSHint
		jshint: {
			test: {
				src: 'assets/js/src/**/*.js'
			}
		},

		// Concatenate scripts
		concat: {
			build: {
				files: {
					'assets/js/admin.js': [
						'assets/js/src/admin.js',
						'assets/js/src/admin-*.js'
					]
				}
			}
		},

		// Minimize scripts
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n'
			},
			build: {
				files: {
					'assets/js/admin.min.js' : 'assets/js/admin.js'
				}
			}
		},

		// Watch for changes on some files and auto-compile them
		watch: {
			less: {
				files: ['assets/less/**/*.less'],
				tasks: ['less', 'cssmin']
			},
			js: {
				files: ['assets/js/src/**/*.js'],
				tasks: ['jshint', 'concat', 'uglify']
			}
		},

		// Create a .pot file
		makepot: {
			target: {
				options: {
					processPot: function( pot, options ) {
						pot.headers['report-msgid-bugs-to'] = 'https://themeofthecrop.com';
						return pot;
					},
					type: 'wp-plugin',
				}
			}
		},

		// Build a package for distribution
		compress: {
			main: {
				options: {
					archive: 'totc-layout-control-<%= pkg.version %>.zip'
				},
				files: [
					{
						src: [
							'*', '**/*',
							'!totc-layout-control-<%= pkg.version %>.zip',
							'!.*', '!Gruntfile.js', '!package.json', '!node_modules', '!node_modules/**/*',
							'!**/.*', '!**/Gruntfile.js', '!**/package.json', '!**/node_modules', '!**/node_modules/**/*',
							'!assets/src', '!assets/src/**/*',
						],
						dest: 'totc-layout-control/',
					}
				]
			}
		}

	});

	grunt.loadNpmTasks('grunt-contrib-compress');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-wp-i18n');

	grunt.registerTask('default', ['watch']);
	grunt.registerTask('build', ['less', 'cssmin', 'jshint', 'concat', 'uglify']);
	grunt.registerTask('package', ['build', 'compress']);

};
