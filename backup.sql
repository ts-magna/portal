--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: acct; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acct (
    acct integer NOT NULL,
    aefdt timestamp without time zone NOT NULL,
    aact boolean NOT NULL,
    aname1 text NOT NULL,
    aname2 text,
    aadd1 text NOT NULL,
    aadd2 text,
    acity text NOT NULL,
    astate text NOT NULL,
    azip text NOT NULL,
    aphone text NOT NULL,
    afax text,
    acontact text,
    amisc1 text,
    amisc2 text,
    amisc3 text,
    modby text NOT NULL
);


ALTER TABLE acct OWNER TO postgres;

--
-- Name: acctoc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acctoc (
    acct integer NOT NULL,
    aefdt timestamp without time zone NOT NULL,
    oc text NOT NULL,
    oefdt timestamp without time zone NOT NULL
);


ALTER TABLE acctoc OWNER TO postgres;

--
-- Name: acctphy; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE acctphy (
    acct integer NOT NULL,
    aefdt timestamp without time zone NOT NULL,
    npi integer NOT NULL,
    phyefdt timestamp without time zone NOT NULL
);


ALTER TABLE acctphy OWNER TO postgres;

--
-- Name: demo; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE demo (
    pat integer NOT NULL,
    pefdt timestamp without time zone NOT NULL,
    pact boolean NOT NULL,
    pfname text NOT NULL,
    plname text NOT NULL,
    pmname text,
    psuffix text,
    dob date NOT NULL,
    ssn text,
    psex text NOT NULL,
    padd1 text NOT NULL,
    padd2 text,
    pcity text NOT NULL,
    pstate text NOT NULL,
    pzip smallint NOT NULL,
    pphone text,
    pid text,
    modby text NOT NULL
);


ALTER TABLE demo OWNER TO postgres;

--
-- Name: diag; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE diag (
    diag text NOT NULL,
    diagefdt timestamp without time zone NOT NULL,
    diagact boolean NOT NULL,
    diagdesc text NOT NULL
);


ALTER TABLE diag OWNER TO postgres;

--
-- Name: guar; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE guar (
    pat integer NOT NULL,
    pefdt timestamp without time zone NOT NULL,
    gact boolean NOT NULL,
    rel text NOT NULL,
    gfname text NOT NULL,
    glame text NOT NULL,
    gmname text,
    gsuffix text,
    gdob date NOT NULL,
    gssn text,
    gsex text NOT NULL,
    gadd1 text NOT NULL,
    gadd2 path,
    gcity text NOT NULL,
    gstate text NOT NULL,
    gzip text NOT NULL,
    gphone smallint,
    modby text NOT NULL
);


ALTER TABLE guar OWNER TO postgres;

--
-- Name: ins; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ins (
    insid smallint NOT NULL,
    insefdt timestamp without time zone NOT NULL,
    insact boolean NOT NULL,
    insabvr text,
    insname text NOT NULL,
    insadd1 text NOT NULL,
    insadd2 text,
    inscity text NOT NULL,
    insstate text NOT NULL,
    inszip text NOT NULL,
    insphone text NOT NULL,
    insfax text,
    modby text NOT NULL
);


ALTER TABLE ins OWNER TO postgres;

--
-- Name: manifest; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE manifest (
    manifest integer NOT NULL,
    manefdt timestamp without time zone NOT NULL,
    manact boolean NOT NULL,
    acct integer NOT NULL,
    aefdt timestamp without time zone NOT NULL,
    maninfo text NOT NULL,
    modby text NOT NULL
);


ALTER TABLE manifest OWNER TO postgres;

--
-- Name: manifestord; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE manifestord (
    manifest integer NOT NULL,
    manefdt timestamp without time zone NOT NULL,
    ord integer NOT NULL,
    ordefdt timestamp without time zone NOT NULL
);


ALTER TABLE manifestord OWNER TO postgres;

