#List
list = [ 'abcd', 786 , 2.23, 'john', 70.2 ]
tinylist = [123, 'john']
#Dictinary List with key value pair
dict = {}
dict['one'] = "This is one"
dict[2]     = "This is two"
tinydict = {'name': 'john','code':6734, 'dept': 'sales'}

#tuple same as list but cannnot be updated
tuple = ( 'abcd', 786 , 2.23, 'john', 70.2  )
tinytuple = (123, 'john')


#Print List element

print (list)          # Prints complete list
print(list[0])       # Prints first element of the list
print(list[1:3])     # Prints elements starting from 2nd till 3rd
print(list[2:])      # Prints elements starting from 3rd element
print(tinylist * 2)  # Prints list two times
print(list + tinylist) # Prints concatenated lists

#print(Dictinary element
print(dict['one'])       # Prints value for 'one' key
print(dict[2])           # Prints value for 2 key
print(tinydict)          # Prints complete dictionary
print(tinydict.keys())   # Prints all the keys
print(tinydict.values()) # Prints all the values

#print(Tuple element
print(tuple)           # Prints complete list
print(tuple[0])       # Prints first element of the list
print(tuple[1:3])      # Prints elements starting from 2nd till 3rd
print(tuple[2:])       # Prints elements starting from 3rd element
print(tinytuple * 2)   # Prints list two times
print (tuple + tinytuple) # Prints concatenated lists