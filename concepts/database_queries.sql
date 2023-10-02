-- Consulta simples usando somente o básico SELECT, FROM, WHERE
-- Buscar todas as contas ativas
SELECT *
FROM accounts
WHERE status = 'active';


-- Consulta usando LIKE
-- Buscar usuário com nomes com Sr.
SELECT *
FROM users
WHERE name LIKE 'Sr.%';


-- Consulta usando operadores de conjuntos
-- Buscar o nome e level dos players 61 e 62
SELECT c.name AS character_name, c.level AS character_level
FROM characters c
WHERE c.account_id = 61
UNION
SELECT c.name AS character_name, c.level AS character_level
FROM characters c
WHERE c.account_id = 62;


-- Consulta usando um JOIN
-- Buscar o nome, email e cpf de dos donos das contas que foram banidas
SELECT u."name", u.email, u.cpf, a.status, a.updated_at
FROM accounts a
         JOIN users u ON a.user_cpf = u.cpf
WHERE a.status = 'banned'


-- Consulta usando mais de um JOIN
-- Buscar a classe dos personagems das contas não banidas que tenha pelo menos 100 de dano
SELECT u."name" , a.created_at, c."name", c."level", c.damage, c2."name", c2.difficulty
FROM accounts a
         JOIN users u ON a.user_cpf = u.cpf
         JOIN "characters" c ON c.account_id = a.id
         JOIN classes c2 ON c.class_id = c2.id
WHERE c.damage >= 100
  AND a.status = 'active'


-- Consulta usando OUTER JOIN
-- Buscar as informações da conta e caso exista buscar informações de personagem
SELECT u.name AS user_name, a.status AS account_status, c.name AS character_name, c.level AS character_level
FROM users u
         LEFT OUTER JOIN accounts a ON u.cpf = a.user_cpf
         LEFT OUTER JOIN characters c ON a.id = c.account_id;


-- Consulta usando função de agregação
-- Buscar o nome da pessoa com o pernosagem mais poderoso e verificar o status da conta da pessoa
SELECT u."name", a.created_at, a.status
FROM "characters" c
         JOIN accounts a ON c.account_id = a.id
         JOIN users u ON a.user_cpf = u.cpf
WHERE c.damage = (SELECT MAX(damage) FROM "characters");


-- Consulta usando GROUP BY
SELECT COUNT(C.id) AS quantity_by_difficulty, c2.difficulty
FROM "characters" c
         JOIN classes c2 ON c2.id = c.class_id
GROUP BY c2.difficulty
ORDER BY quantity_by_difficulty ASC


-- Consulta usando operador IN
-- Buscar contas ativas nos servers 1, 2 e 3
SELECT *
FROM accounts
WHERE server_id IN (1, 2, 3) AND status = 'active';

-- Consulta usando operador EXISTS
-- Buscar contas que têm pelo menos um personagem com nível >50
SELECT *
FROM accounts a
WHERE EXISTS (
    SELECT 1
    FROM characters c
    WHERE c.account_id = a.id
      AND c.level >= 450
);

--Consulta usando operador SOME

SELECT name, level
FROM guilds
WHERE level >= SOME (
    SELECT level
    FROM guilds
    WHERE name = 'MinhaGuilda'
);

-- Consulta usando operador ALL
-- Buscar todos os servidores nos quais todos os usuários sejam ativos
SELECT s.id, s.name
FROM servers s
WHERE 'active' = ALL (
    SELECT a.status
    FROM accounts a
    WHERE a.server_id = s.id
);

-- Consulta aninhadas no FROM
-- Buscar todas as guilds que participaram de uma guerra
SELECT g.name AS guild_name
FROM guilds g
WHERE EXISTS (
    SELECT 1
    FROM guild_war gw
             INNER JOIN guild_war gg ON g.id = gg.guild_id
    WHERE gw.war_id = gg.war_id
);

