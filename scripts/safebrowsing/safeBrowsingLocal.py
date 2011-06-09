import expression
import md5
import MySQLdb
import time
import urllib

class safeBrowsing:
    def __init__(self, host, user, password, database):
        self._host = host
        self._user = user
        self._password = password
        self._database = database

    def checkUrl(self, url):
        try:
            generator = expression.ExpressionGenerator(url)
                
            if url.lower().startswith('http://'):
                url = url[7:]
            
            newUrl = generator.CanonicalizeUrl(url)
                    
            if newUrl == None or (newUrl != None and not self._checkHash(newUrl)):
                #print 'passed url check'
                newUrl = generator.CanonicalizePath(url)
                if newUrl == None or (newUrl != None and not self._checkHash(newUrl)):
                    #print 'passed path check'
                    newUrl = generator.CanonicalizeHost(url)
                    if newUrl == None or (newUrl != None and not self._checkHash(newUrl)):
                        #print 'passed host check'
                        newUrl = generator.CanonicalizeIp(url)
                        if newUrl == None or (newUrl != None and not self._checkHash(newUrl)):
                            return False
            
            #print 'returning true'
            return True
        except:
            #print 'flat out failed'
            return True
    
    def cleanUpDatabase(self, hours=-1):
        if hours != -1:
            hoursAsSeconds = hours * 60 * 60
            checkTime = time.time() - hoursAsSeconds
            sql = "select id, url from urls where creationDate > " + str(checkTime)
        else:
            sql = "select id, url from urls"

        self._executeCleanup(sql)
                    
    def removeUrl(self, id, cursor=None):
        #remove the url from the db
        conn = None
        if cursor == None:
            conn = self._dbConnect()
            cursor = conn.cursor ()
        
        sql = "delete from urls where id = " + str(id)
        
        cursor.execute(sql)
                        
        if not conn == None:
            cursor.close()
            conn.commit ()
            self._dbDisconnect(conn)
        
    def updateSafeBrowsing(self, apiKey):
        malwareUrl = 'http://sb.google.com/safebrowsing/update?client=api&apikey=' + apiKey + '&version=goog-malware-hash:1:-1'
        blacklistUrl = 'http://sb.google.com/safebrowsing/update?client=api&apikey=' + apiKey + '&version=goog-black-hash:1:-1'
    
        data = self._getDelimitedData(malwareUrl)
        
        self._importData(data)
        
        data = self._getDelimitedData(blacklistUrl)
        
        self._importData(data)
        
    def _checkHash(self, canonicalizedLink):
        #build the hash
        m = md5.new()
        m.update(canonicalizedLink)
        hash = m.hexdigest()
        
        conn = self._dbConnect()
        cursor = conn.cursor ()
        sql = "select hash from google_safe_browsing where hash = '" + hash + "' "
        cursor.execute(sql)
        row = cursor.fetchone ()
        
        isBad = row != None
                
        cursor.close()
        self._dbDisconnect(conn)
        
        return isBad
    
    def _dbConnect(self):
        return MySQLdb.connect(host=self._host, user=self._user, passwd=self._password, db=self._database)
    
    def _dbDisconnect(self, conn):
        conn.close()
        
    def _executeCleanup(self, sql):
        conn = self._dbConnect()
        conn.autocommit = False
        conn.query(sql)
        result = conn.store_result()
        if not result:
            return

        entriesToDelete = []
        for row in result.fetch_row(maxrows=0):
            if self.checkUrl(row[1]):
                entriesToDelete.append(row[0])

        self._dbDisconnect(conn)   
        conn = self._dbConnect()
        cursor = conn.cursor ()

        for entry in entriesToDelete:
            cursor.execute('delete from urls where id = ' + str(id))
            #self.removeUrl(entry, cursor)
            
        cursor.close()
        conn.commit ()
        self._dbDisconnect(conn)
        
    def _getDelimitedData(self, url):
        data = urllib.urlopen(url).read()
        data = data[28:]
        return data.split('\t\n')

    def _importData(self, delimitedData):
        conn = self._dbConnect()
        conn.autocommit = False
        cursor = conn.cursor ()
        
        cursor.execute("lock tables google_safe_browsing write;")
        conn.commit ()
        
        bulkCntr = 0
        totalCntr = 0
        
        bulkInsertStatement = "replace into google_safe_browsing (hash) values "
                
        insertValues = ""
        
        for item in delimitedData:
            operation = item[0]
            if operation == '+':
                if bulkCntr > 0:
                    insertValues += ","
                insertValues += "('" + item[1:] + "')"
                bulkCntr += 1
            elif operation == '-':
                cursor.execute("delete from google_safe_browsing where hash = '" +
item[1:] + "'")

            if bulkCntr == 100:
                bulkCntr = 0
                cursor.execute(bulkInsertStatement + insertValues)
                insertValues = ""
            if totalCntr == 1000:
                totalCntr = 0
                conn.commit ()
            totalCntr += 1
        
        if not insertValues == "":
            cursor.execute(bulkInsertStatement + insertValues)
        
        cursor.execute("unlock tables;")
        cursor.close()
        conn.commit ()
        self._dbDisconnect(conn)
