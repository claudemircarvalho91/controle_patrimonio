--
-- PostgreSQL database dump
--

-- Dumped from database version 10.0
-- Dumped by pg_dump version 10.0

-- Started on 2017-10-31 23:08:06

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2861 (class 1262 OID 16852)
-- Name: patrimonio; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE patrimonio WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';


ALTER DATABASE patrimonio OWNER TO postgres;

\connect patrimonio

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 1 (class 3079 OID 12924)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- TOC entry 2863 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 196 (class 1259 OID 16853)
-- Name: BaixaBemPatrimonial; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "BaixaBemPatrimonial" (
    numero integer NOT NULL,
    data date NOT NULL,
    tipo character(1) NOT NULL,
    motivo character varying(500) NOT NULL,
    "idUsuario" integer NOT NULL
);


ALTER TABLE "BaixaBemPatrimonial" OWNER TO postgres;

--
-- TOC entry 197 (class 1259 OID 16859)
-- Name: BemPatrimonial; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE "BemPatrimonial" (
    numero integer NOT NULL,
    descricao character varying(80) NOT NULL,
    "dataCompra" date NOT NULL,
    "prazoGarantia" integer NOT NULL,
    "nrNotaFiscal" integer NOT NULL,
    fornecedor character varying(60),
    valor numeric(15,2) NOT NULL,
    situacao character(1) NOT NULL,
    "codCategoria" integer NOT NULL,
    "numSala" integer NOT NULL
);


ALTER TABLE "BemPatrimonial" OWNER TO postgres;

--
-- TOC entry 198 (class 1259 OID 16862)
-- Name: categorias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE categorias (
    codigo integer NOT NULL,
    nome character varying(50) NOT NULL,
    descricao character varying(400) NOT NULL,
    vidautil integer NOT NULL
);


ALTER TABLE categorias OWNER TO postgres;

--
-- TOC entry 199 (class 1259 OID 16865)
-- Name: categorias_codigo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE categorias_codigo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE categorias_codigo_seq OWNER TO postgres;

--
-- TOC entry 2864 (class 0 OID 0)
-- Dependencies: 199
-- Name: categorias_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE categorias_codigo_seq OWNED BY categorias.codigo;


--
-- TOC entry 200 (class 1259 OID 16867)
-- Name: departamentos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE departamentos (
    sigla character(5) NOT NULL,
    nome character varying(30) NOT NULL
);


ALTER TABLE departamentos OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 16870)
-- Name: mbp; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE mbp (
    numero integer NOT NULL,
    "dataSolicitacao" date NOT NULL,
    motivo character varying(200) NOT NULL,
    "dataConfirmacao" date NOT NULL,
    "horaConfirmacao" time without time zone NOT NULL,
    "idSolicitante" integer NOT NULL,
    "idAutorizador" integer,
    "numeroBem" integer NOT NULL,
    "numSalaOrigem" integer NOT NULL,
    "numSalaDestino" integer NOT NULL
);


ALTER TABLE mbp OWNER TO postgres;

--
-- TOC entry 202 (class 1259 OID 16873)
-- Name: predios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE predios (
    codigo integer NOT NULL,
    nome character varying(50) NOT NULL,
    cep integer NOT NULL,
    logradouro character varying(60) NOT NULL,
    numero character varying(10) NOT NULL,
    complemento character varying(60),
    bairro character varying(40) NOT NULL,
    cidade character varying(50) NOT NULL,
    uf character(2) NOT NULL
);


ALTER TABLE predios OWNER TO postgres;

--
-- TOC entry 203 (class 1259 OID 16876)
-- Name: predios_codigo_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE predios_codigo_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE predios_codigo_seq OWNER TO postgres;

--
-- TOC entry 2865 (class 0 OID 0)
-- Dependencies: 203
-- Name: predios_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE predios_codigo_seq OWNED BY predios.codigo;


--
-- TOC entry 204 (class 1259 OID 16878)
-- Name: salas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE salas (
    numero integer NOT NULL,
    comprimento numeric(5,2) NOT NULL,
    largura numeric(5,2) NOT NULL,
    descricao character varying(80),
    codpredio integer NOT NULL,
    sigladpto character(5) NOT NULL
);


ALTER TABLE salas OWNER TO postgres;

--
-- TOC entry 205 (class 1259 OID 16881)
-- Name: salas_numero_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE salas_numero_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE salas_numero_seq OWNER TO postgres;

--
-- TOC entry 2866 (class 0 OID 0)
-- Dependencies: 205
-- Name: salas_numero_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE salas_numero_seq OWNED BY salas.numero;


--
-- TOC entry 206 (class 1259 OID 16883)
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE usuarios (
    id integer NOT NULL,
    login character varying(20) NOT NULL,
    nome character varying(50) NOT NULL,
    senha character varying(32) NOT NULL,
    email character varying(80) NOT NULL,
    tipo character(1) NOT NULL,
    sigladpto character(5)
);


ALTER TABLE usuarios OWNER TO postgres;

--
-- TOC entry 207 (class 1259 OID 16886)
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE usuarios_id_seq OWNER TO postgres;

--
-- TOC entry 2867 (class 0 OID 0)
-- Dependencies: 207
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuarios_id_seq OWNED BY usuarios.id;


--
-- TOC entry 2705 (class 2604 OID 16888)
-- Name: categorias codigo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY categorias ALTER COLUMN codigo SET DEFAULT nextval('categorias_codigo_seq'::regclass);


--
-- TOC entry 2706 (class 2604 OID 16889)
-- Name: predios codigo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY predios ALTER COLUMN codigo SET DEFAULT nextval('predios_codigo_seq'::regclass);


