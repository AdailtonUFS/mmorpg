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
-- PENSAR NISSO!!!!!!!!!!!!!!!!!!!!!!!!!!!
--___________________________________________


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
-- PENSAR NISSO !!!!!!!!!!!!!!!
--_______________________________________


-- Consulta usando função de agregação
-- Buscar o nome da pessoa com o pernosagem mais poderoso e verificar o status da conta da pessoa
SELECT u."name", a.created_at, a.status
FROM "characters" c
         JOIN accounts a ON c.account_id = a.id
         JOIN users u ON a.user_cpf = u.cpf
WHERE c.damage = (SELECT MAX(damage) FROM "characters");


