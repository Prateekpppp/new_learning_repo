
# Common Operations in an Array 

# Declaring, instantiating, initializing an Array
# Inserting a value
# Traversing the array
# Accessing a given cell
# Searching a given value
# Deleting a given value


# Uses Of Array

# Create Hash Tables
# Create Stacks
# Create Queues

import sys
from array import *
from typing import List

# sys.path.append("arrayDir")
sys.path.append('../')
from my_utils import swaping


class basic_array_operations:

# 1. Write a Python program to create an array of 5 integers and display the array items. Access individual elements through indexes.
    arr = array('i',[1,2,3,4,5])

    def func1(self):
        
        for i in self.arr:
            # acces array items
            print(i)
            # acces array items
            print(self.arr[1])


# 2. Write a Python program to append a new item to the end of the array.
    
    def func2(self,lst: List[int]) -> array:
        for i in range(0,len(lst)):
            self.arr.append(lst[i])
            
        # print(self.arr)


# 3. Write a Python program to reverse the order of the items in the array.

    def func3(self):
        arr = self.arr
        self.func2([4,5])
        start_index = 0
        end_index = len(self.arr) - 1
        
        while start_index < end_index :
            
            arr[start_index] = arr[start_index] + arr[end_index] 
            arr[end_index] = arr[start_index] - arr[end_index] 
            arr[start_index] = arr[start_index] - arr[end_index] 

            # arr[start_index], arr[end_index] = arr[end_index], arr[start_index]
            start_index += 1
            end_index -= 1 

        return arr


# 4. Write a Python program to get the length in bytes of one array item in the internal representation.
    
    def func4(self):
        array_num = array('i', [1, 3, 5, 7, 9])
        print("Original array: "+str(array_num))
        print("Length in bytes of one array item: "+str(array_num.itemsize))


# 5. Write a Python program to get the number of occurrences of a specified element in an array. 
        
    def func5(self, el):

        cnt = 0
        for i in self.arr:
            if i == el:
                cnt += 1

        return cnt
    

# 6. List to array coonversion
    def func6(self):
        my_list = [1, 2, 3, 4, 5]

        # Convert list to array of integers
        my_array = array('i', my_list)
        return my_array


# 7. Write a Python program to insert a newly created item before the second element in an existing array. 

    def func7(self,new_item):
        old_arr = self.arr
        new_arr = array('i',[])
        new_arr = []

        for k in range(0,len(old_arr)):
            if k == 2:
                new_arr.append(new_item)

            new_arr.append(old_arr[k])
        return new_arr
    
        old_arr.insert(3, new_item)
        
        return old_arr


# 8. Write a Python program to remove a specified item using the index of an array. 
    
    def func8(self):
        array_num = self.arr

        print("Original array: "+str(array_num))
        array_num.pop(2)
        print("New array: "+str(array_num))


# 9. Write a Python program to remove the first occurrence of a specified element from an array.
        
    def func9(self):
        # array_num = self.arr
        array_num = array('i', [1, 3, 5, 3, 7, 1, 9, 3])

        print("Original array: "+str(array_num))
        array_num.remove(3)
        print("New array: "+str(array_num))
        
# 10. Write a Python program to convert an array to an ordinary list with the same items. 
        
    def func10(self):
        print(self.arr.tolist())


# 11. Python program to find out if a given array of integers contains any duplicate elements.
    
    def func11(self):
        arr = [1,1,2,2,3,3,4,4,5]
        n_arr = []
        for i in arr:
            if i in n_arr:
                continue
                return True

            n_arr.append(i)
        return n_arr
    

# 12. Python program to check whether it follows the sequence given in the patterns array.

    def func12(self, color, patterns):
        # print('complete this after some time......')

        if len(color) != len(patterns):
            return False
        
        sdict = {}
        pset = set()
        cset = set()

        for i in range(len(patterns)):

            pset.add(patterns[i])
            cset.add(color[i])

            if patterns[i] not in sdict.keys():
                sdict[patterns[i]] = []

            keys = sdict[patterns[i]]
            keys.append(color[i])
            sdict[patterns[i]] = keys

        # print(sdict)
            
        for val in sdict.values():
            for i in range(len(val)-1):
                if val[i] != val[i+1]:
                    return False

        return True
    
    
# 13. Python program to find a pair with the highest product from a given array of integers.
    
    def func13(self,arr):
        
        i = 0
        j = 0
        prod = 1
        prv_prod = 1

        l = len(arr)
        
        while j <= l-1:

            mx_prd = arr[j]
            
            if mx_prd == 0:
                j += 1
                continue

            prod = mx_prd*arr[i]

            if prod > prv_prod and i != j:
                prv_prod = prod

            if i < l-1:
                i += 1
            else:
                i = 0
                j += 1



        print(highest_product)
        return highest_product




obj = basic_array_operations()

# obj.func1()
# obj.func2([5,6])
# print(obj.func3())
# print(obj.func6())
# obj.func4()
# print(obj.func7(9))
# obj.func8()
# obj.func9()
# obj.func10()
# print(obj.func11())
# obj.func11()
# obj.func12(["red","green", "greenn"], ["a","b","b"])
# print(obj.func12(["red","green", "green"], ["a","b","b"]))
obj.func13([0, -1, -2, -4, 5, 0, -6])
# print(sys.path.append('newDsa'))