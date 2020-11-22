from hashlib import md5
dates = []
UsersList =[]
userblacklist = []

class User:

    #$this->getPersonFirstName().$this->getPersonLastName().$this->getPersonGender().$this->getPersonBirthDay().
    #$this->getPersonBirthMonth().$this->getPersonBirthYear()
    def __init__(self,firstname,lastname,gender,avatar,birthday,birthmonth,birthyear):
        md5text = firstname+lastname+gender+birthday+birthmonth+birthyear;
        self.userid = "c1f995d8885a570afb0ca50d4c37fd9b"
        self.personid = md5(md5text.encode('utf-8')).hexdigest()
        self.lastname = lastname
        self.firstname = firstname
        self.gender = gender
        self.avatar = avatar
        self.birthday = birthday
        self.birthmonth = birthmonth
        self.birthyear = birthyear

with open("Files/BirthDates.txt") as datereader:
    content = datereader.read()
    if "\n" in content:
        lines = content.split("\n")
        for line in lines:
            if "." in line:
                data = line.split(".")
                day = data[0]
                month = data[1]
                year = data[2]
                #print(year)


with open("Files/fullnames.txt") as reader:
    content = reader.read()
    if "\n" in content:
        lines  = content.split("\n")
        i = 0
        for line in lines:
            if line.count(' ') == 1:
                fullname = line.split(" ")
                firstname = fullname[0]
                lastname = fullname[1]
                lastchar = firstname[len(firstname)-1]
                i+=1
                if firstname + " "+ lastname not in str(userblacklist):
                    userblacklist.append(firstname + " "+lastname)
                    if lastchar == "a":
                        avatar = '/opt/lampp/htdocs/Drive//Avatars/FemaleAvatar.png'
                        #print("ID = {} , FIRSTNAME = {} , LASTNAME = {} , GENDER = Female, Date = {} ".format(str(i),firstname,lastname))
                        #UserARray.append()
                        #print(lastname)
                    else:
                        avatar = '/opt/lampp/htdocs/Drive//Avatars/MaleAvatar.png'
                        #print("ID = {} , FIRSTNAME = {} , LASTNAME = {} , GENDER = Male, Date = {}".format(str(i),firstname,lastname))
                        #print(lastname)

                #print("USERSIZE = " + str(len(userblacklist)) + "  DATES SIZE = "+ str(len(dates)))

for i in range(100):
    pass
    #print("c1f995d8885a570afb0ca50d4c37fd9b")


def generateQUery():
    query = ''
    for user in UsersList:
        query = "INSERT INTO ZODIAC.SUB_PERSONS (USER_ID, PERSON_ID, PERSON_FIRSTNAME, PERSON_LASTNAME, PERSON_AVATAR, PERSON_GENDER, PERSON_BIRTH_DAY, PERSON_BIRTH_MONTH, PERSON_BIRTH_YEAR, PERSON_BIRTH_HOUR, PERSON_BIRTH_PLACE) VALUES ( "
        query += "'"+user.userid+"',"
        query += "'"+user.personid+"',"
        query += "'"+user.firstname+"',"
        query += "'"+user.lastname+"',"
        query += "'"+user.avatar+"',"
        query += "'"+user.gender+"',"
        query += "'"+user.birthday+"',"
        query += "'"+user.birthmonth+"',"
        query += "'"+user.birthyear+"',"
        query += "'~',"
        query +="'~');"
    print(query)
    with open("Outputs/out.sql", "a") as writer:
        writer.write(query+"\n")

with open("Outputs/out.csv") as reader:
    content =reader.read()
    if "\n" in content:
        lines = content.split("\n")
        for line in lines:
            if ',' in line:
                data = line.split(",")
                userid = data[0]
                firstname = data[1]
                lastname = data[2]
                gender = data[3]
                day = data[4]
                month = data[5]
                year=data[6]
                avatar = data[7]
                UsersList.append(User(firstname,lastname,gender,avatar,day,month,year))
                generateQUery()

