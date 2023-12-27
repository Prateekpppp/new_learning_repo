# Given an integer array nums, return an array answer such that answer[i] is equal to the product of all the elements of nums except nums[i].

# The product of any prefix or suffix of nums is guaranteed to fit in a 32-bit integer.

# You must write an algorithm that runs in O(n) time and without using the division operation.

def productofarrayexceptself(arr):
    i = 0
    mv = 0
    n =len(arr)
    narr = []
    sm = 0
    while(i<n):
        if(i != mv):
            sm += arr[i]*arr[mv]

        if(mv != n-1):
            mv+=1
        else:        
            i+=1
            mv = 0
            narr += [sm]
            sm = 0

    return narr

arr = [1,2,3,4]
print(productofarrayexceptself(arr))