"""
This program is free and open source, released into the public domain.

Daniel Barnes http://nasonfish.com/

This is a program made to add numbers together using a variable base
number system, specified on the command line.

The numbers or symbols supplied become a number system and anything
specified as the second or third argument become
the numbers the symbols represent.

if the first argument is 0123456789, that's base-10 and therefore
will add just like anything else normally would (up to 100 digits
because of bad programming style that I should fix.)

Usage: ./multidigit_add.py symbols addend1 addend2
Result: addend1 + addend2 in a symbols number system.
Symbols' characters should all be unique.
"""

import math
import sys

symbols = sys.argv[1]
addend1 = sys.argv[2]
addend2 = sys.argv[3]

result = ""

length = len(symbols)
values1 = addend1[::-1].ljust(100, symbols[0])
values2 = addend2[::-1].ljust(100, symbols[0])

leftover = 0

for key in range(0,100):
  v = symbols.index(values1[key]) + symbols.index(values2[key]) + leftover
  leftover = math.floor(v / length)
  result += symbols[int(v % length)]

result = result[::-1].lstrip(symbols[0])

print result

