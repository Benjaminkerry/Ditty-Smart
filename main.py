# Dity the enforcer Ver0.4 - Thanks Pete.
# Written by James Colderwood - james@colderwood.com.
# OpenSource Smart alarm system project.
import RPi.GPIO as GPIO # import the GPIO library
import logbook # import Logbook Library
import os # import the os library
import MySQLdb as mariadb # import mysql MariaDB library
import nest # import the nest library
import sys # import the system library
import urllib2 # import URLLib Library
# import remote # import the remote server connection
from time import sleep # import sleep from time library
from twilio.rest import Client
alarm = 0 # alarm setmode
ac = 0 # alarm state
ab = 0 # door sensor state
ad = 0 # kitchen pir state
ae = 0 # living room pir state
af = 0 # tamper state
ag = 0 # tamper alarm
ah = 0 # bedroom state
ai = 0 # mancave state
aj = 0 # alarm off state
ak = 0 # door sensor walk state
al = 1 # check the walk database bit
am = 0 # kitchen sensor walk state
an = 0 # living sensor walk state
ao = 0 # bedroom sensor walk state
ap = 0 # mancave sensor walk state
aq = 0 # Used to set omit info
ar = 0 # clear omit database bit
at = 0 # Zone 6 state
au = 0 # Zone 6 Walk state
av = 0 # Zone 7 state
aw = 0 # Zone 7 walk state
ax = 0 # Zone 8 state
ay = 0 # Zone 8 walk state
et = 10 # entry timer
ee = 0  # count down state
ed = 0 # alarm setter
ma = 1 # Text message status
ms = 0 # Text message counter
oa = 0 # part alarm bit
pa = 0 # Zone 1 selector
pb = 0 # Zone 2 selector
pc = 0 # Zone 3 selector
pd = 0 # Zone 4 selector
pe = 0 # Zone 5 selector
pf = 0 # Zone 6 selector
pg = 0 # Zone 7 selector
ph = 0 # Zone 8 selector
sa = 1 # Reset the reload script
ua = 10 # userselect Entry Timer
ub = 10 # userselect Exit Timer
uc = 0 # userselect Duration of ALARM
ud = 0 # userselect feature 4
ue = 0 # userselect feature 5
uf = 0 # userselect feature 6
ug = 0 # userselect feature 7
uh = 0 # userselect feature 8
ui = 0 # userselect feature 9
uj = 0 # userselect feature 10
uk = 0 # userselect feature 11
ul = 0 # userselect feature 12
um = 0 # userselect feature 13
uo = 0 # userselect feature 14
up = 0 # userselect feature 15
uq = 0 # userselect feature 16
ur = 0 # userselect feature 17
us = 0 # userselect feature 18
ut = 0 # userselect feature 19
uu = 0 # userselect feature 20
uv = 0 # userselect feature 21
uw = 0 # userselect feature 22
ux = 0 # userselect feature 23
uy = 0 # userselect feature 24
uz = 0 # userselect feature 25
var = 0 # alarm mode
edd = 0 # alarm state
edt = 0 # exit counter
omit = 0 # check to see if omit function is being used?
eme = 0 # Email / Alarm state
check = 5 # check SQL database
wreck = 1 # timer to check user prefs
walktime = 6 # walk timer reset
panel = 0 # Panel mode
modeset = 0 # omit mode
account_sid = "" # Twilio SID key
auth_token = "" # Twilio Auth token
client = Client(account_sid, auth_token) # define client
client_id = '' # NEST Developer client ID
client_secret = '' # NEST Developer client secret
access_token_cache_file = 'nest.json' # Cache file for NEST.
napi = nest.Nest(client_id=client_id, client_secret=client_secret, access_token_cache_file=access_token_cache_file) # define napi
logger = logbook.Logger('Ditty Ver 0.4 log')
log = logbook.FileHandler('ditty.log')
log.push_application()
GPIO.setmode(GPIO.BCM) # Set board PIN mode.
GPIO.setup(7, GPIO.IN, pull_up_down = GPIO.PUD_UP) # Zone2
GPIO.setup(1, GPIO.IN, pull_up_down = GPIO.PUD_UP) # Zone1
GPIO.setup(8, GPIO.IN, pull_up_down = GPIO.PUD_UP) # Zone3
GPIO.setup(25, GPIO.IN, pull_up_down = GPIO.PUD_UP) # Tamper
GPIO.setup(24, GPIO.IN, pull_up_down = GPIO.PUD_UP) # Zone4
GPIO.setup(23, GPIO.IN, pull_up_down = GPIO.PUD_UP) # Zone5
GPIO.setup(20, GPIO.IN, pull_up_down = GPIO.PUD_UP) # Zone6
GPIO.setup(16, GPIO.IN, pull_up_down = GPIO.PUD_UP) # Zone 7
GPIO.setup(12, GPIO.IN, pull_up_down = GPIO.PUD_UP) # Zone 8
GPIO.setup(22, GPIO.OUT) # Red LED 
GPIO.setup(21, GPIO.OUT) # internal buzzer
GPIO.setup(26, GPIO.OUT) # Strobe
GPIO.setup(19, GPIO.OUT) # BELLBOX
GPIO.setup(13, GPIO.OUT) # Internal Siren
GPIO.setup(4, GPIO.OUT) # Green LED
GPIO.setup(5, GPIO.OUT) # Second ALARM LED
GPIO.setup(6, GPIO.OUT) # Second LED R/G/O

