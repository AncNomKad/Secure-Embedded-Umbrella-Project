import os
import sys
import smtplib

from email.mime.text import MIMEText

postName = sys.argv[1]
postEmail = sys.argv[2]

userEmail = "kade.cooper@colorado.edu"
userSMTP = "mx.colorado.edu"
msg= MIMEText("[NOTICE]: This email is an alert from the Umbrella Network Database System alerting you that your account is now active. Follow this link to login: http://127.0.0.1/umbrella/redirect.php. Your account info is as follows: Username: "+postName+" - Email: "+postEmail+". For Password and PIN see Admin.")
msg['Subject'] = '[Admin] REQUIRE USER CONFIRMATION'
msg['From'] = userEmail
msg['To'] = userEmail
try:
    s = smtplib.SMTP(userSMTP)
    s.sendmail(userEmail, userEmail, msg.as_string())
    print "[NOTICE]: Successfully sent email!\n"
except:
    print "[ERROR]: Could not send out alert email. Contact local IT."
