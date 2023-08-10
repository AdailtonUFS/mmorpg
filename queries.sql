-- USER TABLE
CREATE TABLE IF NOT EXISTS users (
	cpf VARCHAR(15) PRIMARY KEY,
	name VARCHAR (200) NOT NULL,
	email VARCHAR (200) NOT NULL,
	password VARCHAR (200) NOT NULL,
	created_at TIMESTAMP NOT NULL,
	updated_at TIMESTAMP NOT NULL
);

-- SERVER TABLE
CREATE TABLE IF NOT EXISTS servers (
	id serial PRIMARY KEY,
	name VARCHAR (50) NOT NULL,
	created_at TIMESTAMP NOT NULL,
	updated_at TIMESTAMP NOT NULL
);

-- TABLE TO STORE SERVER STATUS HISTORY
CREATE TYPE status_server AS ENUM('active', 'deactivated', 'maintenance');
CREATE TABLE IF NOT EXISTS servers_status(
	id serial PRIMARY KEY,
	server_id INT NOT NULL,
	status status_server DEFAULT 'active' NOT NULL,
	created_at TIMESTAMP NOT NULL,
	FOREIGN KEY (server_id) REFERENCES servers (id)
);

-- GUILD TABLE
CREATE TABLE IF NOT EXISTS guilds(
	id serial PRIMARY KEY,
	server_id INT NOT NULL,
	name VARCHAR(50) NOT NULL UNIQUE,
	level SMALLINT NOT NULL,
	shield TEXT,
	description VARCHAR(200),
	created_at TIMESTAMP NOT NULL,
	updated_at TIMESTAMP NOT NULL,
	FOREIGN KEY (server_id) REFERENCES servers (id)
);

-- WAR TABLE
CREATE TABLE IF NOT EXISTS wars(
	id serial PRIMARY KEY,
	name VARCHAR(45) NOT NULL,
	created_at TIMESTAMP NOT NULL
);

-- GUILD WAR RELATION
CREATE TABLE IF NOT EXISTS guild_war(
	id serial PRIMARY KEY,
	guild_id INT NOT NULL,
	war_id INT NOT NULL,
	winner BOOLEAN NOT NULL,-- NOT NULL MESMO?
	FOREIGN KEY (guild_id) REFERENCES guilds (id),
	FOREIGN KEY (war_id) REFERENCES wars (id)
);

-- ACCOUNT TABLE
CREATE TYPE status_account AS ENUM('active', 'banned', 'inactive');
CREATE TABLE IF NOT EXISTS accounts(
	id serial PRIMARY KEY,
	user_cpf VARCHAR(15) NOT NULL,
	server_id INT NOT NULL,
	status status_account DEFAULT 'active' NOT NULL,
	created_at TIMESTAMP NOT NULL,
	updated_at TIMESTAMP NOT NULL,
	CONSTRAINT unique_account_in_server UNIQUE (user_cpf, server_id),
	FOREIGN KEY (user_cpf) REFERENCES users (cpf),
	FOREIGN KEY (server_id) REFERENCES servers (id)
);


-- TABLE TO STORE RELATION ACCOUNT GUILD
CREATE TYPE account_guild_status AS ENUM('active', 'expelled', 'left');
CREATE TABLE IF NOT EXISTS account_guild(
	id serial PRIMARY KEY,
	account_id INT NOT NULL,
	guild_id INT NOT NULL,
	created_at TIMESTAMP NOT NULL,
	updated_at TIMESTAMP NOT NULL,
	status account_guild_status DEFAULT 'active' NOT NULL,
	FOREIGN KEY (account_id) REFERENCES accounts (id),
	FOREIGN KEY (guild_id) REFERENCES guilds (id)
);

-- BATTLE TABLE
CREATE TABLE IF NOT EXISTS battles(
	id serial PRIMARY KEY,
	created_at TIMESTAMP NOT NULL
);

-- BATTLE HISTORY BETWEEN ACCOUNTS

CREATE TABLE IF NOT EXISTS account_battle(
	id serial PRIMARY KEY,
	account_id INT NOT NULL,
	battle_id INT NOT NULL,
	guild_war_id INT,
	winner BOOLEAN NOT NULL,
	FOREIGN KEY (account_id) REFERENCES accounts (id),
	FOREIGN KEY (battle_id) REFERENCES battles (id),
	FOREIGN KEY (guild_war_id) REFERENCES guild_war (id)
);

-- FRIENDSHIP TABLE

