CREATE TABLE _gct_store_info
(
  store_id             INT NOT NULL AUTO_INCREMENT,
  store_name           VARCHAR (64),
  store_website        VARCHAR (120),
  store_location       VARCHAR (120),
  store_description    TEXT,
  store_date           DATETIME,
  store_banner         TEXT,
  store_status         INT
);

CREATE TABLE _gct_billing_info
(
  billing_id           INT NOT NULL AUTO_INCREMENT,
  bfname               VARCHAR (64),
  blname               VARCHAR (64),
  baddr1               VARCHAR (120),
  baddr2               VARCHAR (120),
  bcity                VARCHAR (32),
  bstate               VARCHAR (32),
  bcountry             VARCHAR (32),
  bzip_code            VARCHAR (15),
  bphone_no            VARCHAR (32),
  bemail               VARCHAR (80)
);