--
-- Name: med; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE med (
    med text NOT NULL,
    medefdt timestamp without time zone NOT NULL,
    medact boolean NOT NULL,
    meddesc timestamp without time zone NOT NULL
);


ALTER TABLE med OWNER TO postgres;

--
-- Name: medord; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE medord (
    med text NOT NULL,
    medefdt timestamp without time zone NOT NULL,
    ord integer NOT NULL,
    ordefdt timestamp without time zone NOT NULL,
    dose text,
    lastdose text
);


ALTER TABLE medord OWNER TO postgres;

--
-- Name: oc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE oc (
    oc text NOT NULL,
    oefdt timestamp without time zone NOT NULL,
    oname text NOT NULL,
    oact boolean NOT NULL,
    modby text NOT NULL
);


ALTER TABLE oc OWNER TO postgres;

--
-- Name: octc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE octc (
    oc text NOT NULL,
    oefdt timestamp without time zone NOT NULL,
    tc text NOT NULL,
    tefdt timestamp without time zone NOT NULL
);


ALTER TABLE octc OWNER TO postgres;

--
-- Name: ord; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE ord (
    ord integer NOT NULL,
    ordefdt timestamp without time zone NOT NULL,
    ordact boolean NOT NULL,
    pat integer NOT NULL,
    pefdt timestamp without time zone NOT NULL,
    oc text NOT NULL,
    oefdt timestamp without time zone NOT NULL,
    acct integer NOT NULL,
    aefdt timestamp without time zone NOT NULL,
    npi integer NOT NULL,
    phyefdt timestamp without time zone NOT NULL,
    modby text NOT NULL
);


ALTER TABLE ord OWNER TO postgres;

--
-- Name: orddiag; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE orddiag (
    ord integer NOT NULL,
    oefdt timestamp without time zone NOT NULL,
    diag text NOT NULL,
    diagefdt timestamp without time zone NOT NULL
);


ALTER TABLE orddiag OWNER TO postgres;

--
-- Name: phy; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE phy (
    npi integer NOT NULL,
    phyefdt timestamp without time zone NOT NULL,
    phyact boolean NOT NULL,
    phytitle text,
    phyfname text NOT NULL,
    phylname text NOT NULL,
    phymname text,
    phycred text,
    modby text NOT NULL
);


ALTER TABLE phy OWNER TO postgres;

--
-- Name: pins; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pins (
    pat integer NOT NULL,
    pefdt timestamp without time zone NOT NULL,
    pinseq smallint NOT NULL,
    pinsact boolean NOT NULL,
    insid integer NOT NULL,
    insefdt timestamp without time zone NOT NULL,
    pinspol text NOT NULL,
    pinsgrp abstime,
    pinsrel path NOT NULL,
    pinsfname text NOT NULL,
    pinslname text NOT NULL,
    pinsmname path,
    pinssuffix text,
    pinsdob date NOT NULL,
    pinsssn text,
    pinssex text NOT NULL,
    pinsadd1 text NOT NULL,
    pinsadd2 text,
    pinscity text NOT NULL,
    pinsstate text NOT NULL,
    pinszip text NOT NULL,
    pinsphone text NOT NULL,
    pinsstart text,
    pinsend text,
    pinsref text,
    modby text NOT NULL
);


ALTER TABLE pins OWNER TO postgres;

--
-- Name: pmdcd; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pmdcd (
    pat integer NOT NULL,
    pefdt timestamp without time zone NOT NULL,
    pmdcdseq smallint NOT NULL,
    pmdcdid text NOT NULL,
    pmdcdstate text NOT NULL,
    pmdcdstart date NOT NULL,
    pmdcdend date NOT NULL,
    modby text NOT NULL
);


ALTER TABLE pmdcd OWNER TO postgres;

