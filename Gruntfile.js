module.exports = function(grunt) {

    // 1. All configuration goes here 
    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        concat: {
            dist: {
			src: [
				'assets/js/jquery.form.min.js', 
				'assets/js/jquery.timepicker.min.js', 
				'assets/js/main.js', 
			],
			dest: 'assets/js/production.js',
			}
        },
		uglify:{
			build:{
				src: 'assets/js/production.js',
				dest: 'assets/js/production.min.js'
			}
		}

    });

    // 3. Where we tell Grunt we plan to use this plug-in.
    grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-uglify');

    // 4. Where we tell Grunt what to do when we type "grunt" into the terminal.
    grunt.registerTask('default', ['concat', 'uglify']);

};