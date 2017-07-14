# Dity the enforcer Ver0.3 - Thanks Pete.
# Written by James Colderwood - james@colderwood.com.
# OpenSource Smart alarm system project.
import RPi.GPIO as GPIO # import the GPIO library
import os # import the os library
import MySQLdb as mariadb # import mysql MariaDB library
import smtplib # import SMTP for Email sending.
from time import sleep # import sleep from time library
alarm = 0 # alarm setmode
partarm = 0 # alarm partarm setmode
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
al = 0 # check the walk database bit
am = 0 # kitchen sensor walk state
an = 0 # living sensor walk state
ao = 0 # bedroom sensor walk state
ap = 0 # mancave sensor walk state
aq = 0 # Used to set omit info
ar = 0 # clear omit database bit
et = 10 # entry timer
ee = 0  # count down state
ed = 0 # alarm setter
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
check = 2 # check SQL database
wreck = 1 # timer to check user prefs
walktime = 20 # walk timer reset
panel = 0
modeset = 0
GPIO.setmode(GPIO.BCM)
GPIO.setup(7, GPIO.IN) # Kitchen PIR
GPIO.setup(1, GPIO.IN) # Door PIR
GPIO.setup(8, GPIO.IN) # Living room PIR
GPIO.setup(25, GPIO.IN) # Tamper
GPIO.setup(24, GPIO.IN) # Bedroom PIR
GPIO.setup(23, GPIO.IN) # ManCave PIR
GPIO.setup(22, GPIO.OUT) # Red LED 
GPIO.setup(21, GPIO.OUT) # internal buzzer
GPIO.setup(4, GPIO.OUT) # Green LED
GPIO.setup(5, GPIO.OUT) # Second ALARM LED
GPIO.setup(6, GPIO.OUT) # Second LED R/G/O

GPIO.output(22,0) # Off
GPIO.output(4,0) # Off
GPIO.output(5,0) # Off
GPIO.output(6,0) # Off
GPIO.output(21,0) # internal buzzer 

## user_input = int(input('Enter passcode to set: ')) # will allow user to enter a Pin to run the program. Normally not used.
## while True:
##        if user_input == int(1234):
##            print ("SET")
##            alarm=1
##            break
##        else:
##            user_input = int(input('Try again: '))

