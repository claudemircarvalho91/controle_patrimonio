--
-- PostgreSQL database cluster dump
--

-- Started on 2017-10-21 22:45:40

SET default_transaction_read_only = off;

SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;

--
-- Roles
--

CREATE ROLE "postgres";
ALTER ROLE "postgres" WITH SUPERUSER INHERIT CREATEROLE CREATEDB LOGIN REPLICATION BYPASSRLS PASSWORD 'md5244af1e2823d5eaeeffc42c5096d8260';
CREATE ROLE "queops";
ALTER ROLE "queops" WITH SUPERUSER INHERIT CREATEROLE CREATEDB LOGIN REPLICATION NOBYPASSRLS PASSWORD 'md5d9f405cfa266ef5a01010fdcb1e1940c';
COMMENT ON ROLE "queops" IS 'Sobre o banco de dados:
• Nome do banco: patrimonio
• Usuário: queops
• Senha: piramide';


--
-- Role memberships
--

GRANT "pg_read_all_settings" TO "queops" WITH ADMIN OPTION GRANTED BY "postgres";
GRANT "postgres" TO "queops" WITH ADMIN OPTION GRANTED BY "postgres";




--
-- Database creation
--

CREATE DATABASE "patrimonio" WITH TEMPLATE = template0 OWNER = "queops";
REVOKE ALL ON DATABASE "patrimonio" FROM "queops";
GRANT CREATE,CONNECT ON DATABASE "patrimonio" TO "queops";
GRANT TEMPORARY ON DATABASE "patrimonio" TO "queops" WITH GRANT OPTION;
REVOKE CONNECT,TEMPORARY ON DATABASE "template1" FROM PUBLIC;
GRANT CONNECT ON DATABASE "template1" TO PUBLIC;


\connect "patrimonio"

SET default_transaction_read_only = off;

--
-- PostgreSQL database dump
--

-- Dumped from database version 10.0
-- Dumped by pg_dump version 10.0

-- Started on 2017-10-21 22:45:40

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2894 (class 1262 OID 16523)
-- Dependencies: 2893
-- Name: patrimonio; Type: COMMENT; Schema: -; Owner: queops
--

COMMENT ON DATABASE "patrimonio" IS 'Sobre o banco de dados:
• Nome do banco: patrimonio
• Usuário: queops
• Senha: piramide';


--
-- TOC entry 2895 (class 0 OID 0)
-- Dependencies: 3
-- Name: SCHEMA "public"; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA "public" IS 'standard public schema';


--
-- TOC entry 1 (class 3079 OID 12924)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS "plpgsql" WITH SCHEMA "pg_catalog";


--
-- TOC entry 2896 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION "plpgsql"; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION "plpgsql" IS 'PL/pgSQL procedural language';


SET search_path = "public", pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 196 (class 1259 OID 16524)
-- Name: BaixaBemPatrimonial; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "BaixaBemPatrimonial" (
    "numero" integer NOT NULL,
    "data" "date" NOT NULL,
    "tipo" character(1) NOT NULL,
    "motivo" character varying(500) NOT NULL,
    "idUsuario" integer NOT NULL
);


ALTER TABLE "BaixaBemPatrimonial" OWNER TO "queops";

--
-- TOC entry 197 (class 1259 OID 16530)
-- Name: BemPatrimonial; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "BemPatrimonial" (
    "numero" integer NOT NULL,
    "descricao" character varying NOT NULL,
    "dataCompra" "date" NOT NULL,
    "prazoGarantia" integer NOT NULL,
    "nrNotaFiscal" integer NOT NULL,
    "fornecedor" character varying(60),
    "valor" numeric(15,2) NOT NULL,
    "situacao" character(1) NOT NULL,
    "codCategoria" integer NOT NULL,
    "numSala" integer NOT NULL
);


ALTER TABLE "BemPatrimonial" OWNER TO "queops";