--
-- Name: pmdcr; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pmdcr (
    pat integer NOT NULL,
    pefdt timestamp without time zone NOT NULL,
    pmdcrseq smallint NOT NULL,
    pmdcrid text NOT NULL,
    pmdcrstate text NOT NULL,
    pmdcrstart date,
    pmdcrend date,
    modby text NOT NULL
);


ALTER TABLE pmdcr OWNER TO postgres;

--
-- Name: pwc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE pwc (
    pat integer NOT NULL,
    pefdt timestamp without time zone NOT NULL,
    pwcseq smallint NOT NULL,
    pwcid text NOT NULL,
    pwccompany text NOT NULL,
    pwcadd1 text NOT NULL,
    pwcadd2 text,
    pwccity text NOT NULL,
    pwcstate text NOT NULL,
    pwczip text NOT NULL,
    pwcphone text,
    pwcadjuster text,
    pwcinjdate text,
    pwcaccident boolean,
    modby text NOT NULL
);


ALTER TABLE pwc OWNER TO postgres;

--
-- Name: rc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE rc (
    rc text NOT NULL,
    refdt timestamp without time zone NOT NULL,
    rname text NOT NULL,
    rmeasure text NOT NULL,
    ract boolean NOT NULL,
    modby text NOT NULL
);


ALTER TABLE rc OWNER TO postgres;

--
-- Name: result; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE result (
    result text NOT NULL,
    resefdt timestamp without time zone NOT NULL,
    resact boolean NOT NULL,
    ord integer NOT NULL,
    ordefdt timestamp without time zone NOT NULL,
    rc text NOT NULL,
    refdt timestamp without time zone NOT NULL
);


ALTER TABLE result OWNER TO postgres;

--
-- Name: tc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tc (
    tc text NOT NULL,
    tefdt timestamp without time zone NOT NULL,
    tname text NOT NULL,
    tact boolean NOT NULL,
    modby text NOT NULL
);


ALTER TABLE tc OWNER TO postgres;

--
-- Name: tcrc; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE tcrc (
    tc text NOT NULL,
    tefdt timestamp without time zone NOT NULL,
    rc text NOT NULL,
    refdt timestamp without time zone NOT NULL
);


ALTER TABLE tcrc OWNER TO postgres;

--
-- Data for Name: acct; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY acct (acct, aefdt, aact, aname1, aname2, aadd1, aadd2, acity, astate, azip, aphone, afax, acontact, amisc1, amisc2, amisc3, modby) FROM stdin;
0	2016-05-02 11:12:42	f	Test Name 1	Test Name 2	Test address 1	Test address 2	Test City	Test State	99999	123-456-7890	123-456-7891	Test Contact	Test misc1	Test misc2	Test misc3	%SYS
1	2016-05-02 16:48:37	f	test		test	test	test	test	test	test		test	\N	\N	\N	%SYS
2	2016-05-02 16:49:23	f	Test Account	suite B	123 Anywhere Ln		Nashville	TN	37204	123-456-7890		Test@test.com	\N	\N	\N	%SYS
3	2016-05-03 08:12:02	f	Test Account 3	ya know	123 Somewhere ln		Nashville	TN	37204	123-456-7890			\N	\N	\N	%SYS
4	2016-05-03 08:14:20	f	Test account 4		Test	test	test	test	test	test	test		\N	\N	\N	%SYS
8	2016-05-03 08:19:48	f	test	123	test	test	test	test	test	test	test	test	\N	\N	\N	%SYS
9	2016-05-04 21:05:00	t	This is a test account	Test account line 2	Account address 123	suite what	Nashville	TN	37204	123-456-790	123456-694541	test@test.com	\N	\N	\N	%SYS
5	2016-05-03 08:14:45	f	test account 5	test account	test	test	test	test	test	test	test		\N	\N	\N	%SYS
6	2016-05-03 08:19:22	f	test	123	test	test	test	test	test	test	test	test	\N	\N	\N	%SYS
7	2016-05-05 11:14:06	t	test	123	test	test	test	test	test	test	test		\N	\N	\N	%SYS
\.