try:  
      while True:
        if var == int(1): # Full set
            GPIO.output(22, 1)     
            GPIO.output(4,0)
            ed=1
            check = check -1
            sleep(0.3)
        elif omit == int(1): # If user selects omit.
            GPIO.output(22, 1)         
            GPIO.output(4,0)
            aq=1
            check = check -1
            sleep(0.3)
            walktime = walktime -1
        else:  # Unset mode
            GPIO.output(22, 0)   
            GPIO.output(4,1)
            GPIO.output(21,0)
            GPIO.output(5,0)
            alarm=0
            ac=0
            ab=0
            ad=0
            ae=0
            et=ua
            ee=0
            eme=1
            edd=1
            ed=0
            aq=0 # Reset omit status
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
            sleep(0.2)         # wait 0.1 seconds  
 
        if wreck < 2:
         sa=0
         wreck = 500

        if sa == int(0): # Read user prefs
         print ("Checking")
         mariadb_connection = mariadb.connect(user='root', passwd='', db='alarm')
         cursor = mariadb_connection.cursor()
         cursor.execute("SELECT pref1, pref2, pref3, pref4, pref5, pref6, pref7, pref8 FROM userpref WHERE id=1") # read user settings.
         sleep(0.2) # Have a breath
         for pref1, pref2, pref3, pref4, pref5, pref6, pref7, pref8 in cursor:
          ua = pref1 # Entry Timer
          ub = pref2 # Exit Timer
          uc = pref3 # Duration of alarm
          ud = pref4
          ue = pref5
          uf = pref6
          ug = pref7
          uh = pref8
          edt = ub # Set exit value
          sa = 1 # We don't need to check the User settings for a while.
 
        if check < 2:
           mariadb_connection = mariadb.connect(user='root', passwd='', db='alarm')
           cursor = mariadb_connection.cursor()
           cursor.execute("SELECT panel, modeset FROM mode WHERE id=1")
           sleep(0.2)
           check = 15
           for panel, modeset in cursor:
             if panel == int(0.00):
              var = 0
             if panel == int(1.00):
              var = 1
             if modeset == int(1.00): # check the modeset value.
              omit = 1
             else:
              omit = 0

        if walktime < 2 and al == int(1):
           cursor.execute("UPDATE pir SET pir1=0,pir2=0,pir3=0,pir4=0,pir5=0,pir6=0,pir7=0,pir8=0 WHERE id=3")
           mariadb_connection.commit()
           sleep(0.2)
           al=0
           walktime=20

        if walktime < 1:
           walktime=20

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
            print ("Alarm UNSET")
            cursor.execute("INSERT into events SET sensor='ALARM UNSET'")
            mariadb_connection.commit()
            sleep(0.2)
            aj=1

        if oa == int(1):
            edt = edt -1
            GPIO.output(21,1)
            sleep(0.4)
            GPIO.output(4,1)
            GPIO.output(21,0)
            sleep(0.5)
            print (edt)
        if edt < 1 and oa == int(1):
            cursor.execute("INSERT into events SET sensor='Part Arm'")
            mariadb_connection.commit()
            print ("Part Arm")
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
            sleep(0.5)
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
            ee=1
            cursor.execute("INSERT into events SET sensor='Door Sensor'")
            mariadb_connection.commit()
            ab=0
            sleep(0.2)

        if (GPIO.input(1) == 0) and eme  == int(1):
            ak = 1
        elif ak == int(1):
            cursor.execute("UPDATE pir SET pir1=1 WHERE id=3")
            mariadb_connection.commit()
            ak=0
            al=1
            walktime=20
            sleep(0.2)

        if (GPIO.input(7) == 0) & alarm == int(1) or (GPIO.input(7) == 0) and pb == int(1):
            ad = 1
        elif ad == int(1):
            print ("kitchen pir")
            ee=1
            cursor.execute("INSERT into events SET sensor='Kitchen Sensor'")
            mariadb_connection.commit()
            ad=0
            sleep(0.2)

        if (GPIO.input(7) == 0) & eme == int(1):
            am = 1
        elif am == int(1):
            cursor.execute("UPDATE pir SET pir2=1 WHERE id=3")
            mariadb_connection.commit()
            am=0
            al=1
            walktime=20
            sleep(0.2)

        if (GPIO.input(8) == 0) & alarm == int(1) or (GPIO.input(8) == 0) and pc == int(1):
            ae = 1
        elif ae == int(1):
            print ("living room pir")
            ac=1
            cursor.execute("INSERT into events SET sensor='Living Room PIR'")
            mariadb_connection.commit()   
            ae = 0
            sleep(0.2)            

        if (GPIO.input(8) == 0) & eme == int(1):
            an = 1
        elif an == int(1):
            cursor.execute("UPDATE pir SET pir3=1 WHERE id=3")
            mariadb_connection.commit()
            an=0
            al=1
            walktime=20
            sleep(0.2)

        if (GPIO.input(24) == 0) & alarm == int(1) or (GPIO.input(24) == 0) and pd == int(1):
            ah = 1
        elif ah == int(1):
            print ("bed room pir")
            ac=1
            cursor.execute("INSERT into events SET sensor='Bed Room PIR'")
            mariadb_connection.commit()
            ah = 0
            sleep(0.2)

        if (GPIO.input(24) == 0) & eme == int(1):
            ao = 1
        elif ao == int(1):
            cursor.execute("UPDATE pir SET pir4=1 WHERE id=3")
            mariadb_connection.commit()
            ao=0
            al=1
            walktime=20
            sleep(0.2)

        if (GPIO.input(23) == 0) & alarm == int(1) or (GPIO.input(23) == 0) and pe == int(1):
            ai = 1
        elif ai == int(1):
            print ("mancave pir")
            ac=1
            cursor.execute("INSERT into events SET sensor='Man cave PIR'")
            mariadb_connection.commit()
            ai = 0
            sleep(0.2)

        if (GPIO.input(23) == 0) & eme == int(1):
            ap = 1
        elif ap == int(1):
            cursor.execute("UPDATE pir SET pir5=1 WHERE id=3")
            mariadb_connection.commit()
            ap=0
            al=1
            walktime=20
            sleep(0.2)

        if ee == int(1) and aj == int(0): # Entry Timer
            et = et -1
            sleep(0.5)
            GPIO.output(22, 0)
            GPIO.output(21,1)
            sleep(0.4)
            GPIO.output(21,0)
            print (et)     
            check = check -10
        if et < 1:
            ac=1
            ee=0

        if eme == int(1) & ac == int(1):
            eme=0 
            print("mail")
            os.system('python3 mail.py')
            cursor.execute("INSERT into events SET sensor='Email Sent'")
            mariadb_connection.commit()

        if ac == int(1):
            print ("alarm!!!!!!")
            GPIO.output(21,1)
            GPIO.output(5,0)
            GPIO.output(6,1)
            sleep(0.5)
            GPIO.output(5,1)
            GPIO.output(6,0)
            sleep(0.5)
            uc = uc -1 # start alarm sounder count down
            check = check -5

            if uc < 5: # If alarm timeout is reached silence the alarm
             print ("Alarm TimeOut") # Show status in console
             cursor.execute("INSERT into events SET sensor='Alarm TimeOut'") # Write event to database
             mariadb_connection.commit()
             GPIO.output(21,0) # Internal Buzzer off
             ac=0 # Turn the alarm off
             sa=0 # Get user settings from database.
             et=ua
            
        if (GPIO.input(25) == 0):
            af = 1
        elif af == int(1):
            print ("TAMPER")
            ac=1
            ag=1
            GPIO.output(5,0)
            GPIO.output(6,0)
            cursor.execute("INSERT into events SET sensor='TAMPER'")
            mariadb_connection.commit()
            af = 0
            sleep(0.5)

        if ag == int(1):
            GPIO.output(21,1)
            GPIO.output(5,0)
            GPIO.output(6,1)
            sleep(0.3)
            GPIO.output(5,1)
            GPIO.output(6,0)

finally:                   # this block will run no matter how the try block exits  
    GPIO.cleanup()         # clean up after yourself
