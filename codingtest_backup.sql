--
-- PostgreSQL database dump
--

\restrict UnnDrjJ1HYc4o4gB37FaLzczQ1G1cpAgZ6wYZ1Ht27Hiz4c0gGbYUb70ebqvHlz

-- Dumped from database version 16.11
-- Dumped by pg_dump version 16.11

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: data_form; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.data_form (
    id_form_data bigint NOT NULL,
    id_form bigint,
    id_registrasi bigint,
    data json,
    is_delete boolean DEFAULT false,
    create_by bigint,
    update_by bigint,
    create_time_at timestamp without time zone,
    update_time_at timestamp without time zone
);


ALTER TABLE public.data_form OWNER TO postgres;

--
-- Name: data_form_id_form_data_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.data_form_id_form_data_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.data_form_id_form_data_seq OWNER TO postgres;

--
-- Name: data_form_id_form_data_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.data_form_id_form_data_seq OWNED BY public.data_form.id_form_data;


--
-- Name: registrasi; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.registrasi (
    id_registrasi bigint NOT NULL,
    no_registrasi bigint,
    no_rekam_medis bigint,
    nama_pasien character varying(255),
    tanggal_lahir date,
    nik bigint,
    create_by bigint,
    create_time_at timestamp without time zone,
    update_by bigint,
    update_time_at timestamp without time zone
);


ALTER TABLE public.registrasi OWNER TO postgres;

--
-- Name: registrasi_id_registrasi_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.registrasi_id_registrasi_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.registrasi_id_registrasi_seq OWNER TO postgres;

--
-- Name: registrasi_id_registrasi_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.registrasi_id_registrasi_seq OWNED BY public.registrasi.id_registrasi;


--
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    username character varying(100) NOT NULL,
    password_hash character varying(255) NOT NULL,
    auth_key character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.user_id_seq OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;


--
-- Name: data_form id_form_data; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.data_form ALTER COLUMN id_form_data SET DEFAULT nextval('public.data_form_id_form_data_seq'::regclass);