GPIO.output(22,0) # Off
GPIO.output(4,0) # Off
GPIO.output(5,0) # Off
GPIO.output(6,0) # Off
GPIO.output(21,0) # internal buzzer 
GPIO.output(26,1) # Strobe
GPIO.output(19,1) # BELLBOX
GPIO.output(13,0) # Internal siren
mariadb_connection = mariadb.connect(user='root', passwd='', db='alarm') # MySQL Database details
cursor = mariadb_connection.cursor() # define cursor

def fullset(): # Alarm is set
      global ed,check
      GPIO.output(22, 1)     
      GPIO.output(4,0)
      ed=1
      check = check -1
      sleep(1)
      print check    
  
def omitset(): # Alarm is partset
      global aq,check,walktime
      GPIO.output(22, 1)         
      GPIO.output(4,0)
      aq=1
      check = check -1
      sleep(1)
      walktime = walktime -1
      
def unset(): # Alarm is not set
      global alarm,ac,ab,ad,ae,ah,ai,at,et,ua,ee,eme,edd,ed,aq,ms,ma,pa,pb,pc,pd,pe,pf,pg,ph,var,omit,wreck,check,walktime
      GPIO.output(22, 0)   
      GPIO.output(4,1)
      GPIO.output(21,0)
      GPIO.output(5,0)
      GPIO.output(26,1) # Strobe
      GPIO.output(19,1) # BELLBOX
      GPIO.output(13,0) # Internal siren
      alarm=0
      ac=0
      ab=0
      ad=0
      ae=0
      ah=0
      ai=0
      at=0
      et=ua
      ee=0
      eme=1
      edd=1
      ed=0
      aq=0 # Reset omit status
      ms=0 # Reset text message
      ma=1 # Set ready to send message when set.
      pa=0 # Zone reset
      pb=0 # Zone reset
      pc=0 # Zone reset
      pd=0 # Zone reset
      pe=0 # Zone reset
      pf=0 # Zone reset
      pg=0 # Zone reset
      ph=0 # Zone reset
      var=0
      omit=0
      wreck = wreck -1
      check = check -1
      walktime = walktime -1
      sleep(1)         # wait 1 seconds
      print check

def alarms(): # Called when alarm trigger
      global msg
      alarmmode() # Check the alarm is still set
      print ("alarm!!!!!!")
      msg="ALARM" # Text message to be sent.
      sleep(0.2)
      GPIO.output(21,1)
      GPIO.output(5,0)
      GPIO.output(6,1)
      GPIO.output(26,0) # Strobe on
      GPIO.output(19,0) # BELLBOX
      GPIO.output(13,1) # Internal siren
      GPIO.output(5,1)
      GPIO.output(6,0)

def alarmtime(): # Alarm timeout.
      global cursor,ac,sa,eme,et,ua
      print ("Alarm TimeOut") # Show status in console
      logger.info('Alarm timeout reached')
      cursor.execute("INSERT into events SET sensor='Alarm TimeOut'") # Write event to database
      mariadb_connection.commit()
      GPIO.output(21,0) # Internal Buzzer off
      GPIO.output(19,1) # BELLBOX
      GPIO.output(13,0) # Internal siren
      ac=0 # Turn the alarm off
      sa=0 # Get user settings from database.
      eme=1 # Reset email + Test message bit
      et=ua

