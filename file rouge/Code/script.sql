CREATE TABLE Admin(
   id_adm INT AUTO_INCREMENT,
   adm_name VARCHAR(50),
   adm_lastename VARCHAR(50),
   adm_email VARCHAR(50),
   adm_pswrd VARCHAR(50),
   PRIMARY KEY(id_adm)
);

CREATE TABLE Plan(
   id_plan INT,
   pl_name VARCHAR(50),
   pl_introduction_ VARCHAR(255),
   pl_state VARCHAR(50),
   PRIMARY KEY(id_plan)
);

CREATE TABLE tasks(
   id_tsk INT AUTO_INCREMENT,
   tsk_name VARCHAR(50),
   tsk_task VARCHAR(50),
   tsk_description_ VARCHAR(255),
   tsk_nature VARCHAR(50),
   tsk_state VARCHAR(50),
   id_plan INT NOT NULL,
   PRIMARY KEY(id_tsk),
   FOREIGN KEY(id_plan) REFERENCES Plan(id_plan)
);

CREATE TABLE Members(
   id_mb INT AUTO_INCREMENT,
   mb_name VARCHAR(50),
   mb_last_name VARCHAR(50),
   mb_birth DATE,
   mb_gender VARCHAR(50),
   mb_email VARCHAR(50),
   mb_pswrd VARCHAR(255),
   mb_score INT,
   is_blocked VARCHAR(50),
   id_plan INT NOT NULL,
   PRIMARY KEY(id_mb),
   FOREIGN KEY(id_plan) REFERENCES Plan(id_plan)
);

CREATE TABLE Journal(
   id_jr INT AUTO_INCREMENT,
   jr_name VARCHAR(50),
   jr_date_pub DATE,
   jr_description_ VARCHAR(100),
   jr_content VARCHAR(8000),
   jr_state VARCHAR(50),
   is_prooved_ VARCHAR(50),
   id_mb INT NOT NULL,
   PRIMARY KEY(id_jr),
   FOREIGN KEY(id_mb) REFERENCES Members(id_mb)
);

CREATE TABLE likes(
   id_mb INT ,
   id_jr INT,
   PRIMARY KEY(id_mb, id_jr),
   FOREIGN KEY(id_mb) REFERENCES Members(id_mb),
   FOREIGN KEY(id_jr) REFERENCES Journal(id_jr)
);

CREATE TABLE save(
   id_mb INT,
   id_jr INT,
   PRIMARY KEY(id_mb, id_jr),
   FOREIGN KEY(id_mb) REFERENCES Members(id_mb),
   FOREIGN KEY(id_jr) REFERENCES Journal(id_jr)
);

CREATE TABLE completed_tasks(
   id_mb INT,
   id_tsk INT,
   PRIMARY KEY(id_mb, id_tsk),
   FOREIGN KEY(id_mb) REFERENCES Members(id_mb),
   FOREIGN KEY(id_tsk) REFERENCES tasks(id_tsk)
);
