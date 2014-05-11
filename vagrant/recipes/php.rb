execute "apt-get -y install php5-cli php-apc php5-json php5-intl php5-mcrypt php5-mongo php5-memcached php5-xdebug php5-curl php5-mysql php5-sqlite php5-tidy php5-gd php5-xmlrpc php5-xsl"
execute "cd /usr/local/bin && curl -sS https://getcomposer.org/installer | php"

template "#{node[:php][:dir]}/mods-available/xdebug.ini" do
  source "php/xdebug.ini"
end

template "#{node[:php][:dir]}/mods-available/custom.ini" do
  source "php/custom.ini"
end

execute "ln -sf /etc/php5/mods-available/custom.ini /etc/php5/cli/conf.d/99-custom.ini"