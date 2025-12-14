CREATE TABLE mentor (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100),
  jk VARCHAR(20),
  email VARCHAR(100),
  telp VARCHAR(20),
  tgl_lahir DATE,
  jadwal VARCHAR(100),
  mapel VARCHAR(100),
  kelas VARCHAR(50)
);

CREATE TABLE siswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nama VARCHAR(100)
);

CREATE TABLE materi (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mentor_id INT,
  judul VARCHAR(200),
  jenis ENUM('pdf','video'),
  file VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (mentor_id) REFERENCES mentor(id)
);

CREATE TABLE kuis (
  id INT AUTO_INCREMENT PRIMARY KEY,
  mentor_id INT,
  sub_bab VARCHAR(100),
  pertanyaan TEXT,
  a VARCHAR(255),
  b VARCHAR(255),
  c VARCHAR(255),
  d VARCHAR(255),
  jawaban CHAR(1),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE nilai (
  id INT AUTO_INCREMENT PRIMARY KEY,
  siswa_id INT,
  kuis_id INT,
  jawaban_siswa CHAR(1),
  nilai INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  FOREIGN KEY (siswa_id) REFERENCES siswa(id),
  FOREIGN KEY (kuis_id) REFERENCES kuis(id)
);

INSERT INTO mentor (nama, jk, email, telp, tgl_lahir, jadwal, mapel, kelas) VALUES
('Nadya Putri Anindya', 'Perempuan', 'nadya.biologi@elearning.com', '081357892134', '1994-03-18', 'Senin & Rabu, 09.00–10.30', 'Biologi', 'X IPA 1, XI IPA 2');

