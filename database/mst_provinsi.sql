/*
 Navicat Premium Data Transfer

 Source Server         : PGSQL
 Source Server Type    : PostgreSQL
 Source Server Version : 160002
 Source Host           : localhost:5432
 Source Catalog        : devsikuat
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 160002
 File Encoding         : 65001

 Date: 12/08/2024 09:39:46
*/


-- ----------------------------
-- Table structure for mst_provinsi
-- ----------------------------
DROP TABLE IF EXISTS "public"."mst_provinsi";
CREATE TABLE "public"."mst_provinsi" (
  "KD_PROVINSI" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "PROVINSI" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "ninput_oleh" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "ninput_tgl" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "nupdate_oleh" "pg_catalog"."varchar" COLLATE "pg_catalog"."default",
  "nupdate_tgl" "pg_catalog"."varchar" COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of mst_provinsi
-- ----------------------------
INSERT INTO "public"."mst_provinsi" VALUES ('11', 'ACEH', NULL, NULL, 'all', '11/7/2013 08:54:23');
INSERT INTO "public"."mst_provinsi" VALUES ('12', 'SUMATERA UTARA', '0', '5/4/2013', NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('13', 'SUMATERA BARAT', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('14', 'RIAU', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('15', 'JAMBI', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('16', 'SUMATERA SELATAN', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('17', 'BENGKULU', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('18', 'LAMPUNG', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('19', 'KEPULAUAN BANGKA BELITUNG', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('21', 'KEPULAUAN RIAU', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('31', 'DKI JAKARTA', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('32', 'JAWA BARAT', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('33', 'JAWA TENGAH', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('34', 'D I YOGYAKARTA', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('35', 'JAWA TIMUR', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('36', 'BANTEN', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('51', 'BALI', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('52', 'NUSA TENGGARA BARAT', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('53', 'NUSA TENGGARA TIMUR', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('61', 'KALIMANTAN BARAT', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('62', 'KALIMANTAN TENGAH', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('63', 'KALIMANTAN SELATAN', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('64', 'KALIMANTAN TIMUR', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('71', 'SULAWESI UTARA', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('72', 'SULAWESI TENGAH', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('73', 'SULAWESI SELATAN', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('74', 'SULAWESI TENGGARA', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('75', 'GORONTALO', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('76', 'SULAWESI BARAT', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('81', 'MALUKU', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('82', 'MALUKU UTARA', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('91', 'PAPUA BARAT', NULL, NULL, NULL, NULL);
INSERT INTO "public"."mst_provinsi" VALUES ('94', 'PAPUA', NULL, NULL, NULL, NULL);
