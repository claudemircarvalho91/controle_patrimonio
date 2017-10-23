CREATE TABLE "BaixaBemPatrimonial" (
    numero integer NOT NULL,
    data date NOT NULL,
    tipo character(1) NOT NULL,
    motivo character varying(500) NOT NULL,
    "idUsuario" integer NOT NULL
);


ALTER TABLE "BaixaBemPatrimonial" OWNER TO queops;

--
-- TOC entry 204 (class 1259 OID 16432)
-- Name: BemPatrimonial; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "BemPatrimonial" (
    numero integer NOT NULL,
    descricao character varying NOT NULL,
    "dataCompra" date NOT NULL,
    "prazoGarantia" integer NOT NULL,
    "nrNotaFiscal" integer NOT NULL,
    fornecedor character varying(60),
    valor numeric(15,2) NOT NULL,
    situacao character(1) NOT NULL,
    "codCategoria" integer NOT NULL,
    "numSala" integer NOT NULL
);


ALTER TABLE "BemPatrimonial" OWNER TO queops;

--
-- TOC entry 203 (class 1259 OID 16430)
-- Name: BemPatrimonial_Numero_seq; Type: SEQUENCE; Schema: public; Owner: queops
--

CREATE SEQUENCE "BemPatrimonial_Numero_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "BemPatrimonial_Numero_seq" OWNER TO queops;

--
-- TOC entry 2896 (class 0 OID 0)
-- Dependencies: 203
-- Name: BemPatrimonial_Numero_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: queops
--

ALTER SEQUENCE "BemPatrimonial_Numero_seq" OWNED BY "BemPatrimonial".numero;


--
-- TOC entry 197 (class 1259 OID 16396)
-- Name: Categoria; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "Categoria" (
    codigo integer NOT NULL,
    nome character varying(50) NOT NULL,
    descricao character varying(400) NOT NULL,
    "vidaUtil" integer NOT NULL
);


ALTER TABLE "Categoria" OWNER TO queops;

--
-- TOC entry 196 (class 1259 OID 16394)
-- Name: Categoria_codigo_seq; Type: SEQUENCE; Schema: public; Owner: queops
--

CREATE SEQUENCE "Categoria_codigo_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Categoria_codigo_seq" OWNER TO queops;

--
-- TOC entry 2897 (class 0 OID 0)
-- Dependencies: 196
-- Name: Categoria_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: queops
--

ALTER SEQUENCE "Categoria_codigo_seq" OWNED BY "Categoria".codigo;


--
-- TOC entry 202 (class 1259 OID 16425)
-- Name: Departamento; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "Departamento" (
    sigla character(5) NOT NULL,
    nome character varying(30) NOT NULL
);;


ALTER TABLE "Departamento" OWNER TO queops;

--
-- TOC entry 209 (class 1259 OID 16492)
-- Name: MBP; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "MBP" (
    numero integer NOT NULL,
    motivo character varying(200) NOT NULL,
    "dataSolicitacao" date NOT NULL,
    "dataConfirmacao" date,
    "horaConfirmacao" time without time zone,
    "idSolicitante" integer NOT NULL,
    "idAutorizador" integer,
    "numeroBem" integer NOT NULL,
    "numSalaOrigem" integer NOT NULL,
    "numSalaDestino" integer NOT NULL
);


ALTER TABLE "MBP" OWNER TO queops;

--
-- TOC entry 208 (class 1259 OID 16490)
-- Name: MBP_numero_seq; Type: SEQUENCE; Schema: public; Owner: queops
--

CREATE SEQUENCE "MBP_numero_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;;


ALTER TABLE "MBP_numero_seq" OWNER TO queops;

--
-- TOC entry 2898 (class 0 OID 0)
-- Dependencies: 208
-- Name: MBP_numero_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: queops
--

ALTER SEQUENCE "MBP_numero_seq" OWNED BY "MBP".numero;


--
-- TOC entry 201 (class 1259 OID 16419)
-- Name: Predio; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "Predio" (
    codigo integer NOT NULL,
    nome character varying(50) NOT NULL,
    cep integer NOT NULL,
    logradouro character varying(60) NOT NULL,
    numero character(10) NOT NULL,
    complemento character varying(60),
    bairro character varying(40) NOT NULL,
    cidade character varying(50) NOT NULL,
    uf character(2) NOT NULL
);