--
-- TOC entry 198 (class 1259 OID 16536)
-- Name: BemPatrimonial_Numero_seq; Type: SEQUENCE; Schema: public; Owner: queops
--

CREATE SEQUENCE "BemPatrimonial_Numero_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "BemPatrimonial_Numero_seq" OWNER TO "queops";

--
-- TOC entry 2899 (class 0 OID 0)
-- Dependencies: 198
-- Name: BemPatrimonial_Numero_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: queops
--

ALTER SEQUENCE "BemPatrimonial_Numero_seq" OWNED BY "BemPatrimonial"."numero";


--
-- TOC entry 199 (class 1259 OID 16538)
-- Name: Categoria; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "Categoria" (
    "codigo" integer NOT NULL,
    "nome" character varying(50) NOT NULL,
    "descricao" character varying(400) NOT NULL,
    "vidaUtil" integer NOT NULL
);


ALTER TABLE "Categoria" OWNER TO "queops";

--
-- TOC entry 200 (class 1259 OID 16541)
-- Name: Categoria_codigo_seq; Type: SEQUENCE; Schema: public; Owner: queops
--

CREATE SEQUENCE "Categoria_codigo_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Categoria_codigo_seq" OWNER TO "queops";

--
-- TOC entry 2901 (class 0 OID 0)
-- Dependencies: 200
-- Name: Categoria_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: queops
--

ALTER SEQUENCE "Categoria_codigo_seq" OWNED BY "Categoria"."codigo";


--
-- TOC entry 201 (class 1259 OID 16543)
-- Name: Departamento; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "Departamento" (
    "sigla" character(5) NOT NULL,
    "nome" character varying(30) NOT NULL
);


ALTER TABLE "Departamento" OWNER TO "queops";

--
-- TOC entry 202 (class 1259 OID 16546)
-- Name: MBP; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "MBP" (
    "numero" integer NOT NULL,
    "motivo" character varying(200) NOT NULL,
    "dataSolicitacao" "date" NOT NULL,
    "dataConfirmacao" "date",
    "horaConfirmacao" time without time zone,
    "idSolicitante" integer NOT NULL,
    "idAutorizador" integer,
    "numeroBem" integer NOT NULL,
    "numSalaOrigem" integer NOT NULL,
    "numSalaDestino" integer NOT NULL
);


ALTER TABLE "MBP" OWNER TO "queops";

--
-- TOC entry 203 (class 1259 OID 16549)
-- Name: MBP_numero_seq; Type: SEQUENCE; Schema: public; Owner: queops
--

CREATE SEQUENCE "MBP_numero_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "MBP_numero_seq" OWNER TO "queops";

--
-- TOC entry 2904 (class 0 OID 0)
-- Dependencies: 203
-- Name: MBP_numero_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: queops
--

ALTER SEQUENCE "MBP_numero_seq" OWNED BY "MBP"."numero";


--
-- TOC entry 204 (class 1259 OID 16551)
-- Name: Predio; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "Predio" (
    "codigo" integer NOT NULL,
    "nome" character varying(50) NOT NULL,
    "cep" integer NOT NULL,
    "logradouro" character varying(60) NOT NULL,
    "numero" character(10) NOT NULL,
    "complemento" character varying(60),
    "bairro" character varying(40) NOT NULL,
    "cidade" character varying(50) NOT NULL,
    "uf" character(2) NOT NULL
);


ALTER TABLE "Predio" OWNER TO "queops";

--
-- TOC entry 205 (class 1259 OID 16554)
-- Name: Predio_codigo_seq; Type: SEQUENCE; Schema: public; Owner: queops
--

CREATE SEQUENCE "Predio_codigo_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Predio_codigo_seq" OWNER TO "queops";

--
-- TOC entry 2906 (class 0 OID 0)
-- Dependencies: 205
-- Name: Predio_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: queops
--

ALTER SEQUENCE "Predio_codigo_seq" OWNED BY "Predio"."codigo";


