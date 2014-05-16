execute "echo '127.0.0.1 api.sportlobster.dev api.sportlobster.test' >> /etc/hosts"
execute "composer.phar install --no-interaction --working-dir #{node[:api][:dir]}"
execute "php #{node[:api][:dir]}/app/console doctrine:database:create --no-interaction"
execute "php #{node[:api][:dir]}/app/console doctrine:migrations:migrate --no-interaction"