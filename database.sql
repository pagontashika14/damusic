create table image (
	id serial primary key,
	code 	varchar(15)		not null unique,
	link 	varchar(500) 	not null
);

create table tai_khoan (
	id serial primary key,
	ten_dang_nhap	varchar(100)	not null unique,
	pass 			varchar(100)	not null,
	loai_tai_khoan	varchar(10)		not null,
	ho_ten			varchar(50),
	code_image		varchar(15)		references image(code)
	);

create table quoc_gia (
	id serial primary key,
	ten  	varchar(50)		not null unique
);

create table nghe_si (
	id serial primary key,
	code		varchar(15)		not null unique,
	nghe_danh	varchar(50)		not null,
	ten 		varchar(50),
	ngay_sinh	varchar(15),
	id_quoc_gia	integer			references quoc_gia(id),
	code_image	varchar(15)		references image(code),
	mo_ta		text
);

create table nhac (
	id serial primary key,
	code 			varchar(15)		not null unique,
	ten 			varchar(100)	not null,
	id_quoc_gia		integer			not null references quoc_gia(id),
	chat_luong		smallint		not null,
	link 			varchar(500)	not null
);

create table nhac_nghe_si (
	id serial primary key,
	code_nhac 		varchar(15) 	not null references nhac(code),
	code_nghe_si	varchar(15)		not null references nghe_si(code),
	unique (code_nhac,code_nghe_si)
);

create table lyrics (
	id serial primary key,
	code_nhac		varchar(15)	 not null references nhac(code),
	ten_tai_khoan 	varchar(100) not null references tai_khoan(ten_dang_nhap),
	loi 			text		 not null
);

create table playlist (
	id serial primary key,
	code 			varchar(15)		not null unique,
	ten 			varchar(100) 	not null,
	ten_tai_khoan	varchar(100)	not null references tai_khoan(ten_dang_nhap),
	code_image		varchar(15)		references image(code),
	mo_ta			text
);

create table playlist_nhac (
	id serial primary key,
	code_playlist 	varchar(15)	not null references playlist(code),
	code_nhac		varchar(15)	not null references nhac(code),
	thoi_gian_tao	timestamp	not null,
	unique (code_playlist,code_nhac)
);

create table album (
	id serial primary key,
	code 			varchar(15)		not null unique,
	ten 			varchar(100)	not null,
	code_nghe_si	varchar(15)		not null references nghe_si(code),
	code_image		varchar(15)		references image(code),
	mo_ta 			text
);

create table album_nhac (
	id serial primary key,
	code_album	 	varchar(15)	not null references album(code),
	code_nhac		varchar(15)	not null references nhac(code),
	thoi_gian_tao	timestamp	not null,
	unique (code_album,code_nhac)
);

INSERT INTO public.image(code, link) VALUES ('img0000001', 'img/avatar.png');

INSERT INTO public.tai_khoan(
            ten_dang_nhap, pass, loai_tai_khoan, ho_ten, code_image)
    VALUES ('admin', '$2y$10$N9q.Aw4yyF2N20PEZUfxX./W1RpXIi.P1JhkW1XXwgkpsp2YI5CXS', 'admin', 'Dương Tuấn Đạt','img0000001');