--
-- Data for Name: acctoc; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY acctoc (acct, aefdt, oc, oefdt) FROM stdin;
\.


--
-- Data for Name: acctphy; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY acctphy (acct, aefdt, npi, phyefdt) FROM stdin;
\.


--
-- Data for Name: demo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY demo (pat, pefdt, pact, pfname, plname, pmname, psuffix, dob, ssn, psex, padd1, padd2, pcity, pstate, pzip, pphone, pid, modby) FROM stdin;
\.


--
-- Data for Name: diag; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY diag (diag, diagefdt, diagact, diagdesc) FROM stdin;
\.


--
-- Data for Name: guar; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY guar (pat, pefdt, gact, rel, gfname, glame, gmname, gsuffix, gdob, gssn, gsex, gadd1, gadd2, gcity, gstate, gzip, gphone, modby) FROM stdin;
\.


--
-- Data for Name: ins; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ins (insid, insefdt, insact, insabvr, insname, insadd1, insadd2, inscity, insstate, inszip, insphone, insfax, modby) FROM stdin;
2	2016-06-01 10:42:35	t	test									%SYS
0	2016-05-19 15:54:10	f	Test	Test Insurance Group	123 Anywhere Ln	ste 100	Nashville	TN	37204			%SYS
1	2016-05-19 16:05:47	f	Test2	Test 2								%SYS
\.


--
-- Data for Name: manifest; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY manifest (manifest, manefdt, manact, acct, aefdt, maninfo, modby) FROM stdin;
\.


--
-- Data for Name: manifestord; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY manifestord (manifest, manefdt, ord, ordefdt) FROM stdin;
\.


--
-- Data for Name: med; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY med (med, medefdt, medact, meddesc) FROM stdin;
\.


--
-- Data for Name: medord; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY medord (med, medefdt, ord, ordefdt, dose, lastdose) FROM stdin;
\.


--
-- Data for Name: oc; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY oc (oc, oefdt, oname, oact, modby) FROM stdin;
\.


--
-- Data for Name: octc; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY octc (oc, oefdt, tc, tefdt) FROM stdin;
\.


--
-- Data for Name: ord; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY ord (ord, ordefdt, ordact, pat, pefdt, oc, oefdt, acct, aefdt, npi, phyefdt, modby) FROM stdin;
\.


--
-- Data for Name: orddiag; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY orddiag (ord, oefdt, diag, diagefdt) FROM stdin;
\.


--
-- Data for Name: phy; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY phy (npi, phyefdt, phyact, phytitle, phyfname, phylname, phymname, phycred, modby) FROM stdin;
123456789	2016-05-17 10:17:20	f	Dr	Updated	Updated	Updated	DO	%SYS
123456789	2016-05-17 10:17:37	t	Dr	Test	Test	Test	DO	%SYS
1234567890	2016-05-05 15:11:25	f	Dr	Test	TEST	Test	DO	%SYS
1234567890	2016-05-17 10:16:56	f	Dr	Test	TEST	Test	DO	%SYS
1234567890	2016-05-17 10:17:06	f	Dr	Updated	Updated	Updated	DO	%SYS
1234567890	2016-05-18 11:51:06	t	Dr	Updated	Updated	Updated	DO	%SYS
\.


--
-- Data for Name: pins; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pins (pat, pefdt, pinseq, pinsact, insid, insefdt, pinspol, pinsgrp, pinsrel, pinsfname, pinslname, pinsmname, pinssuffix, pinsdob, pinsssn, pinssex, pinsadd1, pinsadd2, pinscity, pinsstate, pinszip, pinsphone, pinsstart, pinsend, pinsref, modby) FROM stdin;
\.


--
-- Data for Name: pmdcd; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pmdcd (pat, pefdt, pmdcdseq, pmdcdid, pmdcdstate, pmdcdstart, pmdcdend, modby) FROM stdin;
\.


