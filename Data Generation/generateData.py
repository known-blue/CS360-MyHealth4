from classes import *
from randomGenerators import ID

LOOP_AMOUNT = 290
outfile = open("output.txt", 'w', encoding='utf-8')
id = ID()
ids = []

for i in range(0, LOOP_AMOUNT):
    patient = Patient(id)
    ids.append(patient.id)
    patient.write(outfile)
    Treatment(id).write(outfile)
    Hospital(id).write(outfile)
    Doctor(id).write(outfile)
    InsuranceNetwork(id).write(outfile)
    InsuranceCompany(id).write(outfile)
    Pharmacy(id).write(outfile)
    Lab(id).write(outfile)

for i in range(0, LOOP_AMOUNT):
    InsurancePlan(id).write(outfile)

for i in range(0, LOOP_AMOUNT):
    SSDD(id).write(outfile)
    SSDH(id).write(outfile)
    SSDO(id).write(outfile)
    SSDL(id).write(outfile)
    HospitalBill(id).write(outfile)
    PharmacyBill(id).write(outfile)
    PatientNote(id).write(outfile)
    CanSharePatientInfoWithDoctor(id).write(outfile)
    CanSharePatientInfoWithPharmacy(id).write(outfile)
    Perscription(id).write(outfile)
    PharmacySells(id).write(outfile)
    PlanCovers(id).write(outfile)
    PlanInNetwork(id).write(outfile)
    DoctorWorksAt(id).write(outfile)

outfile.close()

#print(ids)
#print("=====")
#print(ID.generatedIDs)

#for i in range(0, len(ID.generatedIDs)):
    #if ID.generatedIDs[i][0:2] == '10' and ID.generatedIDs[i] not in ids:
        #print(ID.generatedIDs[i])