--
-- TOC entry 206 (class 1259 OID 16556)
-- Name: Sala; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "Sala" (
    "numero" integer NOT NULL,
    "comprimento" numeric(5,2) NOT NULL,
    "largura" numeric(5,2) NOT NULL,
    "descricao" character varying(80),
    "codPredio" integer NOT NULL,
    "siglaDpto" character(5) NOT NULL
);


ALTER TABLE "Sala" OWNER TO "queops";

--
-- TOC entry 207 (class 1259 OID 16559)
-- Name: Sala_numero_seq; Type: SEQUENCE; Schema: public; Owner: queops
--

CREATE SEQUENCE "Sala_numero_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Sala_numero_seq" OWNER TO "queops";

--
-- TOC entry 2908 (class 0 OID 0)
-- Dependencies: 207
-- Name: Sala_numero_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: queops
--

ALTER SEQUENCE "Sala_numero_seq" OWNED BY "Sala"."numero";


--
-- TOC entry 208 (class 1259 OID 16561)
-- Name: Usuario; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "Usuario" (
    "Id" integer NOT NULL,
    "login" character varying(20) NOT NULL,
    "nome" character varying(50) NOT NULL,
    "senha" character varying(32) NOT NULL,
    "email" character varying(80) NOT NULL,
    "siglaDpto" character(5) NOT NULL,
    "tipo" character(1) NOT NULL
);


ALTER TABLE "Usuario" OWNER TO "queops";

--
-- TOC entry 209 (class 1259 OID 16564)
-- Name: Usuario_Id_seq; Type: SEQUENCE; Schema: public; Owner: queops
--

CREATE SEQUENCE "Usuario_Id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Usuario_Id_seq" OWNER TO "queops";

--
-- TOC entry 2910 (class 0 OID 0)
-- Dependencies: 209
-- Name: Usuario_Id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: queops
--

ALTER SEQUENCE "Usuario_Id_seq" OWNED BY "Usuario"."Id";


--
-- TOC entry 2710 (class 2604 OID 16566)
-- Name: BemPatrimonial numero; Type: DEFAULT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "BemPatrimonial" ALTER COLUMN "numero" SET DEFAULT "nextval"('"BemPatrimonial_Numero_seq"'::"regclass");


--
-- TOC entry 2711 (class 2604 OID 16567)
-- Name: Categoria codigo; Type: DEFAULT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Categoria" ALTER COLUMN "codigo" SET DEFAULT "nextval"('"Categoria_codigo_seq"'::"regclass");


--
-- TOC entry 2712 (class 2604 OID 16568)
-- Name: MBP numero; Type: DEFAULT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "MBP" ALTER COLUMN "numero" SET DEFAULT "nextval"('"MBP_numero_seq"'::"regclass");


--
-- TOC entry 2713 (class 2604 OID 16569)
-- Name: Predio codigo; Type: DEFAULT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Predio" ALTER COLUMN "codigo" SET DEFAULT "nextval"('"Predio_codigo_seq"'::"regclass");


--
-- TOC entry 2714 (class 2604 OID 16570)
-- Name: Sala numero; Type: DEFAULT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Sala" ALTER COLUMN "numero" SET DEFAULT "nextval"('"Sala_numero_seq"'::"regclass");


--
-- TOC entry 2715 (class 2604 OID 16571)
-- Name: Usuario Id; Type: DEFAULT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Usuario" ALTER COLUMN "Id" SET DEFAULT "nextval"('"Usuario_Id_seq"'::"regclass");


--
-- TOC entry 2875 (class 0 OID 16524)
-- Dependencies: 196
-- Data for Name: BaixaBemPatrimonial; Type: TABLE DATA; Schema: public; Owner: queops
--

COPY "BaixaBemPatrimonial" ("numero", "data", "tipo", "motivo", "idUsuario") FROM stdin;
\.


--
-- TOC entry 2876 (class 0 OID 16530)
-- Dependencies: 197
-- Data for Name: BemPatrimonial; Type: TABLE DATA; Schema: public; Owner: queops
--