--
-- Data for Name: pmdcr; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pmdcr (pat, pefdt, pmdcrseq, pmdcrid, pmdcrstate, pmdcrstart, pmdcrend, modby) FROM stdin;
\.


--
-- Data for Name: pwc; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pwc (pat, pefdt, pwcseq, pwcid, pwccompany, pwcadd1, pwcadd2, pwccity, pwcstate, pwczip, pwcphone, pwcadjuster, pwcinjdate, pwcaccident, modby) FROM stdin;
\.


--
-- Data for Name: rc; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY rc (rc, refdt, rname, rmeasure, ract, modby) FROM stdin;
\.


--
-- Data for Name: result; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY result (result, resefdt, resact, ord, ordefdt, rc, refdt) FROM stdin;
\.


--
-- Data for Name: tc; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tc (tc, tefdt, tname, tact, modby) FROM stdin;
\.


--
-- Data for Name: tcrc; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY tcrc (tc, tefdt, rc, refdt) FROM stdin;
\.


--
-- Name: Pat and PEFDT combined key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY demo
    ADD CONSTRAINT "Pat and PEFDT combined key" PRIMARY KEY (pat, pefdt);


--
-- Name: acct pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY acct
    ADD CONSTRAINT "acct pk" PRIMARY KEY (acct, aefdt);


--
-- Name: diag pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY diag
    ADD CONSTRAINT "diag pk" PRIMARY KEY (diag, diagefdt);


--
-- Name: ins pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ins
    ADD CONSTRAINT "ins pk" PRIMARY KEY (insid, insefdt);


--
-- Name: manifest pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY manifest
    ADD CONSTRAINT "manifest pk" PRIMARY KEY (manifest, manefdt);


--
-- Name: med pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY med
    ADD CONSTRAINT "med pk" PRIMARY KEY (med, medefdt);


--
-- Name: oc pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY oc
    ADD CONSTRAINT "oc pk" PRIMARY KEY (oc, oefdt);


--
-- Name: ord pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY ord
    ADD CONSTRAINT "ord pk" PRIMARY KEY (ord, ordefdt);


--
-- Name: phy pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY phy
    ADD CONSTRAINT "phy pk" PRIMARY KEY (npi, phyefdt);


--
-- Name: rc pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY rc
    ADD CONSTRAINT "rc pk" PRIMARY KEY (rc, refdt);


--
-- Name: tc pk; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY tc
    ADD CONSTRAINT "tc pk" PRIMARY KEY (tc, tefdt);


--
-- Name: dob; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX dob ON demo USING btree (dob);


--
-- Name: fki_acct -> acctphy; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_acct -> acctphy" ON acctphy USING btree (acct, aefdt);


--
-- Name: fki_acctoc acct fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_acctoc acct fk" ON acctoc USING btree (acct, aefdt);


--
-- Name: fki_acctoc oc fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_acctoc oc fk" ON acctoc USING btree (oc, oefdt);


--
-- Name: fki_acctphy phy fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_acctphy phy fk" ON acctphy USING btree (npi, phyefdt);


--
-- Name: fki_demo FK; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_demo FK" ON guar USING btree (pat, pefdt);


--
-- Name: fki_demo pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_demo pk" ON pins USING btree (pat, pefdt);


--
-- Name: fki_ins fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_ins fk" ON pins USING btree (insid, insefdt);


--
-- Name: fki_manifest acct fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_manifest acct fk" ON manifest USING btree (acct, aefdt);


--
-- Name: fki_manord man fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_manord man fk" ON manifestord USING btree (manifest, manefdt);


--
-- Name: fki_medord  ord fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_medord  ord fk" ON medord USING btree (ord, ordefdt);


--
-- Name: fki_medord med fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_medord med fk" ON medord USING btree (med, medefdt);


