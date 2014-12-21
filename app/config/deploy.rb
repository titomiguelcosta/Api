set :application, "api"
set :domain,      "#{application}.titomiguelcosta.com"
set :deploy_to,   "/home/ubuntu/websites/api"
set :app_path,    "app"

set :repository,  "https://github.com/titomiguelcosta/Api.git"
set :scm,         :git

set :model_manager, "doctrine"

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3

# Be more verbose by uncommenting the following line
# logger.level = Logger::MAX_LEVEL

set :user, "ubuntu"
set :use_sudo, false
set :shared_files, ["app/config/parameters.yml"]
set :shared_children, [app_path + "/logs", web_path + "/uploads", "vendor"]
set :use_composer, true
set :composer_options,  "--no-dev --verbose --prefer-dist --optimize-autoloader --no-progress --no-interaction"
set :update_vendors, true
set :vendors_mode, :install
set :copy_vendors, true
after "deploy", "deploy:cleanup"