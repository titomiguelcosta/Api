execute "setfacl -R -m u:#{node[:apache][:user]}:rwx -m u:vagrant:rwx #{node[:api][:dir]}/app/cache #{node[:api][:dir]}/app/logs"
execute "setfacl -dR -m u:#{node[:apache][:user]}:rwx -m u:vagrant:rwx #{node[:api][:dir]}/app/cache #{node[:api][:dir]}/app/logs"

execute "echo '127.0.0.1 api.sportlobster.dev api.sportlobster.test' >> /etc/hosts"