-- ANDROID QUERIES
-- #1 update device status by android_id
USE projectx_db;
UPDATE devices SET 
	latitude = 11, 
    longitude = 22,
    charge_level = 95,
    charge_status = 'charging'
WHERE android_id = 'krakoziabra111';

-- #2 get color balance by android_id
USE projectx_db;
SELECT color_balance
FROM devices
WHERE android_id = 'krakoziabra111';

-- #3 register device by android_id
USE projectx_db;
INSERT INTO devices (android_id)
	VALUES ('abcdef123');

-- WEB QUERIES
-- #1 set color balance by android_id
USE projectx_db;
UPDATE devices SET color_balance = 45
WHERE android_id = 'krakoziabra111';

-- #2 get device status by android_id
USE projectx_db;
SELECT 
	latitude, 
	longitude,
    charge_level,
    charge_status,
    temperature
FROM devices
WHERE android_id = 'krakoziabra111';

-- #3 register a user
USE projectx_db;
INSERT INTO users (name, email, password)
VALUES ('some_name', 'some_email@mail.com', 'some_password');

-- #4 get user's password
USE projectx_db;
SELECT password
FROM users
WHERE name = 'John';

-- #5 get location by user name
USE projectx_db;
SELECT location_id, name
FROM locations
WHERE user_id IN
	(SELECT user_id FROM users WHERE name = 'Rosa');
    
-- #6 get devices by location
USE projectx_db;
SELECT *
FROM devices
WHERE device_id IN
	(SELECT device_id 
     FROM devices_locations
     WHERE location_id = '2');