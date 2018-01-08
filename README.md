# berserkers-06-imdb-clone
Lets do it!

# link to site: http://berzerkermovies.me
# link to stageing http://stage.berzerkermovies.me

#

# How to get started:

  1. Clone the repository to your local machine.
  2. Setup SSH-keys: https://help.github.com/articles/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent/
  3. Install npm: https://docs.npmjs.com/getting-started/installing-node
  4. install composer: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx or https://getcomposer.org/doc/00-intro.md#installation-windows
  3. Install and configure Homestead VM: https://laravel.com/docs/5.5/homestead#installation-and-setup
  4. Add berserkers.test to both the Homestead.yaml config and your /etc/hosts/ or Windows hosts file.
  5. vagrant reload --provision
  6. Inside the project root run composer install
  7. Inside the project root duplicate and then rename the .env.example file to .env.
  8. run php artisan key:generate in project root with in the VM (use vagrant ssh in the VM folder to get and then navigate to the root folder)
  9. Browse to http://berserkers.test
  10. Develop like the wind!

# Working with the databse

  When working with database related issues use php artisan migrate (or php artisan migrate:fresh if the migration had been done once beefore and you whant to update some tables or just refresh the information). To fill the databse with movies, series, cast run php artisan seed:db (this takes a while, so feel free to commentout some of the series and or movies int the movies or series seeder for a speedier seed).

# Compiling style-sheets

 
 Add your files to the mix-mainfest https://laravel.com/docs/5.5/mix#working-with-stylesheets
 Run npm run dev or npm run watch-poll (the later compiles everytime you save you stylesheet) https://laravel.com/docs/5.5/mix#running-mix

 If you are working on a spesific page please use the setup for automaticly geeting the right css file loaded on your page by including all the scss files you need (and I meen only those you actualy need) in a sccs file with the same name as the path of your page (and of course add that scss file to the mix-mainfest.json file)
 (this feeture is not yeat merged curently only exists in the three-reg-page branch)

# Setup for using deployer

  1. run "vim ~/.ssh/config"
  2. paste this in to the file: 
     
     > Host berzerkers
      >  Hostname 104.131.98.20
       > IdentityFile ~/.ssh/id_rsa
        >AddKeysToAgent yes

  3. If using windows it's adviceble first install WSL (https://docs.microsoft.com/en-us/windows/wsl/install-win10) and then use Bash on Ubuntu on Windows and       make create new ssh keys and make shure that they are accesible in the Bash adding this:

      > SSH_ENV="$HOME/.ssh/environment"
      >
      > function start_agent {
      >   echo "Initializing new SSH agent..."
      >   touch $SSH_ENV
      >   chmod 600 "${SSH_ENV}"
      >   /usr/bin/ssh-agent | sed 's/^echo/#echo/' >> "${SSH_ENV}"
      >   . "${SSH_ENV}" > /dev/null
      >   /usr/bin/ssh-add
      >}
    >
     > if [ -f "${SSH_ENV}" ]; then
     >     . "${SSH_ENV}" > /dev/null
     >     kill -0 $SSH_AGENT_PID 2>/dev/null || {
     >        start_agent
     >     }
     > else
     >     start_agent
     > fi

      to your .bashrc(or .zshrc if using om-my-zsh) and adding this:

     > Host *
      >  ProxyCommand nc %h %p %r
      >  ForwardAgent yes

      to your ssh config file should to the trick!
  4. send your public ssh key to admin to alow setup for access to the Berzerers server
  5. Try if access has been granted by running "ssh deploy@Berzerkers" and then run exit to return to your local machine (if you where able to acces the server)
  6. If step 5 is successfull the setup is done.


# Doing a deploy

  1. Start by checking that everything thats merged in to dev is working (and make shure to run git pull before to make shure you have the latest updates loacly)
  2. Merge dev to stage (run "git merge dev" while in the stage branch). Please use this guide on rebase git flow to keep merge conflict at an minimum     https://raygun.com/blog/git-workflow/
  3. Check that everyting still works localy
  4. Make shure to push after merging
  5. run "npm run dev" to build all resources (trying to setup a autmatic build with deployer, will remove this stage when it's done)
  6. run "php dep deploy stage" (or "php dep deploy prod" for deploying from master but only after repeeting steps 1-5 from stage branch to master branch)
  7. Check out the result at http://stage.berzerkermovies.me ( or http://berzerkermovies.me if deploying from master)



