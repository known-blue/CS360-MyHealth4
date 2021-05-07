CREATE TABLE Appointments (
  DrID BIGINT UNSIGNED,
  PatientID BIGINT UNSIGNED,
  AppointmentID BIGINT UNSIGNED AUTO_INCREMENT,
  Date varchar(20) NOT NULL,
  Time varchar(20) NOT NULL,

  FOREIGN KEY (DrID)
    REFERENCES Doctors (DrID),
  FOREIGN KEY (PatientID)
    REFERENCES Patients (PatientID),
  PRIMARY KEY (AppointmentID)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;
