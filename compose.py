import re

print("Enter f(x) in (f o g)(x)")
e1 = str(raw_input(">>> "))
print("Enter g(x)")
e2 = str(raw_input(">>> "))
from math import *
import sympy
x = sympy.symbols("x")
a = sympy.expand(eval(e1.replace("x", "(" + e2 + ")")))
print a
