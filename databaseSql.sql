create table dm_loai_hang (
	id serial primary key,
	code		varchar(10)	not null unique,
	ten			varchar(50)	not null,
	link_icon	text					
	);

create table dm_thuoc_tinh (
	id serial primary key,
	code 	varchar(10)		not null unique,
	ten		varchar(50)		not null
	);

create table dm_loai_thuoc_tinh (
	id serial primary key,
	ten		varchar(50)		not null unique
	);

create table  dm_thuoc_tinh_loai_thuoc_tinh(
	id serial primary key,
	id_loai_thuoc_tinh 	integer		not null references dm_loai_thuoc_tinh(id),
	id_thuoc_tinh 		integer		not null references dm_thuoc_tinh(id),
	unique (id_loai_thuoc_tinh,id_thuoc_tinh)
	);

create table dm_hang_hoa (
	id serial primary key,
	code			varchar(10)		not null unique,
	ten				varchar(200)	not null,
	mo_ta			text,
	icon 			varchar(500),
	image1			varchar(500),
	image2			varchar(500),
	image3			varchar(500),
	image4			varchar(500),
	dang_su_dung	varchar(1)		default 'Y'
	);

create table dm_hang_hoa_thuoc_tinh (
	id serial primary key,
	id_hang_hoa		integer			not null references dm_hang_hoa(id),
	id_thuoc_tinh	integer			not null references dm_thuoc_tinh(id),
	mo_ta			text,
	unique (id_hang_hoa,id_thuoc_tinh)
	);

create table dm_hang_hoa_loai_hang (
	id serial primary key,
	id_hang_hoa		integer		not null references dm_hang_hoa(id),
	id_loai_hang	integer		not null references dm_loai_hang(id),
	unique (id_hang_hoa,id_loai_hang)
	);

create table gd_gia (
	id serial primary key,
	id_hang_hoa		integer		not null references dm_hang_hoa(id),
	gia 			integer		not null,
	ngay_phat_hanh	timestamp	not null,
	unique (id_hang_hoa,ngay_phat_hanh)
	);

create table dm_cua_hang (
	id serial primary key,
	code		varchar(10) 	not null unique,
	ten			varchar(200)	not null,
	dia_chi		varchar(500)	not null
	);

create table gd_ton_kho (
	id serial primary key,
	id_cua_hang		integer		not null references dm_cua_hang(id),
	id_hang_hoa   	integer		not null references dm_hang_hoa(id),
	code_size		varchar(15),
	so_luong		integer,
	unique (id_cua_hang,id_hang_hoa,code_size)
	);

create table dm_tai_khoan (
	id serial primary key,
	ten		varchar(50)		not null unique,
	pass	varchar(100)	not null,
	email	varchar(100)
	);

create table dm_nhan_vien (
	id serial primary key,
	code 			varchar(15)		not null unique,
	ten				varchar(50)		not null,
	id_tai_khoan	integer			not null references dm_tai_khoan(id)
	);

create table gd_phieu_nhap (
	id serial primary key,
	code 			varchar(15)		not null unique,
	thoi_gian		timestamp		not null,
	id_nhan_vien		integer		not null references dm_nhan_vien(id)
	);

create table gd_phieu_nhap_chi_tiet (
	id serial primary key,
	id_phieu_nhap		integer 		not null references gd_phieu_nhap(id),
	id_hang_hoa 		integer			not null references dm_hang_hoa(id),
	code_size			varchar(15),
	so_luong			integer			not null,
	don_gia				integer			not null,
	don_gia_binh_quan	integer			not null,
	unique (id_phieu_nhap,id_hang_hoa,code_size)
	);

create table gd_phieu_xuat (
	id serial primary key,
	code 			varchar(15)		not null unique,
	thoi_gian		timestamp		not null,
	id_nhan_vien		integer			not null references dm_nhan_vien(id)
	);

create table gd_phieu_xuat_chi_tiet (
	id serial primary key,
	id_phieu_xuat	integer 		not null references gd_phieu_xuat(id),
	id_hang_hoa 	integer			not null references dm_hang_hoa(id),
	code_size		varchar(15),
	so_luong		integer			not null,
	don_gia			integer			not null,
	unique (id_phieu_xuat,id_hang_hoa,code_size)
	);

create table dm_khach_hang (
	id serial primary key,
	code 			varchar(15)		not null unique,
	ten				varchar(50)		not null,
	dia_chi			varchar(500),
	diem_thuong		integer,
	id_tai_khoan	integer			not null references dm_tai_khoan(id)
	);

create table gd_hoa_don (
	id serial primary key,
	code 			varchar(15)		not null unique,
	thoi_gian		timestamp		not null,
	id_nhan_vien	integer			not null,
	id_khach_hang	integer			not null
	);

create table gd_hoa_don_chi_tiet (
	id serial primary key,
	id_hoa_don 		integer			not null references gd_hoa_don(id),
	id_hang_hoa 	integer			not null references dm_hang_hoa(id),
	code_size		varchar(15),
	so_luong		integer			not null,
	don_gia			integer			not null
	);

create table gd_khuyen_mai (
	id serial primary key,
	time_start		timestamp		not null,
	time_end		timestamp		not null,
	ten 			varchar(50)		not null
	);

create table gd_khuyen_mai_chi_tiet (
	id serial primary key,
	id_khuyen_mai 	integer			not null references gd_khuyen_mai(id),
	id_hang_hoa 	integer			not null references dm_hang_hoa(id),
	giam_gia		decimal(3,2)	not null,
	unique (id_khuyen_mai,id_hang_hoa,giam_gia)
	);

create table gd_like (
	id serial primary key,
	id_tai_khoan	integer	not null references dm_tai_khoan(id),
	id_hang_hoa 	integer not null references dm_hang_hoa(id),
	unique(id_tai_khoan,id_hang_hoa)
	);

create table gd_comment (
	id serial primary key,
	id_tai_khoan 	integer	not null references dm_tai_khoan(id),
	id_hang_hoa 	integer not null references dm_hang_hoa(id),
	thoi_gian		timestamp	not null,
	noi_dung		text not null,
	unique (id_tai_khoan,id_hang_hoa,thoi_gian)
	);




insert into dm_cua_hang(code,ten,dia_chi) values ('CH001','Bắc Âu','32 Trần Duy Hưng, Hà Nội');