CREATE TABLE IF NOT EXISTS friendships(
	id serial PRIMARY KEY,
	account_id_1 INT NOT NULL,
	account_id_2 INT NOT NULL,
	created_at TIMESTAMP NOT NULL,
	CONSTRAINT unique_friendship_between_accounts UNIQUE (account_id_1, account_id_2),
	FOREIGN KEY (account_id_1) REFERENCES accounts (id),
	FOREIGN KEY (account_id_2) REFERENCES accounts (id)
);

-- CLASSES TABLE
CREATE TYPE class_difficulty AS ENUM('easy', 'medium', 'hard');
CREATE TABLE IF NOT EXISTS classes(
	id serial PRIMARY KEY,
	name VARCHAR(50) NOT NULL,
	difficulty class_difficulty NOT NULL,
	description VARCHAR(200)
);

-- SKILLS TABLE
CREATE TABLE IF NOT EXISTS skills(
	id serial PRIMARY KEY,
	class_id INT NOT NULL,
	name VARCHAR(50) NOT NULL,
	description VARCHAR(100) NOT NULL,
	FOREIGN KEY (class_id) REFERENCES classes (id)
);

-- CHARACTERS TABLE
CREATE TABLE IF NOT EXISTS characters(
	id serial PRIMARY KEY,
	account_id INT NOT NULL,
	class_id INT NOT NULL,
	name VARCHAR(50) NOT NULL,
	level SMALLINT NOT NULL,
	damage REAL NOT NULL,
	defense REAL NOT NULL,
	resistence REAL NOT NULL,
	critical REAL NOT NULL,
	life REAL NOT NULL,
	honor INT,
	description VARCHAR(200),
	FOREIGN KEY (account_id) REFERENCES accounts (id),
	FOREIGN KEY (class_id) REFERENCES classes (id)
);

-- ITEMS TABLE
CREATE TABLE IF NOT EXISTS items(
	id serial PRIMARY KEY,
	name VARCHAR(45) NOT NULL,
	critical REAL NOT NULL,
	damage REAL NOT NULL,
	defense REAL NOT NULL,
	description VARCHAR(200) NOT NULL,
	life REAL NOT NULL,
	rarity VARCHAR (45) NOT NULL,
	resistence REAL NOT NULL
);

-- ITEMS IN ACCOUNT
CREATE TYPE account_item_status AS ENUM('traded', 'won');
CREATE TABLE IF NOT EXISTS account_item(
	id serial PRIMARY KEY,
	account_id INT NOT NULL,
	item_id INT NOT NULL,
	quantity SMALLINT NOT NULL,
	status account_item_status NOT NULL,
	FOREIGN KEY (account_id) REFERENCES accounts (id),
	FOREIGN KEY (item_id) REFERENCES items (id)
);

-- ITEMS IN ACCOUNT IN CHARACTER
CREATE TABLE IF NOT EXISTS character_item(
	character_id INT,
	account_item_id INT,
	PRIMARY KEY (character_id, account_item_id),
	FOREIGN KEY (character_id) REFERENCES characters (id),
	FOREIGN KEY (account_item_id) REFERENCES account_item (id)
);

-- OFFER TABLE
CREATE TYPE offer_status AS ENUM('open', 'closed');
CREATE TABLE IF NOT EXISTS offers(
	id serial PRIMARY KEY,
	account_item_id INT NOT NULL,
	item_id INT NOT NULL,
	status offer_status NOT NULL,
	quantity_offer SMALLINT NOT NULL CHECK(quantity_offer >= 0),
	quantity_receive SMALLINT NOT NULL CHECK(quantity_receive >= 0),
	FOREIGN KEY (account_item_id) REFERENCES account_item (id),
	FOREIGN KEY (item_id) REFERENCES items (id)
);

-- TRADES TABLE
CREATE TABLE IF NOT EXISTS trades(
	id serial PRIMARY KEY,
	account_item_id_1 INT NOT NULL,
	account_item_id_2 INT NOT NULL,
	offer_id INT,
	quantity_item_trade_account_1 REAL NOT NULL CHECK(quantity_item_trade_account_1 >= 0),
	quantity_item_trade_account_2 REAL NOT NULL CHECK(quantity_item_trade_account_1 >= 0),
	FOREIGN KEY (account_item_id_1) REFERENCES account_item (id),
	FOREIGN KEY (account_item_id_2) REFERENCES account_item (id),
	FOREIGN KEY (offer_id) REFERENCES offers (id)		
);

