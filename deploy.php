<?php
namespace Deployer;

require 'recipe/laravel.php';
require 'recipe/npm.php';

// Project name
set('application', 'imdbClone');

// Project repository
set('repository', 'git@github.com:chas-academy/berserkers-06-imdb-clone.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 
set('ssh_multiplexing', true);

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);
set('allow_anonymous_stats', false);

// Hosts

host('prod')
	->hostname('berzerkers')
	->set('branch','master')
	->set('deploy_path', '/var/www/berzerkermovies.me')
	->user('deploy')
	->port(22);

host('stage')
	->hostname('berzerkers')
	->set('branch', 'stage')
	->set('deploy_path','/var/www/stage.berzerkermovies.me')
	->user('deploy')
	->port(22);

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

task('npm:build', function () {
  run("cd {{release_path}} && {{bin/npm}} run production");
});

desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    run ('sudo service php7.1-fpm reload');
});

desc('Execute artisan db:seed');

task('artisan:db:seed', function () {
  run('{{bin/php}} {{release_path}}/artisan db:seed');
});

task('artisan:migrate:fresh', function () {
  run('{{bin/php}} {{release_path}}/artisan migrate:fresh');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

//after('deploy:update_code', 'npm:install');

//after('deploy:symlink', 'npm:build');

// Migrate database before symlink new release.

//before('deploy:symlink', 'artisan:migrate:fresh');
after('deploy:symlink', 'php-fpm:restart');
after('deploy:symlink', 'artisan:db:seed');


