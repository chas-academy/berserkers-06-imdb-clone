<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'imdbClone');

// Project repository
set('repository', 'git@github.com:chas-academy/berserkers-06-imdb-clone.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', false); 
set('ssh_multiplexing', false);

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

desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    run ('sudo service php7.1-fpm reload');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

after('deploy:symlink', 'php-fpm:restart');
// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

