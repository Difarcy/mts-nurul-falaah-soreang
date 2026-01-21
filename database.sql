--
-- PostgreSQL database dump
--

\restrict g6Id2Tubvc8tH2nBBejbULRltVocV1uiN9GT79kxclXWJB5laJgPGLoTP9gmJjJ

-- Dumped from database version 18.1
-- Dumped by pg_dump version 18.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
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
-- Name: activity_photos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.activity_photos (
    id bigint NOT NULL,
    judul character varying(255),
    deskripsi text,
    gambar character varying(255) NOT NULL,
    urutan integer DEFAULT 0 NOT NULL,
    is_active boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.activity_photos OWNER TO postgres;

--
-- Name: activity_photos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.activity_photos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.activity_photos_id_seq OWNER TO postgres;

--
-- Name: activity_photos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.activity_photos_id_seq OWNED BY public.activity_photos.id;


--
-- Name: activity_videos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.activity_videos (
    id bigint NOT NULL,
    judul character varying(255),
    youtube_url character varying(255) NOT NULL,
    youtube_id character varying(255),
    urutan integer DEFAULT 0 NOT NULL,
    is_active boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.activity_videos OWNER TO postgres;

--
-- Name: activity_videos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.activity_videos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.activity_videos_id_seq OWNER TO postgres;

--
-- Name: activity_videos_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.activity_videos_id_seq OWNED BY public.activity_videos.id;


--
-- Name: agendas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.agendas (
    id bigint NOT NULL,
    judul character varying(255) NOT NULL,
    author_name character varying(255),
    deskripsi text,
    tanggal_mulai date,
    tanggal_selesai date,
    waktu_mulai time(0) without time zone,
    waktu_selesai time(0) without time zone,
    lokasi character varying(255),
    urutan integer DEFAULT 0 NOT NULL,
    status character varying(255) DEFAULT 'draft'::character varying NOT NULL,
    published_at timestamp(0) without time zone,
    views_count bigint DEFAULT '0'::bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.agendas OWNER TO postgres;

--
-- Name: agendas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.agendas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.agendas_id_seq OWNER TO postgres;

--
-- Name: agendas_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.agendas_id_seq OWNED BY public.agendas.id;


--
-- Name: announcements; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.announcements (
    id bigint NOT NULL,
    judul character varying(255) NOT NULL,
    isi text NOT NULL,
    tanggal date,
    urutan integer DEFAULT 0 NOT NULL,
    status character varying(255) DEFAULT 'draft'::character varying NOT NULL,
    author_name character varying(255),
    views_count bigint DEFAULT '0'::bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.announcements OWNER TO postgres;

--
-- Name: announcements_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.announcements_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.announcements_id_seq OWNER TO postgres;

--
-- Name: announcements_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.announcements_id_seq OWNED BY public.announcements.id;


--
-- Name: banners; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.banners (
    id bigint NOT NULL,
    judul character varying(255),
    tagline character varying(255),
    deskripsi text,
    gambar character varying(255) NOT NULL,
    link character varying(255),
    button_text character varying(255),
    urutan integer DEFAULT 0 NOT NULL,
    is_active boolean DEFAULT true NOT NULL,
    show_logo boolean DEFAULT false NOT NULL,
    show_tagline boolean DEFAULT false NOT NULL,
    show_title boolean DEFAULT false NOT NULL,
    show_description boolean DEFAULT false NOT NULL,
    show_button boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.banners OWNER TO postgres;

--
-- Name: banners_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.banners_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.banners_id_seq OWNER TO postgres;

--
-- Name: banners_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.banners_id_seq OWNED BY public.banners.id;


--
-- Name: cache; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache (
    key character varying(255) NOT NULL,
    value text NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache OWNER TO postgres;

--
-- Name: cache_locks; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.cache_locks (
    key character varying(255) NOT NULL,
    owner character varying(255) NOT NULL,
    expiration integer NOT NULL
);


ALTER TABLE public.cache_locks OWNER TO postgres;

--
-- Name: chatbot_conversations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.chatbot_conversations (
    id bigint NOT NULL,
    session_id character varying(255) NOT NULL,
    user_message text,
    bot_response text,
    intent_matched character varying(255),
    confidence_score numeric(5,2),
    response_time_ms integer,
    method character varying(255),
    ip_address character varying(255),
    user_agent text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.chatbot_conversations OWNER TO postgres;

--
-- Name: chatbot_conversations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.chatbot_conversations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.chatbot_conversations_id_seq OWNER TO postgres;

--
-- Name: chatbot_conversations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.chatbot_conversations_id_seq OWNED BY public.chatbot_conversations.id;


--
-- Name: comment_likes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.comment_likes (
    id bigint NOT NULL,
    comment_id bigint NOT NULL,
    user_id bigint,
    session_id character varying(255),
    ip_address character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.comment_likes OWNER TO postgres;

--
-- Name: comment_likes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.comment_likes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.comment_likes_id_seq OWNER TO postgres;

--
-- Name: comment_likes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.comment_likes_id_seq OWNED BY public.comment_likes.id;


--
-- Name: comments; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.comments (
    id bigint NOT NULL,
    post_id bigint NOT NULL,
    parent_id bigint,
    is_admin boolean DEFAULT false NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    comment text NOT NULL,
    admin_reply_by character varying(255),
    admin_reply text,
    admin_replied_at timestamp(0) without time zone,
    is_approved boolean DEFAULT false NOT NULL,
    is_read boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.comments OWNER TO postgres;

--
-- Name: comments_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.comments_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.comments_id_seq OWNER TO postgres;

--
-- Name: comments_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.comments_id_seq OWNED BY public.comments.id;


--
-- Name: contacts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.contacts (
    id bigint NOT NULL,
    jenis character varying(255) NOT NULL,
    label character varying(255),
    nilai text NOT NULL,
    icon character varying(255),
    urutan integer DEFAULT 0 NOT NULL,
    is_active boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.contacts OWNER TO postgres;

--
-- Name: contacts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.contacts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.contacts_id_seq OWNER TO postgres;

--
-- Name: contacts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.contacts_id_seq OWNED BY public.contacts.id;


--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.failed_jobs_id_seq OWNER TO postgres;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: inbox_messages; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.inbox_messages (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    email character varying(255),
    phone character varying(255),
    message text NOT NULL,
    is_read boolean DEFAULT false NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.inbox_messages OWNER TO postgres;

--
-- Name: inbox_messages_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.inbox_messages_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.inbox_messages_id_seq OWNER TO postgres;

--
-- Name: inbox_messages_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.inbox_messages_id_seq OWNED BY public.inbox_messages.id;


--
-- Name: info_texts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.info_texts (
    id bigint NOT NULL,
    key character varying(255) NOT NULL,
    value text,
    deskripsi character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.info_texts OWNER TO postgres;

--
-- Name: info_texts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.info_texts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.info_texts_id_seq OWNER TO postgres;

--
-- Name: info_texts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.info_texts_id_seq OWNED BY public.info_texts.id;


--
-- Name: job_batches; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.job_batches (
    id character varying(255) NOT NULL,
    name character varying(255) NOT NULL,
    total_jobs integer NOT NULL,
    pending_jobs integer NOT NULL,
    failed_jobs integer NOT NULL,
    failed_job_ids text NOT NULL,
    options text,
    cancelled_at integer,
    created_at integer NOT NULL,
    finished_at integer
);


ALTER TABLE public.job_batches OWNER TO postgres;

--
-- Name: jobs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.jobs (
    id bigint NOT NULL,
    queue character varying(255) NOT NULL,
    payload text NOT NULL,
    attempts smallint NOT NULL,
    reserved_at integer,
    available_at integer NOT NULL,
    created_at integer NOT NULL
);


ALTER TABLE public.jobs OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.jobs_id_seq OWNER TO postgres;

--
-- Name: jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.jobs_id_seq OWNED BY public.jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.migrations_id_seq OWNER TO postgres;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_reset_tokens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.password_reset_tokens (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_reset_tokens OWNER TO postgres;

--
-- Name: post_views; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.post_views (
    id bigint NOT NULL,
    post_id bigint NOT NULL,
    session_id character varying(255) NOT NULL,
    ip_address character varying(255),
    viewed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.post_views OWNER TO postgres;

--
-- Name: post_views_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.post_views_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.post_views_id_seq OWNER TO postgres;

--
-- Name: post_views_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.post_views_id_seq OWNED BY public.post_views.id;


--
-- Name: posts; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.posts (
    id bigint NOT NULL,
    title character varying(255) NOT NULL,
    slug character varying(255) NOT NULL,
    type character varying(255) DEFAULT 'berita'::character varying NOT NULL,
    excerpt text,
    body text NOT NULL,
    thumbnail_path character varying(255),
    status character varying(255) DEFAULT 'draft'::character varying NOT NULL,
    published_at timestamp(0) without time zone,
    is_featured boolean DEFAULT false NOT NULL,
    author_id bigint,
    author_name character varying(255),
    meta_description character varying(255),
    tags json,
    images json,
    image_metadata json,
    view_count bigint DEFAULT '0'::bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.posts OWNER TO postgres;

--
-- Name: posts_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.posts_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.posts_id_seq OWNER TO postgres;

--
-- Name: posts_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.posts_id_seq OWNED BY public.posts.id;


--
-- Name: school_profiles; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.school_profiles (
    id bigint NOT NULL,
    nama_sekolah character varying(255),
    gambar_sekolah character varying(255),
    deskripsi_sekolah text,
    sejarah text,
    visi text,
    misi text,
    tujuan text,
    struktur_organisasi text,
    kepala_sekolah_nama character varying(255),
    kepala_sekolah_foto character varying(255),
    kepala_sekolah_sambutan text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.school_profiles OWNER TO postgres;

--
-- Name: school_profiles_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.school_profiles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.school_profiles_id_seq OWNER TO postgres;

--
-- Name: school_profiles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.school_profiles_id_seq OWNED BY public.school_profiles.id;


--
-- Name: sessions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id bigint,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO postgres;

--
-- Name: spmb_faqs; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.spmb_faqs (
    id bigint NOT NULL,
    question character varying(255) NOT NULL,
    answer text NOT NULL,
    urutan integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.spmb_faqs OWNER TO postgres;

--
-- Name: spmb_faqs_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.spmb_faqs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.spmb_faqs_id_seq OWNER TO postgres;

--
-- Name: spmb_faqs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.spmb_faqs_id_seq OWNED BY public.spmb_faqs.id;


--
-- Name: spmb_requirements; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.spmb_requirements (
    id bigint NOT NULL,
    content character varying(255) NOT NULL,
    type character varying(255) DEFAULT 'general'::character varying NOT NULL,
    urutan integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    CONSTRAINT spmb_requirements_type_check CHECK (((type)::text = ANY ((ARRAY['general'::character varying, 'document'::character varying, 'other'::character varying])::text[])))
);


ALTER TABLE public.spmb_requirements OWNER TO postgres;

--
-- Name: spmb_requirements_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.spmb_requirements_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.spmb_requirements_id_seq OWNER TO postgres;

--
-- Name: spmb_requirements_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.spmb_requirements_id_seq OWNED BY public.spmb_requirements.id;


--
-- Name: spmb_settings; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.spmb_settings (
    id bigint NOT NULL,
    registration_status character varying(255) DEFAULT 'closed'::character varying NOT NULL,
    academic_year character varying(255),
    hero_slogan text,
    registration_start_date date,
    registration_end_date date,
    contact_wa character varying(255),
    quota character varying(255),
    registration_fee numeric(12,2) DEFAULT '0'::numeric NOT NULL,
    banner_path character varying(255),
    show_brochure boolean DEFAULT false NOT NULL,
    brochure_path character varying(255),
    flow_image_path character varying(255),
    step_1_start_date date,
    step_1_end_date date,
    step_2_start_date date,
    step_2_end_date date,
    step_3_start_date date,
    step_3_end_date date,
    step_4_start_date date,
    step_4_end_date date,
    step_5_start_date date,
    step_5_end_date date,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.spmb_settings OWNER TO postgres;

--
-- Name: spmb_settings_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.spmb_settings_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.spmb_settings_id_seq OWNER TO postgres;

--
-- Name: spmb_settings_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.spmb_settings_id_seq OWNED BY public.spmb_settings.id;


--
-- Name: spmb_timelines; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.spmb_timelines (
    id bigint NOT NULL,
    activity character varying(255) NOT NULL,
    start_date date,
    end_date date,
    description character varying(255),
    urutan integer DEFAULT 0 NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.spmb_timelines OWNER TO postgres;

--
-- Name: spmb_timelines_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.spmb_timelines_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.spmb_timelines_id_seq OWNER TO postgres;

--
-- Name: spmb_timelines_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.spmb_timelines_id_seq OWNED BY public.spmb_timelines.id;


--
-- Name: student_achievements; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.student_achievements (
    id bigint NOT NULL,
    judul character varying(255) NOT NULL,
    nama_siswa character varying(255),
    kelas character varying(255),
    jenis_prestasi character varying(255),
    tingkat_prestasi character varying(255),
    deskripsi text,
    gambar character varying(255),
    foto_sertifikat character varying(255),
    tanggal_prestasi date,
    urutan integer DEFAULT 0 NOT NULL,
    is_active boolean DEFAULT true NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.student_achievements OWNER TO postgres;

--
-- Name: student_achievements_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.student_achievements_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.student_achievements_id_seq OWNER TO postgres;

--
-- Name: student_achievements_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.student_achievements_id_seq OWNED BY public.student_achievements.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    username character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    remember_token character varying(100),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: visual_identities; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.visual_identities (
    id bigint NOT NULL,
    logo_path character varying(255),
    tagline character varying(255),
    judul character varying(255),
    deskripsi text,
    link character varying(255),
    button_text character varying(255),
    show_logo boolean DEFAULT true NOT NULL,
    show_tagline boolean DEFAULT true NOT NULL,
    show_title boolean DEFAULT true NOT NULL,
    show_description boolean DEFAULT true NOT NULL,
    show_button boolean DEFAULT true NOT NULL,
    promosi_banner_path character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.visual_identities OWNER TO postgres;

--
-- Name: visual_identities_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.visual_identities_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.visual_identities_id_seq OWNER TO postgres;

--
-- Name: visual_identities_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.visual_identities_id_seq OWNED BY public.visual_identities.id;


--
-- Name: activity_photos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_photos ALTER COLUMN id SET DEFAULT nextval('public.activity_photos_id_seq'::regclass);


--
-- Name: activity_videos id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_videos ALTER COLUMN id SET DEFAULT nextval('public.activity_videos_id_seq'::regclass);


--
-- Name: agendas id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agendas ALTER COLUMN id SET DEFAULT nextval('public.agendas_id_seq'::regclass);


--
-- Name: announcements id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.announcements ALTER COLUMN id SET DEFAULT nextval('public.announcements_id_seq'::regclass);


--
-- Name: banners id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.banners ALTER COLUMN id SET DEFAULT nextval('public.banners_id_seq'::regclass);


--
-- Name: chatbot_conversations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chatbot_conversations ALTER COLUMN id SET DEFAULT nextval('public.chatbot_conversations_id_seq'::regclass);


--
-- Name: comment_likes id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comment_likes ALTER COLUMN id SET DEFAULT nextval('public.comment_likes_id_seq'::regclass);


--
-- Name: comments id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comments ALTER COLUMN id SET DEFAULT nextval('public.comments_id_seq'::regclass);


--
-- Name: contacts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contacts ALTER COLUMN id SET DEFAULT nextval('public.contacts_id_seq'::regclass);


--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: inbox_messages id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inbox_messages ALTER COLUMN id SET DEFAULT nextval('public.inbox_messages_id_seq'::regclass);


--
-- Name: info_texts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_texts ALTER COLUMN id SET DEFAULT nextval('public.info_texts_id_seq'::regclass);


--
-- Name: jobs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs ALTER COLUMN id SET DEFAULT nextval('public.jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: post_views id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post_views ALTER COLUMN id SET DEFAULT nextval('public.post_views_id_seq'::regclass);


--
-- Name: posts id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posts ALTER COLUMN id SET DEFAULT nextval('public.posts_id_seq'::regclass);


--
-- Name: school_profiles id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.school_profiles ALTER COLUMN id SET DEFAULT nextval('public.school_profiles_id_seq'::regclass);


--
-- Name: spmb_faqs id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.spmb_faqs ALTER COLUMN id SET DEFAULT nextval('public.spmb_faqs_id_seq'::regclass);


--
-- Name: spmb_requirements id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.spmb_requirements ALTER COLUMN id SET DEFAULT nextval('public.spmb_requirements_id_seq'::regclass);


--
-- Name: spmb_settings id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.spmb_settings ALTER COLUMN id SET DEFAULT nextval('public.spmb_settings_id_seq'::regclass);


--
-- Name: spmb_timelines id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.spmb_timelines ALTER COLUMN id SET DEFAULT nextval('public.spmb_timelines_id_seq'::regclass);


--
-- Name: student_achievements id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.student_achievements ALTER COLUMN id SET DEFAULT nextval('public.student_achievements_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: visual_identities id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visual_identities ALTER COLUMN id SET DEFAULT nextval('public.visual_identities_id_seq'::regclass);


--
-- Data for Name: activity_photos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.activity_photos (id, judul, deskripsi, gambar, urutan, is_active, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: activity_videos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.activity_videos (id, judul, youtube_url, youtube_id, urutan, is_active, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: agendas; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.agendas (id, judul, author_name, deskripsi, tanggal_mulai, tanggal_selesai, waktu_mulai, waktu_selesai, lokasi, urutan, status, published_at, views_count, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: announcements; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.announcements (id, judul, isi, tanggal, urutan, status, author_name, views_count, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: banners; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.banners (id, judul, tagline, deskripsi, gambar, link, button_text, urutan, is_active, show_logo, show_tagline, show_title, show_description, show_button, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: cache; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache (key, value, expiration) FROM stdin;
\.


--
-- Data for Name: cache_locks; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.cache_locks (key, owner, expiration) FROM stdin;
\.


--
-- Data for Name: chatbot_conversations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.chatbot_conversations (id, session_id, user_message, bot_response, intent_matched, confidence_score, response_time_ms, method, ip_address, user_agent, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: comment_likes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.comment_likes (id, comment_id, user_id, session_id, ip_address, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: comments; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.comments (id, post_id, parent_id, is_admin, name, email, comment, admin_reply_by, admin_reply, admin_replied_at, is_approved, is_read, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: contacts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.contacts (id, jenis, label, nilai, icon, urutan, is_active, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.failed_jobs (id, uuid, connection, queue, payload, exception, failed_at) FROM stdin;
\.


--
-- Data for Name: inbox_messages; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.inbox_messages (id, name, email, phone, message, is_read, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: info_texts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.info_texts (id, key, value, deskripsi, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: job_batches; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.job_batches (id, name, total_jobs, pending_jobs, failed_jobs, failed_job_ids, options, cancelled_at, created_at, finished_at) FROM stdin;
\.


--
-- Data for Name: jobs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.jobs (id, queue, payload, attempts, reserved_at, available_at, created_at) FROM stdin;
\.


--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.migrations (id, migration, batch) FROM stdin;
1	2025_01_01_000000_create_complete_database_schema	1
\.


--
-- Data for Name: password_reset_tokens; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.password_reset_tokens (email, token, created_at) FROM stdin;
\.


--
-- Data for Name: post_views; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.post_views (id, post_id, session_id, ip_address, viewed_at, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: posts; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.posts (id, title, slug, type, excerpt, body, thumbnail_path, status, published_at, is_featured, author_id, author_name, meta_description, tags, images, image_metadata, view_count, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: school_profiles; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.school_profiles (id, nama_sekolah, gambar_sekolah, deskripsi_sekolah, sejarah, visi, misi, tujuan, struktur_organisasi, kepala_sekolah_nama, kepala_sekolah_foto, kepala_sekolah_sambutan, created_at, updated_at) FROM stdin;
1	MTs Nurul Falaah Soreang	\N	\N	\N	\N	\N	\N	\N	\N	\N	\N	2026-01-20 19:58:07	2026-01-20 19:58:07
\.


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) FROM stdin;
\.


--
-- Data for Name: spmb_faqs; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.spmb_faqs (id, question, answer, urutan, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: spmb_requirements; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.spmb_requirements (id, content, type, urutan, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: spmb_settings; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.spmb_settings (id, registration_status, academic_year, hero_slogan, registration_start_date, registration_end_date, contact_wa, quota, registration_fee, banner_path, show_brochure, brochure_path, flow_image_path, step_1_start_date, step_1_end_date, step_2_start_date, step_2_end_date, step_3_start_date, step_3_end_date, step_4_start_date, step_4_end_date, step_5_start_date, step_5_end_date, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: spmb_timelines; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.spmb_timelines (id, activity, start_date, end_date, description, urutan, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: student_achievements; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.student_achievements (id, judul, nama_siswa, kelas, jenis_prestasi, tingkat_prestasi, deskripsi, gambar, foto_sertifikat, tanggal_prestasi, urutan, is_active, created_at, updated_at) FROM stdin;
\.


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, username, password, remember_token, created_at, updated_at) FROM stdin;
1	Admin	admin	$2y$12$iLe/pO2GnDbT436CXElwYuFMwTFoc1dsTWMm.xU4zY6/kBwOIM5SG	\N	2026-01-20 19:58:07	2026-01-20 19:58:07
\.


--
-- Data for Name: visual_identities; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.visual_identities (id, logo_path, tagline, judul, deskripsi, link, button_text, show_logo, show_tagline, show_title, show_description, show_button, promosi_banner_path, created_at, updated_at) FROM stdin;
1	\N	\N	\N	\N	\N	\N	t	t	t	t	t	\N	2026-01-20 19:58:07	2026-01-20 19:58:07
\.


--
-- Name: activity_photos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.activity_photos_id_seq', 1, false);


--
-- Name: activity_videos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.activity_videos_id_seq', 1, false);


--
-- Name: agendas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.agendas_id_seq', 1, false);


--
-- Name: announcements_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.announcements_id_seq', 1, false);


--
-- Name: banners_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.banners_id_seq', 1, false);


--
-- Name: chatbot_conversations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.chatbot_conversations_id_seq', 1, false);


--
-- Name: comment_likes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.comment_likes_id_seq', 1, false);


--
-- Name: comments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.comments_id_seq', 1, false);


--
-- Name: contacts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.contacts_id_seq', 1, false);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: inbox_messages_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.inbox_messages_id_seq', 1, false);


--
-- Name: info_texts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.info_texts_id_seq', 1, false);


--
-- Name: jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.migrations_id_seq', 1, true);


--
-- Name: post_views_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.post_views_id_seq', 1, false);


--
-- Name: posts_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.posts_id_seq', 1, false);


--
-- Name: school_profiles_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.school_profiles_id_seq', 1, false);


--
-- Name: spmb_faqs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.spmb_faqs_id_seq', 1, false);


--
-- Name: spmb_requirements_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.spmb_requirements_id_seq', 1, false);


--
-- Name: spmb_settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.spmb_settings_id_seq', 1, false);


--
-- Name: spmb_timelines_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.spmb_timelines_id_seq', 1, false);


--
-- Name: student_achievements_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.student_achievements_id_seq', 1, false);


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 1, true);


--
-- Name: visual_identities_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.visual_identities_id_seq', 1, false);


--
-- Name: activity_photos activity_photos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_photos
    ADD CONSTRAINT activity_photos_pkey PRIMARY KEY (id);


--
-- Name: activity_videos activity_videos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.activity_videos
    ADD CONSTRAINT activity_videos_pkey PRIMARY KEY (id);


--
-- Name: agendas agendas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.agendas
    ADD CONSTRAINT agendas_pkey PRIMARY KEY (id);


--
-- Name: announcements announcements_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.announcements
    ADD CONSTRAINT announcements_pkey PRIMARY KEY (id);


--
-- Name: banners banners_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.banners
    ADD CONSTRAINT banners_pkey PRIMARY KEY (id);


--
-- Name: cache_locks cache_locks_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache_locks
    ADD CONSTRAINT cache_locks_pkey PRIMARY KEY (key);


--
-- Name: cache cache_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.cache
    ADD CONSTRAINT cache_pkey PRIMARY KEY (key);


--
-- Name: chatbot_conversations chatbot_conversations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.chatbot_conversations
    ADD CONSTRAINT chatbot_conversations_pkey PRIMARY KEY (id);


--
-- Name: comment_likes comment_likes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comment_likes
    ADD CONSTRAINT comment_likes_pkey PRIMARY KEY (id);


--
-- Name: comments comments_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comments
    ADD CONSTRAINT comments_pkey PRIMARY KEY (id);


--
-- Name: contacts contacts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.contacts
    ADD CONSTRAINT contacts_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: inbox_messages inbox_messages_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.inbox_messages
    ADD CONSTRAINT inbox_messages_pkey PRIMARY KEY (id);


--
-- Name: info_texts info_texts_key_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_texts
    ADD CONSTRAINT info_texts_key_unique UNIQUE (key);


--
-- Name: info_texts info_texts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.info_texts
    ADD CONSTRAINT info_texts_pkey PRIMARY KEY (id);


--
-- Name: job_batches job_batches_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.job_batches
    ADD CONSTRAINT job_batches_pkey PRIMARY KEY (id);


--
-- Name: jobs jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.jobs
    ADD CONSTRAINT jobs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: password_reset_tokens password_reset_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.password_reset_tokens
    ADD CONSTRAINT password_reset_tokens_pkey PRIMARY KEY (email);


--
-- Name: post_views post_views_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post_views
    ADD CONSTRAINT post_views_pkey PRIMARY KEY (id);


--
-- Name: posts posts_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_pkey PRIMARY KEY (id);


--
-- Name: posts posts_slug_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_slug_unique UNIQUE (slug);


--
-- Name: school_profiles school_profiles_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.school_profiles
    ADD CONSTRAINT school_profiles_pkey PRIMARY KEY (id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: spmb_faqs spmb_faqs_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.spmb_faqs
    ADD CONSTRAINT spmb_faqs_pkey PRIMARY KEY (id);


--
-- Name: spmb_requirements spmb_requirements_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.spmb_requirements
    ADD CONSTRAINT spmb_requirements_pkey PRIMARY KEY (id);


--
-- Name: spmb_settings spmb_settings_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.spmb_settings
    ADD CONSTRAINT spmb_settings_pkey PRIMARY KEY (id);


--
-- Name: spmb_timelines spmb_timelines_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.spmb_timelines
    ADD CONSTRAINT spmb_timelines_pkey PRIMARY KEY (id);


--
-- Name: student_achievements student_achievements_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.student_achievements
    ADD CONSTRAINT student_achievements_pkey PRIMARY KEY (id);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: users users_username_unique; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_username_unique UNIQUE (username);


--
-- Name: visual_identities visual_identities_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.visual_identities
    ADD CONSTRAINT visual_identities_pkey PRIMARY KEY (id);


--
-- Name: activity_photos_is_active_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX activity_photos_is_active_index ON public.activity_photos USING btree (is_active);


--
-- Name: activity_videos_is_active_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX activity_videos_is_active_index ON public.activity_videos USING btree (is_active);


--
-- Name: agendas_judul_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX agendas_judul_index ON public.agendas USING btree (judul);


--
-- Name: agendas_status_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX agendas_status_index ON public.agendas USING btree (status);


--
-- Name: agendas_tanggal_mulai_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX agendas_tanggal_mulai_index ON public.agendas USING btree (tanggal_mulai);


--
-- Name: announcements_status_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX announcements_status_index ON public.announcements USING btree (status);


--
-- Name: announcements_tanggal_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX announcements_tanggal_index ON public.announcements USING btree (tanggal);


--
-- Name: banners_is_active_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX banners_is_active_index ON public.banners USING btree (is_active);


--
-- Name: chatbot_conversations_intent_matched_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX chatbot_conversations_intent_matched_index ON public.chatbot_conversations USING btree (intent_matched);


--
-- Name: chatbot_conversations_method_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX chatbot_conversations_method_index ON public.chatbot_conversations USING btree (method);


--
-- Name: chatbot_conversations_session_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX chatbot_conversations_session_id_index ON public.chatbot_conversations USING btree (session_id);


--
-- Name: comment_likes_session_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX comment_likes_session_id_index ON public.comment_likes USING btree (session_id);


--
-- Name: comments_email_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX comments_email_index ON public.comments USING btree (email);


--
-- Name: comments_is_approved_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX comments_is_approved_index ON public.comments USING btree (is_approved);


--
-- Name: contacts_is_active_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX contacts_is_active_index ON public.contacts USING btree (is_active);


--
-- Name: contacts_jenis_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX contacts_jenis_index ON public.contacts USING btree (jenis);


--
-- Name: inbox_messages_email_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX inbox_messages_email_index ON public.inbox_messages USING btree (email);


--
-- Name: inbox_messages_is_read_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX inbox_messages_is_read_index ON public.inbox_messages USING btree (is_read);


--
-- Name: jobs_queue_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX jobs_queue_index ON public.jobs USING btree (queue);


--
-- Name: post_views_session_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX post_views_session_id_index ON public.post_views USING btree (session_id);


--
-- Name: posts_is_featured_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX posts_is_featured_index ON public.posts USING btree (is_featured);


--
-- Name: posts_published_at_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX posts_published_at_index ON public.posts USING btree (published_at);


--
-- Name: posts_status_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX posts_status_index ON public.posts USING btree (status);


--
-- Name: posts_type_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX posts_type_index ON public.posts USING btree (type);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: spmb_requirements_type_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX spmb_requirements_type_index ON public.spmb_requirements USING btree (type);


--
-- Name: spmb_settings_registration_status_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX spmb_settings_registration_status_index ON public.spmb_settings USING btree (registration_status);


--
-- Name: spmb_timelines_activity_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX spmb_timelines_activity_index ON public.spmb_timelines USING btree (activity);


--
-- Name: student_achievements_is_active_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX student_achievements_is_active_index ON public.student_achievements USING btree (is_active);


--
-- Name: student_achievements_jenis_prestasi_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX student_achievements_jenis_prestasi_index ON public.student_achievements USING btree (jenis_prestasi);


--
-- Name: student_achievements_tanggal_prestasi_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX student_achievements_tanggal_prestasi_index ON public.student_achievements USING btree (tanggal_prestasi);


--
-- Name: student_achievements_tingkat_prestasi_index; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX student_achievements_tingkat_prestasi_index ON public.student_achievements USING btree (tingkat_prestasi);


--
-- Name: comment_likes comment_likes_comment_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comment_likes
    ADD CONSTRAINT comment_likes_comment_id_foreign FOREIGN KEY (comment_id) REFERENCES public.comments(id) ON DELETE CASCADE;


--
-- Name: comment_likes comment_likes_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comment_likes
    ADD CONSTRAINT comment_likes_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE SET NULL;


--
-- Name: comments comments_parent_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comments
    ADD CONSTRAINT comments_parent_id_foreign FOREIGN KEY (parent_id) REFERENCES public.comments(id) ON DELETE CASCADE;


--
-- Name: comments comments_post_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.comments
    ADD CONSTRAINT comments_post_id_foreign FOREIGN KEY (post_id) REFERENCES public.posts(id) ON DELETE CASCADE;


--
-- Name: post_views post_views_post_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post_views
    ADD CONSTRAINT post_views_post_id_foreign FOREIGN KEY (post_id) REFERENCES public.posts(id) ON DELETE CASCADE;


--
-- Name: posts posts_author_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.posts
    ADD CONSTRAINT posts_author_id_foreign FOREIGN KEY (author_id) REFERENCES public.users(id) ON DELETE SET NULL;


--
-- PostgreSQL database dump complete
--

\unrestrict g6Id2Tubvc8tH2nBBejbULRltVocV1uiN9GT79kxclXWJB5laJgPGLoTP9gmJjJ

