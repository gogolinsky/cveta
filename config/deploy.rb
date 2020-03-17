# config valid only for current version of Capistrano
lock [">= 3.0.0", "< 4.0.0"]

# Application Settings
# set :application, ''
set :deploy_to, -> { "/home/dancecolor/domains/mastercveta.com" }
set :linked_dirs, %w{web/uploads runtime}
set :linked_files, %w{composer.phar .env web/sitemap.xml web/robots.txt}
set :keep_releases, 1

# Git Settings
set :scm, :git
set :repo_url, 'git@bitbucket.org:dancecolor/master-cveta.ru.git'

# Other
#set :group_writable, false
set :tmp_dir, "/home/dancecolor/temp"

set :composer_install_flags, '--no-dev'
set :composer_roles, :all
set :composer_working_dir, -> { fetch(:release_path) }
set :composer_dump_autoload_flags, '--optimize'
set :composer_download_url, "https://getcomposer.org/installer"
set :composer_version, '1.5.0'
SSHKit.config.command_map[:composer] = "php71 #{shared_path.join("composer.phar")}"

namespace :deploy do
    after :starting, 'composer:install_executable'

    task :change_symlink do
        on roles(:app) do
            execute "rm -d #{current_path}"
            execute "cd #{deploy_to} && if [ -L public_html ]; then rm public_html; fi"
            execute "cd #{deploy_to} && ln -s ./releases/#{File.basename release_path}/web public_html"
            info "Created public_html link"

            execute "cd #{deploy_to}/public_html && rm .htaccess && mv .htaccess-prod .htaccess"
            execute "cd #{deploy_to}/releases/#{File.basename release_path} && rm .htaccess"
            info "Fix .htaccesses"

            execute "cd #{deploy_to}/releases/#{File.basename release_path} && php71 yii migrate --interactive=0"
            #info "Apply migrations"

            execute "cd #{deploy_to}/releases/#{File.basename release_path} && rm -rf migrations"
            execute "cd #{deploy_to}/releases/#{File.basename release_path} && rm -rf src"
            info "Delete dev folders"
        end
    end

    after :deploy, 'deploy:change_symlink'
end
