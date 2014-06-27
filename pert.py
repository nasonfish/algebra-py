#!/usr/bin/python
#import pyperclip
import readline
from math import *
while True:
  type = raw_input('Type [p, e|l, 2|r]: ')
  if 'l' in type:
    if '2' in type:
        a = 2
        p = 1
    else:
        p = float(eval(raw_input("Principal: ")))
        a = float(eval(raw_input("Amount: ")))
    r = float(eval(raw_input("Rate: %"))) / 100.
    t = float(log((a/p))/r)
    print "{} years, {} months".format(int(floor(t)), int(round((t % 1.) * 12.)))
    continue
  if 'r' in type:
    p = float(eval(raw_input("Principal: ")))
    a = float(eval(raw_input("Amount: ")))
    r = float(eval(raw_input("Years: ")))
    t = float(log(a/p)/r)
    print round(t * 100, 1)
    continue
  past = int("p" in type)
  earned = int("e" in type)
  p = float(eval(raw_input("Principal: ")))
  r = float(eval(raw_input("Rate: %"))) / 100.
  t = float(eval(raw_input("Years: ")))
  if past:
    if earned:
      pert = round(p - (p/e**(r * t)), 2)
    else:
      pert = round(p/e**(r * t), 2)
  else:
    pert = round(p * e**(r * t) - (earned * p), 2)
  #pyperclip.copy(pert)
  print pert

