[DELETE THIS ON ACTIVE WEBSERVERS BUT KEEP FOR PERSONAL USE]


Database Backup Run in Cron from command:

	30 3 * * mon mysqldump umbrellaDB > /home/kcooper/sqlBackup/backup.


Login Section:
	Username,Password,Tone
	kcooper,v53rFIPd,314014
	ekirk,L1u6pgtJ,990876
	wbirkin,KqKFJT95,661392
	awesker,YDc25oSx,694561
	awong,3e5Q1shM,953571
	jclemens,eCuN58V8,962417
	hunk,QH3strQc,677345

To get SSL:

	sudo dnf install mod_ssl
	sudo service httpd restart
	sudo service httpd status

	Edit /etc/httpd/conf/httpd.conf
	We will add a default VirtualHost entry
	<VirtualHost *:80>
	Redirect /umbrella https://127.0.0.1/umbrella
	</VirtualHost>
	

Database Delete Last Bad Entry:

	delete from [table] order by userid desc limit 1

Database Creation:

	Create umbrellaDB and populate the tables:
		create DATABASE `umbrellaDB`;
		use umbrellaDB;

		CREATE TABLE IF NOT EXISTS `employeeData` ( `userid` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NULL , `email` VARCHAR(50) NULL , `telephone` VARCHAR(50) NULL , `division` VARCHAR(20) NULL , `geolocation` VARCHAR(100) NULL , `facility` VARCHAR(120) NULL , `position` VARCHAR(50) NULL , `dob` INT NULL , PRIMARY KEY (`userid`)) ENGINE = InnoDB;
		Use employee_table.txt --> chmod 755 /home/kaco0964/employee_table_x.txt
		head employee_table_x.txt
		awk -F "," '{ print "NULL , " $1 " , " $2 " , " $3 " , " $4 " , " $5 " , " $6 " , " $7" , " $8 " , NULL" }' /home/kaco0964/employee_table_x.txt > /home/kaco0964/temp/employee_table_x.txt
		LOAD DATA LOCAL INFILE '/home/kaco0964/temp/employee_table_x.txt' INTO TABLE employeeData FIELDS TERMINATED BY ' , ' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\n';

		CREATE TABLE IF NOT EXISTS `loginData` ( `userid` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(256) NULL , `email` VARCHAR(50) NULL , `hash` VARCHAR(256) NULL , `salt` VARCHAR(64) NULL , `sound` VARCHAR(64) NULL , `confirmed` VARCHAR(10) NULL , PRIMARY KEY (`userid`) , UNIQUE INDEX `username_UNIQUE` (`username` ASC)) ENGINE = InnoDB;
		Use login_table_x.txt --> chmod 755 /home/kaco0964/login_table_x.txt
		head login_table_x.txt
		awk -F "," '{ print "NULL , " $1 " , " $2 " , " $3 " , " $4 " , " $5 " , " $6 " , NULL" }' /home/kaco0964/login_table_x.txt > /home/kaco0964/temp/login_table_x.txt
		LOAD DATA LOCAL INFILE '/home/kaco0964/temp/login_table_x.txt' INTO TABLE loginData FIELDS TERMINATED BY ' , ' OPTIONALLY ENCLOSED BY '"' LINES TERMINATED BY '\n';

		CREATE TABLE IF NOT EXISTS `loginAttempts`(`ip` VARCHAR( 20 ) NOT NULL ,`attempts` INT NOT NULL ,`lastlogin` DATETIME NOT NULL); 

	Database Files:

		employee_table_x.txt

		"Kade Cooper","kcooper@UmbrellaInc.com","303 555 0140","IT","Thousand Oaks","Umbrella IT Center","Admin","1994"
		"Edward Kirk","ekirk@UmbrellaInc.com","202 555 0135","Third Energy","Borginia","Ibis Island","Head Energy Researcher","1977"
		"William Birkin","wbirkin@UmbrellaInc.com","202 555 0107","Genetics","Raccoon City","Underground R&D Racooon City Center","Research Virologist","1962"
		"Albert Wesker","awesker@UmbrellaInc.com","202 555 0153","Genetics","Tokyo","Raccoon Police Department","Research Virologist","1960"
		"Ada Wong","awong@UmbrellaInc.com","202 555 0127","U.S.S.","Tokyo","Japan Global Operations","PMC","1974"
		"John Clemens","jclemens@UmbrellaInc.com","202 555 0124","Genetics","Raccoon City","R&D Arklay Center","Research Virologist","1972"
		"HUNK","hunk@UmbrellaInc.com","202 555 0159","U.S.S.","Rockfort Island","CLASSIFIED","PMC","0000"


		login_table_x.txt

		"kcooper","kcooper@UmbrellaInc.com","MUnpax89MK5QI","MUQ3Q1dPUVU3a3hVRnU1d0FLeWdJNVFod0cyQU83","MUnhZzo4jHVBw","Yes"
		"ekirk","ekirk@UmbrellaInc.com","MUecoz9QWNhyg","MUQ3Q1dPUVU3a3hVRnU1d0FLeWdJNVFod0cyQU83","MUuSCD6JZ.MaY","Yes"
		"wbirkin","wbirkin@UmbrellaInc.com","MUlI45Ly2nXUE","MUQ3Q1dPUVU3a3hVRnU1d0FLeWdJNVFod0cyQU83","MUZ1aE/ny83iY","Yes"
		"awesker","awesker@UmbrellaInc.com","MUTVaErK6g5ec","MUQ3Q1dPUVU3a3hVRnU1d0FLeWdJNVFod0cyQU83","MUerVepF66gB.","Yes"
		"awong","awong@UmbrellaInc.com","MUtuM4cogbOik","MUQ3Q1dPUVU3a3hVRnU1d0FLeWdJNVFod0cyQU83","MUCo65kG0vz/Q","Yes"
		"jclemens","jclemens@UmbrellaInc.com","MUukmWC/0Qwqw","MUQ3Q1dPUVU3a3hVRnU1d0FLeWdJNVFod0cyQU83","MUcHWp8jbmx.2","Yes"
		"hunk","hunk@UmbrellaInc.com","MU.MxFJZ7ytfU","MUQ3Q1dPUVU3a3hVRnU1d0FLeWdJNVFod0cyQU83","MUZh82hJ82ncA","Yes"
		