ALTER TABLE "Predio" OWNER TO queops;

--
-- TOC entry 200 (class 1259 OID 16417)
-- Name: Predio_codigo_seq; Type: SEQUENCE; Schema: public; Owner: queops
--

CREATE SEQUENCE "Predio_codigo_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Predio_codigo_seq" OWNER TO queops;

--
-- TOC entry 2899 (class 0 OID 0)
-- Dependencies: 200
-- Name: Predio_codigo_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: queops
--

ALTER SEQUENCE "Predio_codigo_seq" OWNED BY "Predio".codigo;


--
-- TOC entry 206 (class 1259 OID 16452)
-- Name: Sala; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "Sala" (
    numero integer NOT NULL,
    comprimento numeric(5,2) NOT NULL,
    largura numeric(5,2) NOT NULL,
    descricao character varying(80),
    "codPredio" integer NOT NULL,
    "siglaDpto" character(5) NOT NULL
);


ALTER TABLE "Sala" OWNER TO queops;

--
-- TOC entry 205 (class 1259 OID 16450)
-- Name: Sala_numero_seq; Type: SEQUENCE; Schema: public; Owner: queops
--

CREATE SEQUENCE "Sala_numero_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Sala_numero_seq" OWNER TO queops;

--
-- TOC entry 2900 (class 0 OID 0)
-- Dependencies: 205
-- Name: Sala_numero_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: queops
--

ALTER SEQUENCE "Sala_numero_seq" OWNED BY "Sala".numero;


--
-- TOC entry 199 (class 1259 OID 16404)
-- Name: Usuario; Type: TABLE; Schema: public; Owner: queops
--

CREATE TABLE "Usuario" (
    "Id" integer NOT NULL,
    login character varying(20) NOT NULL,
    nome character varying(50) NOT NULL,
    senha character varying(32) NOT NULL,
    email character varying(80) NOT NULL,
    "siglaDpto" character(5) NOT NULL,
    tipo character(1) NOT NULL
);


ALTER TABLE "Usuario" OWNER TO queops;

--
-- TOC entry 198 (class 1259 OID 16402)
-- Name: Usuario_Id_seq; Type: SEQUENCE; Schema: public; Owner: queops
--

CREATE SEQUENCE "Usuario_Id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE "Usuario_Id_seq" OWNER TO queops;

--
-- TOC entry 2901 (class 0 OID 0)
-- Dependencies: 198
-- Name: Usuario_Id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: queops
--

ALTER SEQUENCE "Usuario_Id_seq" OWNED BY "Usuario"."Id";


--
-- TOC entry 2713 (class 2604 OID 16438)
-- Name: BemPatrimonial numero; Type: DEFAULT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "BemPatrimonial" ALTER COLUMN numero SET DEFAULT nextval('"BemPatrimonial_Numero_seq"'::regclass);


--
-- TOC entry 2710 (class 2604 OID 16399)
-- Name: Categoria codigo; Type: DEFAULT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Categoria" ALTER COLUMN codigo SET DEFAULT nextval('"Categoria_codigo_seq"'::regclass);


--
-- TOC entry 2715 (class 2604 OID 16495)
-- Name: MBP numero; Type: DEFAULT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "MBP" ALTER COLUMN numero SET DEFAULT nextval('"MBP_numero_seq"'::regclass);


--
-- TOC entry 2712 (class 2604 OID 16422)
-- Name: Predio codigo; Type: DEFAULT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Predio" ALTER COLUMN codigo SET DEFAULT nextval('"Predio_codigo_seq"'::regclass);


--
-- TOC entry 2714 (class 2604 OID 16455)
-- Name: Sala numero; Type: DEFAULT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Sala" ALTER COLUMN numero SET DEFAULT nextval('"Sala_numero_seq"'::regclass);


--
-- TOC entry 2711 (class 2604 OID 16407)
-- Name: Usuario Id; Type: DEFAULT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Usuario" ALTER COLUMN "Id" SET DEFAULT nextval('"Usuario_Id_seq"'::regclass);


