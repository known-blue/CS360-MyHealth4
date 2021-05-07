from faker import Faker
from randomGenerators import ID, PhoneNumber, Treatment, RandomQuantity
from essential_generators import DocumentGenerator
import enum
import random

fake = Faker()
phone = PhoneNumber()
treatment = Treatment()
documentGenerator = DocumentGenerator()
quantities = RandomQuantity()

class IDType(enum.Enum):
    Patient = '10'
    Doctor = '20'
    Treatment = '30'
    Hospital = '40'
    InsuranceNetwork = '50'
    InsuranceCompany = '60'
    InsurancePlan = '70'
    Pharmacy = '80'
    HospitalBill = '90'
    PharmacyBill = '11'
    PatientNote = '12'
    Lab = '13'

class Patient:
    def __init__(self, id):
        # Create a fake ID
        self.id = id.new_ID(IDType.Patient)
        # Assign names
        if random.randint(0, 1) == 0:
            self.nameFirst = fake.first_name_male()
            self.nameLast = fake.last_name_male()
        else:
            self.nameFirst = fake.first_name_female()
            self.nameLast = fake.last_name_female()
        # Assign a date-of-birth in MySQL date format
        self.dob = fake.date(pattern='%Y-%m-%d')
        # Assign an address
        self.address = fake.address()
        # Assign an email
        self.email = fake.email()
        # And assign a phone number
        self.phone = phone.new_phone_number()

        self.password = fake.password()

    def write(self, outfile):
        outfile.write(f'INSERT INTO Patients(PatientID, NameFirst, NameLast, DOB, Address, Email, Phone, Password) VALUES ({self.id}, "{self.nameFirst}", "{self.nameLast}", "{self.dob}", "{self.address}", "{self.email}", "{self.phone}", "{self.password}");\n')

class Lab:
    def __init__(self, id):
        self.id = id.new_ID(IDType.Lab)
        self.name = fake.company()
        self.address = fake.address()
        self.email = fake.email()
        self.phone = phone.new_phone_number()

    def write(self, outfile):
        outfile.write(f'INSERT INTO Labs(LabID, LabName, Address, Email, PhoneNumber) VALUES ({self.id}, "{self.name}", "{self.address}", "{self.email}", "{self.phone}");\n')

