#!/usr/bin/python
import sympy
from math import *
import readline

x, y = sympy.symbols("x y")
while True:
  ans = sympy.expand(eval(raw_input(">>> ")))
  print ans

