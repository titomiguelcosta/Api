group node[:cookbook][:group]

user node[:cookbook][:user] do
  group node[:cookbook][:group]
  system true
  shell '/bin/bash'
end