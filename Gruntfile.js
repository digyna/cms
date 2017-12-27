module.exports = function(grunt) {

    grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		wiredep: {
			task: {
				ignorePath: '../../../',
				src: ['application/views/mypanel/includes/header.php','application/views/mypanel/includes/footer.php']
			}

		},
		bower_concat: {
			all: {
				mainFiles: {
					'bootstrap': ["dist/css/bootstrap.css", "dist/js/bootstrap.js"],
					"jquery-slimscroll": ["jquery.slimscroll.js"],
					"fullcalendar": ["dist/fullcalendar.js","dist/fullcalendar.css","dist/locale-all.js"],
					"jquery.steps": ["build/jquery.steps.js"]
					
				},
				dest: {
					'js': 'tmp/<%= pkg.name %>_bower.js',
					'css': 'tmp/<%= pkg.name %>_bower.css'
				}
			}
		},
		bowercopy: {
			options: {
				report: false
			},
			targetbootstrap: {
				options: {
					srcPrefix: 'bower_components/bootstrap',
					destPrefix: 'assets'
				},
				files: {
					'fonts': 'fonts'
				}
			}
		},
		concat: {
			js: {
				options: {
					separator: ';'
				},
				files: {
					'tmp/<%= pkg.name %>.js': ['tmp/digyna-cms_bower.js', 'assets/mypanel/src/js/*.js']
				}
			},
			sql: {
				options: {
					banner: '-- >> Este archivo se genera automáticamente desde tables.sql y constraints.sql. No modifique directamente << --'
				},
				files: {
					'database/database.sql': ['database/tables.sql', 'database/constraints.sql']
				}
			}
		},
		uglify: {
			main: {
				options: {
					banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
				},
				files: {
					'assets/mypanel/dist/js/<%= pkg.name %>.min.js': ['tmp/<%= pkg.name %>.js']
				}
			}
		},
		cssmin: {
			target: {
				files: {
					'assets/mypanel/dist/css/<%= pkg.name %>.min.css': ['tmp/digyna-cms_bower.css', 'assets/mypanel/src/css/materialize.css','assets/mypanel/src/css/style.css', 'assets/mypanel/src/css/themes/all-themes.css']
				}
			},
			target_login: {
				files: {
					'assets/mypanel/dist/css/login.min.css': ['assets/mypanel/src/css/login.css']
				}
			}
		},
		jshint: {
			files: ['Gruntfile.js', 'public/js/*.js'],
			options: {
				// options here to override JSHint defaults
				globals: {
					jQuery: true,
					console: true,
					module: true,
					document: true
				}
			}
		},
		tags: {
			mincss_header: {
				options: {
					scriptTemplate: '<rel type="text/css" src="{{ path }}"></rel>',
					openTag: '<!-- start mincss template tags -->',
					closeTag: '<!-- end mincss template tags -->',
					ignorePath: '../../../'
				},
				src: ['assets/mypanel/dist/css/*.min.css','!assets/mypanel/dist/css/login.min.css'],
				dest: 'application/views/mypanel/includes/header.php',
			},
			mincss_login: {
				options: {
					scriptTemplate: '<rel type="text/css" src="{{ path }}"></rel>',
					openTag: '<!-- start mincss template tags -->',
					closeTag: '<!-- end mincss template tags -->',
					ignorePath: '../../../'
				},
				src: ['assets/mypanel/dist/css/login.min.css'],
				dest: 'application/views/mypanel/login.php',
			},
			css_header: {
				options: {
					scriptTemplate: '<rel type="text/css" src="{{ path }}"></rel>',
					openTag: '<!-- start css template tags -->',
					closeTag: '<!-- end css template tags -->',
					ignorePath: '../../../'
				},
				src: ['assets/mypanel/src/css/materialize.css','assets/mypanel/src/css/*.css','assets/mypanel/src/css/themes/all-themes.css'],
				dest: 'application/views/mypanel/includes/header.php'
			},
			minjs: {
				options: {
					scriptTemplate: '<script type="text/javascript" src="{{ path }}"></script>',
					openTag: '<!-- start minjs template tags -->',
					closeTag: '<!-- end minjs template tags -->',
                    ignorePath: '../../../'
				},
				src: ['assets/mypanel/dist/js/*min.js'],
				dest: 'application/views/mypanel/includes/footer.php'
			},
			js_footer: {
				options: {
					scriptTemplate: '<script type="text/javascript" src="{{ path }}"></script>',
					openTag: '<!-- start js template tags -->',
					closeTag: '<!-- end js template tags -->',
					ignorePath: '../../../'
				},
				src: ['assets/mypanel/src/js/pages/manage_tables.js', 'assets/mypanel/src/js/*.js'],
				dest: 'application/views/mypanel/includes/footer.php'
			}
		},
		mochaWebdriver: {
			options: {
				timeout: 1000 * 60 * 3
			},
			test : {
				options: {
					usePhantom: true,
					usePromises: true
				},
				src: ['test/**/*.js']
			}
		},
		watch: {
			files: ['<%= jshint.files %>'],
			tasks: ['jshint']
		},
		cachebreaker: {
			dev: {
				options: {
					match: [ {
						'digyna-cms.min.js': 'assets/mypanel/dist/js/digyna-cms.min.js',
						'digyna-cms.min.css': 'assets/mypanel/dist/css/digyna-cms.min.css',
						'login.min.css': 'assets/mypanel/dist/css/login.min.css'
					} ],
					replacement: 'md5'
				},
				files: {
					src: [
					'application/views/mypanel/includes/header.php',
					'application/views/mypanel/includes/footer.php',
					'application/views/mypanel/login.php'
					]
				}
			}
		}
    });

    require('load-grunt-tasks')(grunt);
    grunt.loadNpmTasks('grunt-mocha-webdriver');
	grunt.loadNpmTasks('grunt-composer');

    grunt.registerTask('default', ['wiredep', 'bower_concat', 'bowercopy', 'concat', 'uglify', 'cssmin', 'tags', 'cachebreaker']);
    grunt.registerTask('packages', ['composer:update']);
    grunt.registerTask('debug', ['tags','cachebreaker']);

};