--
-- TOC entry 2707 (class 2604 OID 16890)
-- Name: usuarios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios ALTER COLUMN id SET DEFAULT nextval('usuarios_id_seq'::regclass);


--
-- TOC entry 2845 (class 0 OID 16853)
-- Dependencies: 196
-- Data for Name: BaixaBemPatrimonial; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2846 (class 0 OID 16859)
-- Dependencies: 197
-- Data for Name: BemPatrimonial; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2847 (class 0 OID 16862)
-- Dependencies: 198
-- Data for Name: categorias; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2849 (class 0 OID 16867)
-- Dependencies: 200
-- Data for Name: departamentos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO departamentos (sigla, nome) VALUES ('SECOM', 'Secretaria de Comunicação');
INSERT INTO departamentos (sigla, nome) VALUES ('SEJUR', 'Secretaria de Justiça');
INSERT INTO departamentos (sigla, nome) VALUES ('SEGOV', 'Secretaria de Governo');


--
-- TOC entry 2850 (class 0 OID 16870)
-- Dependencies: 201
-- Data for Name: mbp; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2851 (class 0 OID 16873)
-- Dependencies: 202
-- Data for Name: predios; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO predios (codigo, nome, cep, logradouro, numero, complemento, bairro, cidade, uf) VALUES (2, 'Predio A', 75896412, 'Rua da divisa', '10', 'avenida', 'morada do morro', 'senador canedo', 'GO');


--
-- TOC entry 2853 (class 0 OID 16878)
-- Dependencies: 204
-- Data for Name: salas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO salas (numero, comprimento, largura, descricao, codpredio, sigladpto) VALUES (1234, 120.00, 90.00, 'Teste de sala com acentuação 2', 1, 'SECOM');
INSERT INTO salas (numero, comprimento, largura, descricao, codpredio, sigladpto) VALUES (10, 5.00, 9.00, 'meio pequeno', 2, 'SECOM');


--
-- TOC entry 2855 (class 0 OID 16883)
-- Dependencies: 206
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO usuarios (id, login, nome, senha, email, tipo, sigladpto) VALUES (7, 'rafael.couto', 'Rafael Couto', '4badaee57fed5610012a296273158f5f', '102030@senha.com', 'D', 'SEGOV');
INSERT INTO usuarios (id, login, nome, senha, email, tipo, sigladpto) VALUES (4, 'bruno.rodrigues', 'Bruno Rodrigues', '4badaee57fed5610012a296273158f5f', '102030@senha.com', 'F', 'SECOM');
INSERT INTO usuarios (id, login, nome, senha, email, tipo, sigladpto) VALUES (3, 'elias.ferreira', 'Elias Ferreira', '4badaee57fed5610012a296273158f5f', '102030@senha.com', 'P', 'SEJUR');
INSERT INTO usuarios (id, login, nome, senha, email, tipo, sigladpto) VALUES (2, 'claudemir.carvalho', 'Claudemir Carvalho', '4badaee57fed5610012a296273158f5f', '102030@senha.com', 'P', 'SECOM');
INSERT INTO usuarios (id, login, nome, senha, email, tipo, sigladpto) VALUES (8, 'matheus.ribeiro', 'Matheus Ribeiro', '4badaee57fed5610012a296273158f5f', '102030@senha.com', 'P', 'SEJUR');


--
-- TOC entry 2868 (class 0 OID 0)
-- Dependencies: 199
-- Name: categorias_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('categorias_codigo_seq', 2, true);


--
-- TOC entry 2869 (class 0 OID 0)
-- Dependencies: 203
-- Name: predios_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('predios_codigo_seq', 2, true);


--
-- TOC entry 2870 (class 0 OID 0)
-- Dependencies: 205
-- Name: salas_numero_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('salas_numero_seq', 1, false);


--
-- TOC entry 2871 (class 0 OID 0)
-- Dependencies: 207
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuarios_id_seq', 6, true);


--
-- TOC entry 2709 (class 2606 OID 16892)
-- Name: BaixaBemPatrimonial BaixaBemPatrimonial_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "BaixaBemPatrimonial"
    ADD CONSTRAINT "BaixaBemPatrimonial_pkey" PRIMARY KEY (numero);


--
-- TOC entry 2711 (class 2606 OID 16894)
-- Name: BemPatrimonial BemPatrimonial_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "BemPatrimonial"
    ADD CONSTRAINT "BemPatrimonial_pkey" PRIMARY KEY (numero);


--
-- TOC entry 2713 (class 2606 OID 16896)
-- Name: categorias categorias_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY categorias
    ADD CONSTRAINT categorias_pkey PRIMARY KEY (codigo);


--
-- TOC entry 2715 (class 2606 OID 16898)
-- Name: departamentos departamentos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY departamentos
    ADD CONSTRAINT departamentos_pkey PRIMARY KEY (sigla);


--
-- TOC entry 2717 (class 2606 OID 16900)
-- Name: mbp mbp_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mbp
    ADD CONSTRAINT mbp_pkey PRIMARY KEY (numero);


--
-- TOC entry 2719 (class 2606 OID 16902)
-- Name: predios predios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY predios
    ADD CONSTRAINT predios_pkey PRIMARY KEY (codigo);


--
-- TOC entry 2721 (class 2606 OID 16904)
-- Name: salas salas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY salas
    ADD CONSTRAINT salas_pkey PRIMARY KEY (numero);


--
-- TOC entry 2723 (class 2606 OID 16906)
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


-- Completed on 2017-10-31 23:08:06

--
-- PostgreSQL database dump complete
--
