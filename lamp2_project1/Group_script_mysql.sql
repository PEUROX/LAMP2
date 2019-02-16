/*ADD the drop database tables and user code here*/

CREATE USER 'part1user'@'localhost' IDENTIFIES BY 'Test123';

create database microwave_info;

GRANT ALL PRIVILEGES ON microwave_info.* TO 'part1user'@'localhost' IDENTIFIED BY 'Test123';

ALTER DATABASE microwave_info CHARACTER SET utf8 COLLATE utf8_general_ci;

drop table path_data if exists;
drop table csv_file if exists;

CREATE TABLE path_data (
    pathID int AUTO_INCREMENT,
    pathFile int,
    distSpEp varchar(55),
    groundHeight varchar(55),
    terrainType varchar(55),
    obstructionHeight varchar(55),
    obstructionType varchar(55),
    PRIMARY KEY (pathID),
    FOREIGN KEY (pathFile) REFERENCES csv_file(fileID)
);

CREATE TABLE csv_file (
    fileID int AUTO_INCREMENT,
    file_name varchar(55),
    PRIMARY KEY (fileID),
    UNIQUE(file_name)
);

