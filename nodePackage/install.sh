clear
echo "[+] Need root..."
echo "[+] Requirement python3 and php..."
read -p '[*] You Want install node monitor?[y/n]' se
if [ $se = "n" ];then
	exit 0
fi
clear
echo "[*] Installing python3"
apt install python3 -y
read -p '[Enter]' enter
clear
echo "[*] Install on /var/www/papazolaMasterMonitor"
echo "[!] move if it doesn't match with your webserver"
cp -r ./papazolaMasterMonitor /var/www/
chmod -R 777 /var/www/papazolaMasterMonitor
chown -R www-data:www-data /var/www/papazolaMasterMonitor
read -p "[!] Setup a key ! [Enter]" enter
nano /var/www/papazolaMasterMonitor/index.php
read -p '[Enter]' enter
clear
echo "[*] Install App on /opt/papazolaMasterMonitorApps"
cp -r ./papazolaMasterMonitorApps /opt/
read -p "[!] Setup a config ! [Enter]" enter
nano /opt/papazolaMasterMonitorApps/config.json
echo "[*] Running App Checker"
cp ./papazolaMasterMonitor.service /etc/systemd/system/
systemctl start papazolaMasterMonitor.service
systemctl enable papazolaMasterMonitor.service
read -p 'Complete [Enter]' enter
clear