def statuscheck(): # Update the user settings.
      global ua,ub,uc,ud,ue,uf,ug,uh,edt,sa,mariadb_connection,cursor
      print ("Checking")
      cursor.execute("SELECT pref1, pref2, pref3, pref4, pref5, pref6, pref7, pref8 FROM userpref WHERE id=1") # read user settings.
      sleep(0.2) # Have a breath
      for pref1, pref2, pref3, pref4, pref5, pref6, pref7, pref8 in cursor:
       ua = pref1 # Entry Timer
       ub = pref2 # Exit Timer
       uc = pref3 # Duration of alarm
       ud = pref4 # Entry/Exit Zones
       ue = pref5
       uf = pref6
       ug = pref7
       uh = pref8
       edt = ub # Set exit value
       sa = 1 # We don't need to check the User settings for a while.

def alarmmode(): # Check alarm mode
      global var,omit,check,mariadb_connection,cursor
      cursor.execute("SELECT panel, modeset FROM mode WHERE id=1")
      sleep(0.5)
      check = 45
      for panel, modeset in cursor:
       if panel == int(0.00):
        var = 0
       if panel == int(1.00):
        var = 1
       if modeset == int(1.00): # check the modeset value.
        omit = 1
       else:
        omit = 0
      nestcheck()

def alarmunset(): # Alarm unset message
      global aj,mariadb_connection,cursor
      logger.info('Alarm Unset')
      print ("Alarm UNSET")
      cursor.execute("INSERT into events SET sensor='ALARM UNSET'")
      mariadb_connection.commit()
      sleep(0.2)
      aj=1
      
def nestcheck(): # NEST API polling
    global mariadb_connection,cursor
    try:
       napi = nest.Nest(client_id=client_id, client_secret=client_secret, access_token_cache_file=access_token_cache_file)
       print (napi.structures[1].away)
       if (napi.structures[1].away == "away"):
            cursor.execute("UPDATE mode SET panel=1 WHERE id=1")
            mariadb_connection.commit()
            logger.info('Nest API - Set Alarm')
       else:
             cursor.execute("UPDATE mode SET panel=0 WHERE id=1")
             mariadb_connection.commit()
    except:
         print ("No connection")
         logger.warn('Unable to connect to Internet for NEST API check')
    sleep(0.2)
      
if napi.authorization_required: # If there is no cache user will have to enter PIN as per screen instructions
    print('Go to ' + napi.authorize_url + ' to authorize, then enter PIN below')
    logger.error('Nest requires .json file or password auth')
    if sys.version_info[0] < 3:
        pin = raw_input("PIN: ")
    else:
        pin = input("PIN: ")
    napi.request_token(pin)

