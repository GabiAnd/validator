# validator

  There are two Barcode validation standards: N10 and N13. 
Here are some valid examples of each:
 N10: 
  o 0471958697 
  o 067443000X 
  o 0 471 60695 2 
  o 0-470-84525-2 
  o 0-321-14653-0 

 N13: 
  o 9780470059029 
  o 978 0 471 48648 0 
  o 978-0596809485 
  o 978-0-13-149505-0 
  o 978-0-262-13472-9 
    
    N10 is made up of 9 digits plus a check digit (which may be ‘X’) and N13 is made up of 12 digits plus a check digit. Spaces and hyphens may be included in a code but are not significant. This means that 9780471486480 is equivalent to 978-0-471-48648-0 and 978 0 471 48648 0. The check digit for N10 is calculated by multiplying each digit by its position (i.e., 1 x 1st digit, 2 x 2nd digit, etc.), summing these products together and making modulo 11 of the result (with ‘X’ being used if the result is 10). The check digit for N13 is calculated by multiplying each digit alternately by 1 or 3 (i.e., 1 x 1st digit, 3 x 2nd digit, 1 x 3rd digit, 3 x 4th digit, etc.), summing these products together, taking modulo 10 of the result and subtracting this value from 10, and then taking the modulo 10 of the result again to produce a single digit.

Task: Create code that can validate both number types. The code should be created in a modular fashion so it can be used as a validation layer in an application and can be easily extended.
