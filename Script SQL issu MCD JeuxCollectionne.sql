CREATE TABLE ADDRESSES(
   id_address INT,
   city VARCHAR(150) NOT NULL,
   zip_code INT NOT NULL,
   address VARCHAR(350) NOT NULL,
   PRIMARY KEY(id_address)
);

CREATE TABLE PLAYERS_GAMES(
   id_game INT,
   id_player INT,
   PRIMARY KEY(id_game, id_player)
);

CREATE TABLE GAMES(
   id_game INT,
   name VARCHAR(150) NOT NULL,
   max_players INT NOT NULL,
   id_type__fk_ INT NOT NULL,
   PRIMARY KEY(id_game)
);

CREATE TABLE TYPES(
   id_type INT,
   name VARCHAR(150) NOT NULL,
   id_sub_type__fk_ INT,
   PRIMARY KEY(id_type)
);

CREATE TABLE SUBTYPES(
   id_subtype INT,
   name VARCHAR(150) NOT NULL,
   id_type INT NOT NULL,
   PRIMARY KEY(id_subtype),
   FOREIGN KEY(id_type) REFERENCES TYPES(id_type)
);

CREATE TABLE SELLERS(
   id_seller INT,
   name VARCHAR(150) NOT NULL,
   web_site VARCHAR(150) NOT NULL,
   id_address__fk_ INT NOT NULL,
   id_address INT NOT NULL,
   PRIMARY KEY(id_seller),
   FOREIGN KEY(id_address) REFERENCES ADDRESSES(id_address)
);

CREATE TABLE GAMES_SELLERS(
   id_seller INT,
   id_game INT,
   PRIMARY KEY(id_seller, id_game)
);

CREATE TABLE PLAYERS(
   id_player INT,
   last_name VARCHAR(50) NOT NULL,
   first_name VARCHAR(50) NOT NULL,
   age INT NOT NULL,
   mail VARCHAR(150) NOT NULL,
   password VARCHAR(50) NOT NULL,
   description VARCHAR(350),
   id_address__fk_ INT NOT NULL,
   id_address INT NOT NULL,
   PRIMARY KEY(id_player),
   UNIQUE(mail),
   FOREIGN KEY(id_address) REFERENCES ADDRESSES(id_address)
);

CREATE TABLE owns(
   id_player INT,
   id_game INT,
   id_player_1 INT,
   PRIMARY KEY(id_player, id_game, id_player_1),
   FOREIGN KEY(id_player) REFERENCES PLAYERS(id_player),
   FOREIGN KEY(id_game, id_player_1) REFERENCES PLAYERS_GAMES(id_game, id_player)
);

CREATE TABLE belongs(
   id_game INT,
   id_player INT,
   id_game_1 INT,
   PRIMARY KEY(id_game, id_player, id_game_1),
   FOREIGN KEY(id_game, id_player) REFERENCES PLAYERS_GAMES(id_game, id_player),
   FOREIGN KEY(id_game_1) REFERENCES GAMES(id_game)
);

CREATE TABLE categorized(
   id_game INT,
   id_type INT,
   PRIMARY KEY(id_game, id_type),
   FOREIGN KEY(id_game) REFERENCES GAMES(id_game),
   FOREIGN KEY(id_type) REFERENCES TYPES(id_type)
);

CREATE TABLE is_sold(
   id_game INT,
   id_seller INT,
   id_game_1 INT,
   PRIMARY KEY(id_game, id_seller, id_game_1),
   FOREIGN KEY(id_game) REFERENCES GAMES(id_game),
   FOREIGN KEY(id_seller, id_game_1) REFERENCES GAMES_SELLERS______(id_seller, id_game)
);

CREATE TABLE sells(
   id_seller INT,
   id_seller_1 INT,
   id_game INT,
   PRIMARY KEY(id_seller, id_seller_1, id_game),
   FOREIGN KEY(id_seller) REFERENCES SELLERS______(id_seller),
   FOREIGN KEY(id_seller_1, id_game) REFERENCES GAMES_SELLERS______(id_seller, id_game)
);