COPY "BemPatrimonial" ("numero", "descricao", "dataCompra", "prazoGarantia", "nrNotaFiscal", "fornecedor", "valor", "situacao", "codCategoria", "numSala") FROM stdin;
\.


--
-- TOC entry 2878 (class 0 OID 16538)
-- Dependencies: 199
-- Data for Name: Categoria; Type: TABLE DATA; Schema: public; Owner: queops
--

COPY "Categoria" ("codigo", "nome", "descricao", "vidaUtil") FROM stdin;
\.


--
-- TOC entry 2880 (class 0 OID 16543)
-- Dependencies: 201
-- Data for Name: Departamento; Type: TABLE DATA; Schema: public; Owner: queops
--

COPY "Departamento" ("sigla", "nome") FROM stdin;
\.


--
-- TOC entry 2881 (class 0 OID 16546)
-- Dependencies: 202
-- Data for Name: MBP; Type: TABLE DATA; Schema: public; Owner: queops
--

COPY "MBP" ("numero", "motivo", "dataSolicitacao", "dataConfirmacao", "horaConfirmacao", "idSolicitante", "idAutorizador", "numeroBem", "numSalaOrigem", "numSalaDestino") FROM stdin;
\.


--
-- TOC entry 2883 (class 0 OID 16551)
-- Dependencies: 204
-- Data for Name: Predio; Type: TABLE DATA; Schema: public; Owner: queops
--

COPY "Predio" ("codigo", "nome", "cep", "logradouro", "numero", "complemento", "bairro", "cidade", "uf") FROM stdin;
\.


--
-- TOC entry 2885 (class 0 OID 16556)
-- Dependencies: 206
-- Data for Name: Sala; Type: TABLE DATA; Schema: public; Owner: queops
--

COPY "Sala" ("numero", "comprimento", "largura", "descricao", "codPredio", "siglaDpto") FROM stdin;
\.


--
-- TOC entry 2887 (class 0 OID 16561)
-- Dependencies: 208
-- Data for Name: Usuario; Type: TABLE DATA; Schema: public; Owner: queops
--

COPY "Usuario" ("Id", "login", "nome", "senha", "email", "siglaDpto", "tipo") FROM stdin;
\.


--
-- TOC entry 2911 (class 0 OID 0)
-- Dependencies: 198
-- Name: BemPatrimonial_Numero_seq; Type: SEQUENCE SET; Schema: public; Owner: queops
--

SELECT pg_catalog.setval('"BemPatrimonial_Numero_seq"', 1, false);


--
-- TOC entry 2912 (class 0 OID 0)
-- Dependencies: 200
-- Name: Categoria_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: queops
--

SELECT pg_catalog.setval('"Categoria_codigo_seq"', 1, false);


--
-- TOC entry 2913 (class 0 OID 0)
-- Dependencies: 203
-- Name: MBP_numero_seq; Type: SEQUENCE SET; Schema: public; Owner: queops
--

SELECT pg_catalog.setval('"MBP_numero_seq"', 1, false);


--
-- TOC entry 2914 (class 0 OID 0)
-- Dependencies: 205
-- Name: Predio_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: queops
--

SELECT pg_catalog.setval('"Predio_codigo_seq"', 1, false);


--
-- TOC entry 2915 (class 0 OID 0)
-- Dependencies: 207
-- Name: Sala_numero_seq; Type: SEQUENCE SET; Schema: public; Owner: queops
--

SELECT pg_catalog.setval('"Sala_numero_seq"', 1, false);


--
-- TOC entry 2916 (class 0 OID 0)
-- Dependencies: 209
-- Name: Usuario_Id_seq; Type: SEQUENCE SET; Schema: public; Owner: queops
--

SELECT pg_catalog.setval('"Usuario_Id_seq"', 1, false);


--
-- TOC entry 2717 (class 2606 OID 16573)
-- Name: BaixaBemPatrimonial BaixaBemPatrimonial_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "BaixaBemPatrimonial"
    ADD CONSTRAINT "BaixaBemPatrimonial_pkey" PRIMARY KEY ("numero");


