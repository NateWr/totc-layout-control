'use strict';

module.exports = function(grunt) {

	// Project configuration.
	grunt.initConfig({

		// Load grunt project configuration
		pkg: grunt.file.readJSON('package.json'),

		// Configure JSHint
		jshint: {
			test: {
				src: 'js/src/**/*.js'
			}
		},

		// Concatenate scripts
		concat: {
			build: {
				files: {
					'js/customizer-preview.js': [
						'js/src/components/model/*.js',
						'js/src/components/preview/*.js',
					],
					'js/customizer-control.js': [
						'js/src/components/model/*.js',
						'js/src/components/control/*.js',
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
					'js/customizer-preview.min.js' : 'js/customizer-preview.js',
					'js/customizer-control.min.js' : 'js/customizer-control.js'
				}
			}
		},

		// Watch for changes on some files and auto-compile them
		watch: {
			js: {
				files: ['js/src/**/*.js'],
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
							'!js/src', '!js/src/**/*',
						],
						dest: 'totc-layout-control/',
					}
				]
			}
		}

	});

	grunt.loadNpmTasks('grunt-contrib-compress');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-wp-i18n');

	grunt.registerTask('default', ['watch']);
	grunt.registerTask('build', ['jshint', 'concat', 'uglify']);
	grunt.registerTask('package', ['build', 'compress']);

};
