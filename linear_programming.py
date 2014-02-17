#!/usr/bin/python
"""
This program is free and open source, released into the public domain.

Daniel Barnes http://nasonfish.com/

This program is made for linear programming, as discussed in my math book.
The program accepts a list of inequalities (in the form of ax+by=c, where
a, b, and c are integers or floats in the form of `[+-]?\d+(\.\d+)?` if
you speak magic) and it essentially lays all the inequalities out
together, to create a sort of shape of a feasable region.
The program is also given a goal - minimize or maximize - and a value for
x and y.

According to the corner-point principle, one of the corners of the feasable
region can be plugged into the values for x and y to reach the best
possible way to come near the goal of minimize or maximize.

Here's an example problem:

There are two types of computers I can make. Computer A takes 10 minutes
to assemble, while Computer B takes 20 minutes.
There are 120 total minutes available to be spread among the computers.
Find the way to maximze the profit where computer A's profit is $20.00 and
Computer B's profit is $35.00

We can find the inequalities from the problem as
10x+20y<=120 because the maximum of it is 120 minutes and x and y can be
anything under that with the allowed minutes.
x and y must also be above 0, we can't make negative computers.
1x+0y>=0, 0x+1y>=0

The profit is 20x+35y.

We can pass all the information to the program as so:

nasonfish@nasonfish.com ~> ./linear_programming.py max "20x+35y" "10x+20y<=120" "1x+0y>=0" "0x+1y>=0"

Finding the max of {'y': 35.0, 'x': 20.0} with equations: [10.0x+20.0y<=120.0, 1.0x+0.0y>=0.0, 0.0x+1.0y>=0.0]
ans is 240.0 as [(12.0, 0.0)]

The maximum profit is $240 by putting all resources into 
making Computer A, of which we make 12 of (it's x in the tuple of
(x, y). The list can have multiple if it needs to.)

#                                 goal    values     equations, each as a separate argument. Must be in that form.
Usage: ./linear_programming.py (max|min) <a>x+<b>y [ax+by>=c ...]
"""
# This comes in handy later, trust me
from linear import Equation
import re
import sys

find_max = sys.argv[1] == "max"  # max or min?

matches = re.match(r'^(-?\d+)x([+-]\d+)y$', sys.argv[2])  # 10x+20y
values = {"x": float(matches.group(1)), "y": float(matches.group(2))}
e = sys.argv[3:]

#e = map(Equation, e)
e = [Equation(s) for s in e]
copy = e[:]
points = []  # list of tuples


print("Finding the %s of %s with equations: %s" % ("max" if find_max else "min", values, e))


def check(e1, e2, lst=[]):
  # find x at intersection of equations 1 and 2
  # plug the x into every lst and find y.
  point = intersect(e1, e2)
  if not point:
    return False
  for e in copy:
    if e is e1 or e is e2: 
      continue
    if not e.f(point):
      return False
  return point



def intersect(e1, e2):
  # ax + by = c
  # remember that x and y, as fields, are just 
  # coefficients of x and y. great naming :|

  # solving a system of equations:
  # ax/a + by/a = c/a (1)
  # dx/d + ey/d = f/d (2)
  # (b/a)y - (e/d)y = c/a - f/d
  # ((b/a)-(e/d))y = c/a - f/d
  # y = ((c/a) - (f/d))/((b/a)-(e/d))
  # x = (c - b*y)/a
  if 0.0 in (e1.x, e1.y, e2.x, e2.y):
    if (e1.x == 0.0 and e2.x == 0.0) or (e1.y == 0.0 and e2.y == 0.0):
      return False
    if e1.x == 0.0:
      y = e1.c/e1.y
      if e2.y == 0.0:
        x = e2.c/e2.x
      else:
        x = (e2.c - (e2.y * y))/e2.x
    if e1.y == 0.0:
      x = e1.c/e1.x
      if e2.x == 0.0:
        y = e2.c/e2.y
      else:
        y = (e2.c - (e2.x * x))/e2.y
    if e2.x == 0.0:
      y = e2.c/e2.y
      x = (e1.c - (e1.y * y))/e1.x
    if e2.y == 0.0:
      x = e2.c/e2.x
      y = (e1.c - (e1.x * x))/e1.y
    return (x, y)
  # I'm actually really sorry for this. :(
  y = ((e1.c/e1.x) - (e2.c/e2.x))/((e1.y/e1.x)-(e2.y/e2.x))
  x = (e1.c - (e1.y*y))/e1.x
  # remember of the existance of equation.f(tuple) boolean - for checking, in feasable region?
  return (x, y)
 

# Here's something awfully complicated!

# As we loop through each expression, we remove it from the list.
# We're looping through to find every intersecting point in the list.
# Each point we find will be added to a list. then, we can use e_copy
# and compare every point's y to the line it wasn't part of.

# Essentially, we want to execute a certain function one time for
# every combonation of two equations.

# maybe McMorrow can help! :O
for expression in e:
  e.remove(expression)
  for ch in e:
    res = check(expression, ch)
    if res:
      points.append(res)

ans = None
ans_pts = []
for point in points:
  curr = (float(values['x']) * point[0]) + (float(values['y']) * point[1])
  if not ans or (ans > curr and not find_max) or (ans < curr and find_max):
    ans = curr
    ans_points = [point]
  elif ans == curr:
    ans_points.append(point)
  


print "ans is %s as %s" % (ans, ans_points)