class Treatment:
    def __init__(self, id):
        self.id = id.new_ID(IDType.Treatment)
        self.name = treatment.new_treatment_name()
        self.otc = bool(random.randint(0, 1))

    def print(self):
        print(f"Treatment {self.name}")
        print(f"\tID: {self.id}")
        print(f"\tOver the counter: {self.otc}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO Treatments(TreatmentID, TreatmentName, OTC) VALUES ({self.id}, "{self.name}", {self.otc});\n')

class Hospital:
    def __init__(self, id):
        self.name = fake.company()
        self.address = fake.address()
        self.id = id.new_ID(IDType.Hospital)
        self.email = fake.email()
        self.phone = phone.new_phone_number()

    def print(self):
        print(f"Hospital {self.name}")
        print(f"\tID: {self.id}")
        print(f"\tAddress: {self.address}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO Hospitals(HospitalID, Address, HospitalName, Email, Phone) VALUES ({self.id}, "{self.address}", "{self.name}", "{self.email}", "{self.phone}");\n')

class Doctor:
    def __init__(self, id):
        self.id = id.new_ID(IDType.Doctor)
        if random.randint(0, 1) == 0:
            self.nameFirst = fake.first_name_male()
            self.nameLast = fake.last_name_male()
        else:
            self.nameFirst = fake.first_name_female()
            self.nameLast = fake.last_name_female()
        self.email = fake.email()
        self.password = fake.password()
        self.phone = phone.new_phone_number()
        self.address = fake.address()
        self.dob = fake.date(pattern='%Y-%m-%d')

    def print(self):
        print(f"Doctor {self.nameFirst} {self.nameLast}")
        print(f"\tID: {self.id}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO Doctors(DrID, NameFirst, NameLast, Email, Password, Phone, Address, DOB) VALUES ({self.id}, "{self.nameFirst}", "{self.nameLast}", "{self.email}", "{self.password}", "{self.phone}", "{self.address}", "{self.dob}");\n')

class InsuranceNetwork:
    def __init__(self, id):
        self.id = id.new_ID(IDType.InsuranceNetwork)
        self.name = fake.company()

    def print(self):
        print(f"Insurance Network: {self.name}")
        print(f"\tID: {self.id}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO InsuranceNetworks(NetworkID, NetworkName) VALUES ({self.id}, "{self.name}");\n')

class InsuranceCompany:
    def __init__(self, id):
        self.id = id.new_ID(IDType.InsuranceCompany)
        self.name = fake.company()
        self.address = fake.address()
        self.email = fake.email()
        self.phone = phone.new_phone_number()

    def print(self):
        print(f"Insurance Company {self.name}")
        print(f"\tID: {self.id}")
        print(f"\tAddress: {self.address}")
        print(f"\tEmail: {self.email}")
        print(f"\tPhone: {self.phone}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO InsuranceCompanies(InsuranceCompanyID, CompanyName, Address, Email, PhoneNumber) VALUES ({self.id}, "{self.name}", "{self.address}", "{self.email}", "{self.phone}");\n')

class Pharmacy:
    def __init__(self, id):
        self.id = id.new_ID(IDType.Pharmacy)
        self.name = fake.company()
        self.address = fake.address()
        self.email = fake.email()
        self.phone = phone.new_phone_number()

    def print(self):
        print(f"Pharmacy {self.name}")
        print(f"\tID: {self.id}")
        print(f"\tAddress: {self.address}")
        print(f"\tEmail: {self.email}")
        print(f"\tPhone: {self.phone}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO Pharmacies(PharmacyID, PharmacyName, Address, Email, PhoneNumber) VALUE ({self.id}, "{self.name}", "{self.address}", "{self.email}", "{self.phone}");\n')

class InsurancePlan:
    def __init__(self, id):
        self.id = id.new_ID(IDType.InsurancePlan)
        self.insuranceCompanyID = id.existing_ID(IDType.InsuranceCompany)
        self.lifetimeCoverage = random.randint(500000, 2500000)
        self.annualPremium = random.randint(500, 20000)
        self.annualDeductible = random.randint(500, 20000)
        self.coverage = random.uniform(0, 1)

    def print(self):
        print(f"Insurance Plan: {self.id}")
        print(f"\tBelonging to company: {self.insuranceCompanyID}")
        print(f"\tCoverage: {self.coverage * 100}%")
        print(f"Lifetime coverage: {self.lifetimeCoverage}")
        print(f"Annual premium: {self.annualPremium}")
        print(f"Annual deductible: {self.annualDeductible}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO InsurancePlans(PlanID, InsuranceCompanyID, LifetimeCoverage, AnnualPremium, AnnualDeductible, Coverage) VALUES ({self.id}, {self.insuranceCompanyID}, {self.lifetimeCoverage}, {self.annualPremium}, {self.annualDeductible}, {self.coverage});\n')

class SSDD:
    patientsWithDoctors = []
    def __init__(self, id):
        self.drID = id.existing_ID(IDType.Doctor)
        self.patientID = id.existing_ID(IDType.Patient)
        while self.patientID in SSDD.patientsWithDoctors:
            self.patientID = id.existing_ID(IDType.Patient)
        SSDD.patientsWithDoctors.append(self.patientID)

    def write(self, outfile):
        outfile.write(f'INSERT INTO SSDD(PatientID, DrID) VALUES ({self.patientID}, {self.drID});\n')

class SSDH:
    patientsWithHospitals = []
    def __init__(self, id):
        self.hospitalID = id.existing_ID(IDType.Hospital)
        self.patientID = id.existing_ID(IDType.Patient)
        while self.patientID in SSDH.patientsWithHospitals:
            self.patientID = id.existing_ID(IDType.Patient)
        SSDH.patientsWithHospitals.append(self.patientID)

    def print(self):
        print(f"Patient {self.patientID} goes to Hospital {self.hospitalID}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO SSDH(PatientID, HospitalID) VALUES ({self.patientID}, {self.hospitalID});\n')

class SSDO:
    patientsWithPlans = []
    def __init__(self, id):
        self.pharmacyID = id.existing_ID(IDType.Pharmacy)
        self.planID = id.existing_ID(IDType.InsurancePlan)
        self.patientID = id.existing_ID(IDType.Patient)
        while self.patientID in SSDO.patientsWithPlans:
            self.patientID = id.existing_ID(IDType.Patient)
        SSDO.patientsWithPlans.append(self.patientID)

    def print(self):
        print(f"Patient {self.patientID} has Plan {self.planID} and Pharmacy {self.pharmacyID}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO SSDO(PatientID, PharmacyID, PlanID) VALUES ({self.patientID}, {self.pharmacyID}, {self.planID});\n')

class SSDL:
    patientsWithLabs = []
    def __init__(self, id):
        self.labID = id.existing_ID(IDType.Lab)
        self.patientID = id.existing_ID(IDType.Patient)
        while self.patientID in SSDL.patientsWithLabs:
            self.patientID = id.existing_ID(IDType.Patient)
        SSDL.patientsWithLabs.append(self.patientID)

    def write(self, outfile):
        outfile.write(f'INSERT INTO SSDL(LabID, PatientID) VALUES ({self.labID}, {self.patientID});\n')

class HospitalBill:
    def __init__(self, id):
        self.billID = id.new_ID(IDType.HospitalBill)
        self.patientID = id.existing_ID(IDType.Patient)
        self.hospitalID = id.existing_ID(IDType.Hospital)
        self.date = fake.date(pattern='%Y-%m-%d', end_datetime=None)
        self.cost = random.randint(50, 50000)
        self.amtInsurancePaid = self.cost - random.randint(int(self.cost / 5), self.cost) * random.uniform(0, 1)
        self.amtPatientPaid = self.cost - self.amtInsurancePaid

    def print(self):
        print(f"Hospital Bill {self.billID}")
        print(f"\tPatient: {self.patientID}")
        print(f"\tHospital: {self.hospitalID}")
        print(f"\tDate: {self.date}")
        print(f"\tCost: {self.cost}")
        print(f"\tAmount paid by patient: {self.amtPatientPaid}")
        print(f"\tAmount paid by insurance: {self.amtInsurancePaid}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO HospitalBills(HospitalBillID, PatientID, HospitalID, Date, TotalCost, AmtPatientPaid, AmtInsurancePaid) VALUES ({self.billID}, {self.patientID}, {self.hospitalID}, "{self.date}", {self.cost}, {self.amtPatientPaid}, {self.amtInsurancePaid});\n')

class PharmacyBill:
    def __init__(self, id):
        self.billID = id.new_ID(IDType.PharmacyBill)
        self.patientID = id.existing_ID(IDType.Patient)
        self.pharmacyID = id.existing_ID(IDType.Pharmacy)
        self.date = fake.date(pattern='%Y-%m-%d', end_datetime=None)
        self.cost = random.randint(50, 50000)
        self.amtInsurancePaid = self.cost - random.randint(int(self.cost / 5), self.cost) * random.uniform(0, 1)
        self.amtPatientPaid = self.cost - self.amtInsurancePaid

    def print(self):
        print(f"Pharmacy Bill {self.billID}")
        print(f"\tPatient: {self.patientID}")
        print(f"\tPharmacy: {self.pharmacyID}")
        print(f"\tDate: {self.date}")
        print(f"\tCost: {self.cost}")
        print(f"\tAmount paid by patient: {self.amtPatientPaid}")
        print(f"\tAmount paid by insurance: {self.amtInsurancePaid}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO PharmacyBills(PharmacyBillID, PatientID, PharmacyID, Date, TotalCost, AmtPatientPaid, AmtInsurancePaid) VALUES ({self.billID}, {self.patientID}, {self.pharmacyID}, "{self.date}", {self.cost}, {self.amtPatientPaid}, {self.amtInsurancePaid});\n')


class PatientNote:
    def __init__(self, id):
        self.patientNoteID = id.new_ID(IDType.PatientNote)
        self.patientID = id.existing_ID(IDType.Patient)
        self.drID = id.existing_ID(IDType.Doctor)
        self.date = fake.date(pattern='%Y-%m-%d', end_datetime=None)
        self.notes = documentGenerator.sentence().replace('"', "").replace("'", "").encode()
        self.diagnosis = documentGenerator.word().replace('"', "").replace("'", "").encode()

    def print(self):
        print(f"Patient notes for Patient {self.patientID} by Doctor {self.drID}")
        print(f"\tDate: {self.date}")
        print(f"\tNotes: {self.notes}")
        print(f"\tDiagnosis: {self.diagnosis}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO PatientNotes(PatientNoteID, DrID, PatientID, Date, Notes, Diagnosis) VALUES ({self.patientNoteID}, {self.drID}, {self.patientID}, "{self.date}", "{self.notes}", "{self.diagnosis}");\n')

class CanSharePatientInfoWithDoctor:
    primaryKeys = []
    def __init__(self, id):
        self.drID = id.existing_ID(IDType.Doctor)
        self.patientID = id.existing_ID(IDType.Patient)
        self.recipient = id.existing_ID(IDType.Doctor)
        while (self.drID, self.patientID, self.recipient) in CanSharePatientInfoWithDoctor.primaryKeys:
            self.drID = id.existing_ID(IDType.Doctor)
            self.patientID = id.existing_ID(IDType.Patient)
            self.recipient = id.existing_ID(IDType.Doctor)
        CanSharePatientInfoWithDoctor.primaryKeys.append((self.drID, self.patientID, self.recipient))
        self.name = bool(random.randint(0, 1))
        self.dob = bool(random.randint(0, 1))
        self.contactInfo = bool(random.randint(0, 1))
        self.notes = bool(random.randint(0, 1))
        self.perscriptions = bool(random.randint(0, 1))

    def print(self):
        print(f"Doctor {self.drID} can share Patient {self.patientID}'s information with Doctor {self.recipient}:")
        print(f"Name: {self.name}")
        print(f"Date of birth: {self.dob}")
        print(f"Contact info: {self.contactInfo}")
        print(f"Notes: {self.notes}")
        print(f"Perscriptions: {self.perscriptions}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO CanSharePatientInfoWithDoctor(DrID, PatientID, RecipientDrID, Name, DOB, ContactInfo, Notes, Perscriptions) VALUES ({self.drID}, {self.patientID}, {self.recipient}, {self.name}, {self.dob}, {self.contactInfo}, {self.notes}, {self.perscriptions});\n')

class CanSharePatientInfoWithPharmacy:
    primaryKeys = []
    def __init__(self, id):
        self.drID = id.existing_ID(IDType.Doctor)
        self.patientID = id.existing_ID(IDType.Patient)
        self.recipient = id.existing_ID(IDType.Pharmacy)
        while (self.drID, self.patientID, self.recipient) in CanSharePatientInfoWithPharmacy.primaryKeys:
            self.drID = id.existing_ID(IDType.Doctor)
            self.patientID = id.existing_ID(IDType.Patient)
            self.recipient = id.existing_ID(IDType.Pharmacy)
        CanSharePatientInfoWithPharmacy.primaryKeys.append((self.drID, self.patientID, self.recipient))
        self.name = bool(random.randint(0, 1))
        self.dob = bool(random.randint(0, 1))
        self.contactInfo = bool(random.randint(0, 1))
        self.notes = bool(random.randint(0, 1))
        self.perscriptions = bool(random.randint(0, 1))

    def print(self):
        print(f"Doctor {self.drID} can share Patient {self.patientID}'s information with Pharmacy {self.recipient}:")
        print(f"\tName: {self.name}")
        print(f"\tDate of birth: {self.dob}")
        print(f"\tContact info: {self.contactInfo}")
        print(f"\tNotes: {self.notes}")
        print(f"\tPerscriptions: {self.perscriptions}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO CanSharePatientInfoWithPharmacy(DrID, PatientID, PharmacyID, Name, DOB, ContactInfo, Notes, Perscriptions) VALUES ({self.drID}, {self.patientID}, {self.recipient}, {self.name}, {self.dob}, {self.contactInfo}, {self.notes}, {self.perscriptions});\n')

class Perscription:
    primaryKeys = []
    def __init__(self, id):
        self.drID = id.existing_ID(IDType.Doctor)
        self.patientID = id.existing_ID(IDType.Patient)
        self.treatmentID = id.existing_ID(IDType.Treatment)
        self.date = fake.date(pattern='%Y-%m-%d', end_datetime=None)
        while (self.drID, self.patientID, self.treatmentID, self.date) in Perscription.primaryKeys:
            self.drID = id.existing_ID(IDType.Doctor)
            self.patientID = id.existing_ID(IDType.Patient)
            self.treatmentID = id.existing_ID(IDType.Treatment)
            self.date = fake.date(pattern='%Y-%m-%d', end_datetime=None)
        Perscription.primaryKeys.append((self.drID, self.patientID, self.treatmentID, self.date))
        self.quantity = quantities.quantity()

    def print(self):
        print(f"Doctor {self.drID} has perscribed Patient {self.patientID} with:")
        print(f"\tTreatment: {self.treatmentID}")
        print(f"\tDate: {self.date}")
        print(f"\tQuantity: {self.quantity}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO Perscriptions(DrID, PatientID, TreatmentID, Date, Quantity) VALUES ({self.drID}, {self.patientID}, {self.treatmentID}, "{self.date}", "{self.quantity}");\n')

class PharmacySells:
    primaryKeys = []
    def __init__(self, id):
        self.treatmentID = id.existing_ID(IDType.Treatment)
        self.pharmacyID = id.existing_ID(IDType.Pharmacy)
        while (self.treatmentID, self.pharmacyID) in PharmacySells.primaryKeys:
            self.treatmentID = id.existing_ID(IDType.Treatment)
            self.pharmacyID = id.existing_ID(IDType.Pharmacy)           
        PharmacySells.primaryKeys.append((self.treatmentID, self.pharmacyID))
        self.price = random.uniform(1.00, 50.00)

    def print(self):
        print(f"Pharmacy {self.pharmacyID} sellf Treatment {self.treatmentID}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO PharmacySells(TreatmentID, PharmacyID, Price) VALUES ({self.treatmentID}, {self.pharmacyID}, {self.price});\n')

class PlanCovers:
    primaryKeys = []
    def __init__(self, id):
        self.planID = id.existing_ID(IDType.InsurancePlan)
        self.treatmentID = id.existing_ID(IDType.Treatment)
        while (self.planID, self.treatmentID) in PlanCovers.primaryKeys:
            self.planID = id.existing_ID(IDType.InsurancePlan)
            self.treatmentID = id.existing_ID(IDType.Treatment)        
        PlanCovers.primaryKeys.append((self.planID, self.treatmentID))

    def print(self):
        print(f"Insurance Plan {self.planID} covers Treatment {self.treatmentID}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO PlanCovers(PlanID, TreatmentID) VALUES ({self.planID}, {self.treatmentID});\n')

class PlanInNetwork:
    primaryKeys = []
    def __init__(self, id):
        self.planID = id.existing_ID(IDType.InsurancePlan)
        self.networkID = id.existing_ID(IDType.InsuranceNetwork)
        while (self.planID, self.networkID) in PlanInNetwork.primaryKeys:
            self.planID = id.existing_ID(IDType.InsurancePlan)
            self.networkID = id.existing_ID(IDType.InsuranceNetwork)
        PlanInNetwork.primaryKeys.append((self.planID, self.networkID))

    def print(self):
        print(f"Insurance Plan {self.planID} is part of Network {self.networkID}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO PlanInNetwork(PlanID, NetworkID) VALUES ({self.planID}, {self.networkID});\n')

class DoctorWorksAt:
    primaryKeys = []
    def __init__(self, id):
        self.drID = id.existing_ID(IDType.Doctor)
        self.hospitalID = id.existing_ID(IDType.Hospital)
        while (self.drID, self.hospitalID) in DoctorWorksAt.primaryKeys:
            self.drID = id.existing_ID(IDType.Doctor)
            self.hospitalID = id.existing_ID(IDType.Hospital)
        DoctorWorksAt.primaryKeys.append((self.drID, self.hospitalID))

    def print(self):
        print(f"Doctor {self.drID} works at Hospital {self.hospitalID}")

    def write(self, outfile):
        outfile.write(f'INSERT INTO DoctorWorksAt(DrID, HospitalID) VALUES ({self.drID}, {self.hospitalID});\n')