--
-- Name: registrasi id_registrasi; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registrasi ALTER COLUMN id_registrasi SET DEFAULT nextval('public.registrasi_id_registrasi_seq'::regclass);


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- Data for Name: data_form; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.data_form (id_form_data, id_form, id_registrasi, data, is_delete, create_by, update_by, create_time_at, update_time_at) FROM stdin;
1	\N	1	"{\\"tinggi_badan\\":\\"170\\",\\"berat_badan\\":\\"50\\",\\"keluhan\\":\\"pusing\\",\\"imt\\":17.3,\\"kategori_imt\\":\\"Kurus\\",\\"riwayat_penyakit\\":\\"0\\",\\"keterangan_riwayat\\":\\"\\"}"	f	\N	\N	\N	\N
3	\N	3	"{\\"cara_masuk\\":\\"Jalan\\",\\"jenis_anamnesis\\":\\"Auto\\",\\"diperoleh_dari\\":\\"Kakak\\",\\"hubungan\\":\\"\\",\\"alergi\\":\\"udang\\",\\"keluhan\\":\\"sakit perut berterus terus\\",\\"keadaan_umum\\":\\"Sakit ringan\\",\\"warna_kulit\\":\\"Normal\\",\\"kesadaran\\":\\"Compos Mentis\\",\\"td\\":\\"\\",\\"nadi\\":\\"\\",\\"rr\\":\\"\\",\\"suhu\\":\\"\\",\\"alat_bantu\\":\\"Tongkat\\",\\"prothesa\\":\\"\\",\\"cacat_tubuh\\":\\"\\",\\"adl\\":\\"\\",\\"riwayat_jatuh\\":\\"Ya\\",\\"bb\\":\\"80\\",\\"tb\\":\\"160\\",\\"pb\\":\\"\\",\\"lk\\":\\"\\",\\"imt\\":31.25,\\"status_gizi\\":\\"Obesitas\\",\\"riwayat_sekarang\\":\\"\\",\\"riwayat_dahulu\\":\\"\\",\\"riwayat_penyakit\\":\\"\\",\\"riwayat_keluarga\\":\\"\\",\\"riwayat_operasi\\":\\"Tidak\\",\\"operasi_apa\\":\\"\\",\\"operasi_kapan\\":\\"\\",\\"riwayat_rawat_inap\\":\\"Tidak\\",\\"rs_penyakit\\":\\"\\",\\"rs_kapan\\":\\"\\",\\"rj_riwayat_jatuh\\":\\"25\\",\\"rj_diagnosa_sekunder\\":\\"15\\",\\"rj_alat_bantu\\":\\"\\",\\"rj_iv\\":\\"\\",\\"rj_cara_berjalan\\":\\"\\",\\"rj_status_mental\\":\\"\\",\\"rj_total\\":40,\\"rj_kategori\\":\\"Risiko Sedang\\"}"	f	\N	\N	\N	2026-02-12 09:06:04
2	\N	2	"{\\"cara_masuk\\":\\"Jalan\\",\\"jenis_anamnesis\\":\\"\\",\\"diperoleh_dari\\":\\"\\",\\"hubungan\\":\\"\\",\\"alergi\\":\\"udang\\",\\"keluhan\\":\\"batuk\\",\\"keadaan_umum\\":\\"\\",\\"warna_kulit\\":\\"\\",\\"kesadaran\\":\\"\\",\\"td\\":\\"\\",\\"nadi\\":\\"\\",\\"rr\\":\\"\\",\\"suhu\\":\\"\\",\\"alat_bantu\\":\\"\\",\\"prothesa\\":\\"\\",\\"cacat_tubuh\\":\\"\\",\\"adl\\":\\"\\",\\"riwayat_jatuh\\":\\"\\",\\"bb\\":\\"70\\",\\"tb\\":\\"180\\",\\"pb\\":\\"\\",\\"lk\\":\\"\\",\\"imt\\":21.6,\\"status_gizi\\":\\"Normal\\",\\"riwayat_sekarang\\":\\"\\",\\"riwayat_dahulu\\":\\"\\",\\"riwayat_penyakit\\":\\"\\",\\"riwayat_keluarga\\":\\"\\",\\"riwayat_operasi\\":\\"\\",\\"operasi_apa\\":\\"\\",\\"operasi_kapan\\":\\"\\",\\"riwayat_rawat_inap\\":\\"\\",\\"rs_penyakit\\":\\"\\",\\"rs_kapan\\":\\"\\"}"	f	\N	\N	\N	\N
\.


--
-- Data for Name: registrasi; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.registrasi (id_registrasi, no_registrasi, no_rekam_medis, nama_pasien, tanggal_lahir, nik, create_by, create_time_at, update_by, update_time_at) FROM stdin;
1	20231102025	\N	donkur	2023-02-07	\N	\N	2026-02-11 20:24:17.110479	\N	2026-02-11 20:24:17.110479
2	20260211145347	\N	donkur	2024-03-25	1471124141	\N	2026-02-11 20:54:09.459436	\N	2026-02-11 20:54:09.459436
3	20260212030545	\N	donkur	2014-12-29	1471124141	\N	2026-02-12 09:05:57.724132	\N	2026-02-12 09:05:57.724132
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (id, username, password_hash, auth_key, created_at) FROM stdin;
1	admin	$2y$10$AUQTAQ8fXUO5nJ4eXy7pSeSaMgAikLhB.GHGAOkCH2N0pnqO8rJ.6	819bff58f7864e64ac9510013e7b4264	2026-02-11 10:59:17.430878
\.


--
-- Name: data_form_id_form_data_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.data_form_id_form_data_seq', 3, true);


--
-- Name: registrasi_id_registrasi_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.registrasi_id_registrasi_seq', 3, true);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id_seq', 1, true);


--
-- Name: data_form data_form_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.data_form
    ADD CONSTRAINT data_form_pkey PRIMARY KEY (id_form_data);


--
-- Name: registrasi registrasi_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.registrasi
    ADD CONSTRAINT registrasi_pkey PRIMARY KEY (id_registrasi);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: user user_username_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_username_key UNIQUE (username);


--
-- PostgreSQL database dump complete
--

\unrestrict UnnDrjJ1HYc4o4gB37FaLzczQ1G1cpAgZ6wYZ1Ht27Hiz4c0gGbYUb70ebqvHlz

