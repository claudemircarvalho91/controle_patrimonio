--
-- PostgreSQL database dump
--

-- Dumped from database version 10.0
-- Dumped by pg_dump version 10.0

-- Started on 2017-10-23 13:06:25

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2854 (class 1262 OID 16394)
-- Name: patrimonio; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE patrimonio WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'Portuguese_Brazil.1252' LC_CTYPE = 'Portuguese_Brazil.1252';


ALTER DATABASE patrimonio OWNER TO postgres;

connect patrimonio

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
-- TOC entry 2856 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 196 (class 1259 OID 16441)
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
-- TOC entry 197 (class 1259 OID 16447)
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
-- TOC entry 198 (class 1259 OID 16450)
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
-- TOC entry 199 (class 1259 OID 16453)
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
-- TOC entry 2857 (class 0 OID 0)
-- Dependencies: 199
-- Name: categorias_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE categorias_codigo_seq OWNED BY categorias.codigo;


--
-- TOC entry 200 (class 1259 OID 16455)
-- Name: departamentos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE departamentos (
    sigla character(5) NOT NULL,
    nome character varying(30) NOT NULL
);


ALTER TABLE departamentos OWNER TO postgres;

--
-- TOC entry 201 (class 1259 OID 16458)
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
-- TOC entry 202 (class 1259 OID 16461)
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
-- TOC entry 203 (class 1259 OID 16464)
-- Name: salas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE salas (
    numero integer NOT NULL,
    comprimento numeric(5,2) NOT NULL,
    largura numeric(5,2) NOT NULL,
    dscricao character varying(80),
    "codPredio" integer NOT NULL,
    "siglaDpto" character(5) NOT NULL
);


ALTER TABLE salas OWNER TO postgres;

--
-- TOC entry 204 (class 1259 OID 16467)
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
-- TOC entry 205 (class 1259 OID 16470)
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
-- TOC entry 2858 (class 0 OID 0)
-- Dependencies: 205
-- Name: usuarios_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE usuarios_id_seq OWNED BY usuarios.id;


--
-- TOC entry 2701 (class 2604 OID 16472)
-- Name: categorias codigo; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY categorias ALTER COLUMN codigo SET DEFAULT nextval('categorias_codigo_seq'::regclass);


--
-- TOC entry 2702 (class 2604 OID 16473)
-- Name: usuarios id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios ALTER COLUMN id SET DEFAULT nextval('usuarios_id_seq'::regclass);


--
-- TOC entry 2840 (class 0 OID 16441)
-- Dependencies: 196
-- Data for Name: BaixaBemPatrimonial; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2841 (class 0 OID 16447)
-- Dependencies: 197
-- Data for Name: BemPatrimonial; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2842 (class 0 OID 16450)
-- Dependencies: 198
-- Data for Name: categorias; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO categorias (codigo, nome, descricao, vidautil) VALUES (1, 'Objetos', 'Computadores, laptops, tablets, insumos em geral.', 10);
INSERT INTO categorias (codigo, nome, descricao, vidautil) VALUES (2, 'Conzinha', 'Panela, colher, fogão', 5);


--
-- TOC entry 2844 (class 0 OID 16455)
-- Dependencies: 200
-- Data for Name: departamentos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO departamentos (sigla, nome) VALUES ('SECOM', 'Secretaria de Comunicação');
INSERT INTO departamentos (sigla, nome) VALUES ('SEJUR', 'Secretaria de Justiça');
INSERT INTO departamentos (sigla, nome) VALUES ('SEGOV', 'Secretaria de Governo');


--
-- TOC entry 2845 (class 0 OID 16458)
-- Dependencies: 201
-- Data for Name: mbp; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2846 (class 0 OID 16461)
-- Dependencies: 202
-- Data for Name: predios; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2847 (class 0 OID 16464)
-- Dependencies: 203
-- Data for Name: salas; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 2848 (class 0 OID 16467)
-- Dependencies: 204
-- Data for Name: usuarios; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO usuarios (id, login, nome, senha, email, tipo, sigladpto) VALUES (8, 'eliasfrr', 'Elias Ferreira', '827ccb0eea8a706c4c34a16891f84e7b', 'senha12345@com.br', 'D', 'SEJUR');
INSERT INTO usuarios (id, login, nome, senha, email, tipo, sigladpto) VALUES (1, 'claudemir.91', 'Claudemir Carvalho da Silva', 'd8ebbd0f7fcc21ebd988fc09e7e9dfeb', 'claudemir.91@outlook.com', 'P', 'SECOM');


--
-- TOC entry 2859 (class 0 OID 0)
-- Dependencies: 199
-- Name: categorias_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('categorias_codigo_seq', 2, true);


--
-- TOC entry 2860 (class 0 OID 0)
-- Dependencies: 205
-- Name: usuarios_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('usuarios_id_seq', 8, true);


--
-- TOC entry 2704 (class 2606 OID 16475)
-- Name: BaixaBemPatrimonial BaixaBemPatrimonial_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "BaixaBemPatrimonial"
    ADD CONSTRAINT "BaixaBemPatrimonial_pkey" PRIMARY KEY (numero);


--
-- TOC entry 2706 (class 2606 OID 16477)
-- Name: BemPatrimonial BemPatrimonial_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY "BemPatrimonial"
    ADD CONSTRAINT "BemPatrimonial_pkey" PRIMARY KEY (numero);


--
-- TOC entry 2708 (class 2606 OID 16479)
-- Name: categorias categorias_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY categorias
    ADD CONSTRAINT categorias_pkey PRIMARY KEY (codigo);


--
-- TOC entry 2710 (class 2606 OID 16481)
-- Name: departamentos departamentos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY departamentos
    ADD CONSTRAINT departamentos_pkey PRIMARY KEY (sigla);


--
-- TOC entry 2712 (class 2606 OID 16483)
-- Name: mbp mbp_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY mbp
    ADD CONSTRAINT mbp_pkey PRIMARY KEY (numero);


--
-- TOC entry 2714 (class 2606 OID 16485)
-- Name: predios predios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY predios
    ADD CONSTRAINT predios_pkey PRIMARY KEY (codigo);


--
-- TOC entry 2716 (class 2606 OID 16487)
-- Name: salas salas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY salas
    ADD CONSTRAINT salas_pkey PRIMARY KEY (numero);


--
-- TOC entry 2718 (class 2606 OID 16489)
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


-- Completed on 2017-10-23 13:06:26

--
-- PostgreSQL database dump complete
--