--
-- TOC entry 2886 (class 0 OID 16476)
-- Dependencies: 207
-- Data for Name: BaixaBemPatrimonial; Type: TABLE DATA; Schema: public; Owner: queops
--


SELECT pg_catalog.setval('"BemPatrimonial_Numero_seq"', 1, false);


--
-- TOC entry 2903 (class 0 OID 0)
-- Dependencies: 196
-- Name: Categoria_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: queops
--

SELECT pg_catalog.setval('"Categoria_codigo_seq"', 1, false);


--
-- TOC entry 2904 (class 0 OID 0)
-- Dependencies: 208
-- Name: MBP_numero_seq; Type: SEQUENCE SET; Schema: public; Owner: queops
--

SELECT pg_catalog.setval('"MBP_numero_seq"', 1, false);


--
-- TOC entry 2905 (class 0 OID 0)
-- Dependencies: 200
-- Name: Predio_codigo_seq; Type: SEQUENCE SET; Schema: public; Owner: queops
--

SELECT pg_catalog.setval('"Predio_codigo_seq"', 1, false);


--
-- TOC entry 2906 (class 0 OID 0)
-- Dependencies: 205
-- Name: Sala_numero_seq; Type: SEQUENCE SET; Schema: public; Owner: queops
--

SELECT pg_catalog.setval('"Sala_numero_seq"', 1, false);


--
-- TOC entry 2907 (class 0 OID 0)
-- Dependencies: 198
-- Name: Usuario_Id_seq; Type: SEQUENCE SET; Schema: public; Owner: queops
--

SELECT pg_catalog.setval('"Usuario_Id_seq"', 1, false);


--
-- TOC entry 2735 (class 2606 OID 16483)
-- Name: BaixaBemPatrimonial BaixaBemPatrimonial_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "BaixaBemPatrimonial"
    ADD CONSTRAINT "BaixaBemPatrimonial_pkey" PRIMARY KEY (numero);


--
-- TOC entry 2727 (class 2606 OID 16440)
-- Name: BemPatrimonial BemPatrimonial_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "BemPatrimonial"
    ADD CONSTRAINT "BemPatrimonial_pkey" PRIMARY KEY (numero);


--
-- TOC entry 2717 (class 2606 OID 16401)
-- Name: Categoria Categoria_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Categoria"
    ADD CONSTRAINT "Categoria_pkey" PRIMARY KEY (codigo);


--
-- TOC entry 2725 (class 2606 OID 16429)
-- Name: Departamento Departamento_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Departamento"
    ADD CONSTRAINT "Departamento_pkey" PRIMARY KEY (sigla);


--
-- TOC entry 2738 (class 2606 OID 16497)
-- Name: MBP MBP_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "MBP"
    ADD CONSTRAINT "MBP_pkey" PRIMARY KEY (numero);


--
-- TOC entry 2723 (class 2606 OID 16424)
-- Name: Predio Predio_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Predio"
    ADD CONSTRAINT "Predio_pkey" PRIMARY KEY (codigo);


--
-- TOC entry 2731 (class 2606 OID 16457)
-- Name: Sala Sala_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Sala"
    ADD CONSTRAINT "Sala_pkey" PRIMARY KEY (numero);


--
-- TOC entry 2719 (class 2606 OID 16411)
-- Name: Usuario Usuario_login_key; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Usuario"
    ADD CONSTRAINT "Usuario_login_key" UNIQUE (login);


--
-- TOC entry 2721 (class 2606 OID 16409)
-- Name: Usuario Usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Usuario"
    ADD CONSTRAINT "Usuario_pkey" PRIMARY KEY ("Id");


--
-- TOC entry 2739 (class 1259 OID 16515)
-- Name: fki_BemPatrimonial_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_BemPatrimonial_fkey" ON "MBP" USING btree ("numeroBem");


--
-- TOC entry 2732 (class 1259 OID 16469)
-- Name: fki_Departamento_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_Departamento_fkey" ON "Sala" USING btree ("siglaDpto");


--
-- TOC entry 2733 (class 1259 OID 16463)
-- Name: fki_Predio_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_Predio_fkey" ON "Sala" USING btree ("codPredio");


--
-- TOC entry 2740 (class 1259 OID 16527)
-- Name: fki_SalaDestino_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_SalaDestino_fkey" ON "MBP" USING btree ("numSalaDestino");


