# Make sure the Apt package lists are up to date, so we're downloading versions that exist.
cookbook_file "apt-sources.list" do
  path "/etc/apt/sources.list"
end

execute 'apt_update' do
  command 'apt-get update'
end

execute 'php7.0' do
  command 'apt-get install -y php7.0-cli'
end

execute 'composer' do
  command 'apt-get install -y composer'
end

execute 'mysql' do
  command 'apt-get install -y php-mysql'
end

execute 'mysql client' do
  command 'apt-get install -y mysql-client-core-5.7'
end

package "nginx"
cookbook_file "nginx-default" do
  path "/etc/nginx/sites-available/default"
end
service 'nginx' do
  action :restart
end

# Base configuration recipe in Chef.
package "wget"
package "ntp"
cookbook_file "ntp.conf" do
  path "/etc/ntp.conf"
end
execute 'ntp_restart' do
  command 'service ntp restart'
end

package 'php-mbstring'
package 'php-xml'
package 'php-gd'
package 'zip'
package 'unzip'
execute 'composer' do
  cwd '/home/ubuntu/project/online_bidding'
  command 'composer update'
end
package 'mysql-server'
execute 'mysql-setup' do
  command 'echo "create database IF NOT EXISTS online_bid;" | mysql -uroot'
end
execute 'mysql-perms' do
  command "echo \"GRANT ALL PRIVILEGES ON online_bid.* To 'projectuser'@'localhost' IDENTIFIED BY 'password'; flush privileges;\" | mysql -uroot"
end
execute 'composer' do
  cwd '/home/ubuntu/project/online_bidding'
  user 'ubuntu'
  command 'php artisan migrate && php artisan db:seed && php artisan serve --port=8000 --host=192.168.10.10'
end

