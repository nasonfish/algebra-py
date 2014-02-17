"""
This program is free and open source, released into the public domain.

Daniel Barnes http://nasonfish.com/

A library for linear equation operations, specifically 
designed for linear_programming.py

Here, you can create an object simply by passing an
equation in the form ax+by>=c to the __init__ function.

The operation is stored so we can compare the numbers
from Equation.f((x, y)) to what is possible, to see if
values are in the feasable region.
"""

import re

parse = re.compile('^(?P<x>[+-]?\d+(?:\.\d+)?)x(?P<y>[-+]\d+(?:\.\d+)?)y(?P<oper>[<>]=)(?P<constant>[-+]?\d+(?:\.\d+)?)$')

operation = {
">=": lambda x, y: x >= y,
"<=": lambda x, y: x <= y
}

class Equation():
  x = 0
  y = 0 
  oper = ">="
  c = 0

  def __init__(self, data):
    match = parse.match(data)
    self.x, self.y, self.oper, self.c = match.group('x', 'y', 'oper', 'constant')
    self.x = float(self.x)
    self.y = float(self.y)
    self.c = float(self.c)

  def f(self, v):
    x, y = v
    # currently in the form ax+by>=c
    return operation[self.oper](self.y * y + self.x * x, self.c)

  def __repr__(self):
    return "%sx+%sy%s%s" % (self.x, self.y, self.oper, self.c)

