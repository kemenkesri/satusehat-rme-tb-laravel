/*
 Navicat Premium Data Transfer

 Source Server         : PGSQL
 Source Server Type    : PostgreSQL
 Source Server Version : 160002
 Source Host           : localhost:5432
 Source Catalog        : sikuat_sitb
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 160002
 File Encoding         : 65001

 Date: 12/08/2024 12:07:03
*/


-- ----------------------------
-- Table structure for pasien
-- ----------------------------
DROP TABLE IF EXISTS "public"."pasien";
CREATE TABLE "public"."pasien" (
  "id_pasien" "pg_catalog"."int8" NOT NULL DEFAULT nextval('pasien_id_pasien_seq'::regclass),
  "nama_pasien" "pg_catalog"."varchar" COLLATE "pg_catalog"."default" NOT NULL,
  "alamat_pasien" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "no_asuransi_pasien" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "jenis_asuransi_pasien" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "nik_pasien" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "status_kewarganegaraan" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "paspor" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "kewarganegaraan" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "provinsi_id" "pg_catalog"."int8",
  "kabupaten_id" "pg_catalog"."int8",
  "kecamatan_id" "pg_catalog"."int8",
  "desa_id" "pg_catalog"."int8",
  "kode_pos" "pg_catalog"."int8",
  "no_telepon" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "jenis_no_telepon" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "surat_elektronik" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "gol_darah" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "nama_ayah" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "nama_ibu" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "nama_pasangan" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "jenis_kelamin" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "tempat_lahir" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "tgl_lahir" "pg_catalog"."date",
  "tgl_kematian" "pg_catalog"."date",
  "agama" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "pendidikan_terakhir" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "status_pernikahan" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "jenis_pekerjaan" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "suku" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "ket_identitas_pasien" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "kd_pasien" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "puskesmas_id" "pg_catalog"."int8",
  "created_at" "pg_catalog"."date",
  "updated_at" "pg_catalog"."date",
  "rm_lama" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "riwayat_alergi" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "kode_provider" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "nama_provider" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "no_rm_lama" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "rw" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "rt" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "berat_badan" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "tinggi_badan" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "nik_ibu" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "alamat_domisili" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "provinsi_id_domisili" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "kabupaten_id_domisili" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "kecamatan_id_domisili" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "desa_id_domisili" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "email" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "rt_domisili" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "rw_domisili" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "ktp_domisili" "pg_catalog"."varchar" COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of pasien
-- ----------------------------
INSERT INTO "public"."pasien" VALUES (1, 'TESTING', 'ALAMAT LENGKAP', '6767676767676', 'BPJS', '3515454533131313', 'WNI', '-', 'INDONESIA', 35, 3515, 3515010, 3515010000, 654454, '085648182005', 'HP', '-', 'A', 'AYAH', 'IBU', 'PASANGAN', 'P', 'MOJOKERTO', '1997-08-12', NULL, 'Islam', 'SMK', 'BELUM', 'PROGRAMMER', 'JAWA', '-', '0000001', 1, '2024-08-12', '2024-08-12', NULL, 'TIDAK ADA', NULL, 'TAMAN', NULL, '03', '03', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