--
-- TOC entry 2741 (class 1259 OID 16521)
-- Name: fki_SalaOrigem_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_SalaOrigem_fkey" ON "MBP" USING btree ("numSalaOrigem");


--
-- TOC entry 2728 (class 1259 OID 16475)
-- Name: fki_Sala_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_Sala_fkey" ON "BemPatrimonial" USING btree ("numSala");


--
-- TOC entry 2742 (class 1259 OID 16528)
-- Name: fki_UsuarioAutorizador_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_UsuarioAutorizador_fkey" ON "MBP" USING btree ("idAutorizador");


--
-- TOC entry 2743 (class 1259 OID 16503)
-- Name: fki_UsuarioSolicitante_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_UsuarioSolicitante_fkey" ON "MBP" USING btree ("idSolicitante");


--
-- TOC entry 2736 (class 1259 OID 16489)
-- Name: fki_Usuario_fkey; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_Usuario_fkey" ON "BaixaBemPatrimonial" USING btree ("idUsuario");


--
-- TOC entry 2729 (class 1259 OID 16449)
-- Name: fki_qweqweqweqwCate; Type: INDEX; Schema: public; Owner: queops
--

CREATE INDEX "fki_qweqweqweqwCate" ON "BemPatrimonial" USING btree ("codCategoria");


--
-- TOC entry 2750 (class 2606 OID 16510)
-- Name: MBP BemPatrimonial_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "MBP"
    ADD CONSTRAINT "BemPatrimonial_fkey" FOREIGN KEY ("numeroBem") REFERENCES "BemPatrimonial"(numero);


--
-- TOC entry 2744 (class 2606 OID 16444)
-- Name: BemPatrimonial Categoria_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "BemPatrimonial"
    ADD CONSTRAINT "Categoria_fkey" FOREIGN KEY ("codCategoria") REFERENCES "Categoria"(codigo);


--
-- TOC entry 2747 (class 2606 OID 16464)
-- Name: Sala Departamento_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Sala"
    ADD CONSTRAINT "Departamento_fkey" FOREIGN KEY ("siglaDpto") REFERENCES "Departamento"(sigla);


--
-- TOC entry 2746 (class 2606 OID 16458)
-- Name: Sala Predio_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "Sala"
    ADD CONSTRAINT "Predio_fkey" FOREIGN KEY ("codPredio") REFERENCES "Predio"(codigo);


--
-- TOC entry 2752 (class 2606 OID 16522)
-- Name: MBP SalaDestino_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "MBP"
    ADD CONSTRAINT "SalaDestino_fkey" FOREIGN KEY ("numSalaDestino") REFERENCES "Sala"(numero);


--
-- TOC entry 2751 (class 2606 OID 16516)
-- Name: MBP SalaOrigem_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "MBP"
    ADD CONSTRAINT "SalaOrigem_fkey" FOREIGN KEY ("numSalaOrigem") REFERENCES "Sala"(numero);


--
-- TOC entry 2745 (class 2606 OID 16470)
-- Name: BemPatrimonial Sala_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "BemPatrimonial"
    ADD CONSTRAINT "Sala_fkey" FOREIGN KEY ("numSala") REFERENCES "Sala"(numero);


--
-- TOC entry 2753 (class 2606 OID 16529)
-- Name: MBP UsuarioAutorizador_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "MBP"
    ADD CONSTRAINT "UsuarioAutorizador_fkey" FOREIGN KEY ("idAutorizador") REFERENCES "Usuario"("Id");


--
-- TOC entry 2749 (class 2606 OID 16498)
-- Name: MBP UsuarioSolicitante_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "MBP"
    ADD CONSTRAINT "UsuarioSolicitante_fkey" FOREIGN KEY ("idSolicitante") REFERENCES "Usuario"("Id");


--
-- TOC entry 2748 (class 2606 OID 16484)
-- Name: BaixaBemPatrimonial Usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: queops
--

ALTER TABLE ONLY "BaixaBemPatrimonial"
    ADD CONSTRAINT "Usuario_fkey" FOREIGN KEY ("idUsuario") REFERENCES "Usuario"("Id");


-- Completed on 2017-10-21 11:55:30

--
-- queopsQL database dump complete
--
