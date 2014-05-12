#
# Cookbook Name:: cookbook
# Recipe:: default
#
# Copyright (C) 2014 YOUR_NAME
#
# All rights reserved - Do Not Redistribute
#

# make sure no questions are asked during the instalation process
ENV["DEBIAN_FRONTEND"] = "noninteractive"

include_recipe "build-essential"
include_recipe "apt"
include_recipe "cookbook::php"
include_recipe "cookbook::apache2"
include_recipe "cookbook::mysql"
include_recipe "cookbook::mongodb"
include_recipe "cookbook::memcached"

# install other utils
execute "apt-get -y install git"

include_recipe "cookbook::project"