--
-- Name: fki_medord ord fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_medord ord fk" ON manifestord USING btree (ord, ordefdt);


--
-- Name: fki_octc oc fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_octc oc fk" ON octc USING btree (oc, oefdt);


--
-- Name: fki_octc tc pk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_octc tc pk" ON octc USING btree (tc, tefdt);


--
-- Name: fki_ord acct fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_ord acct fk" ON ord USING btree (acct, aefdt);


--
-- Name: fki_ord oc fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_ord oc fk" ON ord USING btree (oc, oefdt);


--
-- Name: fki_ord phy fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_ord phy fk" ON ord USING btree (npi, phyefdt);


--
-- Name: fki_orddiag diag fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_orddiag diag fk" ON orddiag USING btree (diag, diagefdt);


--
-- Name: fki_orddiag ord fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_orddiag ord fk" ON orddiag USING btree (ord, oefdt);


--
-- Name: fki_pmdcd fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_pmdcd fk" ON pmdcd USING btree (pat, pefdt);


--
-- Name: fki_pmdcr fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_pmdcr fk" ON pmdcr USING btree (pat, pefdt);


--
-- Name: fki_pwc fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_pwc fk" ON pwc USING btree (pat, pefdt);


--
-- Name: fki_result ord fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_result ord fk" ON result USING btree (ord, ordefdt);


--
-- Name: fki_result rc fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_result rc fk" ON result USING btree (rc, refdt);


--
-- Name: fki_tcrc rc fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_tcrc rc fk" ON tcrc USING btree (rc, refdt);


--
-- Name: fki_tcrc tc fk; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "fki_tcrc tc fk" ON tcrc USING btree (tc, tefdt);


--
-- Name: gdob; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX gdob ON guar USING btree (gdob);


--
-- Name: gpat; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX gpat ON guar USING btree (pat);


--
-- Name: gssn; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX gssn ON guar USING btree (gssn);


--
-- Name: lname; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX lname ON guar USING btree (glame);


--
-- Name: npi indx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "npi indx" ON phy USING btree (npi);


--
-- Name: patid; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX patid ON demo USING btree (pat);


--
-- Name: phylname indx; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX "phylname indx" ON phy USING btree (phylname);


--
-- Name: plname; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX plname ON demo USING btree (plname);


--
-- Name: ssn; Type: INDEX; Schema: public; Owner: postgres; Tablespace: 
--

CREATE INDEX ssn ON demo USING btree (ssn);


--
-- Name: acct -> acctphy; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acctphy
    ADD CONSTRAINT "acct -> acctphy" FOREIGN KEY (acct, aefdt) REFERENCES acct(acct, aefdt);


--
-- Name: acctoc acct fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acctoc
    ADD CONSTRAINT "acctoc acct fk" FOREIGN KEY (acct, aefdt) REFERENCES acct(acct, aefdt);


--
-- Name: acctoc oc fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acctoc
    ADD CONSTRAINT "acctoc oc fk" FOREIGN KEY (oc, oefdt) REFERENCES oc(oc, oefdt);


--
-- Name: acctphy acct fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acct
    ADD CONSTRAINT "acctphy acct fk" FOREIGN KEY (acct, aefdt) REFERENCES acct(acct, aefdt);


--
-- Name: acctphy_npi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY acctphy
    ADD CONSTRAINT acctphy_npi_fkey FOREIGN KEY (npi, phyefdt) REFERENCES phy(npi, phyefdt);


--
-- Name: demo FK; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY guar
    ADD CONSTRAINT "demo FK" FOREIGN KEY (pat, pefdt) REFERENCES demo(pat, pefdt);


--
-- Name: demo pk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pins
    ADD CONSTRAINT "demo pk" FOREIGN KEY (pat, pefdt) REFERENCES demo(pat, pefdt);


--
-- Name: ins fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pins
    ADD CONSTRAINT "ins fk" FOREIGN KEY (insid, insefdt) REFERENCES ins(insid, insefdt);


