<?php
namespace Deployer;

require 'recipe/laravel.php';

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

host('ssh.binero.se')
	->set('branch','master')
	->set('deploy_path', '~/berzerkers.chas.academy')
	->user('226728_sgs')
	->port(22);

host('ssh.binero.se')
	->stage('dev')
	->set('branch','dev')
	->set('deploy_path', '~/dev.berzerkers.chas.academy')
	->user('226728_sgs')
	->port(22);
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

