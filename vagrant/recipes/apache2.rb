execute "apt-get -y install apache2"
execute "apt-get -y install libapache2-mod-php5"
execute "apt-get -y install apache2-mpm-itk"

template "#{node[:apache][:dir]}/sites-available/sportlobster.conf" do
  source "apache2/sportlobster.conf.erb"
end

execute "a2ensite sportlobster.conf"
execute "a2enmod rewrite"

execute "ln -sf /etc/php5/mods-available/custom.ini /etc/php5/apache2/conf.d/99-custom.ini"
execute "service apache2 restart"