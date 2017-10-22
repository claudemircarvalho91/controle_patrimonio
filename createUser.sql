CREATE USER queops WITH
	LOGIN
	SUPERUSER
	CREATEDB
	CREATEROLE
	INHERIT
	REPLICATION
	CONNECTION LIMIT -1
	PASSWORD 'xxxxxx';
GRANT postgres, pg_read_all_settings TO queops WITH ADMIN OPTION;
COMMENT ON ROLE queops IS 'Sobre o banco de dados:
• Nome do banco: patrimonio
• Usuário: queops
• Senha: piramide';
