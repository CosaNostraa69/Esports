
-- SELECT * FROM player;

-- SELECT first_name , second_name FROM player;

-- SELECT COUNT(id) FROM team

-- SELECT name AS competition_name from competition 

-- SELECT name FROM game

-- SELECT name from competition WHERE cash_prize > 70000

-- SELECT name from competition WHERE cash_prize > 10000 AND cash_prize < 150000

-- SELECT * from sponsor LEFT JOIN team ON team_id = team_id WHERE team_id = 1 or team_id = 3;

-- SELECT * from player WHERE game_id = 1 or game_id = 3;

-- SELECT * FROM team WHERE name LIKE "%s%"; 

-- SELECT * from player ORDER BY city ASC;

-- SELECT * from player LEFT JOIN team ON team_id = team.id;

-- SELECT * from player left join game on game_id = game.id ORDER BY game_id DESC

-- SELECT * from player LEFT JOIN team on team_id = team.id LEFT JOIN game on game_id = game.id

-- SELECT * from player LEFT JOIN team on team_id = team.id WHERE game_id = 2 or game_id = 3