--
-- Name: manifest acct fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY manifest
    ADD CONSTRAINT "manifest acct fk" FOREIGN KEY (acct, aefdt) REFERENCES acct(acct, aefdt);


--
-- Name: manifestord_ord_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY manifestord
    ADD CONSTRAINT manifestord_ord_fkey FOREIGN KEY (ord, ordefdt) REFERENCES ord(ord, ordefdt);


--
-- Name: manord man fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY manifestord
    ADD CONSTRAINT "manord man fk" FOREIGN KEY (manifest, manefdt) REFERENCES manifest(manifest, manefdt);


--
-- Name: medord med fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY medord
    ADD CONSTRAINT "medord med fk" FOREIGN KEY (med, medefdt) REFERENCES med(med, medefdt);


--
-- Name: medord_ord_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY medord
    ADD CONSTRAINT medord_ord_fkey FOREIGN KEY (ord, ordefdt) REFERENCES ord(ord, ordefdt);


--
-- Name: octc oc fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY octc
    ADD CONSTRAINT "octc oc fk" FOREIGN KEY (oc, oefdt) REFERENCES oc(oc, oefdt);


--
-- Name: octc tc pk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY octc
    ADD CONSTRAINT "octc tc pk" FOREIGN KEY (tc, tefdt) REFERENCES tc(tc, tefdt);


--
-- Name: ord acct fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ord
    ADD CONSTRAINT "ord acct fk" FOREIGN KEY (acct, aefdt) REFERENCES acct(acct, aefdt);


--
-- Name: ord oc fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ord
    ADD CONSTRAINT "ord oc fk" FOREIGN KEY (oc, oefdt) REFERENCES oc(oc, oefdt);


--
-- Name: ord pat fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ord
    ADD CONSTRAINT "ord pat fk" FOREIGN KEY (pat, pefdt) REFERENCES demo(pat, pefdt);


--
-- Name: ord_npi_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY ord
    ADD CONSTRAINT ord_npi_fkey FOREIGN KEY (npi, phyefdt) REFERENCES phy(npi, phyefdt);


--
-- Name: orddiag diag fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY orddiag
    ADD CONSTRAINT "orddiag diag fk" FOREIGN KEY (diag, diagefdt) REFERENCES diag(diag, diagefdt);


--
-- Name: orddiag_ord_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY orddiag
    ADD CONSTRAINT orddiag_ord_fkey FOREIGN KEY (ord, oefdt) REFERENCES ord(ord, ordefdt);


--
-- Name: pmdcd fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pmdcd
    ADD CONSTRAINT "pmdcd fk" FOREIGN KEY (pat, pefdt) REFERENCES demo(pat, pefdt);


--
-- Name: pmdcr fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pmdcr
    ADD CONSTRAINT "pmdcr fk" FOREIGN KEY (pat, pefdt) REFERENCES demo(pat, pefdt);


--
-- Name: pwc fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pwc
    ADD CONSTRAINT "pwc fk" FOREIGN KEY (pat, pefdt) REFERENCES demo(pat, pefdt);


--
-- Name: result rc fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY result
    ADD CONSTRAINT "result rc fk" FOREIGN KEY (rc, refdt) REFERENCES rc(rc, refdt);


--
-- Name: result_ord_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY result
    ADD CONSTRAINT result_ord_fkey FOREIGN KEY (ord, ordefdt) REFERENCES ord(ord, ordefdt);


--
-- Name: tcrc rc fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tcrc
    ADD CONSTRAINT "tcrc rc fk" FOREIGN KEY (rc, refdt) REFERENCES rc(rc, refdt);


--
-- Name: tcrc tc fk; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY tcrc
    ADD CONSTRAINT "tcrc tc fk" FOREIGN KEY (tc, tefdt) REFERENCES tc(tc, tefdt);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

