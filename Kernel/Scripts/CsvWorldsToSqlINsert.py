
class Segregator:

    def reader(self,file):
        with open(file,'r') as reader:
            return reader.read()
    def splitLines(self,data):
        if "\n" in data:
            return data.split("\n")

    def splitCommas(self,data):
        if "," in data:
            return data.split(",")

    def splitDate(self,data):
        if "." in data:
            return  data.split(".")

    def export(self,file,data):
        with open(file, 'a', encoding='utf8') as writer:
            writer.write(str(data)+'\n')
        return True



def cmain(seg)->int:
    QUERY = ''
    USERID = 'c1f995d8885a570afb0ca50d4c37fd9b'
    PERSONIDS = seg.reader("Files/PersonID.txt")
    WORLDS = seg.reader('Files/worlds.csv')
    PERSONIDLINES = seg.splitLines(PERSONIDS)
    WORLDLINES = seg.splitLines(WORLDS)
    for i in range(len(PERSONIDLINES)):
        WORLDROW = seg.splitCommas(WORLDLINES[i])
        QUERY = 'INSERT INTO  PERSON_WORLDS (USER_ID, PERSON_ID, PERSON_ACTION, PERSON_FUN, PERSON_SEEK, PERSON_MATTER, PERSON_USABILITY, PERSON_CAREER, PERSON_INFORMATION, PERSON_RELATIONS, PERSON_FUTURE, PERSON_FEELING, PERSON_DESIRE, PERSON_SPIRITUAL, PERSON_WALLPAPER)' \
                ' VALUES ("{}","{}",{},{},{},{},{},{},{},{},{},{},{},{},{});'.format(USERID,PERSONIDLINES[i], WORLDROW[0],WORLDROW[1],WORLDROW[2],WORLDROW[3],WORLDROW[4],WORLDROW[5],WORLDROW[6],WORLDROW[7],WORLDROW[8],WORLDROW[9],WORLDROW[10],WORLDROW[11],WORLDROW[12],WORLDROW[13])
        seg.export('Outputs/worlds_out.sql',QUERY)
        print(QUERY)
if __name__ == '__main__':
    seg = Segregator()
    cmain(seg)

