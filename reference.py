#!/usr/bin/python
"""
This program is free and open source, released into the public domain.

Daniel Barnes http://nasonfish.com/

This program is made to find reference angles for angles on circles,
in either radians or degrees. It will accept an angle (floats only
for degrees, can be fractions of pi in radians in the form xpi/y).

The program will return a reference angle between 0 and 90 degrees,
or 0 and 1pi/2 radians. It will also return if x or y has flipped.

#             radians or degrees     angle value
Usage: ./reference.py r|d number[pi/othernumber, if radians]
"""

import sys
import re
import math

# Usage: ./programname r|d int
# Find the reference angle of an angle.
# Author Daniel Barnes / nasonfish.com

def reference_r(co, d, flip_x=False, flip_y=True):
  if co >= 0.0 and co/d <= 0.5:
    return (co, d, "-" if flip_x else "+", "-" if flip_y else "+")
  if co >= 2.0 * d:
    return reference_r(co - (2.0 * d), d, flip_x, flip_y)  # Yes! recursion! muahahahaha!
  if co < 0.0:
    return reference_r(co + (2.0 * d), d, flip_x, flip_y)
  if co/d < 1.0:  # check if it's already right is above
    return reference_r(d - co, d, not flip_x, flip_y)
  if co/d < 1.5:
    return reference_r(d + co, d, not flip_x, not flip_y)
  if co/d < 2.0:
    return reference_r((2.0 * d) - co, d, flip_x, not flip_y)

def reference_d(d, flip_x=False, flip_y=False):
  if d >= 0.0 and d < 90:
    return (d, "-" if flip_x else "+", "-" if flip_y else "+")
  if d >= 360:
    return reference_d(d - 360, flip_x, flip_y)
  if d < 0:
    return reference_d(d + 360, flip_x, flip_y)
  if d < 180:
    return reference_d(180 - d, not flip_x, flip_y)
  if d < 270:
    return reference_d(180 + d, not flip_x, not flip_y)
  if d < 360:
    return reference_d(360 - d, flip_x, not flip_y)

if sys.argv[1] == "r":
  # Radians!
  try:
    co, d = (float(sys.argv[2]), math.pi) # I KNOW I'M A TERRIBLE PERSON I'M VERY SORRY
  except ValueError:
    # Expressed in terms of pi. I suppose that's a good thing.
    matches = re.match('(?P<co>[+-]?\d+(?:\.\d+)?)pi\/(?P<d>[+-]?\d+(?:\.\d+)?)', sys.argv[2])
    co, d = map(float, matches.group('co', 'd'))
  print("The reference point used is %spi/%s with %sx and %sy." % reference_r(co, d))
else:
  print("The reference point used is %s with %sx and %sy." % reference_d(float(sys.argv[2])))
