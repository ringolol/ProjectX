USE projectx_db;

INSERT INTO users (username, email, password)
	VALUES 
		('John','JohnHK@mail.com','123321'),
		('Michael','Mike88@mail.com','321123'),
        ('Rosa','Rossalia@mail.com','r123321');
        
INSERT INTO devices (android_id)
	VALUES 
		('krakoziabra123'),
		('krakoziabra456'),
        ('krakoziabra789'),
        ('krakoziabra101'),
        ('krakoziabra111'),
        ('krakoziabra121'),
        ('krakoziabra314');
    
INSERT INTO locations (user_id, name)
	VALUES
		(1, 'STORE'),
        (3, 'STREET');
        
INSERT INTO devices_locations
	VALUE
		(1, 1, 'OUTSIDE #1'),
        (1, 3, 'OUTSIDE #2'),
        (1, 6, 'INSIDE #1'),
        (2, 2, 'ON DOOR'),
        (2, 7, 'ON WINDOW');
        
-- additional data
INSERT INTO locations (user_id, name)
	VALUES
		(3, 'FIRST_FLOOR');
        
INSERT INTO devices_locations
	VALUE
		(3, 5, 'RECEPTION');

		