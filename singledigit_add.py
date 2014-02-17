"""
This program is free and open source, released into the public domain.

Daniel Barnes http://nasonfish.com/

This is another program that will add two symbols together in a
variable base system. However, this satisfies the requirements
of a previous program from a college course somewhere - it only
accepts one character in each addend, so it's shorter and simpler.

Usage: ./singledigit_add.py symbols a b
Result: a and b added together in a symbols number system.
a and b need to be inside symbols. They can be the same, however.
Keep in mind the first digit in symbols will be equal to 0.
"""
#!/usr/bin/env python

import math
import sys
#symbols = "0123456789"
#addend1 = "5"
#addend2 = "3"

symbols = sys.argv[1]
addend1 = sys.argv[2]
addend2 = sys.argv[3]

result = ""

length = len(symbols)

v = symbols.index(addend1) + symbols.index(addend2)
result += str(symbols[int(math.floor(v / length))]) + str(symbols[int(v % length)])

print result

