import random

TREATMENT_FILE = 'treatments.txt'

class PhoneNumber:
    generatedNumbers = []
    def new_phone_number(self):
        number = (str(random.randint(1, 9)) + str(random.randint(0, 9)) + str(random.randint(0, 9)) + '-' + 
            str(random.randint(0, 9)) + str(random.randint(0, 9)) + str(random.randint(0, 9)) + '-' + 
            str(random.randint(0, 9)) + str(random.randint(0, 9)) + str(random.randint(0, 9)) + str(random.randint(0, 9)))
        while number in PhoneNumber.generatedNumbers:
            number = str(random.randint(1, 9)) + str(random.randint(0, 99)) + '-' + str(random.randint(0, 999)) + '-' + str(random.randint(0, 9999))
        PhoneNumber.generatedNumbers.append(number)
        return number

    def existing_phone_number(self):
        if len(PhoneNumber.generatedNumbers) != 0:
            return random.choice(PhoneNumber.generatedNumbers)
        else:
            return self.new_phone_number()

class ID:
    generatedIDs = []
    def new_ID(self, prefix, digits=10):
        newID = str(prefix.value)
        for i in range(0, digits):
            newID += str(random.randint(0, 9))
        while newID in ID.generatedIDs:
            newID = str(prefix.value)
            for i in range(0, digits):
                newID += str(random.randint(0, 9))
        ID.generatedIDs.append(newID)
        return newID          

    def existing_ID(self, prefix):
        IDsWithPrefix = []
        for i in range(0, len(ID.generatedIDs)):
            if ID.generatedIDs[i][0:2] == str(prefix.value):
                IDsWithPrefix.append(ID.generatedIDs[i])
        
        if len(IDsWithPrefix) != 0:
            tempid = random.choice(IDsWithPrefix)
            return tempid
        else:
            return self.new_ID(prefix)

class Treatment:
    treatmentNames = []
    generatedTreatmentNames = []

    def __init__(self):
        treatmentFile = open(TREATMENT_FILE, 'r')
        while True:
            line = treatmentFile.readline()
            if not line:
                break
            Treatment.treatmentNames.append(line.strip())
        treatmentFile.close()

    def new_treatment_name(self):
        if len(Treatment.treatmentNames) != len(Treatment.generatedTreatmentNames):
            newName = random.choice(Treatment.treatmentNames)
            while newName in Treatment.generatedTreatmentNames:
                newName = random.choice(Treatment.treatmentNames)
        else: 
            return self.existing_treatment_name()
        Treatment.generatedTreatmentNames.append(newName)
        return newName
    
    def existing_treatment_name(self):
        if len(Treatment.generatedTreatmentNames) != 0:
            return random.choice(Treatment.generatedTreatmentNames)
        else:
            return self.new_treatment_name()

class RandomQuantity:
    units = ['tsp', 'Tbsp', 'mL', 'fl oz', 'mg', 'g', 'oz']

    def quantity(self):
        return str(random.randint(1, 100)) + ' ' + random.choice(RandomQuantity.units)    