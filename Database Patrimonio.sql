-- Database: patrimonio

-- DROP DATABASE patrimonio;

CREATE DATABASE patrimonio
    WITH 
    OWNER = queops
    ENCODING = 'UTF8'
    LC_COLLATE = 'Portuguese_Brazil.1252'
    LC_CTYPE = 'Portuguese_Brazil.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;

COMMENT ON DATABASE patrimonio
    IS 'Sobre o banco de dados:
• Nome do banco: patrimonio
• Usuário: queops
• Senha: piramide';

GRANT TEMPORARY, CONNECT ON DATABASE patrimonio TO PUBLIC;

GRANT CREATE, CONNECT ON DATABASE patrimonio TO queops;
GRANT TEMPORARY ON DATABASE patrimonio TO queops WITH GRANT OPTION;
