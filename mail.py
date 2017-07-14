import smtplib

SERVER = "aspmx.l.google.com"

FROM = ""
TO = [""] # must be a list
CC = [""]

SUBJECT = "ALARM"

TEXT = "The House alarm is going!"

# Prepare actual message

message = """\
From: %s
To: %s
Subject: %s

%s
""" % (FROM, ", ".join(TO), SUBJECT, TEXT)

# Send the mail

server = smtplib.SMTP(SERVER)
server.sendmail(FROM, TO, message)
server.sendmail(FROM, CC, message)
server.quit()