try:
      while True:
        if var == int(1): # Full set
            fullset()
        elif omit == int(1): # If user selects omit.
            omitset()
        else:  # Unset mode
            unset()
 
        if wreck < 2: # User prefs timer
         sa=0
         wreck = 500

        if sa == int(0): # Read user prefs
         statuscheck()
 
        if check < 2: # Check alarm set mode.
         alarmmode()

        if walktime < 2 and al == int(1): # Reset the live PIR display
           cursor.execute("UPDATE pir SET pir1=0,pir2=0,pir3=0,pir4=0,pir5=0,pir6=0,pir7=0,pir8=0 WHERE id=3")
           mariadb_connection.commit()
           sleep(0.2)
           al=0
           walktime=6

        if walktime < 1: # Can be removed. Here for good measure.
           walktime=6

        if aq == int(1) and alarm == int(0): # Check to see which zones should be set. 
           cursor.execute("SELECT pir1, pir2, pir3, pir4, pir5, pir6, pir7, pir8 FROM pir WHERE id=4") # read the database
           sleep(0.1)
           ar=1 # Set clear seq
           for pir1, pir2, pir3, pir4, pir5, pir6, pir7, pir8 in cursor: 
             if pir1 == int(1.00): # Zone 1 selected
              pa=1

             if pir2 == int(1.00): # Zone 2 selected 
              pb=1

             if pir3 == int(1.00): # Zone 3 selected 
              pc=1

             if pir4 == int(1.00): # Zone 4 selected
              pd=1

             if pir5 == int(1.00): # Zone 5 selected 
              pe=1

             if pir6 == int(1.00): # Zone 6 selected
              pf=1

             if pir7 == int(1.00): # Zone 7 selected
              pg=1

             if pir8 == int(1.00): # Zone 8 selected
              ph=1

        if ar == int(1): #Set alarm clear database!
         cursor.execute("UPDATE pir SET pir1=0,pir2=0,pir3=0,pir4=0,pir5=0,pir6=0,pir7=0,pir8=0 WHERE id=4") # Reset state to 0
         mariadb_connection.commit()     
         oa=1
         ar=0
		
        if alarm == int(0) and aj == int(0):
            alarmunset()

        if oa == int(1):
            edt = edt -1
            GPIO.output(21,1)
            sleep(0.4)
            GPIO.output(4,1)
            GPIO.output(21,0)
            print (edt)
        if edt < 1 and oa == int(1):
            cursor.execute("INSERT into events SET sensor='Part Arm'")
            mariadb_connection.commit()
            print ("Part Arm")
            logger.info('System is Partarm')
            walktime = 0
            alarm=2
            edt=ub
            oa=0
            aq=0
            eme=1
            aj=0 # Ready for unset message

        if ed == int(1) & edd == int(1):
            edt = edt -1
            GPIO.output(21,1)
            sleep(0.4)
            GPIO.output(4,1)
            GPIO.output(21,0)
            print (edt)
            ag=0 # reset TAMPER alarm.
        if edt < 1:
            cursor.execute("INSERT into events SET sensor='ALARM SET'")
            mariadb_connection.commit()
            print ("Alarm SET")
            alarm=1
            edt=ub
            walktime = 0 # clear the sensor walk states
            edd=0
            eme=1
            aj=0

        if (GPIO.input(1) == 0) & alarm == int(1) or (GPIO.input(1) == 0) and pa == int(1):
            ab = 1
        elif ab == int(1):
            print ("door sensor")
            cursor.execute("INSERT into events SET sensor='Door Sensor'")
            mariadb_connection.commit()
            ab=0
            if ud > 0: # Zone 1 always will be an Entry/Exit delay.
                ee=1
            else:
                ac=1 # Here for good measure.
            sleep(0.2)

        if (GPIO.input(1) == 0) and eme  == int(1):
            ak = 1
        elif ak == int(1):
            cursor.execute("UPDATE pir SET pir1=1 WHERE id=3")
            mariadb_connection.commit()
            ak=0
            al=1
            walktime=6
            sleep(0.2)

        if (GPIO.input(7) == 0) & alarm == int(1) or (GPIO.input(7) == 0) and pb == int(1):
            ad = 1
        elif ad == int(1):
            print ("kitchen pir")
            cursor.execute("INSERT into events SET sensor='Kitchen Sensor'")
            mariadb_connection.commit()
            ad=0
            if ud > 1: # Zone 2 Entry/Exit delay.
                ee=1
            else:
                ac=1
            sleep(0.2)

        if (GPIO.input(7) == 0) & eme == int(1):
            am = 1
        elif am == int(1):
            cursor.execute("UPDATE pir SET pir2=1 WHERE id=3")
            mariadb_connection.commit()
            am=0
            al=1
            walktime=6
            sleep(0.2)

        if (GPIO.input(8) == 0) & alarm == int(1) or (GPIO.input(8) == 0) and pc == int(1):
            ae = 1
        elif ae == int(1):
            print ("living room pir")
            cursor.execute("INSERT into events SET sensor='Living Room PIR'")
            mariadb_connection.commit()   
            ae = 0
            if ud > 2: # Zone 3 Entry Exit?
                ee=1
            else:
                ac=1
            sleep(0.2)            

        if (GPIO.input(8) == 0) & eme == int(1):
            an = 1
        elif an == int(1):
            cursor.execute("UPDATE pir SET pir3=1 WHERE id=3")
            mariadb_connection.commit()
            an=0
            al=1
            walktime=6
            sleep(0.2)

        if (GPIO.input(24) == 0) & alarm == int(1) or (GPIO.input(24) == 0) and pd == int(1):
            ah = 1
        elif ah == int(1):
            print ("bed room pir")
            cursor.execute("INSERT into events SET sensor='Bed Room PIR'")
            mariadb_connection.commit()
            ah = 0
            if ud > 3: # Zone 4 Entry/Exit?
                ee=1
            else:
                ac=1
            sleep(0.2)

        if (GPIO.input(24) == 0) & eme == int(1):
            ao = 1
        elif ao == int(1):
            cursor.execute("UPDATE pir SET pir4=1 WHERE id=3")
            mariadb_connection.commit()
            ao=0
            al=1
            walktime=6
            sleep(0.2)

        if (GPIO.input(23) == 0) & alarm == int(1) or (GPIO.input(23) == 0) and pe == int(1):
            ai = 1
        elif ai == int(1):
            print ("mancave pir")
            cursor.execute("INSERT into events SET sensor='Man cave PIR'")
            mariadb_connection.commit()
            ai = 0
            if ud > 4: # Zone 5 Entry/Exit?
                ee=1
            else:
                ac=1
            sleep(0.2)

        if (GPIO.input(23) == 0) & eme == int(1):
            ap = 1
        elif ap == int(1):
            cursor.execute("UPDATE pir SET pir5=1 WHERE id=3")
            mariadb_connection.commit()
            ap=0
            al=1
            walktime=6
            sleep(0.2)

        if (GPIO.input(20) == 0) & alarm == int(1) or (GPIO.input(20) == 0) and pf == int(1):
            at = 1
        elif at == int(1):
            print ("UP HALL")
            cursor.execute("INSERT into events SET sensor='UP HALL'")
            mariadb_connection.commit()
            at = 0
            if ud > 5: # Zone 6 Entry/Exit?
                ee=1
            else:
                ac=1
            sleep(0.2)

        if (GPIO.input(20) == 0) & eme == int(1):
            au = 1
        elif au == int(1):
            cursor.execute("UPDATE pir SET pir6=1 WHERE id=3")
            mariadb_connection.commit()
            au=0
            al=1
            walktime=6
            sleep(0.2)

        if (GPIO.input(16) == 0) & alarm == int(1) or (GPIO.input(16) == 0) and pg == int(1):
            av = 1
        elif av == int(1):
            print ("Zone7")
            cursor.execute("INSERT into events SET sensor='Zone7'")
            mariadb_connection.commit()
            av = 0
            if ud > 6: # Zone 7 Entry/Exit?
                ee=1
            else:
                ac=1
            sleep(0.2)
            
        if (GPIO.input(16) == 0) & eme == int(1):
            aw = 1
        elif aw == int(1):
            cursor.execute("UPDATE pir SET pir7=1 WHERE id=3")
            mariadb_connection.commit()
            aw=0 
            al=1
            walktime=6
            sleep(0.2)

        if (GPIO.input(12) == 0) & alarm == int(1) or (GPIO.input(12) == 0) and ph == int(1):
            ax = 1
        elif ax == int(1):
            print ("Zone8")
            cursor.execute("INSERT into events SET sensor='Zone8'")
            mariadb_connection.commit()
            ax = 0
            if ud > 7: # Zone 8 Entry/Exit?
                ee=1
            else:
                ac=1
            sleep(0.2)

        if (GPIO.input(12) == 0) & eme == int(1):
            ay = 1
        elif ay == int(1):
            cursor.execute("UPDATE pir SET pir8=1 WHERE id=3")
            mariadb_connection.commit()
            ay=0
            al=1
            walktime=6
            sleep(0.2)


        if ee == int(1) and aj == int(0): # Entry Timer
            et = et -1
            sleep(0.5)
            GPIO.output(22, 0)