--
-- TOC entry 2720 (class 2606 OID 16575)
-- Name: BemPatrimonial BemPatrimonial_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "BemPatrimonial"
    ADD CONSTRAINT "BemPatrimonial_pkey" PRIMARY KEY ("numero");


--
-- TOC entry 2724 (class 2606 OID 16577)
-- Name: Categoria Categoria_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Categoria"
    ADD CONSTRAINT "Categoria_pkey" PRIMARY KEY ("codigo");


--
-- TOC entry 2726 (class 2606 OID 16579)
-- Name: Departamento Departamento_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Departamento"
    ADD CONSTRAINT "Departamento_pkey" PRIMARY KEY ("sigla");


--
-- TOC entry 2728 (class 2606 OID 16581)
-- Name: MBP MBP_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "MBP"
    ADD CONSTRAINT "MBP_pkey" PRIMARY KEY ("numero");


--
-- TOC entry 2735 (class 2606 OID 16583)
-- Name: Predio Predio_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Predio"
    ADD CONSTRAINT "Predio_pkey" PRIMARY KEY ("codigo");


--
-- TOC entry 2737 (class 2606 OID 16585)
-- Name: Sala Sala_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Sala"
    ADD CONSTRAINT "Sala_pkey" PRIMARY KEY ("numero");


--
-- TOC entry 2741 (class 2606 OID 16587)
-- Name: Usuario Usuario_login_key; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Usuario"
    ADD CONSTRAINT "Usuario_login_key" UNIQUE ("login");


--
-- TOC entry 2743 (class 2606 OID 16589)
-- Name: Usuario Usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Usuario"
    ADD CONSTRAINT "Usuario_pkey" PRIMARY KEY ("Id");


--
-- TOC entry 2729 (class 1259 OID 16590)
-- Name: fki_BemPatrimonial_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_BemPatrimonial_fkey" ON "MBP" USING "btree" ("numeroBem");


--
-- TOC entry 2738 (class 1259 OID 16591)
-- Name: fki_Departamento_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_Departamento_fkey" ON "Sala" USING "btree" ("siglaDpto");


--
-- TOC entry 2739 (class 1259 OID 16592)
-- Name: fki_Predio_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_Predio_fkey" ON "Sala" USING "btree" ("codPredio");


--
-- TOC entry 2730 (class 1259 OID 16593)
-- Name: fki_SalaDestino_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_SalaDestino_fkey" ON "MBP" USING "btree" ("numSalaDestino");


--
-- TOC entry 2731 (class 1259 OID 16594)
-- Name: fki_SalaOrigem_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_SalaOrigem_fkey" ON "MBP" USING "btree" ("numSalaOrigem");


--
-- TOC entry 2721 (class 1259 OID 16595)
-- Name: fki_Sala_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_Sala_fkey" ON "BemPatrimonial" USING "btree" ("numSala");


--
-- TOC entry 2732 (class 1259 OID 16596)
-- Name: fki_UsuarioAutorizador_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_UsuarioAutorizador_fkey" ON "MBP" USING "btree" ("idAutorizador");


--
-- TOC entry 2733 (class 1259 OID 16597)
-- Name: fki_UsuarioSolicitante_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_UsuarioSolicitante_fkey" ON "MBP" USING "btree" ("idSolicitante");


--
-- TOC entry 2718 (class 1259 OID 16598)
-- Name: fki_Usuario_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_Usuario_fkey" ON "BaixaBemPatrimonial" USING "btree" ("idUsuario");


--
-- TOC entry 2722 (class 1259 OID 16599)
-- Name: fki_qweqweqweqwCate; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_qweqweqweqwCate" ON "BemPatrimonial" USING "btree" ("codCategoria");


