to run the program

cd ~/CMPT470-GROUP11/online_bidding

enter "composer update"

cd .. (to CMPT470-GROUP11 folder)

vagrant up

vagrant ssh

enter "sudo apt install mysql-server -y"

enter password root, root

enter "mysql -u root -p"

password: root

mysql> create database online_bid;

ctrl+Z to exit

"cd project/online_bidding"

"php artisan migrate"

"php artisan db:seed"

"php artisan serve --port=8000 --host=192.168.10.10"

http://192.168.10.10:8000