#            GPIO.output(21,1)
            sleep(0.4)
#            GPIO.output(21,0)
            print (et)     
            check = check -8
        if et < 1:
            ac=1
            ee=0

        if et == 20:
           GPIO.output(13,1)
           sleep(0.01)
           GPIO.output(13,0) 

        if eme == int(1) & ac == int(1):
            eme=0 
            print("mail")
            os.system('python3 mail.py')
            cursor.execute("INSERT into events SET sensor='Email Sent'")
            mariadb_connection.commit()
            logger.info('The Alarm is sounding')
            ms=1
            ma=1

        if ac == int(1):
            alarms()
            uc = uc -1 # start alarm sounder count down
            check = check -5
            if uc < 5: # If alarm timeout is reached silence the alarm
             alarmtime()

            
##        if (GPIO.input(25) == 1):
##            af = 1
##        elif af == int(1):
##            print ("TAMPER")
##            ac=1
##            ag=1
##            GPIO.output(5,0)
##            GPIO.output(6,0)
##            cursor.execute("INSERT into events SET sensor='TAMPER'")
##            mariadb_connection.commit()
##            af = 0
##            sleep(0.5)

        if ag == int(1):
            GPIO.output(21,1)
            GPIO.output(5,0)
            GPIO.output(6,1)
            sleep(0.3)
            GPIO.output(5,1)
            GPIO.output(6,0)

        if ms == int(1) and ma == int(1):
           client.messages.create(
            to="",
            from_="",
            body=msg
            )
           ms=0
           ma=0

finally:                   # this block will run no matter how the try block exits  
    GPIO.cleanup()         # clean up after yourself