--
-- TOC entry 2747 (class 2606 OID 16600)
-- Name: MBP BemPatrimonial_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "MBP"
    ADD CONSTRAINT "BemPatrimonial_fkey" FOREIGN KEY ("numeroBem") REFERENCES "BemPatrimonial"("numero");


--
-- TOC entry 2745 (class 2606 OID 16605)
-- Name: BemPatrimonial Categoria_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "BemPatrimonial"
    ADD CONSTRAINT "Categoria_fkey" FOREIGN KEY ("codCategoria") REFERENCES "Categoria"("codigo");


--
-- TOC entry 2752 (class 2606 OID 16610)
-- Name: Sala Departamento_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Sala"
    ADD CONSTRAINT "Departamento_fkey" FOREIGN KEY ("siglaDpto") REFERENCES "Departamento"("sigla");


--
-- TOC entry 2753 (class 2606 OID 16615)
-- Name: Sala Predio_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Sala"
    ADD CONSTRAINT "Predio_fkey" FOREIGN KEY ("codPredio") REFERENCES "Predio"("codigo");


--
-- TOC entry 2748 (class 2606 OID 16620)
-- Name: MBP SalaDestino_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "MBP"
    ADD CONSTRAINT "SalaDestino_fkey" FOREIGN KEY ("numSalaDestino") REFERENCES "Sala"("numero");


--
-- TOC entry 2749 (class 2606 OID 16625)
-- Name: MBP SalaOrigem_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "MBP"
    ADD CONSTRAINT "SalaOrigem_fkey" FOREIGN KEY ("numSalaOrigem") REFERENCES "Sala"("numero");


--
-- TOC entry 2746 (class 2606 OID 16630)
-- Name: BemPatrimonial Sala_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "BemPatrimonial"
    ADD CONSTRAINT "Sala_fkey" FOREIGN KEY ("numSala") REFERENCES "Sala"("numero");


--
-- TOC entry 2750 (class 2606 OID 16635)
-- Name: MBP UsuarioAutorizador_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "MBP"
    ADD CONSTRAINT "UsuarioAutorizador_fkey" FOREIGN KEY ("idAutorizador") REFERENCES "Usuario"("Id");


--
-- TOC entry 2751 (class 2606 OID 16640)
-- Name: MBP UsuarioSolicitante_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "MBP"
    ADD CONSTRAINT "UsuarioSolicitante_fkey" FOREIGN KEY ("idSolicitante") REFERENCES "Usuario"("Id");


--
-- TOC entry 2744 (class 2606 OID 16645)
-- Name: BaixaBemPatrimonial Usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "BaixaBemPatrimonial"
    ADD CONSTRAINT "Usuario_fkey" FOREIGN KEY ("idUsuario") REFERENCES "Usuario"("Id");


--
-- TOC entry 2897 (class 0 OID 0)
-- Dependencies: 196
-- Name: BaixaBemPatrimonial; Type: ACL; Schema: public; Owner: queops
--

REVOKE ALL ON TABLE "BaixaBemPatrimonial" FROM "queops";
GRANT ALL ON TABLE "BaixaBemPatrimonial" TO "queops" WITH GRANT OPTION;


--
-- TOC entry 2898 (class 0 OID 0)
-- Dependencies: 197
-- Name: BemPatrimonial; Type: ACL; Schema: public; Owner: queops
--

REVOKE ALL ON TABLE "BemPatrimonial" FROM "queops";
GRANT ALL ON TABLE "BemPatrimonial" TO "queops" WITH GRANT OPTION;


--
-- TOC entry 2900 (class 0 OID 0)
-- Dependencies: 199
-- Name: Categoria; Type: ACL; Schema: public; Owner: queops
--

REVOKE ALL ON TABLE "Categoria" FROM "queops";
GRANT ALL ON TABLE "Categoria" TO "queops" WITH GRANT OPTION;


--
-- TOC entry 2902 (class 0 OID 0)
-- Dependencies: 201
-- Name: Departamento; Type: ACL; Schema: public; Owner: queops
--

