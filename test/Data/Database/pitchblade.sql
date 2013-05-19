CREATE TABLE test_table (
    id integer NOT NULL,
    name character varying(10) NOT NULL
);
ALTER TABLE public.test_table OWNER TO {username};
CREATE SEQUENCE test_table_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MAXVALUE
    NO MINVALUE
    CACHE 1;
ALTER TABLE public.test_table_id_seq OWNER TO {username};
ALTER SEQUENCE test_table_id_seq OWNED BY test_table.id;
ALTER TABLE test_table ALTER COLUMN id SET DEFAULT nextval('test_table_id_seq'::regclass);
ALTER TABLE ONLY test_table
    ADD CONSTRAINT pk_test_table PRIMARY KEY (id);
REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;