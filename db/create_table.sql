CREATE TABLE Kategori (
    id_kategori INT PRIMARY KEY AUTO_INCREMENT,
    nama_kategori VARCHAR(255) NOT NULL
);

CREATE TABLE Dosen (
    id_dosen INT PRIMARY KEY AUTO_INCREMENT,
    nip_dosen VARCHAR(255) NOT NULL,
    nama_dosen VARCHAR(255) NOT NULL
);

CREATE TABLE MataKuliah (
    id_matakuliah INT PRIMARY KEY AUTO_INCREMENT,
    kode_matakuliah VARCHAR(255) NOT NULL,
    nama_matakuliah VARCHAR(255) NOT NULL,
    sks_matakuliah INT NOT NULL,
    id_dosen INT,
    FOREIGN KEY (id_dosen) REFERENCES Dosen(id_dosen)
);



CREATE TABLE Barang (
    id_barang INT PRIMARY KEY AUTO_INCREMENT,
    nama_barang VARCHAR(255) NOT NULL,
    id_kategori INT,
    jumlah_barang INT,
    id_matakuliah INT,
    FOREIGN KEY (id_kategori) REFERENCES Kategori(id_kategori),
    FOREIGN KEY (id_matakuliah) REFERENCES MataKuliah(id_matakuliah)
);