REVOKE ALL ON TABLE "Departamento" FROM "queops";
GRANT ALL ON TABLE "Departamento" TO "queops" WITH GRANT OPTION;


--
-- TOC entry 2903 (class 0 OID 0)
-- Dependencies: 202
-- Name: MBP; Type: ACL; Schema: public; Owner: queops
--

REVOKE ALL ON TABLE "MBP" FROM "queops";
GRANT ALL ON TABLE "MBP" TO "queops" WITH GRANT OPTION;


--
-- TOC entry 2905 (class 0 OID 0)
-- Dependencies: 204
-- Name: Predio; Type: ACL; Schema: public; Owner: queops
--

REVOKE ALL ON TABLE "Predio" FROM "queops";
GRANT ALL ON TABLE "Predio" TO "queops" WITH GRANT OPTION;


--
-- TOC entry 2907 (class 0 OID 0)
-- Dependencies: 206
-- Name: Sala; Type: ACL; Schema: public; Owner: queops
--

REVOKE ALL ON TABLE "Sala" FROM "queops";
GRANT ALL ON TABLE "Sala" TO "queops" WITH GRANT OPTION;


--
-- TOC entry 2909 (class 0 OID 0)
-- Dependencies: 208
-- Name: Usuario; Type: ACL; Schema: public; Owner: queops
--

REVOKE ALL ON TABLE "Usuario" FROM "queops";
GRANT ALL ON TABLE "Usuario" TO "queops" WITH GRANT OPTION;


-- Completed on 2017-10-21 22:45:40

--
-- PostgreSQL database dump complete
--

\connect "postgres"

SET default_transaction_read_only = off;

--
-- PostgreSQL database dump
--

-- Dumped from database version 10.0
-- Dumped by pg_dump version 10.0

-- Started on 2017-10-21 22:45:40

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2791 (class 1262 OID 12938)
-- Dependencies: 2790
-- Name: postgres; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE "postgres" IS 'default administrative connection database';


--
-- TOC entry 2792 (class 0 OID 0)
-- Dependencies: 4
-- Name: SCHEMA "public"; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA "public" IS 'standard public schema';


--
-- TOC entry 2 (class 3079 OID 12924)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS "plpgsql" WITH SCHEMA "pg_catalog";


--
-- TOC entry 2793 (class 0 OID 0)
-- Dependencies: 2
-- Name: EXTENSION "plpgsql"; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION "plpgsql" IS 'PL/pgSQL procedural language';


--
-- TOC entry 1 (class 3079 OID 16384)
-- Name: adminpack; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS "adminpack" WITH SCHEMA "pg_catalog";


--
-- TOC entry 2794 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION "adminpack"; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION "adminpack" IS 'administrative functions for PostgreSQL';


-- Completed on 2017-10-21 22:45:41

--
-- PostgreSQL database dump complete
--

\connect "template1"

SET default_transaction_read_only = off;

--
-- PostgreSQL database dump
--

-- Dumped from database version 10.0
-- Dumped by pg_dump version 10.0

-- Started on 2017-10-21 22:45:41

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 2790 (class 1262 OID 1)
-- Dependencies: 2789
-- Name: template1; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON DATABASE "template1" IS 'default template for new databases';


--
-- TOC entry 2791 (class 0 OID 0)
-- Dependencies: 3
-- Name: SCHEMA "public"; Type: COMMENT; Schema: -; Owner: postgres
--

COMMENT ON SCHEMA "public" IS 'standard public schema';


--
-- TOC entry 1 (class 3079 OID 12924)
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS "plpgsql" WITH SCHEMA "pg_catalog";


--
-- TOC entry 2792 (class 0 OID 0)
-- Dependencies: 1
-- Name: EXTENSION "plpgsql"; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION "plpgsql" IS 'PL/pgSQL procedural language';


-- Completed on 2017-10-21 22:45:41

--
-- PostgreSQL database dump complete
--

-- Completed on 2017-10-21 22:45:41

--
-- PostgreSQL database cluster dump complete
--

